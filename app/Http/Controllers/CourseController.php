<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModule;
use App\Models\Payment;
use App\Models\ProgressTracking;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class CourseController extends Controller
{
    public function coursesView() {
        $courses = Course::all();
        return view('courses', ['courses'=> $courses]);
    }

    public function courseEditView(Course $course) {
        return view('edit-course', ['course'=> $course]);
    }
    
    public function createCourseView() {
        return view('create-course');
    }

    public function viewCourse(Course $course) {
        $client = new Client();
        $userPayments = Payment::where('user_id', auth()->guard('web')->user()->id)->where('course_id', $course->id)->get();
        $PAYMONGO_SECRET = config('app.PAYMONGO_SECRET');
        $hasPayed = false;

        // First check all previous payments
        foreach ($userPayments as $payment) {
            $checkoutResponse = $client->request('GET', "https://api.paymongo.com/v1/checkout_sessions/{$payment->checkout_session_id}", [
                'headers' => [
                    'accept' => 'application/json',
                    'Authorization' => "Basic {$PAYMONGO_SECRET}",
                ],
                'verify' => false
            ]);

            $checkout = json_decode($checkoutResponse->getBody(), true);

            $status = $checkout['data']['attributes']['payment_intent']['attributes']['status'] ?? null;
            if ($status === 'succeeded') {
                $hasPayed = true;
                break;
            }
        }

        $userProgress = ProgressTracking::where('user_id', auth()->guard('web')->user()->id)->where('course_id', $course->id)->pluck('content_id')->toArray();

        return view('view-course', ['course'=> $course, 'hasPayed' => $hasPayed, 'userProgress' => $userProgress]);
    }

    public function createCourse(Request $request) {
        $body = $request->validate([
            "title" => ["required", "min:3", "max:255"],
            "description" => ["required", "min:3", "max:255"],
            "thumbnail"=> ["required"],
            "badge"=> ["required", "in:Beginner,Intermediate,Advanced"],
            "overview"=> ["required"],
            "time_to_complete"=> ["required"],
            "price"=> ["required"],
        ]);

        $body['owner_id'] = auth()->guard('web')->user()->id;
        $course = Course::create($body);
        return redirect("/course/{$course->id}/edit");
    }
    
    public function updateCourse(Course $course, Request $request) {
        $body = $request->validate([
            "title" => ["required", "min:3", "max:255"],
            "description" => ["required", "min:3", "max:255"],
            "thumbnail"=> ["required"],
            "badge"=> ["required", "in:Beginner,Intermediate,Advanced"],
            "overview"=> ["required"],
            "time_to_complete"=> ["required"],
            "price"=> ["required"],
            "subscription_type"=> ["required", "in:Free,Paid"],
        ]);

        if (auth()->guard('web')->user()->id !== $course->owner_id) {
            return redirect('/course');
        }

        $course->update($body);
        return redirect("/course/{$course->id}/edit");
    }

    public function createCourseModule(Course $course, Request $request) {
        $body = $request->validate([
            "title" => ["required", "min:3", "max:255"],
            "module_number"=> ["required"],
        ]);

        $body['course_id'] = $course->id;
        CourseModule::create($body);
        return redirect("/course/{$course->id}/edit");
    }

    public function viewCourseContent(Course $course) {
        $userProgress = ProgressTracking::where('user_id', auth()->guard('web')->user()->id)->where('course_id', $course->id)->pluck('content_id')->toArray();
        return view('course-content', ['course'=> $course, 'userProgress' => $userProgress]);
    }

    public function createACheckout(Course $course) {
        if ($course->price === 0 || $course->subscription_type === 'Free') {
            return redirect("/course/{$course->id}/content"); 
        }

        $client = new Client();
        $PAYMONGO_SECRET = config('app.PAYMONGO_SECRET');
        $currentUser = auth()->guard('web')->user();
        $userPayments = Payment::where('user_id', $currentUser->id)->where('course_id', $course->id)->get();
        $hasPayed = false;
        $activeLink = null;

        // First check all previous payments
        foreach ($userPayments as $payment) {
            $checkoutResponse = $client->request('GET', "https://api.paymongo.com/v1/checkout_sessions/{$payment->checkout_session_id}", [
                'headers' => [
                    'accept' => 'application/json',
                    'Authorization' => "Basic {$PAYMONGO_SECRET}",
                ],
                'verify' => false
            ]);

            $checkout = json_decode($checkoutResponse->getBody(), true);

            $status = $checkout['data']['attributes']['payment_intent']['attributes']['status'] ?? null;
            $linkStatus = $checkout['data']['attributes']['status'] ?? null;
            if ($status === 'succeeded') {
                $hasPayed = true;
                break;
            }

            if ($linkStatus === 'active') {
                $activeLink = $checkout['data']['attributes']['checkout_url'];
            }
        }

        if ($hasPayed) {
            // Redirect to course content if payment succeeded
            return redirect("/course/{$course->id}/content");
        }

        if ($activeLink !== null) {
            return redirect($activeLink);
        }

        // Otherwise, create a new checkout session
        $response = $client->request('POST', 'https://api.paymongo.com/v1/checkout_sessions', [
            'body' => json_encode([
                'data' => [
                    'attributes' => [
                        'send_email_receipt' => true,
                        'show_description' => true,
                        'show_line_items' => true,
                        'description' => 'Course payment',
                        'line_items' => [[
                            'currency' => 'PHP',
                            'amount' => $course->price * 100,
                            'name' => $course->title,
                            'quantity' => 1
                        ]],
                        'payment_method_types' => ['gcash', 'paymaya']
                    ]
                ]
            ]),
            'headers' => [
                'Content-Type' => 'application/json',
                'accept' => 'application/json',
                'Authorization' => "Basic {$PAYMONGO_SECRET}",
            ],
            'verify' => false
        ]);

        $body = json_decode($response->getBody(), true);

        $checkoutUrl = $body['data']['attributes']['checkout_url'];
        $checkoutID = $body['data']['id'];

        Payment::create([
            'user_id' => $currentUser->id,
            'course_id' => $course->id,
            'checkout_session_id' => $checkoutID,
            'amount' => $course->price
        ]);

        return redirect()->away($checkoutUrl);
    }
}