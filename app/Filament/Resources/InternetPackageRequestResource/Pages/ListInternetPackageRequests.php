<?php

namespace App\Filament\Resources\InternetPackageRequestResource\Pages;

use App\Filament\Resources\InternetPackageRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListInternetPackageRequests extends ListRecords
{
    protected static string $resource = InternetPackageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
