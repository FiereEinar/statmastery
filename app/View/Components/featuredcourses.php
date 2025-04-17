<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class featuredcourses extends Component
{
    public $courses;

    /**
     * Create a new component instance.
     */
    public function __construct($courses)
    {
        $this->courses = $courses;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.featuredcourses');
    }
}