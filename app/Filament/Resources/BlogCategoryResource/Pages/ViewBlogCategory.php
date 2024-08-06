<?php

namespace App\Filament\Resources\BlogCategoryResource\Pages;

use App\Filament\Resources\BlogCategoryResource;
use App\Filament\Resources\BlogCategoryResource\RelationManagers\PostsRelationManager;
use App\Filament\Resources\BlogCategoryResource\RelationManagers\SubCategoriesRelationManager;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\Support\Htmlable;

class ViewBlogCategory extends ViewRecord
{
    use ViewRecord\Concerns\Translatable;

    protected static string $resource = BlogCategoryResource::class;

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
            PostsRelationManager::class,
        ] : [
            SubCategoriesRelationManager::class,
        ];
    }

    public function getRecordTitle(): string|Htmlable
    {
        return $this->getRecord()->parent_id ? __('admin.Sub Category') : __('admin.Blog Category');
    }
}
