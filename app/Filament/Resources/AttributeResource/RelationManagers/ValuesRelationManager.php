<?php

namespace App\Filament\Resources\AttributeResource\RelationManagers;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;

class ValuesRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'values';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('value')->required()->maxLength(255)
                    ->afterStateHydrated(fn ($record, $livewire) => $livewire->mountedTableActionsData[0]['value'] = json_decode($record->getAttributes()['value'], true))
                    ->translatable()->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('admin.Attribute values'))
            ->modelLabel(__('admin.value'))
            ->pluralModelLabel(__('admin.attribute values'))
            ->recordTitleAttribute('value')
            ->columns([
                Tables\Columns\TextColumn::make('id'),
                Tables\Columns\TextColumn::make('value'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\LocaleSwitcher::make(),
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }

    public function canCreate(): bool
    {
        return true;
    }

    public function canEdit($record): bool
    {
        return true;
    }
}
