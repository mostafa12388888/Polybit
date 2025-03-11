<?php

namespace App\Filament\Resources\TestimonialResource\Pages;

use App\Filament\Resources\TestimonialResource;
use App\Filament\Traits\ListRecords\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Support\Facades\Cache;

class ListTestimonials extends ListRecords
{
    use Translatable;

    protected static string $resource = TestimonialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\CreateAction::make(),
        ];
    }

    public function reorderTable(array $order): void
    {
        parent::reorderTable($order);

        collect(array_keys(locales()))->map(fn ($locale) => Cache::forget('slides_'.$locale));
    }
}
