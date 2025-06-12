<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardResource\Pages;
use App\Models\Card;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Table;

class CardResource extends Resource
{
    use Translatable;

    protected static ?string $model = Card::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static ?int $navigationSort = -6;

    protected static ?string $navigationGroup = 'More';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('is_video')
                    ->label(__('admin.Media type'))
                    ->options([
                        1 => __('admin.image'),
                        2 => __('admin.upload video'),
                        3 => __('admin.link video external'),
                    ])
                    ->required()
                    ->reactive(),

                Tabs::make(__('admin.Media'))
                    ->tabs([
                        Tab::make(__('admin.image'))
                            ->visible(fn ($get) => $get('is_video') == 1)
                            ->schema([
                                CuratorPicker::make('image_or_video')
                                    ->label('Card Image')
                                    ->multiple(false)
                                    ->typeValue('card-image')
                                    ->buttonLabel('admin.Add Images')
                                    ->acceptedFileTypes(['image/*'])
                                    ->listDisplay(true)
                                    ->size('sm')
                                    ->relationship('media_file', 'id') // relationship name and related model key
                                    ->columnSpanFull(),

                            ]),

                        Tab::make(__('videos'))
                            ->visible(fn ($get) => $get('is_video') == 2)
                            ->schema([
                                CuratorPicker::make('image_or_video')
                                    ->label(__('admin.upload video'))
                                    ->multiple(false)
                                    ->constrained()
                                    ->relationship('media_file', 'id'),
                            ]),

                        Tab::make( __('admin.link video external'))
                            ->visible(fn ($get) => $get('is_video') == 3)
                            ->schema([
                                // Repeater::make('external_videos')
                                //     ->label(__('admin.link video'))
                                //     ->schema([
                                        TextInput::make('url')
                                            ->label(__('admin.link video'))
                                            ->afterStateUpdated(function (callable $set, ?string $state) {
                                                preg_match('/src="([^"]+)"/i', $state, $match);
                                                $url = array_pop($match) ?: $state;

                                                if (
                                                    preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches) ||
                                                    preg_match('/youtu\.be\/([^?]+)/', $url, $matches)
                                                ) {
                                                    $url = 'https://www.youtube.com/embed/'.$matches[1];
                                                }

                                                if (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $matches)) {
                                                    $url = 'https://www.youtube.com/embed/'.$matches[1];
                                                }

                                                $set('url', $url);
                                            })
                                            ->prefixIcon('heroicon-o-video-camera')
                                            ->rules(['url']),
                                    // ])
                                    // ->columnSpanFull(),
                            ]),
                    ]),

                TextInput::make('link')
                    ->label(__('admin.add link'))
                    ->url()->required(),

                TextInput::make('title.en')
                    ->label(__('admin.title en'))
                    ->required(),

                TextInput::make('title.ar')
                    ->label(__('admin.title ar'))
                    ->required(),

                Textarea::make('description.ar')->label(__('admin.description ar')),

                Textarea::make('description.en')->label(__('admin.description en')),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label(__('admin.title')),

                ViewColumn::make('mediaFile')
                    ->label('admin.Images')
                    ->getStateUsing(fn ($record) => $record)
                    ->view('filament.components.card-media-column'),

                TextColumn::make('link')->label(__('admin.link'))->limit(30),

                IconColumn::make('is_video')
                    ->label(__('admin.link'))
                    ->boolean() // يظهر كأيقونة
                    ->icon(fn ($state) => match ($state) {
                        '1' => 'heroicon-o-photo',
                        '2' => 'heroicon-o-video-camera',
                        '3' => 'heroicon-o-link',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn ($state) => match ($state) {
                        '1' => 'info',
                        '2' => 'warning',
                        '3' => 'success',
                        default => 'gray',
                    }),
            ])
            ->actions([
                // أضف هنا الإجراءات إذا احتجت
            ])
            ->bulkActions([
                // أضف هنا الإجراءات بالجملة إذا احتجت
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCards::route('/'),
            'create' => Pages\CreateCard::route('/create'),
            'edit' => Pages\EditCard::route('/{record}/edit'),
        ];
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.More');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.Cards');
    }
}
