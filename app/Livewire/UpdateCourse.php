<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseModule;
use Livewire\Component;

class UpdateCourse extends Component
{
    public Course $course;

    protected $listeners = ['addCourseModule' => 'addCourseModule'];

    public function mount(Course $course) {
        $this->course = $course;
    }

    public function addCourseModule($data) {
        $data['course_id'] = $this->course->id;
        CourseModule::create($data);
        $this->course->refresh();
    }
    
    public function render()
    {
        return view('livewire.update-course');
    }
}