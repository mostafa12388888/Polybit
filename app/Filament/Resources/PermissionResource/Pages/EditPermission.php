<?php

namespace App\Filament\Resources\PermissionResource\Pages;

use App\Filament\Resources\PermissionResource;
use Filament\Resources\Pages\EditRecord;

class EditPermission extends EditRecord
{
    protected static string $resource = PermissionResource::class;

    protected function getRedirectUrl(): ?string
    {
        $resource = static::getResource();

        return config('filament-spatie-roles-permissions.should_redirect_to_index.permissions.after_edit', false)
            ? $resource::getUrl('index')
            : parent::getRedirectUrl();
    }

    public function getRelationManagers(): array
    {
        return [];
    }
}
