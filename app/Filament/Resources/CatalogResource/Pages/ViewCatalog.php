<?php

namespace App\Filament\Resources\CatalogResource\Pages;

use App\Filament\Resources\CatalogResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCatalog extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = CatalogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\Action::make('preview')->hiddenLabel()->color('gray')->icon('heroicon-o-arrow-top-right-on-square')
                ->url(fn ($record) => localized_url($record->locales()[0] ?? app()->getLocale(), route('catalogs.show', $record)), true),
            Actions\EditAction::make(),
        ];
    }
}
