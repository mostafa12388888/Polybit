<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateProject extends CreateRecord
{
    use CreateRecord\Concerns\Translatable;

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

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
