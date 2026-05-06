<?php

namespace App\Filament\Resources\PrivateJetRequestResource\Pages;

use App\Filament\Resources\PrivateJetRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPrivateJetRequest extends ViewRecord
{
    protected static string $resource = PrivateJetRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
