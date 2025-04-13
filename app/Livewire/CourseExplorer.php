<?php

namespace App\Livewire;

use App\Models\Course;
use App\Models\CourseCategory;
use Livewire\Component;

class CourseExplorer extends Component
{

    public $courses;
    public $categories;
    public ?CourseCategory $activeCategory;

    public function mount($courses, $categories) {
        $this->courses = $courses;
        $this->categories = $categories;
    }

    public function setActiveCategory(CourseCategory $category) {
        $this->activeCategory = $category;
    }

    public function resetActiveCategory() {
        $this->activeCategory = null;
    }

    public function render()
    {
        return view('livewire.course-explorer');
    }
}