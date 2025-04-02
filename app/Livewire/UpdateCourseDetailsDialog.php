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

    public function save() {
        $this->dispatch('submit-update-course-form');
        session()->flash('message', 'Course updated successfully!');
    }

    public function cancel() {
        
    }

    public function showUpdateCourseDetailsDialog() {
        $this->dialog()->id("update-course-details-dialog")->confirm([
            // 'onClose' => [
            //     'method' => 'save',
            // ]
            'icon' => false,
            'accept' => [
                'label' => 'Save Changes',
                'method' => 'save',
            ],
            'reject' => [
                'label' => 'Discard Changes',
                'method' => 'cancel',
            ],
        ]);
    }

    public function render()
    {
        return view('livewire.update-course-details-dialog');
    }
}