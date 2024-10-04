<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\Page;
use App\Models\Post;
use App\Models\Product;
use App\Models\Project;
use App\Models\Slide;
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
            $pages = Cache::remember('pages', 60 * 60, fn () => Page::orderBy('order')->get());

            return $view->with(compact('pages'));
        });

        Facades\View::composer(['layouts.partials._navbar', 'layouts.partials._footer'], function (View $view) {
            $blog_categories = Cache::remember('blog_categories', 60 * 60, function () {
                return BlogCategory::parents()->with('sub_categories')->get();
            });

            return $view->with(compact('blog_categories'));
        });

        Facades\View::composer(['layouts.partials._navbar', 'layouts.partials._footer', 'home.index', 'products.index'], function (View $view) {
            $store_categories = Cache::remember('store_categories', 60 * 60, function () {
                return StoreCategory::parents()->with('sub_categories', 'image')->get();
            });

            return $view->with(compact('store_categories'));
        });

        Facades\View::composer(['home.index'], function (View $view) {
            $slides = Cache::remember('slides_'.app()->getLocale(), 60 * 60, function () {
                return Slide::whereJsonContains('locales', app()->getLocale())->with('image')
                    ->orderBy('order')->get();
            });

            $projects = Cache::remember('projects_'.app()->getLocale(), 60 * 60, function () {
                return Project::latest()->whereJsonContains('locales', app()->getLocale())->with('image')->limit(4)->get();
            });

            $posts = Cache::remember('posts_'.app()->getLocale(), 60 * 60, function () {
                return Post::latest()->whereJsonContains('locales', app()->getLocale())->with('image')->limit(4)->get();
            });

            $products = Cache::remember('products', 60 * 60, function () {
                return Product::latest()->with('image')->limit(4)->get();
            });

            return $view->with(compact('slides', 'projects', 'posts', 'products'));
        });

        Facades\View::composer(['layouts.app', 'schema.*'], function (View $view) use ($darkmode) {
            $app_name = config('app.name');

            $title = (string) $view->title ?: ($app_name ?: 'App');

            $title .= (string) $view->title && $app_name ? ' - '.$app_name : '';

            $description = (string) $view->description ?: setting('app_description');

            $image = (string) $view->image;

            $image_alt = (string) $view->image_alt ?: $title;

            if (! $image && $image = setting('logo')) {
                $image = $image->getSignedUrl(['border' => '200,FFF,expand', 'w' => '800', 'h' => 230, 'fit' => 'fill-max', 'bg' => 'FFFFFF', 'fm' => 'webp', 'q' => 70]);
            }

            $image = $image ? asset($image) : null;

            return $view->with(compact('title', 'description', 'image', 'image_alt'));
        });
    }
}
