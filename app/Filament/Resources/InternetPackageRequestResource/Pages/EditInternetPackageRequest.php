<?php

namespace App\Filament\Resources\InternetPackageRequestResource\Pages;

use App\Filament\Resources\InternetPackageRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditInternetPackageRequest extends EditRecord
{
    protected static string $resource = InternetPackageRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
