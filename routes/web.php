<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::get('/login', [AuthController::class, 'loginView']);
Route::get('/signup', [AuthController::class, 'signupView']);

Route::get('/v1/api/logout', [AuthController::class, 'logout']);
Route::post('/v1/api/login', [AuthController::class, 'login']);
Route::post('/v1/api/signup', [AuthController::class, 'signup']);

Route::get('/google/redirect/admin', [AuthController::class, 'redirectToGoogleAdmin']);
Route::get('/google/callback/admin', [AuthController::class, 'handleGoogleCallbackAdmin']);

Route::get('/google/redirect', [GoogleCalendarController::class, 'redirectToGoogle']);
Route::get('/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);

// Apply 'auth.check' middleware to all course-related routes
Route::middleware(['auth.check'])->group(function () {
    Route::get('/dashboard', [CourseController::class, 'dashboard']);
    Route::get('/gcalendar', [BookingController::class, 'bookAppointmentView']);
    
    // Course routes
    Route::get('/course/create', [CourseController::class, 'createCourseView'])->middleware('auth.admin');
    Route::get('/course/{course}/edit', [CourseController::class, 'courseEditView']);
    Route::get('/course/{course}/content', [CourseController::class, 'viewCourseContent']);
    Route::get('/profile/update', [UserController::class, 'updateProfileView']);
    
    Route::post('/v1/api/course/{course}/checkout', [CourseController::class, 'createACheckout']);
    Route::put('/v1/api/course/{course}', [CourseController::class, 'updateCourse']);
    Route::post('/v1/api/course/{course}/module', [CourseController::class, 'createCourseModule']);
    Route::post('/v1/api/course', [CourseController::class, 'createCourse']);
    
    Route::get('/v1/api/booking/array', [BookingController::class, 'refetchEvents'])->name('booking.array');
    Route::post('/v1/api/booking', [BookingController::class, 'createBooking']);
    Route::put('/v1/api/booking/{event}', [BookingController::class, 'updateBooking']);
    Route::delete('/v1/api/booking/{event}', [BookingController::class, 'deleteBooking']);
});
Route::get('/v1/api/booking/google/events', [BookingController::class, 'fetchGoogleEvents']);

// Public course route
Route::get('/', [CourseController::class, 'home']);
Route::get('/course', [CourseController::class, 'coursesView']);
Route::get('/course/{course}', [CourseController::class, 'viewCourse']);