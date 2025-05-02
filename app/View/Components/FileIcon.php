<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FileIcon extends Component
{
    public string|null $fileExt;
    public string $className;

    /**
     * Create a new component instance.
     */
    public function __construct($fileExt = null, $className = '')
    {
        $this->fileExt = $fileExt;
        $this->className = $className;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.file-icon');
    }
}