<?php

namespace App\Filament\Resources\ProjectResource\Pages;

use App\Filament\Resources\ProjectResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewProject extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = ProjectResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\Action::make('preview')->hiddenLabel()->color('gray')->icon('heroicon-o-arrow-top-right-on-square')
                ->url(fn ($record) => localized_url($record->locales()[0] ?? app()->getLocale(), route('projects.show', $record)), true),
            Actions\EditAction::make(),
        ];
    }
}
