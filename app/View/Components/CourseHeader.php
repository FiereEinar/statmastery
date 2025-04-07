<?php

namespace App\View\Components;

use App\Models\Course;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CourseHeader extends Component
{
    public Course $course;
    public string $type;
    /**
     * Create a new component instance.
     */
    public function __construct(Course $course, string $type = 'view')
    {
        $this->course = $course;
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.course-header');
    }
}