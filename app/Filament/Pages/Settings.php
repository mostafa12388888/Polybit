<?php

namespace App\Filament\Pages;

use App\Models\CuratorMedia;
use App\Models\Setting;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Actions\Action;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Illuminate\Contracts\Support\Htmlable;

class Settings extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';

    protected static ?int $navigationSort = 1;

    protected static string $view = 'filament.pages.settings';

    protected $rules = [];

    public $app_name = [];

    public $logo = [];

    public $darkmode_logo = [];

    public function mount(): void
    {
        $allowed_settings = Setting::$allowed_settings;

        foreach (Setting::all() as $setting) {
            $this->{$setting->key} = setting($setting->key, wants_translation: false);

            $translatable = optional($allowed_settings[$setting->key] ?? [])['translatable'];

            if ($translatable) {
                foreach ($this->{$setting->key} as $locale => $value) {
                    if ($value instanceof CuratorMedia) {
                        $this->{$setting->key}[$locale] = [
                            (string) str()->uuid() => $value,
                        ];
                    }
                }
            }
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()
                    ->schema([
                        TextInput::make('app_name')->translatable()->reactive(),

                        CuratorPicker::make('logo')->constrained()
                            ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->translatable(),

                        CuratorPicker::make('darkmode_logo')->constrained()
                            ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->translatable(),
                    ]),
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

            foreach ($data as $key => $value) {
                if (property_exists($this, $key)) {
                    setting([$key => $value]);
                }
            }

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
