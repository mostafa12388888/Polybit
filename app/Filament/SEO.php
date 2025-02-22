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
    protected $other_fields = [];

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
        return Tabs::make()->schema(function ($get) use ($other_fields) {
            if ($other_fields) {
                if (! $this->other_fields) {
                    if (is_callable($other_fields)) {
                        $this->other_fields = $other_fields($get);
                    } else {
                        $this->other_fields = $other_fields;
                    }
                }

                $first_component = $this->other_fields[0];

                $tabs = $first_component instanceof Tab ? $this->other_fields : [Tab::make('General')->schema($this->other_fields)];
            }

            $tabs[] = Tab::make('SEO')->schema($this->fields());

            return $tabs;
        })->columnSpanFull()->persistTabInQueryString();
    }

    public function fields(): array
    {
        $only = $this->only;

        return [
            Group::make()->schema(Arr::only([
                'meta_title' => TextInput::make('meta_title')->maxLength(250)->columnSpanFull(),
                'meta_description' => Textarea::make('meta_description')->autosize()->maxLength(1000)->columnSpanFull(),
                'meta_keywords' => TagsInput::make('meta_keywords')->splitKeys([','])->reorderable()->columnSpanFull(),
                'og_image' => CuratorPicker::make('og_image')->multiple()->typeValue('og-image')->maxItems(1)
                    ->buttonLabel('admin.Add Image')->acceptedFileTypes(['image/*'])->size('sm')->constrained()
                    ->relationship('media_items', 'id'),
            ], $only))->columns(2)->columnSpanFull(),
        ];
    }
}
