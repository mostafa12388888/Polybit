<?php

namespace App\Filament\Resources\AttributeResource\Pages;

use App\Filament\Resources\AttributeResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAttribute extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = AttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }
}
