<?php

namespace App\Livewire;

use App\Models\CourseModule;
use Livewire\Component;

class AddModuleContentDialog extends Component
{
    /** @var CourseModule */
    public CourseModule $module;
    public $title;
    public $content_number = 1;

    protected $listeners = ['openAddModuleContentDialog'];

    public function openAddModuleContentDialog($moduleId){
        $this->module = CourseModule::findOrFail($moduleId);
        $this->content_number = $this->module->contents()->max("content_number") + 1;
        $this->dispatch('do-show-dialog-event', ['dialogID'=> 'add-module-content-dialog']);
    }

    public function showDialog() {
        $this->dispatch('do-show-dialog-event', ['dialogID'=> 'add-module-content-dialog']);
    }

    public function addModuleContent() {
        $this->dispatch('addModuleContent', [
            'title' => $this->title,
            'content_number' => $this->content_number,
            'course_module_id' => $this->module->id,
            'content' => 'Write your content here.',
        ]);
        $this->module->refresh();
        $this->content_number++;
        $this->reset('title');
    }

    public function render()
    {
        return view('livewire.add-module-content-dialog');
    }
}