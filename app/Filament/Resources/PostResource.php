<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\SEO;
use App\Models\BlogCategory;
use App\Models\Post;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
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

class PostResource extends Resource
{
    use Translatable;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = -8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SEO::make()->schema([
                    TextInput::make('title')->required()->maxLength(250),
                    TextInput::make('slug')->maxLength(250),

                    TiptapEditor::make('body')->required()->columnSpanFull()
                        ->imageResizeMode('cover')->imageCropAspectRatio('16:9')->imageResizeTargetWidth(1920),

                    Split::make([
                        Select::make('main_category_id')->label(__('admin.Main Category'))->grow(true)
                            ->searchable()->preload()->reactive()
                            ->exists(BlogCategory::class, 'id', fn ($rule) => $rule->where('parent_id', null))
                            ->relationship('main_category', 'name', fn ($query) => $query->parents()),

                        Select::make('category_id')->label(__('admin.Sub Category'))->required()
                            ->searchable()->preload()
                            ->default(request()->query('ownerRecord'))
                            ->exists(BlogCategory::class, 'id', fn ($rule) => $rule->where('parent_id', '!=', null))
                            ->relationship('category', 'name', function ($query, $get) {
                                if ($get('main_category_id')) {
                                    return $query->subCategories()->where('parent_id', $get('main_category_id'));
                                }

                                return $query->subCategories();
                            }),
                    ])->columnSpanFull(),

                    CuratorPicker::make('image')->multiple()->maxItems(1)
                        ->typeValue('post-image')
                        ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->constrained()
                        ->relationship('media_items', 'id')->columnSpanFull(),

                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable()->toggleable(),
                TextColumn::make('title')->limit(50)->searchable()->sortable(),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
                TextColumn::make('locales')->getStateUsing(fn ($record) => collect($record->locales())->map(fn ($locale) => locales()[$locale] ?? $locale)->toArray())->toggleable(true, true),
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
                TextEntry::make('title'),
                TextEntry::make('slug'),
                TextEntry::make('created_at')->dateTime(),

                ViewEntry::make('media')->view('filament.infolists.entries.media', ['type' => 'post-image'])->label('admin.Image')->columnSpanFull(),

                TextEntry::make('category.name')->label('admin.Category')
                    ->url(fn (Post $post): string => BlogCategoryResource::getUrl('view', ['record' => $post->category])),

                ViewEntry::make('locales')->view('filament.infolists.entries.locales'),
            ])->columns(2),

            \Filament\Infolists\Components\Section::make()->schema([
                TextEntry::make('body')->columnSpanFull()->hiddenLabel()->html()->state(function (Post $post) {
                    $content = $post->body ? tiptap_converter()->asHTML($post->body) : __('admin.No Content');

                    return Blade::render('<div class="prose max-w-full text-sm">'.$content.'</div>');
                }),
            ]),
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.post');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Post');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.posts');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Posts');
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.Blog');
    }
}
