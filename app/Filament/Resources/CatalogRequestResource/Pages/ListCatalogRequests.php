<?php

namespace App\Filament\Resources\CatalogRequestResource\Pages;

use App\Filament\Resources\CatalogRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCatalogRequests extends ListRecords
{
    protected static string $resource = CatalogRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
