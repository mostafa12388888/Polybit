<?php

namespace App\Filament\Resources\BlogCategoryResource\RelationManagers;

use App\Filament\Resources\BlogCategoryResource;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\Concerns\Translatable;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use FilamentTiptapEditor\TiptapEditor;

class SubCategoriesRelationManager extends RelationManager
{
    use Translatable;

    protected static string $relationship = 'sub_categories';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')->maxLength(250)->required(),
                TextInput::make('slug')->maxLength(250),
                TiptapEditor::make('description')->profile('minimal')->columnSpanFull(),
            ])->translatable();
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading(__('admin.Sub Categories'))
            ->modelLabel(__('admin.sub category'))
            ->pluralModelLabel(__('admin.sub categories'))
            ->recordTitleAttribute('name')
            ->columns([
                TextColumn::make('id')->width(0)->sortable()->searchable()->toggleable(),
                TextColumn::make('name')->sortable()->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\LocaleSwitcher::make(),
                Tables\Actions\CreateAction::make()
                    ->url(fn ($livewire) => BlogCategoryResource::getUrl('create', ['ownerRecord' => $livewire->ownerRecord->getKey()])),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->url(fn ($record) => BlogCategoryResource::getUrl('view', compact('record'))),
                    Tables\Actions\EditAction::make()->url(fn ($record) => BlogCategoryResource::getUrl('edit', compact('record'))),
                    Tables\Actions\DeleteAction::make(),
                    Tables\Actions\Action::make('preview')->groupedIcon('heroicon-o-arrow-top-right-on-square')
                        ->url(fn ($record) => route('blog-categories.show', $record), true),
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
