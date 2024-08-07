<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Password;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?int $navigationSort = -10;

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                TextInput::make('name')->required()->minLength(2)->maxLength(150),
                TextInput::make('slug')->label('admin.Username')
                    ->minLength(3)->maxLength(50)->unique(ignoreRecord: true),
                TextInput::make('email')
                    ->required()->email()->maxLength(150)->unique(ignoreRecord: true),
                TextInput::make('password')->rules(['nullable', Password::defaults()])
                    ->maxLength(150)->password()->revealable()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
                Toggle::make('is_admin')->rules('boolean'),
            ])->columns(2)->columnSpan(2),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')->sortable()->searchable()->toggleable(),
                TextColumn::make('name')->searchable()->sortable(),
                TextColumn::make('email')->toggleable()->searchable(),
                ToggleColumn::make('is_admin')->toggleable()
                    ->disabled(fn ($record) => $record->is(auth()->user())),
                TextColumn::make('created_at')->date()->toggleable(true, true)->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->url(fn ($record) => self::getUrl('view', compact('record'))),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc')
            ->persistSortInSession()
            ->filtersFormColumns(1);
    }

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist->schema([
            \Filament\Infolists\Components\Section::make()->schema([
                TextEntry::make('id'),
                TextEntry::make('name'),
                TextEntry::make('slug')->label('admin.Username'),
                TextEntry::make('email'),
                TextEntry::make('is_admin')->state(fn (User $user) => $user->is_admin ? 'True' : 'False'),
                TextEntry::make('created_at')->dateTime(),
            ])->columns(2)->columnSpan(2),
        ])->columns(2);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'view' => Pages\ViewUser::route('/{record}'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }

    public static function getModelLabel(): string
    {
        return __('admin.user');
    }

    public static function getTitleCaseModelLabel(): string
    {
        return __('admin.User');
    }

    public static function getPluralModelLabel(): string
    {
        return __('admin.users');
    }

    public static function getTitleCasePluralModelLabel(): string
    {
        return __('admin.Users');
    }

    public static function getNavigationGroup(): ?string
    {
        return __('admin.Users');
    }
}
