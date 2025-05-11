<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\EventResource;
use App\Models\Event;
use Carbon\Carbon;
use Exception;
use Google_Service_Exception;
use Illuminate\Http\Request;
use Google\Client;
use Google\Service\Calendar as GoogleCalendar;
use Google\Service\Calendar\Event as GoogleEvent;
use Illuminate\Support\Facades\Session;
use Google\Service\Calendar\EventDateTime;

class BookingController extends Controller
{
    public function bookAppointmentView(){
        $events = $this->fetchGoogleAndLocalEvents();
        
        // dd($events);

        return view('gcalendar', ['events' => $events]);
    }

    protected function fetchGoogleCalendarEvents()
    {
        $client = new Client();
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $client->setHttpClient($guzzleClient);
        $client->setAccessToken(Session::get('google_token'));

        if ($client->isAccessTokenExpired()) {
            // Refresh or redirect to re-authenticate
            return ['token expired'];
        }

        $service = new GoogleCalendar($client);
        $calendarId = 'primary';

        $optParams = [
            // 'maxResults' => 100,
            // 'orderBy' => 'startTime',
            // 'singleEvents' => true,
            // 'timeMin' => now()->toRfc3339String(),
        ];

        $results = $service->events->listEvents($calendarId, $optParams);
        return $results->getItems();
    }

    protected function fetchGoogleAndLocalEvents() {
        $events = Event::all()->toArray();

        // Check if token is available
        if (Session::has('google_token')) {
            $googleEvents = $this->fetchGoogleCalendarEvents();

            // Get all stored google_event_id values
            $localGoogleIds = Event::whereNotNull('google_event_id')->pluck('google_event_id')->toArray();

            // Optionally merge or deduplicate them with local $events
            foreach ($googleEvents as $gEvent) {
                if (in_array($gEvent->id, $localGoogleIds)) {
                    continue; // Skip if already saved locally
                }

                // date format = "2023-01-01 00:00:00"
                // $startDateArr[0] = "2023-01-01"
                // $startDateArr[1] = "00:00:00"
                // $startDateArr = explode(' ', $gEvent->start);

                // dd([
                //     $gEvent->start,
                //     Carbon::parse($gEvent->start->dateTime)->format('Y-m-d H:i'),
                // ]);
                $events[] = [
                    'title' => $gEvent->summary,
                    'start' => Carbon::parse($gEvent->start->dateTime)->format('Y-m-d H:i'),
                    'end' => Carbon::parse($gEvent->end->dateTime)->format('Y-m-d H:i'),
                    'description' => $gEvent->description,
                    // 'event_id' => $gEvent->id,
                    'googe_event_id' => $gEvent->id,
                    'source' => 'google',
                    'status' => 1
                ];
            }

            for ($i = 0; $i < count($events); $i++) {
                // if pending status, color yellow
                if ($events[$i]['status'] === 0) {
                    $events[$i]['backgroundColor'] = '#fcba03';
                }
            }

            // dd([$events, $googleEvents]);
        }

        return $events;
    }

    public function refetchEvents() {
        $events = $this->fetchGoogleAndLocalEvents();

        return $events;
    }

    public function fetchGoogleEvents() {
        $events = [];

        // Check if token is available
        if (Session::has('google_token')) {
            $googleEvents = $this->fetchGoogleCalendarEvents();

            // Optionally merge or deduplicate them with local $events
            foreach ($googleEvents as $gEvent) {
                $events[] = [
                    'title' => $gEvent->getSummary(),
                    'start' => $gEvent->getStart()->getDateTime() ?? $gEvent->getStart()->getDate(),
                    'end' => $gEvent->getEnd()->getDateTime() ?? $gEvent->getEnd()->getDate(),
                    'description' => $gEvent->getDescription(),
                    'source' => 'google'
                ];
            }
        }

        return response()->json([
            'events' => $events,
            'googleEvents' => $googleEvents
        ]);
    }

    public function createBooking(Request $request){ 
        $validated = $request->validate([
            'title' => ['required'],
            'is_all_day' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
            'description' => ['required'],
        ]);

        $currentUser = auth()->guard('web')->user();
        $validated['user_id'] = $currentUser->id;

        $event = Event::create($validated);

        // Also create in Google Calendar
        if (Session::has('google_token')) {
            $this->createGoogleCalendarEvent($event);
        }

        return response()->json([
            'success' => true
        ]);
    }

    protected function createGoogleCalendarEvent(Event $event)
    {
        $client = new Client();
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $client->setHttpClient($guzzleClient);
        $client->setAccessToken(Session::get('google_token'));

        if ($client->isAccessTokenExpired()) return;

        $service = new GoogleCalendar($client);

        $startDate = Carbon::parse($event->start, 'Asia/Manila')->setTimezone('Asia/Manila')->toRfc3339String();
        $endDate = Carbon::parse($event->end, 'Asia/Manila')->setTimezone('Asia/Manila')->toRfc3339String();

        $gEvent = new GoogleEvent([
            'summary' => $event->title,
            'description' => $event->description,
            'start' => ['dateTime' => $startDate, 'timeZone' => 'Asia/Manila'],
            'end' => ['dateTime' => $endDate, 'timeZone' => 'Asia/Manila'],
            'creator' => ['id' => auth()->guard('web')->user()->id],
        ]);

        $createdEvent = $service->events->insert('primary', $gEvent);

        // Store google_event_id in local DB for future updates
        $event->google_event_id = $createdEvent->id;
        $event->save();
    }

    public function updateBooking(Event $event, Request $request) {
        $validated = $request->validate([
            'title' => ['required'],
            'is_all_day' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
            'description' => ['required'],
            'google_event_id' => ['nullable'], // optional
        ]);

        $currentUser = auth()->guard('web')->user();
        if ($currentUser->id !== $event->user_id) {
            return response()->json([
                'success' => false,
            ]);
        }

        $event->update($validated);
        $error = null;
        
        if ($event->google_event_id && Session::has('google_token')) {
            try {
                $this->updateGoogleCalendarEvent($event);
            } catch (Google_Service_Exception $e) {
                $error = $e->getMessage();
            }
        }

        return response()->json([
            'success' => true,
            'error' => $error
        ]);
    }

    protected function updateGoogleCalendarEvent(Event $event)
    {
        try {
            $client = new Client();
            $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
            $client->setHttpClient($guzzleClient);
            $client->setAccessToken(Session::get('google_token'));
    
            $service = new GoogleCalendar($client);
    
            $gEvent = $service->events->get('primary', $event->google_event_id);
            $gEvent->setSummary($event->title);
            $gEvent->setDescription($event->description);
            $gEvent->setStart(new EventDateTime(['dateTime' => $event->start, 'timeZone' => 'Asia/Manila']));
            $gEvent->setEnd(new EventDateTime(['dateTime' => $event->end, 'timeZone' => 'Asia/Manila']));
            // $gEvent->setStart(['dateTime' => $event->start, 'timeZone' => 'Asia/Manila']);
            // $gEvent->setEnd(['dateTime' => $event->end, 'timeZone' => 'Asia/Manila']);
    
            $service->events->update('primary', $event->google_event_id, $gEvent);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteBooking(Event $event) {
        $event->delete();

        if ($event->google_event_id && Session::has('google_token')) {
            $this->deleteGoogleCalendarEvent($event->google_event_id);
        }

        return response()->json([
            'success' => true,
        ]);
    }

    protected function deleteGoogleCalendarEvent($googleEventId)
    {
        $client = new Client();
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $client->setHttpClient($guzzleClient);
        $client->setAccessToken(Session::get('google_token'));

        $service = new GoogleCalendar($client);
        $service->events->delete('primary', $googleEventId);
    }
}