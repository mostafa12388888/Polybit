<?php

namespace App\Filament\Resources;

use App\Filament\Resources\FaqResource\Pages;
use App\Models\Faq;
use Filament\Forms\Components\Section;
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

class FaqResource extends Resource
{
    use Translatable;

    protected static ?string $model = Faq::class;

    protected static ?string $navigationIcon = 'heroicon-o-question-mark-circle';

    protected static ?int $navigationSort = -2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('question')->required()->maxLength(250)->columnSpanFull(),
                    TiptapEditor::make('answer')->profile('minimal')->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                TextColumn::make('question')->sortable()->searchable(),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
                TextColumn::make('locales')->getStateUsing(fn ($record) => collect($record->locales())->map(fn ($locale) => locales()[$locale] ?? $locale)->toArray())->toggleable(true, true),
                TextColumn::make('order')->sortable()->toggleable(true, true),
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
            ->defaultSort('order', 'asc')
            ->persistSortInSession()
            ->filtersFormColumns(1);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            \Filament\Infolists\Components\Section::make()->schema([
                TextEntry::make('id'),
                TextEntry::make('question')->columnSpanFull(),

                TextEntry::make('answer')->state(function (Faq $faq) {
                    $content = $faq->answer ? tiptap_converter()->asHTML($faq->answer) : '';

                    return Blade::render('<div class="prose max-w-full text-sm">'.$content.'</div>');
                })->html()->columnSpanFull(),

                TextEntry::make('created_at')->dateTime(),

                ViewEntry::make('locales')->view('filament.infolists.entries.locales'),
            ])->columns(2)->columnSpan(2),
        ])->columns(2);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListFaqs::route('/'),
            'create' => Pages\CreateFaq::route('/create'),
            'view' => Pages\ViewFaq::route('/{record}'),
            'edit' => Pages\EditFaq::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.faq');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Faq');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.faqs');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Faqs');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.More');
    }
}
