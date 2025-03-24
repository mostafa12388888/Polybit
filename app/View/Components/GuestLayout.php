<?php

namespace App\View\Components;

use App\Models\Page;
use Illuminate\View\Component;
use Illuminate\View\View;

class GuestLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        $page = null;

        $route = request()->route()?->getName();

        if (in_array($route, array_keys(Page::$preset_pages))) {
            $page = Page::where('route', $route)->first();

            request()->merge(['_page' => $page]);
        }

        return view('layouts.guest', compact('page'));
    }
}
