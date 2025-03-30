<?php

namespace App\Filament\Resources\TagResource\RelationManagers;

use App\Filament\Resources\ProductResource;
use App\Filament\Traits\RelationManagers\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ProductsRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'products';

    public function table(Table $table): Table
    {
        return ProductResource::table($table)
            ->heading(__('admin.Products'))
            ->modelLabel(__('admin.product'))
            ->pluralModelLabel(__('admin.products'))
            ->recordTitleAttribute('name')
            ->headerActions([
                Tables\Actions\AttachAction::make()->preloadRecordSelect(),
                Tables\Actions\LocaleSwitcher::make(),
                Tables\Actions\CreateAction::make()
                    ->url(fn ($livewire) => ProductResource::getUrl('create', ['ownerRecord' => $livewire->ownerRecord->getKey()])),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\DetachAction::make(),
                    Tables\Actions\ViewAction::make()->url(fn ($record) => ProductResource::getUrl('view', compact('record'))),
                    Tables\Actions\EditAction::make()->url(fn ($record) => ProductResource::getUrl('edit', compact('record'))),
                    Tables\Actions\Action::make('preview')->groupedIcon('heroicon-o-arrow-top-right-on-square')
                        ->url(fn ($record) => route('products.show', $record), true),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function canCreate(): bool
    {
        return false;
    }

    public function canEdit($record): bool
    {
        return true;
    }
}
