<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogRequestResource\Pages;
use App\Models\CatalogRequest;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class CatalogRequestResource extends Resource
{
    protected static ?string $model = CatalogRequest::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?int $navigationSort = -4;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                TextColumn::make('catalog.title')->limit(50)->searchable()->sortable()->toggleable(),
                TextColumn::make('name')->limit(50)->searchable()->sortable()->toggleable(),
                TextColumn::make('email')->limit(50)->searchable()->sortable()->toggleable(true, true),
                TextColumn::make('phone')->limit(50)->searchable()->sortable()->toggleable(true, true),
                TextColumn::make('company')->limit(50)->searchable()->sortable()->toggleable(true, true),
                ToggleColumn::make('checked'),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->url(fn ($record) => self::getUrl('view', compact('record'))),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc')
            ->persistSortInSession()
            ->filtersFormColumns(1);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            \Filament\Infolists\Components\Section::make()->schema([
                TextEntry::make('id'),
                TextEntry::make('name'),
                TextEntry::make('email'),
                TextEntry::make('phone'),
                TextEntry::make('company'),
                TextEntry::make('catalog.title')->url(fn ($record) => CatalogResource::getUrl('view', ['record' => $record->catalog])),
                TextEntry::make('message')->label(__('admin.Additional Details'))->html()->formatStateUsing(fn ($state) => nl2br($state))->columnSpanFull(),
                TextEntry::make('created_at')->dateTime(),
                IconEntry::make('checked')->boolean(),
            ])->columns(2),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCatalogRequests::route('/'),
            'create' => Pages\CreateCatalogRequest::route('/create'),
            'view' => Pages\ViewCatalogRequest::route('/{record}'),
            'edit' => Pages\EditCatalogRequest::route('/{record}/edit'),
        ];
    }

    public static function canCreate(): bool
    {
        return false;
    }

    public static function canEdit(Model $record): bool
    {
        return false;
    }

    public static function getModelLabel(): string
    {
        return __('admin.catalog request');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Catalog request');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.catalog requests');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Catalog requests');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.Catalogs');
    }

    public static function getNavigationBadge(): ?string
    {
        $unchecked_requests = CatalogRequest::where('checked', false)->count();

        return $unchecked_requests ?: null;
    }
}
