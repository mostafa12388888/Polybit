<?php

namespace App\Filament\Resources\BlogCategoryResource\Pages;

use App\Filament\Resources\BlogCategoryResource;
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
        return $this->getRecord()->parent_id ? [] : parent::getRelationManagers();
    }

    public function getRecordTitle(): string|Htmlable
    {
        return $this->getRecord()->parent_id ? __('admin.Sub Category') : __('admin.Blog Category');
    }

    // public function getBreadcrumbs(): array
    // {
    //     $resource = static::getResource();

    //     $breadcrumbs[$resource::getUrl()] = $resource::getBreadcrumb();

    //     if($this->getRecord()->parent_id) {
    //         $parent = $this->getRecord()->parent;

    //         $breadcrumbs[$resource::getUrl('view', ['record' => $parent])] = str($parent->name)->limit(15, '');
    //     }

    //     $breadcrumbs[] = $this->getBreadcrumb();

    //     return $breadcrumbs;
    // }
}
