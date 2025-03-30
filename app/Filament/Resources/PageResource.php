<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PageResource\Pages;
use App\Filament\SEO;
use App\Models\Page;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
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
use Illuminate\Support\Facades\Route;

class PageResource extends Resource
{
    use Translatable;

    protected static ?string $model = Page::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = -4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SEO::make()->schema([
                    Tab::make('General')->schema([
                        TextInput::make('title')->required()->maxLength(250)->hidden(fn ($record) => ! $record->is_editable),
                        TextInput::make('slug')->maxLength(250)->hidden(fn ($record) => ! $record->is_editable),
                        TiptapEditor::make('body')->columnSpanFull(),
                        Group::make()->schema([
                            Toggle::make('is_visible_in_top_navbar')->rules('boolean'),
                            Toggle::make('is_visible_in_main_navbar')->rules('boolean'),
                            Toggle::make('is_visible_in_footer_navbar')->rules('boolean'),
                        ])->columns(3)->hidden(fn ($record) => ! $record->is_editable),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                TextColumn::make('title')->sortable()->searchable(),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
                TextColumn::make('locales')->getStateUsing(fn ($record) => collect($record->locales())->map(fn ($locale) => locales()[$locale] ?? $locale)->toArray())->toggleable(true, true),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->url(fn ($record) => self::getUrl('view', compact('record'))),
                    Tables\Actions\EditAction::make()->url(fn ($record) => self::getUrl('edit', compact('record'))),
                    Tables\Actions\DeleteAction::make()->hidden(fn ($record) => ! $record->is_editable),
                    Tables\Actions\Action::make('preview')->groupedIcon('heroicon-o-arrow-top-right-on-square')
                        ->url(fn ($record) => $record->route && Route::has($record->route) ? route($record->route) : route('pages.show', $record), true),
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
                \Filament\Infolists\Components\Group::make([
                    ViewEntry::make('locales')->view('filament.infolists.entries.locales'),
                    TextEntry::make('is_visible_in_top_navbar')->state(fn (Page $page) => $page->is_visible_in_top_navbar ? 'True' : 'False'),
                    TextEntry::make('is_visible_in_main_navbar')->state(fn (Page $page) => $page->is_visible_in_main_navbar ? 'True' : 'False'),
                    TextEntry::make('is_visible_in_footer_navbar')->state(fn (Page $page) => $page->is_visible_in_footer_navbar ? 'True' : 'False'),
                ])->hidden(fn ($record) => ! $record->is_editable),
            ])->columns(2),

            \Filament\Infolists\Components\Section::make()->schema([
                TextEntry::make('body')->columnSpanFull()->hiddenLabel()->html()->state(function (Page $page) {
                    $content = $page->body ? tiptap_converter()->asHTML($page->body) : __('admin.No Content');

                    return Blade::render('<div class="prose max-w-full text-sm">'.$content.'</div>');
                }),
            ]),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPages::route('/'),
            'create' => Pages\CreatePage::route('/create'),
            'view' => Pages\ViewPage::route('/{record}'),
            'edit' => Pages\EditPage::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.page');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Page');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.pages');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Pages');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.More');
    }
}
