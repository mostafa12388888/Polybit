<?php

namespace App\Filament\Resources\AttributeResource\RelationManagers;

use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\ColorColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ValuesRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'values';

    public function form(Form $form): Form
    {
        $value_field = $this->ownerRecord->type->isColors() ?
            ColorPicker::make('value.'.collect(array_keys(locales()))->first())->required()->hexColor()->label('admin.Color') :
            TextInput::make('value')->maxLength(250)->hiddenLabel()
                ->translatable(true, null, [collect(array_keys(locales()))->first() => 'required']);

        return $form
            ->schema([
                $value_field->afterStateHydrated(function ($record, $livewire) {
                    if ($record) {
                        $livewire->mountedTableActionsData[0]['value'] = json_decode($record->getAttributes()['value'], true);
                        $livewire->mountedTableActionsData[0]['title'] = json_decode($record->getAttributes()['title'], true);
                    }
                })->columnSpanFull(),
                TextInput::make('title')->translatable()->columnSpanFull()->visible($this->ownerRecord->type->isColors()),
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
                TextColumn::make('id')->sortable()->searchable()->toggleable(),
                $this->ownerRecord->type->isColors() ?
                    ColorColumn::make('value')->sortable()->searchable() :
                    TextColumn::make('value')->sortable()->searchable(),
                TextColumn::make('title')->sortable()->searchable()->toggleable(true, ! $this->ownerRecord->type->isColors()),
            ])
            ->filters([
                //
            ])
            ->headerActions($this->ownerRecord->type->isColors() ? [Tables\Actions\CreateAction::make()] : [
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
