<?php

namespace App\Filament\Pages;

use App\Models\CuratorMedia;
use App\Models\Setting;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Actions\Action;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
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

    public $address = [];

    public $favicon;

    public $logo = [];

    public $darkmode_logo = [];

    public $emails = [];

    public $phones = [];

    public $social_links = [];

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
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Tabs::make()->schema([
                    Tab::make('General')->schema([
                        TextInput::make('app_name')->translatable(),

                        Textarea::make('app_description')->translatable(),

                        CuratorPicker::make('logo')->constrained()
                            ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->translatable(),

                        CuratorPicker::make('darkmode_logo')->constrained()
                            ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->translatable(),

                        CuratorPicker::make('favicon')->constrained()
                            ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm'),
                    ]),
                    Tab::make('Contact details')->schema([
                        Textarea::make('address')->translatable(),
                        Repeater::make('emails')->label('admin.Email addresses')->simple(
                            TextInput::make('email')->email(),
                        )->defaultItems(3),
                        Repeater::make('phones')->label('admin.Phone numbers')->simple(
                            TextInput::make('phone'),
                        )->defaultItems(3),
                        Repeater::make('social_links')->simple(
                            TextInput::make('social_link')->activeUrl(),
                        )->defaultItems(3),
                    ]),
                ])->persistTabInQueryString(),
            ]);
    }

    public function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {
        try {
            $data = $this->form->getState();

            foreach ($data ?: [] as $key => $value) {
                if (property_exists($this, $key)) {
                    setting([$key => is_array($value) ? array_filter($value) : $value]);
                }
            }

            Cache::forget('settings');

            Notification::make()->title(__('admin.Saved.'))->success()->send();

        } catch (Halt $exception) {
            Notification::make()->title(__('admin.Something went wrong.'))->danger()->send();

            return;
        }
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
}
