<?php

namespace App\Filament\Resources\AnotherProductResource\Pages;

use App\Filament\Resources\AnotherProductResource;
use App\Filament\Traits\CreateRecord\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Contracts\Support\Htmlable;

class CreateProduct extends CreateRecord
{
    use Translatable;

    protected static string $resource = AnotherProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
        ];
    }

    public function getTitle(): string|Htmlable
    {
        return __('filament-panels::resources/pages/create-record.title', [
            'label' => static::getResource()::getModelLabel(),
        ]);
    }
}
