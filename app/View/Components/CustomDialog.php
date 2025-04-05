<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class CustomDialog extends Component
{
    public $show;
    public $title;

    /**
     * Create a new component instance.
     */
    public function __construct($show = false, $title = 'Dialog')
    {
        $this->show = $show;
        $this->title = $title;
    }

    public function shouldRender(): bool{
        return true;
    }

    public function attributes(){
        return ['wire:model'];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.custom-dialog');
    }
}