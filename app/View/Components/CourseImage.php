<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CourseImage extends Component
{
    public string $source;
    public string $className = '';
    /**
     * Create a new component instance.
     */
    public function __construct(string $source, string $className = '')
    {
        $this->source = $source;
        $this->className = $className;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.course-image');
    }
}