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

        $this->data['attributes'] = [
            ['key' => __('admin.Location', [], 'ar'), 'value'],
            ['key' => __('admin.Consultant', [], 'ar'), 'value'],
            ['key' => __('admin.Contractor', [], 'ar'), 'value'],
        ];

        $this->otherLocaleData['en']['attributes'] = [
            ['key' => __('admin.Location', [], 'en'), 'value'],
            ['key' => __('admin.Consultant', [], 'en'), 'value'],
            ['key' => __('admin.Contractor', [], 'en'), 'value'],
        ];
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }
}
