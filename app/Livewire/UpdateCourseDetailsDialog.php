<?php

namespace App\Livewire;

use App\Models\Course;
use Livewire\Component;
use WireUi\Traits\WireUiActions;

class UpdateCourseDetailsDialog extends Component
{
    use WireUiActions;

    public Course $course;
    public function mount(Course $course){
        $this->course = $course;
    }

    public function showDialog() {
        $this->dispatch('do-show-dialog-event', ['dialogID' => 'update-course-details-dialog']);
    }

    public function render()
    {
        return view('livewire.update-course-details-dialog');
    }
}