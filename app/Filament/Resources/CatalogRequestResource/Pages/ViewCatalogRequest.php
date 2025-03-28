<?php

namespace App\Filament\Resources\CatalogRequestResource\Pages;

use App\Filament\Resources\CatalogRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCatalogRequest extends ViewRecord
{
    protected static string $resource = CatalogRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('checked')
                ->requiresConfirmation()
                ->label(fn ($record) => $record->checked ? 'admin.Set as not checked' : 'admin.Set as checked')
                ->action(function ($record) {
                    $record->checked = ! $record->checked;
                    $record->save();
                }),

            Actions\EditAction::make(),
        ];
    }
}
