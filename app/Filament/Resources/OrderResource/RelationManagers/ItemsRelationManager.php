<?php

namespace App\Filament\Resources\OrderResource\RelationManagers;

use App\Filament\Resources\ProductResource;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ItemsRelationManager extends RelationManager
{
    protected static string $relationship = 'items';

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('admin.Order Items'))
            ->modelLabel(__('admin.order item'))
            ->pluralModelLabel(__('admin.order items'))
            ->recordTitleAttribute('id')
            ->query(fn () => $this->ownerRecord->items()->with('order', 'variant.attribute_values'))
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                CuratorColumn::make('product.media')->label('admin.Images')->circular()->size(40)->overlap(3)->limit(3)->toggleable(),
                TextColumn::make('product.name')->sortable()->searchable()->toggleable()->url(fn ($record) => ProductResource::getUrl('view', ['record' => $record->product])),
                TextColumn::make('variant.attribute_values.value')->label('admin.Attributes')->formatStateUsing(function ($record) {
                    return $record->variant?->attribute_values
                        ?->map(fn ($value) => $value->attribute->name.' : '.($value->title ?: $value->value))
                        ?->implode('<br />') ?: '';
                })->html()->searchable(['value', 'title'])->toggleable(),
                TextColumn::make('quantity')->sortable()->searchable()->toggleable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
