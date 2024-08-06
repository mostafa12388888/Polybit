<?php

namespace App\Filament\Resources\BlogCategoryResource\RelationManagers;

use App\Filament\Resources\PostResource;
use App\Filament\Traits\RelationManagers\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class PostsRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'posts';

    public function table(Table $table): Table
    {
        return PostResource::table($table)
            ->heading(__('admin.Posts'))
            ->modelLabel(__('admin.post'))
            ->pluralModelLabel(__('admin.posts'))
            ->recordTitleAttribute('title')
            ->headerActions([
                Tables\Actions\LocaleSwitcher::make(),
                Tables\Actions\CreateAction::make()
                    ->url(fn ($livewire) => PostResource::getUrl('create', ['ownerRecord' => $livewire->ownerRecord->getKey()])),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function canCreate(): bool
    {
        return true;
    }

    public function canEdit($record): bool
    {
        return true;
    }
}
