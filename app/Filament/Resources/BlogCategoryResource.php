<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BlogCategoryResource\Pages;
use App\Filament\SEO;
use App\Models\BlogCategory;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Support\Facades\Blade;

class BlogCategoryResource extends Resource
{
    use Translatable;

    protected static ?string $model = BlogCategory::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?int $navigationSort = -9;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SEO::make()->schema([
                    TextInput::make('name')->required()->maxLength(250),
                    TextInput::make('slug')->maxLength(250),
                    TiptapEditor::make('description')->profile('minimal')->columnSpanFull(),

                    Select::make('parent_id')->columnSpanFull()->label(__('admin.Main Category'))
                        ->searchable()->preload()->default(request()->query('ownerRecord'))
                        ->relationship('parent', 'name', fn ($query) => $query->parents())
                        ->exists(BlogCategory::class, 'id', fn ($rule) => $rule->where('parent_id', null))
                        ->visible(fn ($get) => $get('parent_id') || request()->query('ownerRecord')),

                    CuratorPicker::make('image')->multiple()->maxItems(1)
                        ->typeValue('category-image')
                        ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->constrained()
                        ->relationship('media_items', 'id')->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn ($query) => $query->parents())
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                CuratorColumn::make('media')->label('admin.Image')->circular()->size(40)->limit(3)->toggleable(),
                TextColumn::make('name')->sortable()->searchable(),
                TextColumn::make('sub_categories_count')->counts('sub_categories')->toggleable()->sortable(),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
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

                TextEntry::make('description')->state(function (BlogCategory $category) {
                    $content = $category->description ? tiptap_converter()->asHTML($category->description) : '';

                    return Blade::render('<div class="prose max-w-full text-sm">'.$content.'</div>');
                })->html()->columnSpanFull(),

                ViewEntry::make('media')->view('filament.infolists.entries.media', ['type' => 'category-image'])->label('admin.Image')->columnSpanFull(),

                TextEntry::make('parent.name')->label('admin.Main Category')
                    ->visible(fn (BlogCategory $category) => $category->parent_id)
                    ->url(fn (BlogCategory $category): string => self::getUrl('view', ['record' => $category->parent])),

                TextEntry::make('created_at')->dateTime(),
            ])->columns(2)->columnSpan(2),
        ])->columns(2);
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
            'index' => Pages\ListBlogCategories::route('/'),
            'create' => Pages\CreateBlogCategory::route('/create'),
            'view' => Pages\ViewBlogCategory::route('/{record}'),
            'edit' => Pages\EditBlogCategory::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.blog category');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return request()->query('ownerRecord') ? __('admin.Sub Category') : __('admin.Blog Category');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.blog categories');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Blog Categories');
    }

    public static function getNavigationLabel(): string
    {
        return __('admin.Categories');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.Blog');
    }
}
