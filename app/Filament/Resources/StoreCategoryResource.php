<?php

namespace App\Filament\Resources;

use App\Filament\Resources\StoreCategoryResource\Pages;
use App\Filament\Resources\StoreCategoryResource\RelationManagers\SubCategoriesRelationManager;
use App\Filament\SEO;
use App\Filament\Traits\Seoable;
use App\Models\StoreCategory;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Facades\Blade;

class StoreCategoryResource extends Resource
{
    use Seoable, Translatable;

    protected static ?string $model = StoreCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = -8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SEO::make()->schema([
                    TextInput::make('name')->required(),
                    TextInput::make('slug'),
                    TiptapEditor::make('description')->profile('minimal')->columnSpanFull(),

                    Select::make('parent_id')->columnSpanFull()->label(__('admin.Main Category'))
                        ->searchable()->preload()->default(request()->query('ownerRecord'))
                        ->relationship('parent', 'name', fn ($query) => $query->parents())
                        ->visible(fn ($get) => $get('parent_id') || request()->query('ownerRecord')),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->parents())
            ->columns([
                TextColumn::make('id')->sortable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('sub_categories_count')->counts('sub_categories')->toggleable()->sortable(),
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
                TextEntry::make('name')->columnSpanFull(),

                TextEntry::make('description')->state(function (StoreCategory $category) {
                    $content = $category->description ? tiptap_converter()->asHTML($category->description) : '';

                    return Blade::render('<div class="prose max-w-full text-sm">'.$content.'</div>');
                })->html()->columnSpanFull(),

                TextEntry::make('created_at')->dateTime(),
            ])->columns(2)->columnSpan(2),
        ])->columns(2);
    }

    public static function getRelations(): array
    {
        return [
            SubCategoriesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStoreCategories::route('/'),
            'create' => Pages\CreateStoreCategory::route('/create'),
            'view' => Pages\ViewStoreCategory::route('/{record}'),
            'edit' => Pages\EditStoreCategory::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.store category');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return request()->query('ownerRecord') ? __('admin.Sub Category') : __('admin.Store Category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.store categories');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Store Categories');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Categories');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.Store');
    }
}
