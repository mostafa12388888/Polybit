<?php

namespace App\Filament\Resources\CatalogRequestResource\Pages;

use App\Filament\Resources\CatalogRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatalogRequest extends EditRecord
{
    protected static string $resource = CatalogRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
