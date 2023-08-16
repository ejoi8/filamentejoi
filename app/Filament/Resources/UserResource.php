<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Infolists;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Tabs;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\Actions;
use Filament\Infolists\Components\Tabs\Tab;
use Filament\Infolists\Components\TextEntry;
use App\Filament\Resources\UserResource\Pages;
use Filament\Infolists\Components\Actions\Action;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UserResource\RelationManagers;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(static::getFormSchema('basic'));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->searchable(),
                Tables\Columns\TextColumn::make('email')->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateActions([
                Tables\Actions\CreateAction::make(),
            ]);
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

    public static function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Tabs::make('Label')
                    ->tabs([
                        Tabs\Tab::make('Employee')
                            ->schema([
                                Grid::make(['default' => 1])
                                    ->relationship('employee')
                                    ->schema([
                                        TextEntry::make('user.name'),
                                        TextEntry::make('gender'),
                                        TextEntry::make('date_of_birth'),
                                        TextEntry::make('address'),
                                        TextEntry::make('phone_number'),
                                        TextEntry::make('employee_id'),

                                        Actions::make([
                                            Action::make('Edit employee')
                                                ->fillForm(fn ($record) =>  $record->employee->toArray())
                                                ->form([
                                                    Select::make('user_id')->options(User::all()->pluck('name', 'id'))->required(),
                                                    TextInput::make('gender'),
                                                    TextInput::make('date_of_birth'),
                                                    TextInput::make('address'),
                                                    TextInput::make('phone_number'),
                                                    TextInput::make('employee_id'),
                                                ])
                                                ->action(function (array $data, $record) {
                                                    $record->employee()->update($data);
                                                }),
                                        ]),
                                    ]),
                            ]),
                        Tabs\Tab::make('Employment Information')
                            ->schema([
                                Grid::make(['default' => 1])
                                    ->relationship('employmentInformation')
                                    ->schema([
                                        TextEntry::make('user.name'),
                                        TextEntry::make('job_title'),
                                        TextEntry::make('department'),
                                        TextEntry::make('date_of_joining'),
                                        TextEntry::make('employment_status'),
                                        TextEntry::make('work_location'),
                                        TextEntry::make('base_salary'),
                                        TextEntry::make('bonuses'),
                                        TextEntry::make('allowances'),

                                        Actions::make([
                                            Action::make('Edit employmentInformation')
                                                ->fillForm(fn ($record) =>  $record->employmentInformation->toArray())
                                                ->form([
                                                    Select::make('user_id')->options(User::all()->pluck('name', 'id'))->required(),
                                                    TextInput::make('job_title'),
                                                    TextInput::make('department'),
                                                    TextInput::make('date_of_joining'),
                                                    TextInput::make('employment_status'),
                                                    TextInput::make('work_location'),
                                                    TextInput::make('base_salary'),
                                                    TextInput::make('bonuses'),
                                                    TextInput::make('allowances'),
                                                ])
                                                ->action(function (array $data, $record) {
                                                    $record->employmentInformation()->update($data);
                                                }),
                                        ]),
                                    ]),
                            ]),
                    ])
                    ->persistTabInQueryString()
                    ->columnSpan('full')
            ]);
    }

    public static function getFormSchema($section = null)
    {
        if ($section == 'basic') {
            return [
                Forms\Components\TextInput::make('name')->required()->maxLength(255),
                Forms\Components\TextInput::make('email')->email()->required()->maxLength(255),
                Forms\Components\TextInput::make('password')
                    ->password()
                    ->dehydrateStateUsing(fn ($state) => Hash::make($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create'),
            ];
        }
    }
}
