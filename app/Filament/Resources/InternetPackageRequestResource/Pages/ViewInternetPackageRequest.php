<?php

namespace App\Filament\Resources\InternetPackageRequestResource\Pages;

use App\Filament\Resources\InternetPackageRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewInternetPackageRequest extends ViewRecord
{
    protected static string $resource = InternetPackageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
