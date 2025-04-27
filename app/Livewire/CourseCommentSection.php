<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseComment;
use Livewire\Component;

class CourseCommentSection extends Component
{
    public Course $course;
    public $currentUser;
    public $comment = "";

    public function mount($course, $currentUser) {
        $this->course = $course;
        $this->currentUser = $currentUser;
    }

    public function addComment() {
        CourseComment::create([
            'user_id' => $this->currentUser->id,
            'course_id' => $this->course->id,
            'text' => $this->comment,
            'parent_id' => null,
        ]);

        $this->course->refresh();
        $this->reset(['comment']);
    }
    
    public function render()
    {
        return view('livewire.course-comment-section');
    }
}