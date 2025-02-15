<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPost extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\Action::make('preview')->hiddenLabel()->color('gray')->icon('heroicon-o-arrow-top-right-on-square')
                ->url(fn ($record) => localized_url($record->locales()[0] ?? app()->getLocale(), route('posts.show', $record)), true),
            Actions\EditAction::make(),
        ];
    }
}
