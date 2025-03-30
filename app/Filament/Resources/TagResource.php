<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TagResource\Pages;
use App\Filament\Resources\TagResource\RelationManagers\ProductsRelationManager;
use App\Models\Tag;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class TagResource extends Resource
{
    use Translatable;

    protected static ?string $model = Tag::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = -4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('')->schema([
                    TextInput::make('name')->label(__('admin.Tag'))->required()->maxLength(250),
                    TextInput::make('slug')->maxLength(250),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                TextColumn::make('name')->label(__('admin.Tag'))->sortable()->searchable(),
                TextColumn::make('products_count')->counts('products')->toggleable()->sortable(),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->url(fn ($record) => self::getUrl('view', compact('record'))),
                    Tables\Actions\EditAction::make()->url(fn ($record) => self::getUrl('edit', compact('record'))),
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
                TextEntry::make('name')->label(__('admin.Tag'))->columnSpanFull(),
                TextEntry::make('created_at')->dateTime(),
            ])->columns(2)->columnSpan(2),
        ])->columns(2);
    }

    public static function getRelations(): array
    {
        return [
            ProductsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTags::route('/'),
            'create' => Pages\CreateTag::route('/create'),
            'view' => Pages\ViewTag::route('/{record}'),
            'edit' => Pages\EditTag::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.tag');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Tag');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.tags');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Tags');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Tags');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.Store');
    }
}
