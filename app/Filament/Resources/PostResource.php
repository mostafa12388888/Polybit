<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\SEO;
use App\Filament\Traits\Seoable;
use App\Models\Post;
use CodeWithDennis\FilamentSelectTree\SelectTree;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Split;
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
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;

class PostResource extends Resource
{
    use Seoable, Translatable;

    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = -8;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SEO::make()->schema([
                    TextInput::make('title')->required(),
                    TextInput::make('slug'),

                    TiptapEditor::make('body')->required()->columnSpanFull()
                        ->imageResizeMode('cover')->imageCropAspectRatio('16:9')->imageResizeTargetWidth(1920),

                    Split::make([
                        Select::make('main_category_id')->label(__('admin.Main Category'))->grow(true)
                            ->searchable()->preload()->reactive()
                            ->relationship('main_category', 'name', fn ($query) => $query->parents()),

                        Select::make('category_id')->label(__('admin.Sub Category'))->required()
                            ->searchable()->preload()
                            ->default(request()->query('ownerRecord'))
                            ->relationship('category', 'name', function ($query, $get) {
                                if ($get('main_category_id')) {
                                    return $query->subCategories()->where('parent_id', $get('main_category_id'));
                                }

                                return $query->subCategories();
                            }),
                    ])->columnSpanFull(),

                    // SelectTree::make('category_id')->columnSpanFull()->label(__('admin.Category'))
                    //     ->searchable()
                    //     ->relationship('category', 'name', 'parent_id')
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->width(0),
                TextColumn::make('title')->limit(50)->searchable()->sortable(),
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
            ]);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            \Filament\Infolists\Components\Section::make()->schema([
                TextEntry::make('id'),
                TextEntry::make('title'),
                TextEntry::make('slug'),
                TextEntry::make('created_at')->dateTime(),
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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('metadata');
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
