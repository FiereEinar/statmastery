<?php

namespace App\Livewire;

use App\Models\CourseModuleContent;
use Livewire\Component;

class UpdateModuleContentQuizzes extends Component
{
    public CourseModuleContent $moduleContent;

    public function mount(CourseModuleContent $moduleContent) {
        $this->moduleContent = $moduleContent->load('contentQuizzes');
    }
    
    public function render()
    {
        return view('livewire.update-module-content-quizzes');
    }
}