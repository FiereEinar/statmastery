<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseModule;
use App\Models\CourseModuleContent;
use Livewire\Component;

class UpdateCourse extends Component
{
    public Course $course;
    public CourseModuleContent $activeContent;
    public $editorContent;

    protected $listeners = [
        'addCourseModule' => 'addCourseModule', 
        'addModuleContent' => 'addModuleContent',
        'saveContent' => 'saveContent'
    ];

    public function mount(Course $course) {
        $this->course = $course;
    }

    public function showAddModuleContentDialog($moduleID) {
        $this->dispatch('openAddModuleContentDialog', $moduleID);
    }

    public function addCourseModule($data) {
        $data['course_id'] = $this->course->id;
        CourseModule::create($data);
        $this->course->refresh();
    }

    public function addModuleContent($data)  {
        CourseModuleContent::create($data);
        $this->course->refresh();
    }

    public function setActiveContent(CourseModuleContent $content) {
        $this->activeContent = $content;
    }

    public function saveContent() {
        $this->activeContent->content = $this->editorContent;
        $this->activeContent->save();
        $this->course->refresh();
    }
    
    public function render()
    {
        return view('livewire.update-course');
    }
}