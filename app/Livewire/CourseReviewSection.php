<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseReview;
use Livewire\Component;

class CourseReviewSection extends Component
{
    public Course $course;
    public $currentUser;
    public $review = "";
    public $stars = 5;

    public function mount(Course $course, $currentUser) {
        $this->course = $course;
        $this->currentUser = $currentUser;
    }

    public function addReview() {
        CourseReview::create([
            'user_id' => $this->currentUser->id,
            'course_id' => $this->course->id,
            'text' => $this->review,
            'stars' => $this->stars,
        ]);

        $this->course->refresh();
        $this->reset(['review', 'stars']);
    }
    
    public function render()
    {
        return view('livewire.course-review-section');
    }
}