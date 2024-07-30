<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use App\Filament\Traits\CreateRecord\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateProject extends CreateRecord
{
    use Translatable;

    protected static string $resource = ProjectResource::class;

    public function mount(): void
    {
        parent::mount();

        foreach (array_keys(locales()) as $locale) {
            $default_project_attributes = [
                (string) str()->uuid() => ['key' => __('admin.Location', [], $locale), 'value'],
                (string) str()->uuid() => ['key' => __('admin.Consultant', [], $locale), 'value'],
                (string) str()->uuid() => ['key' => __('admin.Contractor', [], $locale), 'value'],
            ];

            if (config('app.locale') == $locale) {
                $this->data['attributes'] = $default_project_attributes;
            } else {
                $this->otherLocaleData[$locale]['attributes'] = $default_project_attributes;
            }
        }
    }

    public function getTitle(): string|Htmlable
    {
        return __('filament-panels::resources/pages/create-record.title', [
            'label' => static::getResource()::getModelLabel(),
        ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
