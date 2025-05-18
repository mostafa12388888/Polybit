<?php

namespace App\Filament\Resources\AnotherProductResource\Pages;

use App\Filament\Resources\AnotherProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProduct extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = AnotherProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\Action::make('preview')->hiddenLabel()->color('gray')->icon('heroicon-o-arrow-top-right-on-square')
                ->url(fn ($record) => route('products.show', $record), true),
            Actions\EditAction::make(),
        ];
    }
}
