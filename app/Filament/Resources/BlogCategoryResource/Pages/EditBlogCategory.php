<?php

namespace App\Filament\Resources\BlogCategoryResource\Pages;

use App\Filament\Resources\BlogCategoryResource;
use App\Filament\Traits\EditRecord\Translatable;
use App\Filament\Traits\Seoable;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditBlogCategory extends EditRecord
{
    use Seoable, Translatable;

    protected static string $resource = BlogCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getRecordTitle(): string|Htmlable
    {
        return $this->getRecord()->parent_id ? __('admin.Sub Category') : __('admin.Blog Category');
    }
}
