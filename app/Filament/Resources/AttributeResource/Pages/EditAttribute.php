<?php

namespace App\Filament\Resources\AttributeResource\Pages;

use App\Filament\Resources\AttributeResource;
use App\Filament\Traits\EditRecord\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAttribute extends EditRecord
{
    use Translatable;

    protected static string $resource = AttributeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getRelationManagers(): array
    {
        return [];
    }
}
