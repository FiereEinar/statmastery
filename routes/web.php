<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});


// Auth routes
Route::get('/login', [AuthController::class, 'loginView']);
Route::get('/signup', [AuthController::class, 'signupView']);

Route::get('/v1/api/logout', [AuthController::class, 'logout']);
Route::post('/v1/api/login', [AuthController::class, 'login']);
Route::post('/v1/api/signup', [AuthController::class, 'signup']);

// Apply 'auth.check' middleware to all course-related routes
Route::middleware(['auth.check'])->group(function () {
    Route::get('/dashboard', [CourseController::class, 'dashboard']);
    
    // Course routes
    Route::get('/course/{course}/edit', [CourseController::class, 'courseEditView']);
    Route::get('/course/create', [CourseController::class, 'createCourseView']);
    Route::get('/course/{course}/content', [CourseController::class, 'viewCourseContent']);
    
    Route::post('/v1/api/course/{course}/checkout', [CourseController::class, 'createACheckout']);
    Route::put('/v1/api/course/{course}', [CourseController::class, 'updateCourse']);
    Route::post('/v1/api/course/{course}/module', [CourseController::class, 'createCourseModule']);
    Route::post('/v1/api/course', [CourseController::class, 'createCourse']);
});

// Public course route
Route::get('/course', [CourseController::class, 'coursesView']);
Route::get('/course/{course}', [CourseController::class, 'viewCourse']);