<?php

namespace App\View\Components;

use App\Models\Course;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CourseCard extends Component
{
    public string $badgeColor;
    public Course $course;
    
    /**
     * Create a new component instance.
     */
    public function __construct(Course $course, string $badgeColor = 'success')
    {
        $this->course = $course;
        $this->badgeColor = $badgeColor;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.course-card');
    }
}
