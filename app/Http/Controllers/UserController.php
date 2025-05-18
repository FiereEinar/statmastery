<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\CourseModuleContent;
use App\Models\ProgressTracking;
use App\Models\User;
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
        }

        return view('user-progress-on-course', [
            'user' => $user, 
            'currentCourse' => $course,
            'courses' => $courses,
            'usersProgress' => $usersProgress,
            'courseModuleContentCount' => $courseModuleContentCount,
        ]);
    }

    public function usersSubmissionsView(User $user, Course $course) {
        $currentUser = auth()->guard("web")->user();
        $courses = Course::where('owner_id', $currentUser->id)->get();
        // $userQuizSubmissionsOnCourse = $user->quizSubmissions()->where('course_id', $course->id)->get();
        
        $courseQuizzes = collect();
        foreach ($course->modules as $module) {
            $quizzes = $module->contents->where('content_type_id', 2);
            $courseQuizzes = $courseQuizzes->merge($quizzes);
        }

        $userQuizSubmissionsOnCourse = collect();
        foreach ($courseQuizzes as $quiz) {
            $userSubmissions = $user->quizSubmissions()->where('quiz_id', $quiz->id)->get();
            $userQuizSubmissionsOnCourse = $userQuizSubmissionsOnCourse->merge($userSubmissions);
        }
        
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
        }

        return view('user-submissions', [
            'user' => $currentUser, 
            'student' => $user,
            'currentCourse' => $course,
            'courses' => $courses,
            'usersProgress' => $usersProgress,
            'courseModuleContentCount' => $courseModuleContentCount,
            'courseQuizzes' => $courseQuizzes,
            'userQuizSubmissionsOnCourse' => $userQuizSubmissionsOnCourse,
        ]);
    }

    public function courseQuizzesView(Course $course) {
        $currentUser = auth()->guard("web")->user();
        
        $courseQuizzes = collect();
        foreach ($course->modules as $module) {
            $quizzes = $module->contents->where('content_type_id', 2);
            $courseQuizzes = $courseQuizzes->merge($quizzes);
        }

        $courseModuleContentCount = 0;

        foreach ($course->modules as $module) {
            foreach ($module->contents as $content) {
                $courseModuleContentCount++;
            }
        }

        return view('course-quizzes', [
            'user' => $currentUser, 
            'currentCourse' => $course,
            'courseModuleContentCount' => $courseModuleContentCount,
            'courseQuizzes' => $courseQuizzes,
        ]);
    }

    public function courseQuizzesSubmissionsView(Course $course, CourseModuleContent $content) {
        $currentUser = auth()->guard("web")->user();

        return view('course-quizzes-submissions', [
            'user' => $currentUser, 
            'currentCourse' => $course,
            'quiz' => $content
        ]);
    }

    public function updateProfileView() {
        $user = auth()->guard("web")->user();
        return view("update-profile", ["user"=> $user]);
    }
}