<?php

namespace App\Filament\Resources\TagResource\Pages;

use App\Filament\Resources\TagResource;
use App\Filament\Traits\ListRecords\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTags extends ListRecords
{
    use Translatable;

    protected static string $resource = TagResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }
}
