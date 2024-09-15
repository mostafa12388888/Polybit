<?php

namespace App\Filament\Resources\PermissionResource\RelationManager;

use App\Filament\Resources\RoleResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables\Table;

class RoleRelationManager extends RelationManager
{
    protected static string $relationship = 'roles';

    protected static ?string $recordTitleAttribute = 'name';

    protected static function getModelLabel(): string
    {
        return __('filament-spatie-roles-permissions::filament-spatie.section.role');
    }

    protected static function getPluralModelLabel(): string
    {
        return __('filament-spatie-roles-permissions::filament-spatie.section.roles');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.name')),
                TextInput::make('guard_name')
                    ->label(__('filament-spatie-roles-permissions::filament-spatie.field.guard_name'))
                    ->visible(fn () => config('filament-spatie-roles-permissions.should_show_guard', true)),

            ]);
    }

    public function table(Table $table): Table
    {
        return RoleResource::table($table)
            ->heading(__('filament-spatie-roles-permissions::filament-spatie.section.roles'));
    }
}
