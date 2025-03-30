<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

// Auth routes
Route::get('/login', [AuthController::class, 'loginView']);
Route::get('/signup', [AuthController::class, 'signupView']);

Route::get('/v1/api/logout', [AuthController::class, 'logout']);
Route::post('/v1/api/login', [AuthController::class, 'login']);
Route::post('/v1/api/signup', [AuthController::class, 'signup']);

// Course routes
Route::get('/course/{course}/edit', [CourseController::class, 'courseEditView']);
Route::put('/course/{course}', [CourseController::class, 'updateCourse']);
Route::get('/course', [CourseController::class, 'coursesView']);
Route::get('/v1/api/course', [CourseController::class, 'getCourses']);
Route::post('/v1/api/course', [CourseController::class, 'createCourse']);
