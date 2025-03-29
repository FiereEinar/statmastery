<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CoursesPlaceholder extends Component
{
    public int $courses;
    /**
     * Create a new component instance.
     */
    public function __construct(int $courses = 4)
    {
        $this->courses = $courses;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.courses-placeholder');
    }
}
