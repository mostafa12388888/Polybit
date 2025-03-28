<?php

namespace App\Filament\Resources\CatalogResource\Pages;

use App\Filament\Resources\CatalogResource;
use App\Filament\Traits\EditRecord\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCatalog extends EditRecord
{
    use Translatable;

    protected static string $resource = CatalogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
