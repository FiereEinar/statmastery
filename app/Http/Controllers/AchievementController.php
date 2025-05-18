<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Achievement;
use App\Models\Course;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    public function courseAchievementsView(Course $course) {
        $courseAchievements = Achievement::where('course_id', $course->id)->get();

        return view('course-achievements', [
            'user' => auth()->guard('web')->user(),
            'currentCourse' => $course,
            'courseAchievements' => $courseAchievements,
        ]);
    }

    public function createAchievementView(Course $course) {
        $user = auth()->guard('web')->user();

        return view('add-course-achievements', [
            'user' => $user,
            'currentCourse' => $course,
        ]);
    }

    public function createAchievement(Course $course, Request $request) {
        $body = $request->validate([
            'title' => 'required|string',
            'description' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,jpg,png',
        ]);

        $path = $request->file('file')->store('achievements', 'public');

        Achievement::create([
            'course_id' => $course->id,
            'title' => $body['title'],
            'description' => $body['description'],
            'file_path' => $path,
        ]);

        return redirect("/course/{$course->id}/achievements");
    }
}