<?php

namespace App\Filament\Resources\EmploymentInformationResource\Pages;

use App\Filament\Resources\EmploymentInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEmploymentInformation extends EditRecord
{
    protected static string $resource = EmploymentInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
