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

        $firstModule = $course->modules->firstWhere(fn ($m) => $m->contents->isNotEmpty());

        if ($firstModule) {
            $this->activeContent = $firstModule->contents->first();
        }
    }

    public function setActiveContent(CourseModuleContent $content) {
        $this->activeContent = $content;
        $this->dispatch('content-updated', $this->activeContent);
    }
    
    public function render()
    {
        return view('livewire.view-course-content');
    }
}