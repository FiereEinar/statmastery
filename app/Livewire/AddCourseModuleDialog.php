<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class AddCourseModuleDialog extends Component
{
    public Course $course;
    
    public function mount(Course $course){
        $this->course = $course;
    }

    public function showDialog() {
        $this->dispatch('do-show-dialog-event', ['dialogID'=> 'add-course-module-dialog']);
    }

    public function render()
    {
        return view('livewire.add-course-module-dialog');
    }
}