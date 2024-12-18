<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SlideResource\Pages;
use App\Models\Slide;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SlideResource extends Resource
{
    use Translatable;

    protected static ?string $model = Slide::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?int $navigationSort = -2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    ToggleButtons::make('active_locales')->multiple()->options(locales())
                        ->formatStateUsing(fn ($record) => $record ? $record->locales() : array_keys(locales()))
                        ->gridDirection('row')->grouped()->extraAttributes(['style' => 'width: 100%']),

                    TextInput::make('title')->maxLength(250)->columnSpanFull(),
                    Textarea::make('description')->maxLength(5000)->columnSpanFull(),

                    TableRepeater::make('actions')->headers([
                        Header::make('text')->label(__('admin.Text')),
                        Header::make('url')->label(__('admin.Url')),
                    ])->schema([
                        TextInput::make('text')->maxLength(50)->required(),
                        TextInput::make('url')->maxLength(250)->required(),
                    ])->defaultItems(0)->columnSpanFull(),

                    CuratorPicker::make('image')->required()->multiple()->maxItems(1)
                        ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->constrained()
                        ->relationship('media_items', 'id')->columnSpanFull(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->reorderable('order')
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                CuratorColumn::make('media')->label('admin.Image')->circular()->size(40)->limit(3)->toggleable(),
                TextColumn::make('title')->limit(50)->searchable()->sortable(),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
                TextColumn::make('locales')->getStateUsing(fn ($record) => collect($record->locales())->map(fn ($locale) => locales()[$locale] ?? $locale)->toArray())->toggleable(true, true),
                TextColumn::make('order')->sortable()->toggleable(true, true),
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
                TextEntry::make('title'),
                TextEntry::make('description')->columnSpanFull(),

                ViewEntry::make('media')->view('filament.infolists.entries.media')->label('admin.Image')->columnSpanFull(),

                RepeatableEntry::make('actions')
                    ->visible(fn ($record) => $record->actions)
                    ->schema([
                        TextEntry::make('text')->label(__('admin.Text'))->hiddenLabel(),
                        TextEntry::make('url')->label(__('admin.Text'))->hiddenLabel()->url(fn ($state) => $state),
                    ])->columnSpanFull(),

                TextEntry::make('created_at')->dateTime(),

                ViewEntry::make('locales')->view('filament.infolists.entries.locales'),
            ])->columns(2)->columnSpan(2),
        ])->columns(2);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('media');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSlides::route('/'),
            'create' => Pages\CreateSlide::route('/create'),
            'view' => Pages\ViewSlide::route('/{record}'),
            'edit' => Pages\EditSlide::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.slide');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Slide');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.slides');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Slides');
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.More');
    }
}
