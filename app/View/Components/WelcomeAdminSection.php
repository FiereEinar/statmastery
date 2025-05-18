<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\User;

class WelcomeAdminSection extends Component
{
    public User $user;
    public $totalStudentCount = 0;
    /**
     * Create a new component instance.
     */
    public function __construct(User $user, $totalStudentCount = 0)
    {
        $this->user = $user;
        $this->totalStudentCount = $totalStudentCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.welcome-admin-section');
    }
}