<?php

namespace App\Livewire;

use App\Models\CourseModuleContent;
use Livewire\Component;

class UpdateModuleContentQuizzes extends Component
{
    public CourseModuleContent $module_content;

    public function mount(CourseModuleContent $module_content) {
        $this->module_content = $module_content;
    }
    
    public function render()
    {
        return view('livewire.update-module-content-quizzes');
    }
}