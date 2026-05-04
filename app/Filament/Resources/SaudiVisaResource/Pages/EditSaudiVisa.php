<?php

namespace App\Filament\Resources\SaudiVisaResource\Pages;

use App\Filament\Resources\SaudiVisaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSaudiVisa extends EditRecord
{
    protected static string $resource = SaudiVisaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
