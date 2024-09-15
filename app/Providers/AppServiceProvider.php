<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\ActivityPolicy;
use App\Policies\PermissionPolicy;
use App\Policies\RolePolicy;
use Filament\Facades\Filament;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Spatie\Activitylog\Models\Activity;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Translatable\Facades\Translatable;

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

        Translatable::fallback(fallbackAny: true);

        Gate::define('use-translation-manager', function (?User $user) {
            return optional($user)->checkPermissionTo('update-translations');
        });

        Gate::policy(Role::class, RolePolicy::class);
        Gate::policy(Permission::class, PermissionPolicy::class);
        Gate::policy(Activity::class, ActivityPolicy::class);

        try {
            config(['app.name' => setting('app_name', config('app.name'))]);

            $logo = setting('logo') ?: setting('darkmode_logo');

            Filament::getPanel()->brandLogo($logo?->getSignedUrl())->brandLogoHeight('35px');
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
