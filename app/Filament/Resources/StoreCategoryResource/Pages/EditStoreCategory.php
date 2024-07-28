<?php

namespace App\Filament\Resources\StoreCategoryResource\Pages;

use App\Filament\Resources\StoreCategoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Contracts\Support\Htmlable;

class EditStoreCategory extends EditRecord
{
    use EditRecord\Concerns\Translatable;

    protected static string $resource = StoreCategoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }

    public function getRelationManagers(): array
    {
        return $this->getRecord()->parent_id ? [] : parent::getRelationManagers();
    }

    public function getRecordTitle(): string|Htmlable
    {
        return $this->getRecord()->parent_id ? __('admin.Sub Category') : __('admin.Store Category');
    }
}
