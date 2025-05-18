<?php

namespace App\Filament\Resources\AnotherProductResource\Pages;

use App\Filament\Resources\AnotherProductResource;
use App\Filament\Traits\ListRecords\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    use Translatable;

    protected static string $resource = AnotherProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
