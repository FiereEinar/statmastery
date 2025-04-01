<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CustomImage extends Component
{

    public string $source;
    public string $alt;
    public string $className;
    public string $defaultImg;
    /**
     * Create a new component instance.
     */
    public function __construct(string $source, string $defaultImg, string $alt = '', string $className)
    {
        $this->source = $source;
        $this->defaultImg = $defaultImg;
        $this->className = $className;
        $this->alt = $alt;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-image');
    }
}