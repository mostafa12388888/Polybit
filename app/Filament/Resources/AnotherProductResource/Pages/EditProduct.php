<?php

namespace App\Filament\Resources\AnotherProductResource\Pages;

use App\Filament\Resources\AnotherProductResource;
use App\Filament\Traits\EditRecord\Translatable;
use App\Filament\Traits\Seoable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditProduct extends EditRecord
{
    use Seoable, Translatable;

    protected static string $resource = AnotherProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
