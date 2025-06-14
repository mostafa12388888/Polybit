<?php

namespace App\Filament\Pages;

use App\Models\CuratorMedia;
use App\Models\Setting;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Actions;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Colors\Color;
use Guava\FilamentIconPicker\Forms\IconPicker;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Cache;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.settings';

    protected $rules = [];

    public $app_name = [];

    public $app_description = [];

    public $addresses = [];

    public $logo = [];

    public $darkmode_logo = [];

    public $favicon;

    public $header_banner;

    public $darkmode_header_banner;

    public $emails = [];

    public $phones = [];

    public $whatsapp = null;

    public $social_links = [];

    public $location = null;

    public $theme_colors = [];

    public $primary_color = null;

    public $secondary_color = null;

    public $dark_color = null;

    public $primary_color_shades = null;

    public $secondary_color_shades = null;

    public $dark_color_shades = null;

    public $stats = [];

    public $catalogs_delivery_method = 'manual';

    public function mount(): void
    {
        $allowed_settings = Setting::$allowed_settings;

        foreach (Setting::all() as $setting) {
            $this->{$setting->key} = setting($setting->key, wants_translation: false);

            $translatable = optional($allowed_settings[$setting->key] ?? [])['translatable'];

            if ($translatable) {
                foreach (array_keys(locales()) as $locale) {
                    $this->{$setting->key}[$locale] = $this->{$setting->key}[$locale] ?? null;
                }

                foreach ($this->{$setting->key} ?: [] as $locale => $value) {
                    if ($value instanceof CuratorMedia) {
                        $this->{$setting->key}[$locale] = [
                            (string) str()->uuid() => $value,
                        ];
                    }
                }
            } else {
                if ($this->{$setting->key} instanceof CuratorMedia) {
                    $this->{$setting->key} = [
                        (string) str()->uuid() => $this->{$setting->key},
                    ];
                }
            }
        }

        foreach (['phone', 'email', 'social_link'] as $repeatable) {
            if (is_array($this->{$repeatable.'s'})) {
                $this->{$repeatable.'s'} = collect($this->{$repeatable.'s'})
                    ->mapWithKeys(fn ($value) => [str()->uuid()->toString() => [$repeatable => $value]])->toArray();
            }

            if (empty($this->{$repeatable.'s'})) {
                $this->{$repeatable.'s'} = collect(range(1, 3))
                    ->mapWithKeys(fn ($value) => [str()->uuid()->toString() => ['']])->toArray();
            }
        }

        $this->set_theme_colors();
    }

    public function set_theme_colors()
    {
        try {
            $theme = file_get_contents(base_path('theme.json'));
            $theme = json_decode($theme, true);
        } catch (\Throwable $th) {
            //throw $th;
        }

        $theme_colors = optional($theme ?? [])['colors'] ?: [];
        $this->theme_colors = $theme_colors;

        foreach (['primary', 'secondary', 'dark'] as $color) {
            $this->{$color.'_color'} = optional($theme_colors[$color] ?? [])['DEFAULT'];
            $this->{$color.'_color_shades'} = $theme_colors[$color] ?? collect(['DEFAULT', 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950])
                ->mapWithKeys(fn ($shade) => [$shade => null])->toArray();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->schema([
                    Tab::make('General')->schema([
                        TextInput::make('app_name')->translatable(),

                        Textarea::make('app_description')->autosize()->translatable(),

                        Group::make()->schema([
                            CuratorPicker::make('logo')->constrained()
                                ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->translatable(),

                            CuratorPicker::make('darkmode_logo')->constrained()
                                ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->translatable(),
                        ])->columns(2),

                        CuratorPicker::make('favicon')->constrained()
                            ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm'),

                        Group::make()->schema([
                            CuratorPicker::make('header_banner')->constrained()
                                ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm'),

                            CuratorPicker::make('darkmode_header_banner')->constrained()
                                ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm'),
                        ])->columns(2),
                    ]),
                    Tab::make('Theme')->schema(function () {
                        foreach (['primary', 'secondary', 'dark'] as $color) {
                            $fields[] = Group::make([
                                ColorPicker::make($color.'_color')->rgb()->live()
                                    ->regex('/^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/')
                                    ->afterStateUpdated(function ($set, $state) use ($color) {
                                        try {
                                            $shades = Color::rgb($state);
                                            $shades = collect($shades)->mapWithKeys(fn ($value, $key) => [$key => 'rgb('.$value.')'])->toArray();
                                            $shades['DEFAULT'] = $state;
                                            $set($color.'_color_shades', $shades);
                                        } catch (\Throwable $th) {
                                            //throw $th;
                                        }
                                    }),

                                Section::make(__('admin.'.str()->title($color).' color shades'))->schema(
                                    collect(['DEFAULT', 50, 100, 200, 300, 400, 500, 600, 700, 800, 900, 950])->map(function ($shade) use ($color) {
                                        return ColorPicker::make($color.'_color_shades.'.$shade)
                                            ->rgb()->live()
                                            ->regex('/^rgb\((\d{1,3}),\s*(\d{1,3}),\s*(\d{1,3})\)$/')
                                            ->label($shade)->hiddenLabel()->prefix(str()->title($shade));
                                    })->toArray()
                                )
                                    ->collapsed()
                                    ->columns(4),
                            ])->columnSpan(1);
                        }

                        $fields[] = Section::make()->schema([
                            \Filament\Forms\Components\Placeholder::make('info')->hiddenLabel()
                                ->content(__('admin.Reset the theme colors to the default values. This action cannot be undone.')),

                            Actions::make([
                                Action::make('reset_theme_colors')
                                    ->label(__('admin.Reset to default'))
                                    ->color('danger')
                                    ->requiresConfirmation()
                                    ->modalHeading(__('admin.Reset theme colors to default'))
                                    ->action(fn () => $this->reset_theme_colors()),
                            ]),
                        ]);

                        return $fields;
                    }),
                    Tab::make('Contact details')->schema([
                        Repeater::make('addresses')->label('admin.Addresses')->schema([
                            TextInput::make('location_name')->placeholder(__('admin.EG: Administrative headquarter')),
                            Textarea::make('address')->rows(1)->autosize()->columnSpan(2),
                        ])->columns(3)->reorderable(false)->defaultItems(3)->translatable(),
                        Repeater::make('emails')->label('admin.Email addresses')->simple(
                            TextInput::make('email')->email(),
                        )->defaultItems(3),
                        Repeater::make('phones')->label('admin.Phone numbers')->simple(
                            TextInput::make('phone')->rules('phone'),
                        )->defaultItems(3),
                        TextInput::make('whatsapp')->rules('phone'),
                        Repeater::make('social_links')->simple(
                            TextInput::make('social_link')->activeUrl(),
                        )->defaultItems(3),
                        Textarea::make('location')->label('admin.Map embed URL'),
                    ]),
                    Tab::make('Stats')->schema([
                        Repeater::make('stats')->hiddenLabel()->schema([
                            IconPicker::make('icon')->columnSpanFull()->sets(['heroicons'])->columns(3),
                            TextInput::make('count')->required()->placeholder(__('admin.eg: 123')),
                            TextInput::make('title')->required()->placeholder(__('admin.eg: Happy Clients'))->maxLength(120),
                            TextInput::make('url')->columnSpanFull()->extraAttributes(['dir' => 'ltr'])->prefixIcon('heroicon-o-link'),
                        ])->columns(2)->reorderable(false)->defaultItems(3)->translatable(),
                    ]),
                    Tab::make('More')->schema([
                        Select::make('catalogs_delivery_method')->options([
                            'manual' => __('admin.Send it manually'),
                            'automatic' => __('admin.Show it Automatically after form submission'),
                            'without_form' => __('admin.Show it Automatically without form submission'),
                        ])->required(),
                    ]),
                ])->persistTabInQueryString(),
            ]);
    }

    public function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            foreach ($data ?: [] as $key => $value) {
                if (in_array($key, array_keys(Setting::$allowed_settings))) {
                    if ($key == 'location') {
                        preg_match('/src="([^"]+)"/i', $value, $match);

                        $value = array_pop($match) ?: $value;
                    }

                    setting([$key => is_array($value) ? array_filter($value) : $value]);
                }
            }

            $this->update_theme_colors($data);

            Cache::forget('settings');

            Notification::make()->title(__('admin.Saved.'))->success()->send();

        } catch (Halt $exception) {
            Notification::make()->title(__('admin.Something went wrong.'))->danger()->send();

            return;
        }
    }

    public function update_theme_colors($data)
    {
        $theme_colors = collect($data)->only(['primary_color_shades', 'secondary_color_shades', 'dark_color_shades'])
            ->mapWithKeys(fn ($value, $key) => [str_replace('_color_shades', '', $key) => $value])
            ->toArray();

        $colors_updated = $theme_colors != $this->theme_colors;

        if ($colors_updated) {
            file_put_contents(base_path('theme.json'), json_encode([
                'applied' => false,
                'colors' => $theme_colors,
            ], JSON_PRETTY_PRINT));

            Notification::make()->title(__('admin.Theme Update in Progress.'))
                ->body(__('admin.Theme settings can take up to 30 seconds to be applied.'))->duration(20000)->info()->send();
        }
    }

    public function reset_theme_colors()
    {
        $default_theme = ['applied' => false];

        try {
            if (file_exists(base_path('theme.json.bak'))) {
                $default_theme = file_get_contents(base_path('theme.json.bak'));
                $default_theme = json_decode($default_theme, true);
            }
        } catch (\Throwable $th) {
            //throw $th;
        }

        file_put_contents(base_path('theme.json'), json_encode($default_theme, JSON_PRETTY_PRINT));

        $this->set_theme_colors();

        Notification::make()->title(__('admin.Resetting theme settings in progress.'))
            ->body(__('admin.Theme settings can take up to 30 seconds to be applied.'))->duration(20000)->info()->send();
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Settings');
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.Settings');
    }

    public function getTitle(): string|Htmlable
    {
        return __('admin.Settings');
    }

    public static function canAccess(): bool
    {
        return auth()->user()->can('update-settings');
    }

    public static function shouldRegisterNavigation(): bool
    {
        return self::canAccess();
    }
}
