<?php

namespace App\View\Components\Dashboard;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\View as FacadesView;
use Illuminate\View\Component;

class Breadcumb extends Component
{
    public string $lastBreadcumbKey;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $breadcumbs = array_keys(FacadesView::getShared()["breadcumbs"]);
        $this->lastBreadcumbKey = end($breadcumbs);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dashboard.breadcumb');
    }
}
