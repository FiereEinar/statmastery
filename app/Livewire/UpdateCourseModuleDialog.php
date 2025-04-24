<?php

namespace App\Livewire;

use App\Models\CourseModule;
use Livewire\Component;

class UpdateCourseModuleDialog extends Component
{
    /** @var CourseModule */
    public CourseModule $module;
    public $title;
    public $module_number;

    protected $listeners = ['openUpdateCourseModuleDialog'];
    
    public function openUpdateCourseModuleDialog($moduleId) {
        $this->module = CourseModule::findOrFail($moduleId);
        $this->title = $this->module->title;
        $this->module_number = $this->module->module_number;
        $this->dispatch('do-show-dialog-event', ['dialogID'=> 'update-course-module-dialog']);
    }
    
    public function updateModule() {
        $this->module->update(['title' => $this->title, 'module_number' => $this->module_number]);
        $this->module->refresh();
        $this->dispatch('refresh-course');
    }
    
    public function render()
    {
        return view('livewire.update-course-module-dialog');
    }

}