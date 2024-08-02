<?php

namespace App\Filament\Resources;

use App\Enums\AttributeType;
use App\Filament\Resources\AttributeResource\Pages;
use App\Filament\Resources\AttributeResource\RelationManagers\ValuesRelationManager;
use App\Models\Attribute;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AttributeResource extends Resource
{
    use Translatable;

    protected static ?string $model = Attribute::class;

    protected static ?string $navigationIcon = 'heroicon-o-swatch';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')->required(),

                    ToggleButtons::make('type')->label('admin.Display Style')
                        ->disabled(fn ($record) => $record)
                        ->reactive()
                        ->default(AttributeType::SELECT_BOX->value)
                        ->options(fn (): array => AttributeType::options())->in(AttributeType::values())
                        ->gridDirection('row')->grouped(),
                ])->columns(2),

                Section::make()->schema([
                    TableRepeater::make('attribute_values')
                        ->headers([
                            Header::make('value')->label(__('admin.Value')),
                        ])
                        ->renderHeader(false)
                        ->relationship()
                        ->schema(fn ($get) => $get('type') == AttributeType::COLORS->value ? [
                            ColorPicker::make('value.'.collect(array_keys(locales()))->first())->required()->hiddenLabel(),
                        ] : [
                            TextInput::make('value')->required()->hiddenLabel()->translatable(),
                        ])
                        ->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->limit(50)->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->url(fn ($record) => self::getUrl('view', compact('record'))),
                    Tables\Actions\EditAction::make(),
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
                TextEntry::make('created_at')->dateTime(),
            ])->columns(2),
        ]);
    }

    public static function getRelations(): array
    {
        return [
            ValuesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAttributes::route('/'),
            'create' => Pages\CreateAttribute::route('/create'),
            'view' => Pages\ViewAttribute::route('/{record}'),
            'edit' => Pages\EditAttribute::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.attribute');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Attribute');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.attributes');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Attributes');
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.Store');
    }
}
