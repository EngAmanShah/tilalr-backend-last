<?php

namespace App\Filament\Resources\SaudiVisaResource\Pages;

use App\Filament\Resources\SaudiVisaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSaudiVisas extends ListRecords
{
    protected static string $resource = SaudiVisaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
