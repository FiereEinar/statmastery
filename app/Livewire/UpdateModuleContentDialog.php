<?php

namespace App\Livewire;

use App\Models\CourseModuleContent;
use Livewire\Component;

class UpdateModuleContentDialog extends Component
{
    /** @var CourseModuleContent */
    public CourseModuleContent $content;
    public $title;
    public $content_number;

    protected $listeners = ['openUpdateModuleContentDialog'];

    public function openUpdateModuleContentDialog($contentID) {
        $this->content = CourseModuleContent::findOrFail($contentID);
        $this->title = $this->content->title;
        $this->content_number = $this->content->content_number;
        $this->dispatch('do-show-dialog-event', ['dialogID'=> 'update-module-content-dialog']);
    }

    public function updateModuleContent() {
        $this->content->update(['title' => $this->title, 'content_number' => $this->content_number]);
        $this->content->refresh();
        $this->dispatch('refresh-course');
    }
    
    public function render()
    {
        return view('livewire.update-module-content-dialog');
    }
}