<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AnotherProductResource\Pages;
use App\Filament\SEO;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Product;
use App\Models\StoreCategory;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Closure;
use Filament\Forms\Components\Actions\Action as FormAction;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\IconEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Concerns\Translatable;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Blade;
use Mokhosh\FilamentRating\Columns\RatingColumn;
use Mokhosh\FilamentRating\Components\Rating;
use Mokhosh\FilamentRating\Entries\RatingEntry;
use Mokhosh\FilamentRating\RatingTheme;

class AnotherProductResource extends Resource
{
    use Translatable;

    protected static ?string $model = Product::class;

    // public static function getEloquentQuery(): Builder
    // {
    //     return parent::getEloquentQuery()
    //         ->whereHas('variantsStatusOn'); // شرط لعرض المنتجات التي تحتوي على variants نشطة فقط
    // }
    protected static ?string $navigationIcon = 'heroicon-o-squares-2x2';

    // protected static ?string $navigationLabel = 'متجر المنتجات';

    protected static ?int $navigationSort = -2;

    protected static ?string $slug = 'another-products';

    public static function getSlug(): string
    {
        return 'another-products';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                SEO::make()->schema(function ($get) {
                    $tabs[] = Tab::make('General')->schema([
                        TextInput::make('name')->required()->maxLength(250),
                        TextInput::make('slug')->maxLength(250),
                        TextInput::make('sku')->label('admin.SKU (Stock Keeping Unit)')
                            ->required()->maxLength(250)->unique('products', 'sku', null, true),
                        Rating::make('rate')->theme(RatingTheme::HalfStars)->stars(10)->default(8.5),
                        TextInput::make('price')->prefixIcon('heroicon-o-currency-euro')->numeric()->step(0.01)->rules(['decimal:0,2'])->requiredWith('price_before_discount'),
                        TextInput::make('price_before_discount')->prefixIcon('heroicon-o-currency-euro')->numeric()->step(0.01)
                            ->rules(['decimal:0,2'])->gt('price'),

                        Toggle::make('is_available')->label('admin.Available in stock')->default(true),

                        TiptapEditor::make('description')->required()->columnSpanFull()->profile('minimal')
                            ->imageResizeMode('cover')->imageCropAspectRatio('16:9')->imageResizeTargetWidth(1920),

                        Select::make('categories')->multiple()->searchable()
                            ->relationship(titleAttribute: 'name')
                            ->getSearchResultsUsing(function ($query) {
                                return StoreCategory::subCategories()->where('name', 'like', '%'.$query.'%')->pluck('name', 'id')->toArray();
                            })
                            ->options(function () {
                                foreach (StoreCategory::parents()->with('sub_categories')->get() as $key => $category) {
                                    $options[$category->name] = $category->sub_categories->pluck('name', 'id')->toArray();
                                }

                                return $options ?? [];
                            })->columnSpanFull(),

                        Select::make('tags')->relationship(titleAttribute: 'name')->multiple()->preload()
                            ->createOptionForm([
                                TextInput::make('name')->label(__('admin.Tag'))->required()->translatable(),
                            ])->searchable()->columnSpanFull(),
                    ]);

                    $tabs[] = Tab::make('Images')->schema([
                        CuratorPicker::make('images')->multiple()->constrained()
                            ->typeValue('product-image')
                            ->buttonLabel('admin.Add Images')
                            ->acceptedFileTypes(['image/*'])
                            ->listDisplay(true)->size('sm')
                            ->relationship('media_items', 'id')
                            ->columnSpanFull(),

                        Repeater::make('embeded_urls')->simple(TextInput::make('url')->prefixIcon('heroicon-o-cube')->rules(['url']))->columnSpanFull(),
                    ]);

                    $tabs[] = Tab::make('Videos')->schema([
                        Repeater::make('videos')->schema([
                            TextInput::make('url')->label('admin.Embed Url')
                                ->afterStateUpdated(function (callable $set, ?string $state) {
                                    preg_match('/src="([^"]+)"/i', $state, $match);
                                    $url = array_pop($match) ?: $state;

                                    // convert youtube video url to embed url
                                    if (
                                        preg_match('/youtube\.com\/watch\?v=([^&]+)/', $url, $matches) ||
                                        preg_match('/youtu\.be\/([^?]+)/', $url, $matches)
                                    ) {
                                        $url = 'https://www.youtube.com/embed/'.$matches[1];
                                    }

                                    // clean embed url from any extra parameters
                                    if (preg_match('/youtube\.com\/embed\/([^?]+)/', $url, $matches)) {
                                        $url = 'https://www.youtube.com/embed/'.$matches[1];
                                    }

                                    $set('url', $url);
                                })
                                ->prefixIcon('heroicon-o-video-camera')->rules(['url']),
                        ])->columnSpanFull(),
                    ]);

                    $tabs[] = Tab::make('Attributes')->schema([
                        Repeater::make('attributes')->hiddenLabel()->maxItems(fn () => Attribute::has('values')->count())->schema([
                            Select::make('attribute')->searchable()->preload()->reactive()
                                ->options(fn () => Attribute::has('values')->limit(50)->pluck('name', 'id')->toArray())
                                ->exists(Attribute::class, 'id')->required()
                                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                                ->getSearchResultsUsing(fn (string $search): array => Attribute::where('name', 'like', "%{$search}%")->limit(50)->pluck('name', 'id')->toArray())
                                ->afterStateUpdated(fn ($set) => $set('values', [])),

                            Select::make('values')->searchable()->preload()->multiple()->reactive()->required()
                                ->options(fn ($get, $state) => AttributeValue::where('attribute_id', $get('attribute'))->get()
                                    ->map(function ($value) use ($state) {
                                        $value->order = array_search($value->id, $state);

                                        return $value;
                                    })->sortBy('order')
                                    ->mapWithKeys(fn ($value, $key) => [$value->id => $value->title ? $value->title : $value->value])->toArray()),
                        ])->live()->defaultItems(1)->columns(2)->columnSpanFull(),
                    ]);

                    $tabs[] = Tab::make('Specefications')->schema([
                        Repeater::make('specs')->label('admin.Specefications')->hiddenLabel()
                            ->schema([
                                TextInput::make('title')->required()->maxLength(250)->translatable()->formatStateUsing(function ($state, $record) {
                                    $state['title'] = json_decode(optional($record?->getAttributes())['title'], true);
                                    $state['description'] = json_decode(optional($record?->getAttributes())['description'], true);

                                    return $state;
                                }),

                                TiptapEditor::make('description')->profile('minimal')->translatable(),

                                Tabs::make()->schema(function () {
                                    foreach (locales() as $key => $locale) {
                                        $tabs[] = Tab::make($locale)->schema([
                                            CuratorPicker::make('media_'.$key)->label('admin.Media')->multiple()->constrained()
                                                ->typeValue($key)
                                                ->listDisplay(true)->size('sm')
                                                ->relationship('media_items', 'id'),
                                        ]);
                                    }

                                    return $tabs ?? [];
                                }),
                            ])
                            ->mutateStateForValidationUsing(function ($state) {
                                return collect($state)
                                    ->filter(fn ($spec) => collect($spec['title'])->filter(fn ($locale_title) => $locale_title)->count())
                                    ->map(function ($spec) {
                                        $spec_title = collect($spec['title'])->filter()->first();
                                        $spec['title'] = collect($spec['title'])->map(fn ($title) => $title ?: $spec_title);

                                        return $spec;
                                    })
                                    ->toArray();
                            })
                            ->relationship('specs')
                            ->collapsible()->persistCollapsed()
                            ->orderColumn('order')->reorderableWithButtons()
                            ->defaultItems(0)->columnSpanFull(),
                    ]);

                    $attributes = Attribute::whereIn('id', collect($get('attributes'))->filter(fn ($attribute) => count($attribute['values']))->pluck('attribute')->toArray())->orderBy('id')->get();

                    $tabs[] = Tab::make('Variants')->schema([
                        Repeater::make('variants')->label('admin.Available variants')
                            ->schema(function ($get) use ($attributes) {
                                $selected_attributes = collect($get('attributes'));
                                $cloned_attributes = clone $attributes;

                                return [
                                    Section::make()
                                        ->columns(2)
                                        ->schema([
                                            Repeater::make('attribute_values_product_variant')->hiddenLabel()
                                                ->simple(function () use ($cloned_attributes, $selected_attributes) {
                                                    $attribute = $cloned_attributes->shift();
                                                    $values = optional($selected_attributes->where('attribute', optional($attribute)->id)->first())['values'];

                                                    return $attribute ? Select::make('attribute_value_id')->label($attribute->name)->hiddenLabel()
                                                        ->prefix($attribute->name)->searchable()->preload()
                                                        ->required()->in($values ?: [])
                                                        ->relationship('attribute_value', 'value', fn ($query) => $query->whereIn('id', $values ?? []))
                                                        ->getOptionLabelFromRecordUsing(fn ($record) => $record->getTranslation('title', app()->getLocale(), true) ?: $record->value) : null;
                                                })
                                                ->relationship('attribute_values_product_variant')->columnSpanFull()->grid(3)->deletable(false)
                                                ->saveRelationshipsUsing(function ($record, $state) {
                                                    $record->attribute_values()->sync(collect($state)->pluck('attribute_value_id')->toArray());
                                                })
                                                ->minItems($attributes->count())->maxItems($attributes->count())->defaultItems($attributes->count())
                                                ->rule(
                                                    fn ($component) => function (string $attribute, $value, Closure $fail) use ($component) {
                                                        $variants = $component->getContainer()->getParentComponent()->getState();
                                                        $variants_values = collect($variants)->pluck('attribute_values_product_variant')
                                                            ->map(fn ($attribute) => collect($attribute ?: [])->map(fn ($a) => (int) $a['attribute_value_id'])->values())->toArray();

                                                        $values = collect($value)->map(fn ($a) => (int) $a['attribute_value_id'])->values()->toArray();

                                                        $occurances = 0;
                                                        foreach ($variants_values as $variant_values) {
                                                            if ($values == $variant_values) {
                                                                $occurances++;
                                                            }
                                                        }
                                                        if ($occurances > 1) {
                                                            $fail(__('admin.The variant is duplicated'));
                                                        }
                                                    },
                                                ),

                                            Grid::make(3) // 3 أعمدة في السطر الواحد
                                                ->schema([
                                                    TextInput::make('price')->hiddenLabel()->prefix(__('admin.Price'))->numeric()->step(0.01)->rules(['decimal:0,2'])->requiredWith('price_before_discount'),

                                                    TextInput::make('price_before_discount')->hiddenLabel()->prefix(__('admin.Price before discount'))->numeric()->step(0.01)
                                                        ->rules(['decimal:0,2'])->gt('price'),
                                                    Toggle::make('status')
                                                        ->label(__('admin.status'))
                                                        ->onColor('success')
                                                        ->offColor('danger'),
                                                ]),
                                        ]),
                                ];
                            })
                            ->hintAction(
                                FormAction::make('generateAllPossibleVariants')->icon('heroicon-m-arrow-path')->requiresConfirmation()
                                    ->action(function ($get, $set) {
                                        $variants = [[]];

                                        foreach (collect($get('attributes'))->sortBy('attribute')->toArray() ?: [] as $attribute) {
                                            $temp = [];

                                            foreach ($variants as $variant) {
                                                foreach ($attribute['values'] as $value) {
                                                    $temp[str()->uuid()->toString()]['attribute_values_product_variant'] =
                                                        array_merge($variant['attribute_values_product_variant'] ?? [], [
                                                            str()->uuid()->toString() => [
                                                                'attribute_value_id' => $value,
                                                            ],
                                                        ]);
                                                }
                                            }

                                            $variants = $temp;
                                        }

                                        $set('variants', $variants);
                                    })
                            )
                            ->relationship('variants')
                            ->defaultItems(0)->columns(2)->columnSpanFull(),
                    ])->hidden(! $attributes->count());

                    return $tabs;
                })->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                CuratorColumn::make('media')->label('admin.Images')->circular()->size(40)->overlap(3)->limit(3)->toggleable(),
                TextColumn::make('name')->limit(50)->searchable()->sortable(),
                TextColumn::make('sku')->toggleable(true, true)->searchable()->sortable(),
                TextColumn::make('price')->toggleable(true, true)->sortable(),
                ToggleColumn::make('is_available')->toggleable(true, true),
                RatingColumn::make('rate')->stars(10)->theme(RatingTheme::HalfStars)->size('sm')->toggleable(true, true),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
                TextColumn::make('locales')->getStateUsing(fn ($record) => collect($record->locales())->map(fn ($locale) => locales()[$locale] ?? $locale)->toArray())->toggleable(true, true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->url(fn ($record) => self::getUrl('view', compact('record'))),
                    Tables\Actions\EditAction::make()->url(fn ($record) => self::getUrl('edit', compact('record'))),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('preview')->groupedIcon('heroicon-o-arrow-top-right-on-square')
                        ->url(fn ($record) => route('products.show', $record), true),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('products.id', 'desc')
            ->persistSortInSession()
            ->filtersFormColumns(1);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            \Filament\Infolists\Components\Tabs::make()->schema([
                \Filament\Infolists\Components\Tabs\Tab::make('General')->schema([
                    TextEntry::make('id'),
                    TextEntry::make('name'),
                    TextEntry::make('slug'),
                    TextEntry::make('sku')->label('admin.SKU (Stock Keeping Unit)'),
                    TextEntry::make('price'),
                    TextEntry::make('price_before_discount'),
                    IconEntry::make('is_available')->boolean(),
                    TextEntry::make('created_at')->dateTime(),

                    TextEntry::make('categories.name'),

                    ViewEntry::make('locales')->view('filament.infolists.entries.locales'),

                    RatingEntry::make('rate')->theme(RatingTheme::HalfStars)->stars(10)->hiddenLabel(false)->columnSpanFull()->size('sm'),

                    ViewEntry::make('media')->view('filament.infolists.entries.media', ['type' => 'product-image'])->label('admin.Images')->columnSpanFull(),

                    TextEntry::make('description')->columnSpanFull()->html()->state(function (Product $product) {
                        $content = $product->description ? tiptap_converter()->asHTML($product->description) : __('admin.No Content');

                        return Blade::render('<div class="prose max-w-full text-sm">'.$content.'</div>');
                    }),
                ])->columns(2),

                \Filament\Infolists\Components\Tabs\Tab::make('variantsStatusOn')->schema([
                    RepeatableEntry::make('variantsStatusOn')->hiddenLabel()->schema([
                        RepeatableEntry::make('attribute_values_product_variant')->hiddenLabel()->schema([
                            TextEntry::make('attribute_value')->hiddenLabel()
                                ->formatStateUsing(fn ($state) => $state->title ? $state->title : $state->value),
                        ])->grid(4)->columnSpanFull(),

                        TextEntry::make('price')->hiddenLabel()->prefix(__('admin.Price').': ')->hidden(fn ($state) => ! $state),
                        TextEntry::make('price_before_discount')->hiddenLabel()->prefix(__('admin.Price before discount').': ')->hidden(fn ($state) => ! $state),
                    ])->columns(2),
                ]),
            ])->columnSpanFull()->persistTabInQueryString(),
        ]);
    }

    public static function getRelations(): array
    {
        return [

        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->with([
                'media' => fn ($query) => $query->where('media_items.type', 'product-image'),
                'variants' => fn ($query) => $query->where('product_variants.status', 'on'),
            ])
            ->whereHas('variants', function ($query) {
                $query->where('product_variants.status', 'on');
            });

    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'view' => Pages\ViewProduct::route('/{record}'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.product');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.Product');
    }
    public static function getNavigationLabel(): string
{
    return __('admin.Product Store'); // Use a key from your language files
}

    public static function getPluralModelLabel(): string
    {
        return __('admin.products');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Products');
    }

    public static function getNavigationGroup(): string
    {
        return __('admin.Store');
    }
}
