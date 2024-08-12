<?php

namespace App\Providers\Filament;

use Awcodes\Curator\CuratorPlugin;
use Awcodes\FilamentQuickCreate\QuickCreatePlugin;
use Filament\Enums\ThemeMode;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\SpatieLaravelTranslatablePlugin;
use Filament\Support\Colors\Color;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\AuthenticateSession;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Outerweb\FilamentTranslatableFields\Filament\Plugins\FilamentTranslatableFieldsPlugin;
use Statikbe\FilamentTranslationManager\FilamentChainedTranslationManagerPlugin;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        \Filament\Support\Components\Component::configureUsing(function ($component): void {
            if (method_exists($component, 'translateLabel')) {
                // If it's not in arabic translate it
                // Arabic characters fall within the Unicode range \u0600-\u06FF and \u0750-\u077F.
                if (app()->getLocale() != 'ar' || ! (bool) preg_match('/[\x{0600}-\x{06FF}\x{0750}-\x{077F}]/u', $component->getLabel())) {
                    $component->label('admin.'.$component->getLabel())->translateLabel();
                }
            }
        }, null, false);

        return $panel
            ->defaultThemeMode(ThemeMode::Light)
            ->default()
            ->id('admin')
            ->path('admin')
            ->login()
            ->colors([
                'primary' => Color::Zinc,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\\Filament\\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\\Filament\\Pages')
            ->resources([
                config('filament-logger.activity_resource'),
            ])
            ->pages([
                Pages\Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\\Filament\\Widgets')
            ->widgets([])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->authMiddleware([
                Authenticate::class,
            ])
            ->plugins([
                FilamentTranslatableFieldsPlugin::make()->supportedLocales(locales()),

                SpatieLaravelTranslatablePlugin::make()
                    ->defaultLocales(collect(array_keys(locales()))->sort(fn ($locale) => $locale == config('app.locale') ? 0 : 1)->values()->toArray()),

                FilamentChainedTranslationManagerPlugin::make(),

                QuickCreatePlugin::make()->sortBy('navigation'),

                CuratorPlugin::make()
                    ->label(__('admin.File'))
                    ->navigationLabel(__('admin.Files Manager'))
                    ->pluralLabel(__('admin.Files'))
                    ->navigationGroup(__('admin.Settings')),
            ])
            ->viteTheme('resources/css/filament/dashboard/theme.css')
            ->homeUrl('/')
            ->font('Almarai');
    }
}
