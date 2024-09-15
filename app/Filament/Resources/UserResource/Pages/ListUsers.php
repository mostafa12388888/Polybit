<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            __('admin.All') => Tab::make()->icon('heroicon-o-users'),
            __('admin.Admins') => Tab::make()->modifyQueryUsing(fn ($query) => $query->whereHas('roles'))->icon('heroicon-o-shield-check'),
            __('admin.Users') => Tab::make()->modifyQueryUsing(fn ($query) => $query->whereDoesntHave('roles'))->icon('heroicon-o-user'),
        ];
    }
}
