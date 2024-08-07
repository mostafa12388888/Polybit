<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\Page;
use App\Models\StoreCategory;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
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

        Facades\View::composer(['layouts.app', 'layouts.guest', 'components.application-logo'], function (View $view) use ($darkmode) {
            return $view->with(compact('darkmode'));
        });

        Facades\View::composer(['layouts.partials._header', 'layouts.partials._footer'], function (View $view) use ($darkmode) {
            $pages = Cache::remember('pages', 60 * 60, fn () => Page::oldest('id')->get());

            return $view->with(compact('pages'));
        });

        Facades\View::composer(['layouts.partials._navbar', 'layouts.partials._footer'], function (View $view) {
            $blog_categories = Cache::remember('blog_categories', 60 * 60, function () {
                return BlogCategory::parents()->with('sub_categories')->get();
            });

            $store_categories = Cache::remember('store_categories', 60 * 60, function () {
                return StoreCategory::parents()->with('sub_categories')->get();
            });

            return $view->with(compact('blog_categories', 'store_categories'));
        });
    }
}
