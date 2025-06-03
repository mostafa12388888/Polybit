<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CardResource\Pages;
use App\Models\Card;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Concerns\Translatable;
use Filament\Forms\Components\Textarea;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;

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
                    ->label('نوع الوسائط')
                    ->options([
                        1 => 'صورة',
                        2 => 'فيديو مرفوع',
                        3 => 'رابط فيديو خارجي',
                    ])
                    ->required()
                    ->reactive(),

                Tabs::make('وسائط')
                    ->tabs([
                        Tab::make('صور')
                            ->visible(fn($get) => $get('is_video') == 1)
                            ->schema([
                                CuratorPicker::make('image_or_video')
                                    ->label('Card Image')
                                    ->multiple(false)
                                    ->typeValue('card-image')
                                    ->buttonLabel('admin.Add Images')
                                    ->acceptedFileTypes(['image/*'])
                                    ->listDisplay(true)
                                    ->size('sm')
                                    ->relationship('mediaFile', 'id') // relationship name and related model key
                                    ->columnSpanFull(),

                                // Repeater::make('external_videos') // إذا كنت تريد روابط مدمجة هنا أزلها من هنا، لأنها خاصة بالفيديو الخارجي
                                //     ->label('روابط مدمجة (اختياري)')
                                //     ->simple(
                                //         TextInput::make('url')
                                //             ->prefixIcon('heroicon-o-cube')
                                //             ->rules(['url'])
                                //     )
                                //     ->columnSpanFull(),
                            ]),

                        Tab::make('فيديوهات')
                            ->visible(fn($get) => $get('is_video') == 2)
                            ->schema([
                                CuratorPicker::make('image_or_video')
                                    ->label('رفع فيديوهات')
                                    ->multiple(false)
                                    ->constrained()
                                    ->relationship('mediaFile', 'id'),
                            ]),

                        Tab::make('روابط فيديو خارجية')
                            ->visible(fn($get) => $get('is_video') == 3)
                            ->schema([
                                Repeater::make('external_videos')
                                    ->label('روابط الفيديو')
                                    ->schema([
                                        TextInput::make('url')
                                            ->label('رابط الفيديو')
                                            ->afterStateUpdated(function (callable $set, ?string $state) {
                                                preg_match('/src="([^"]+)"/i', $state, $match);
                                                $url = array_pop($match) ?: $state;

                                                if (
                                                    preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches) ||
                                                    preg_match('/youtu\.be\/([^?]+)/', $url, $matches)
                                                ) {
                                                    $url = 'https://www.youtube.com/embed/' . $matches[1];
                                                }

                                                if (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $matches)) {
                                                    $url = 'https://www.youtube.com/embed/' . $matches[1];
                                                }

                                                $set('url', $url);
                                            })
                                            ->prefixIcon('heroicon-o-video-camera')
                                            ->rules(['url']),
                                    ])
                                    ->columnSpanFull(),
                            ]),
                    ]),

                TextInput::make('link')
                    ->label('رابط إضافي')
                    ->url()
                    ->nullable(),

                TextInput::make('title.ar')
                    ->label('العنوان (عربي)')
                    ->required(),

                TextInput::make('title.en')
                    ->label('العنوان (إنجليزي)')
                    ->required(),

                Textarea::make('description.ar')->label('الوصف (عربي)'),

                Textarea::make('description.en')->label('الوصف (إنجليزي)'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')->label('العنوان'),

                ViewColumn::make('mediaFile')
                    ->label('admin.Images')
                    ->getStateUsing(fn($record) => $record)
                    ->view('filament.components.card-media-column'),

                TextColumn::make('link')->label('الرابط')->limit(30),

                IconColumn::make('is_video')
                    ->label('النوع')
                    ->boolean() // يظهر كأيقونة
                    ->icon(fn($state) => match ($state) {
                        '1' => 'heroicon-o-photo',
                        '2' => 'heroicon-o-video-camera',
                        '3' => 'heroicon-o-link',
                        default => 'heroicon-o-question-mark-circle',
                    })
                    ->color(fn($state) => match ($state) {
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
