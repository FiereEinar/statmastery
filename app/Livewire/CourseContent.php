<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class CourseContent extends Component
{
    public Course $course;
    
    public function mount(Course $course) {
        $this->course = $course;
    }
    
    public function render()
    {
        return view('livewire.course-content');
    }
}