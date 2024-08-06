<?php

namespace App\Filament\Resources\StoreCategoryResource\Pages;

use App\Filament\Resources\StoreCategoryResource;
use App\Filament\Resources\StoreCategoryResource\RelationManagers\ProductsRelationManager;
use App\Filament\Resources\StoreCategoryResource\RelationManagers\SubCategoriesRelationManager;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewStoreCategory extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = StoreCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\EditAction::make(),
        ];
    }

    public function getRelationManagers(): array
    {
        return $this->getRecord()->parent_id ? [
            ProductsRelationManager::class,
        ] : [
            SubCategoriesRelationManager::class,
        ];
    }

    public function getRecordTitle(): string|Htmlable
    {
        return $this->getRecord()->parent_id ? __('admin.Sub Category') : __('admin.Store Category');
    }
}
