<?php

use App\Http\Controllers\AchievementController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GoogleCalendarController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PasswordResetController;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::get('/login', [AuthController::class, 'loginView']);
Route::get('/signup', [AuthController::class, 'signupView']);

Route::get('/v1/api/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/v1/api/login', [AuthController::class, 'login'])->name('login');
Route::post('/v1/api/signup', [AuthController::class, 'signup']);

Route::get('/google/redirect/admin', [AuthController::class, 'redirectToGoogleAdmin']);
Route::get('/google/callback/admin', [AuthController::class, 'handleGoogleCallbackAdmin']);

Route::get('/google/redirect', [GoogleCalendarController::class, 'redirectToGoogle']);
Route::get('/google/callback', [GoogleCalendarController::class, 'handleGoogleCallback']);

Route::get('/forgot-password', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [PasswordResetController::class, 'reset'])->name('password.update');

// Apply 'auth.check' middleware to all course-related routes
Route::middleware(['auth.check'])->group(function () {
    Route::get('/dashboard', [CourseController::class, 'dashboard']);
    Route::get('/submissions', [UserController::class, 'submissionsView']);
    Route::get('/gcalendar', [BookingController::class, 'bookAppointmentView']);
    
    // Course routes
    Route::get('/course/{course}/edit', [CourseController::class, 'courseEditView']);
    Route::get('/course/{course}/content', [CourseController::class, 'viewCourseContent']);
    Route::get('/profile/update', [UserController::class, 'updateProfileView']);
    Route::get('/profile/achievements', [UserController::class, 'userAchievementsView']);
    
    Route::post('/v1/api/course/{course}/checkout', [CourseController::class, 'createACheckout']);
    Route::put('/v1/api/course/{course}', [CourseController::class, 'updateCourse']);
    Route::post('/v1/api/course/{course}/module', [CourseController::class, 'createCourseModule']);
    Route::post('/v1/api/course', [CourseController::class, 'createCourse']);
    
    Route::get('/v1/api/booking/google/events', [BookingController::class, 'fetchGoogleEvents']);
    Route::get('/v1/api/booking/array', [BookingController::class, 'refetchEvents'])->name('booking.array');
    Route::post('/v1/api/booking', [BookingController::class, 'createBooking']);
    Route::put('/v1/api/booking/{event}', [BookingController::class, 'updateBooking']);
    Route::delete('/v1/api/booking/{event}', [BookingController::class, 'deleteBooking']);

    // Admin routes
    Route::middleware('auth.admin')->group(function () {
        Route::get('/course/create', [CourseController::class, 'createCourseView']);
        Route::get('/course/{course}/achievements/create', [AchievementController::class, 'createAchievementView']);
        Route::post('/v1/api/course/{course}/achievements/create', [AchievementController::class, 'createAchievement']);
        Route::get('/booking', [BookingController::class, 'bookingsView']);
        Route::get('/user/progress', [UserController::class, 'usersProgressView']);
        Route::get('/user/progress/course/{course}', [UserController::class, 'usersProgressOnCourseView']);
        Route::get('/course/{course}/achievements', [AchievementController::class, 'courseAchievementsView']);
        Route::get('/user/progress/course/{course}/quizzes', [UserController::class, 'courseQuizzesView']);
        Route::get('/user/progress/course/{course}/quizzes/{content}', [UserController::class, 'courseQuizzesSubmissionsView']);
        Route::get('/user/progress/course/{course}/quizzes/{content}/download', [UserController::class, 'downloadCourseQuizzesSubmissionsView']);
        Route::get('/user/{user}/submission/course/{course}', [UserController::class, 'usersSubmissionsView']);

        Route::put('/v1/api/booking/{event}/approve', [BookingController::class, 'approveEventHandler']);
    });
});

// Public course route
Route::get('/', [CourseController::class, 'home']);
Route::get('/course', [CourseController::class, 'coursesView']);
Route::get('/course/{course}', [CourseController::class, 'viewCourse']);