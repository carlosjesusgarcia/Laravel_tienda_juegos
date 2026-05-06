<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{

    public string $activeRoute;

    public function __construct(string $activeRoute)
    {
        $this->activeRoute = $activeRoute;
    }

    public function render(): View|Closure|string
    {
        return view('components.nav-link');
    }
}
