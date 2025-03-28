<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CatalogResource\Pages;
use App\Filament\SEO;
use App\Models\Catalog;
use Awcodes\Curator\Components\Forms\CuratorPicker;
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

class CatalogResource extends Resource
{
    use Translatable;

    protected static ?string $model = Catalog::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    protected static ?int $navigationSort = -5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SEO::make()->schema([
                    TextInput::make('title')->required()->maxLength(250),
                    TextInput::make('slug')->maxLength(250),

                    TiptapEditor::make('description')->required()->columnSpanFull()
                        ->imageResizeMode('cover')->imageCropAspectRatio('16:9')->imageResizeTargetWidth(1920),

                    CuratorPicker::make('image')->multiple()->maxItems(1)
                        ->typeValue('catalog-image')
                        ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->constrained()
                        ->relationship('media_items', 'id')->columnSpanFull(),

                    CuratorPicker::make('document')->required()->multiple()->maxItems(1)
                        ->typeValue('catalog-document')
                        ->buttonLabel('admin.Add File')->size('sm')->constrained()
                        ->relationship('media_items', 'id')->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                TextColumn::make('title')->limit(50)->searchable()->sortable(),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
                TextColumn::make('locales')->toggleable(true, true)
                    ->getStateUsing(fn ($record) => collect($record->locales())->map(fn ($locale) => locales()[$locale] ?? $locale)->toArray()),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->url(fn ($record) => self::getUrl('view', compact('record'))),
                    Tables\Actions\EditAction::make()->url(fn ($record) => self::getUrl('edit', compact('record'))),
                    Tables\Actions\DeleteAction::make(),
                    // Tables\Actions\Action::make('preview')->groupedIcon('heroicon-o-arrow-top-right-on-square')
                    //     ->url(fn ($record) => localized_url($record->locales()[0] ?? app()->getLocale(), route('catalogs.show', $record)), true),
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

                TextEntry::make('document')->getStateUsing(fn ($record) => $record->document->getSignedUrl())->copyable(),

                ViewEntry::make('media')->view('filament.infolists.entries.media', ['type' => 'catalog-image'])->label('admin.Image')->columnSpanFull(),

                ViewEntry::make('locales')->view('filament.infolists.entries.locales'),
            ])->columns(2),

            \Filament\Infolists\Components\Section::make()->schema([
                TextEntry::make('body')->columnSpanFull()->hiddenLabel()->html()->state(function (Catalog $catalog) {
                    $content = $catalog->body ? tiptap_converter()->asHTML($catalog->body) : __('admin.No Description');

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
            'index' => Pages\ListCatalogs::route('/'),
            'create' => Pages\CreateCatalog::route('/create'),
            'view' => Pages\ViewCatalog::route('/{record}'),
            'edit' => Pages\EditCatalog::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.catalog');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Catalog');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.catalogs');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Catalogs');
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.Catalogs');
    }
}
