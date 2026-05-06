<?php

namespace App\Filament\Resources\PrivateJetRequestResource\Pages;

use App\Filament\Resources\PrivateJetRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPrivateJetRequest extends EditRecord
{
    protected static string $resource = PrivateJetRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
