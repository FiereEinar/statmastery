<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;

class AddCourseModuleDialog extends Component
{
    public Course $course;
    public $title;
    public $module_number = 0;
    
    public function mount(Course $course){
        $this->course = $course;
        $this->module_number = $course->modules()->max("module_number") + 1;
    }

    public function showDialog() {
        $this->dispatch('do-show-dialog-event', ['dialogID'=> 'add-course-module-dialog']);
    }

    public function addModule() {
        $this->dispatch('addCourseModule', [
            'title' => $this->title,
            'module_number' => $this->module_number,
        ]);
        $this->course->refresh();
        $this->module_number++;
        $this->reset('title');
    }

    public function render()
    {
        return view('livewire.add-course-module-dialog');
    }
}