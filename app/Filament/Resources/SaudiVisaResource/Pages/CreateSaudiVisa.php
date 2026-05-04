<?php

namespace App\Filament\Resources\SaudiVisaResource\Pages;

use App\Filament\Resources\SaudiVisaResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSaudiVisa extends CreateRecord
{
    protected static string $resource = SaudiVisaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['application_type'] = 'saudi_visa';
        return $data;
    }
}
