<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Route;

class ViewPage extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = PageResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\Action::make('preview')->hiddenLabel()->color('gray')->icon('heroicon-o-arrow-top-right-on-square')
                ->url(fn ($record) => $record->route && Route::has($record->route) ? route($record->route) : route('pages.show', $record), true),
            Actions\EditAction::make(),
        ];
    }
}
