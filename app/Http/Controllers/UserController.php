<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\ProgressTracking;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function usersProgressView() {
        $user = auth()->guard("web")->user();
        $courses = Course::where('owner_id', $user->id)->get();
        
        return view('user-progress', [
            'user' => $user, 
            'courses' => $courses
        ]);
    }

    public function usersProgressOnCourseView(Course $course) {
        $user = auth()->guard("web")->user();
        $courses = Course::where('owner_id', $user->id)->get();
        $userProgress = ProgressTracking::
            where('user_id', $currentUser->id ?? '')->
            where('course_id', $course->id)->
            pluck('content_id')->
            toArray();

        $usersProgress = [];
        $courseModuleContentCount = 0;

        foreach ($course->modules as $module) {
            foreach ($module->contents as $content) {
                $courseModuleContentCount++;
            }
        }

        foreach ($course->enrollments as $enrollment) {
            $progress = ProgressTracking::where('user_id', $enrollment->user->id)->where('course_id', $course->id)->get();
            $usersProgress[$enrollment->user->id] = [
                'percentage' => sizeof($progress) / $courseModuleContentCount * 100,
                'completed' => sizeof($progress),
            ];
            // $usersProgress[$enrollment->user->id]['percentage'] = sizeof($progress) / $courseModuleContentCount * 100;
            // $usersProgress[$enrollment->user->id]['completed'] = sizeof($progress);
        }

        return view('user-progress-on-course', [
            'user' => $user, 
            'currentCourse' => $course,
            'courses' => $courses,
            'usersProgress' => $usersProgress,
            'courseModuleContentCount' => $courseModuleContentCount,
        ]);
    }

    public function usersSubmissionsView() {
        return view('user-submissions');
    }

    public function updateProfileView() {
        $user = auth()->guard("web")->user();
        return view("update-profile", ["user"=> $user]);
    }
}