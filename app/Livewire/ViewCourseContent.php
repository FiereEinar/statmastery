<?php
namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseModuleContent;
use App\Models\ProgressTracking;
use Livewire\Component;

class ViewCourseContent extends Component
{
    public CourseModuleContent $activeContent;
    public Course $course;
    public $userProgress;

    public function mount(Course $course, $userProgress) {
        $this->course = $course;
        $this->userProgress = $userProgress;

        $firstModule = $course->modules->firstWhere(fn ($m) => $m->contents->isNotEmpty());

        if ($firstModule) {
            $this->activeContent = $firstModule->contents->first();
        }
    }

    public function setActiveContent(CourseModuleContent $content) {
        $this->activeContent = $content;
        $this->dispatch('content-updated', $this->activeContent);
    }

    public function markAsCompleted() {
        $progressRecord = ProgressTracking::
        where('user_id', auth()->guard('web')->user()->id)->
        where('course_id', $this->course->id)->
        where('module_id', $this->activeContent->course_module_id)->
        where('content_id', $this->activeContent->id)->first();

        if ($progressRecord) {
            return;
        }

        ProgressTracking::create([
            'user_id' => auth()->guard('web')->user()->id,
            'course_id' => $this->course->id,
            'module_id'=> $this->activeContent->course_module_id,
            'content_id'=> $this->activeContent->id
        ]);

        array_push($this->userProgress, $this->activeContent->id);
    }
    
    public function render()
    {
        return view('livewire.view-course-content');
    }
}