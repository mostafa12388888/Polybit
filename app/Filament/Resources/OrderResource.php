<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OrderResource\Pages;
use App\Filament\Resources\OrderResource\RelationManagers\ItemsRelationManager;
use App\Models\Order;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Model;

class OrderResource extends Resource
{
    protected static ?string $model = Order::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?int $navigationSort = -2;

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                TextColumn::make('name')->limit(50)->searchable()->sortable(),
                TextColumn::make('email')->limit(50)->searchable()->sortable()->toggleable(),
                TextColumn::make('phone')->limit(50)->searchable()->sortable()->toggleable(),
                ToggleColumn::make('checked'),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->url(fn ($record) => self::getUrl('view', compact('record'))),
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
                TextEntry::make('message')->html()->formatStateUsing(fn ($state) => nl2br($state))->columnSpanFull(),
                TextEntry::make('created_at')->dateTime(),
                IconEntry::make('checked')->boolean(),
            ])->columns(2),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            ItemsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOrders::route('/'),
            'create' => Pages\CreateOrder::route('/create'),
            'view' => Pages\ViewOrder::route('/{record}'),
            'edit' => Pages\EditOrder::route('/{record}/edit'),
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

    public static function canDelete(Model $record): bool
    {
        return false;
    }

    public static function canDeleteAny(): bool
    {
        return false;
    }

    public static function getModelLabel(): string
    {
        return __('admin.order');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Order');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.orders');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Orders');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.Store');
    }

    public static function getNavigationBadge(): ?string
    {
        $unchecked_orders = Order::where('checked', false)->count();

        return $unchecked_orders ?: null;
    }
}
