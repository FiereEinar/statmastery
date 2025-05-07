<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function bookAppointmentView(){
        $events = Event::all()->toArray();
        return view('gcalendar', ['events' => $events]);
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

        Event::create($validated);
        return response()->json([
            'success' => true
        ]);
    }

    public function updateBooking(Event $event, Request $request) {
        $validated = $request->validate([
            'title' => ['required'],
            'is_all_day' => ['required'],
            'start' => ['required'],
            'end' => ['required'],
            'description' => ['required'],
        ]);

        $event->update($validated);
        return response()->json([
            'success' => true,
        ]);
    }

    public function deleteBooking(Event $event) {
        $event->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}