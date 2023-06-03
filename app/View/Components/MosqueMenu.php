<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MosqueMenu extends Component
{
    public $mosqueMenus;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->mosqueMenus = Auth::user()?->mosques;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mosque-menu');
    }
}
