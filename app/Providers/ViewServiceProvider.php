<?php

namespace App\Providers;

use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        Blade::anonymousComponentPath(resource_path('views').'/components/elements');

        $darkmode = request()->cookie('darkMode');
        $darkmode = in_array($darkmode, ['true', 'false']) ? json_decode($darkmode) : null;

        Facades\View::composer('layouts.app', function (View $view) use ($darkmode) {
            return $view->with(compact('darkmode'));
        });

        Facades\View::composer('layouts.guest', function (View $view) use ($darkmode) {
            return $view->with(compact('darkmode'));
        });
    }
}
