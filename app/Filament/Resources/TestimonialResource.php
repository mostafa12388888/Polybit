<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TestimonialResource\Pages;
use App\Models\Testimonial;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
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
use Illuminate\Database\Eloquent\Builder;

class TestimonialResource extends Resource
{
    use Translatable;

    protected static ?string $model = Testimonial::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';

    protected static ?int $navigationSort = -1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('name')->required()->maxLength(250)->columnSpanFull(),
                    TextInput::make('job_title')->maxLength(250)->columnSpanFull(),

                    CuratorPicker::make('image')->multiple()->maxItems(1)
                        ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->constrained()
                        ->relationship('media_items', 'id')->columnSpanFull(),

                    Textarea::make('body')->autosize()->required()->maxLength(5000)->columnSpanFull(),
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
                TextColumn::make('name')->limit(50)->searchable()->sortable()->toggleable(),
                TextColumn::make('job_title')->limit(50)->searchable()->sortable()->toggleable(true, true),
                TextColumn::make('body')->limit(50)->searchable()->sortable()->toggleable(true, true),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
                TextColumn::make('locales')->getStateUsing(fn ($record) => collect($record->locales())->map(fn ($locale) => locales()[$locale] ?? $locale)->toArray())->toggleable(true, true),
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
                TextEntry::make('id')->columnSpanFull(),
                TextEntry::make('name'),
                TextEntry::make('job_title'),

                TextEntry::make('body')->columnSpanFull(),

                ViewEntry::make('media')->view('filament.infolists.entries.media')->label('admin.Image')->columnSpanFull(),

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
            'index' => Pages\ListTestimonials::route('/'),
            'create' => Pages\CreateTestimonial::route('/create'),
            'view' => Pages\ViewTestimonial::route('/{record}'),
            'edit' => Pages\EditTestimonial::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.testimonial');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Testimonial');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.testimonials');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Testimonials');
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.More');
    }
}
