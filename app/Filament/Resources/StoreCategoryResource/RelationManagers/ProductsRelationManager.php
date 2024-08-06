<?php

namespace App\Filament\Resources\StoreCategoryResource\RelationManagers;

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
                Tables\Actions\LocaleSwitcher::make(),
                Tables\Actions\CreateAction::make()
                    ->url(fn ($livewire) => ProductResource::getUrl('create', ['ownerRecord' => $livewire->ownerRecord->getKey()])),
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
