<?php

namespace App\Filament\Resources\EmploymentInformationResource\Pages;

use App\Filament\Resources\EmploymentInformationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListEmploymentInformation extends ListRecords
{
    protected static string $resource = EmploymentInformationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
