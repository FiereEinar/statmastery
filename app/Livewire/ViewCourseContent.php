<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseModuleContent;
use Livewire\Component;

class ViewCourseContent extends Component
{
    public CourseModuleContent $activeContent;
    public Course $course;

    public function mount(Course $course) {
        $this->course = $course;
    }

    public function setActiveContent(CourseModuleContent $content) {
        $this->activeContent = $content;
    }
    
    public function render()
    {
        return view('livewire.view-course-content');
    }
}