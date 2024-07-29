<?php

namespace App\Filament;

use Awcodes\Curator\Components\Forms\CuratorPicker;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Tabs\Tab;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Illuminate\Support\Arr;

class SEO
{
    public function __construct($only)
    {
        $this->only = $only;
    }

    public static function make(array $only = ['meta_title', 'meta_keywords', 'meta_description', 'og_image'])
    {
        return new self($only);
    }

    public function schema($other_fields)
    {
        return Tabs::make()->schema([
            Tab::make('General')->schema($other_fields),
            Tab::make('SEO')->schema([$this->fields()]),
        ])->columnSpanFull()->persistTabInQueryString();
    }

    public function fields(): Group
    {
        $only = $this->only;

        return Group::make()->schema(Arr::only([
            'meta_title' => TextInput::make('meta_title')->columnSpanFull(),
            'meta_description' => Textarea::make('meta_description')->columnSpanFull(),
            'meta_keywords' => TagsInput::make('meta_keywords')->splitKeys([','])->reorderable()->columnSpanFull(),
            'og_image' => CuratorPicker::make('og_image')->multiple()->typeValue('og-image')->maxItems(1)
                ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')
                ->relationship('media_items', 'id'),
        ], $only))->columns(2)
            ->columnSpanFull();
    }
}
