<?php

namespace App\Filament\Resources\PageResource\Pages;

use App\Filament\Resources\PageResource;
use App\Filament\Traits\ListRecords\Translatable;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Filament\Resources\Pages\ListRecords\Tab;
use Illuminate\Support\Facades\Cache;

class ListPages extends ListRecords
{
    use Translatable;

    protected static string $resource = PageResource::class;

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

        Cache::forget('pages');
    }

    public function getTabs(): array
    {
        return [
            __('admin.Customizable Pages') => Tab::make()->modifyQueryUsing(fn ($query) => $query->where('is_editable', true))->icon('heroicon-o-pencil-square'),
            __('admin.Preset Pages') => Tab::make()->modifyQueryUsing(fn ($query) => $query->where('is_editable', '!=', true))->icon('heroicon-o-lock-closed'),
        ];
    }
}
