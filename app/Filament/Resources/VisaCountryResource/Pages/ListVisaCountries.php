<?php

namespace App\Filament\Resources\VisaCountryResource\Pages;

use App\Filament\Resources\VisaCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListVisaCountries extends ListRecords
{
    protected static string $resource = VisaCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
