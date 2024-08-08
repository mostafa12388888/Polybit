<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);

        Gate::define('use-translation-manager', function (?User $user) {
            return optional($user)->is_admin;
        });

        try {
            config(['app.name' => setting('app_name', config('app.name'))]);
        } catch (\Throwable $th) {
            //
        }

        Relation::morphMap([
            'user' => \App\Models\User::class,
            'blog-category' => \App\Models\BlogCategory::class,
            'post' => \App\Models\Post::class,
            'store-category' => \App\Models\StoreCategory::class,
            'faq' => \App\Models\Faq::class,
            'page' => \App\Models\Page::class,
            'project' => \App\Models\Project::class,
            'setting' => \App\Models\Setting::class,
            'attribute' => \App\Models\Attribute::class,
            'attribute-value' => \App\Models\AttributeValue::class,
            'attribute-value-product-variant' => \App\Models\AttributeValueProductVariant::class,
            'media-item' => \App\Models\MediaItem::class,
            'metadatum' => \App\Models\Metadatum::class,
            'product' => \App\Models\Product::class,
            'product-spec' => \App\Models\ProductSpec::class,
            'product-variant' => \App\Models\ProductVariant::class,
            'slide' => \App\Models\Slide::class,
        ]);
    }
}
