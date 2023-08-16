<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\EmploymentInformation;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\EmploymentInformationResource\Pages;
use App\Filament\Resources\EmploymentInformationResource\RelationManagers;

class EmploymentInformationResource extends Resource
{
    protected static ?string $model = EmploymentInformation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')->options(User::all()->pluck('name', 'id'))->required(),
                Forms\Components\TextInput::make('job_title')->required()->maxLength(255),
                Forms\Components\TextInput::make('department')->required()->maxLength(255),
                Forms\Components\DatePicker::make('date_of_joining')->required(),
                Forms\Components\TextInput::make('employment_status')->required()->maxLength(255),
                Forms\Components\TextInput::make('work_location')->required()->maxLength(255),
                Forms\Components\TextInput::make('base_salary')->required()->numeric(),
                Forms\Components\TextInput::make('bonuses')->required()->numeric(),
                Forms\Components\TextInput::make('allowances')->required()->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user_id')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('job_title')->searchable(),
                Tables\Columns\TextColumn::make('department')->searchable(),
                Tables\Columns\TextColumn::make('date_of_joining')->date()->sortable(),
                Tables\Columns\TextColumn::make('employment_status')->searchable(),
                Tables\Columns\TextColumn::make('work_location')->searchable(),
                Tables\Columns\TextColumn::make('base_salary')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('bonuses')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('allowances')->numeric()->sortable(),
                Tables\Columns\TextColumn::make('created_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')->dateTime()->sortable()->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListEmploymentInformation::route('/'),
            'create' => Pages\CreateEmploymentInformation::route('/create'),
            'view' => Pages\ViewEmploymentInformation::route('/{record}'),
            'edit' => Pages\EditEmploymentInformation::route('/{record}/edit'),
        ];
    }    
}
