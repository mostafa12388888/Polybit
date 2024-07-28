<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProjectResource\Pages;
use App\Models\Project;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Awcodes\TableRepeater\Components\TableRepeater;
use Awcodes\TableRepeater\Header;
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
use FilamentTiptapEditor\TiptapEditor;
use Icetalker\FilamentTableRepeatableEntry\Infolists\Components\TableRepeatableEntry;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;

class ProjectResource extends Resource
{
    use Translatable;

    protected static ?string $model = Project::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office-2';

    protected static ?int $navigationSort = -3;

    protected static ?string $navigationGroup = 'More';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    TextInput::make('title')->required()->columnSpanFull(),
                    Textarea::make('subtitle')->required()->columnSpanFull(),
                    TextInput::make('slug')->columnSpanFull(),

                    TiptapEditor::make('description')->required()->columnSpanFull()
                        ->profile('minimal')
                        ->imageResizeMode('cover')->imageCropAspectRatio('16:9')->imageResizeTargetWidth(1920),

                    TableRepeater::make('attributes')->headers([
                        Header::make('key')->label(__('admin.Attribute')),
                        Header::make('value')->label(__('admin.Value')),
                    ])->schema([
                        TextInput::make('key')->required(),
                        TextInput::make('value')->required(),
                    ])->columnSpanFull()->columns(2)->defaultItems(4),

                    CuratorPicker::make('images')->multiple()
                        ->buttonLabel('admin.Add Images')
                        ->acceptedFileTypes(['image/*'])
                        ->listDisplay(true)->size('sm')
                        ->directory('projects')
                        ->relationship('media_items', 'id')
                        ->columnSpanFull(),
                ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->width(0),
                CuratorColumn::make('media')->circular()->size(40)->overlap(3)->limit(3)->toggleable(),
                TextColumn::make('title')->limit(50)->searchable()->sortable(),
                TextColumn::make('subtitle')->wrap()->limit(200)->lineClamp(2)
                    ->toggleable()->searchable()->sortable(),
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
                TextEntry::make('subtitle')->columnSpanFull(),

                ViewEntry::make('media')->view('filament.infolists.entries.media')->label('admin.Images')->columnSpanFull(),

                TableRepeatableEntry::make('attributes')->schema([
                    TextEntry::make('key')->hiddenLabel()->label(__('admin.Attribute')),
                    TextEntry::make('value')->hiddenLabel()->label(__('admin.Value')),
                ])->columnSpanFull()->striped()->extraAttributes([
                    'class' => '!border-gray-200 dark:!border-gray-600 overflow-hidden',
                ]),

                TextEntry::make('description')->state(function (Project $project) {
                    $content = $project->description ? tiptap_converter()->asHTML($project->description) : '';

                    return Blade::render('<div class="prose max-w-full text-sm">'.$content.'</div>');
                })->html()->columnSpanFull(),

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

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('media');
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProjects::route('/'),
            'create' => Pages\CreateProject::route('/create'),
            'view' => Pages\ViewProject::route('/{record}'),
            'edit' => Pages\EditProject::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.project');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Project');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.projects');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Projects');
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.More');
    }
}
