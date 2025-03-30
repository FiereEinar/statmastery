<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function getCourses() {
        $courses = Course::all();
        return response()->json($courses);
    }

    public function coursesView() {
        $courses = Course::all();
        return view('courses', ['courses'=> $courses]);
    }

    public function courseEditView(Course $course) {
        return view('edit-course', ['course'=> $course]);
    }

    public function createCourse(Request $request) {
        $body = $request->validate([
            "title" => ["required", "min:3", "max:255"],
            "description" => ["required", "min:3", "max:255"],
            "thumbnail"=> ["required"],
        ]);

        Course::create($body);
        return redirect('/course/{$course->id}/edit');
    }
}
