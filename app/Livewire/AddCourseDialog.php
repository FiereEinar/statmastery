<?php

namespace App\Livewire;

use Livewire\Component;

class AddCourseDialog extends Component
{
    public function showDialog() {
        $this->dispatch('do-show-dialog-event', ['dialogID'=> 'add-course-dialog']);
    }
    
    public function render()
    {
        return view('livewire.add-course-dialog');
    }
}