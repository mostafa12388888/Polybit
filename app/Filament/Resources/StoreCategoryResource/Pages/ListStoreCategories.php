<?php

namespace App\Filament\Resources\StoreCategoryResource\Pages;

use App\Filament\Resources\StoreCategoryResource;
use App\Filament\Traits\ListRecords\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListStoreCategories extends ListRecords
{
    use Translatable;

    protected static string $resource = StoreCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
