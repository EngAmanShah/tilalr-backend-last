<?php

namespace App\Filament\Resources\VisaCountryResource\Pages;

use App\Filament\Resources\VisaCountryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVisaCountry extends EditRecord
{
    protected static string $resource = VisaCountryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
