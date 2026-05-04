<?php

namespace App\Filament\Resources\EvisaApplicationResource\Pages;

use App\Filament\Resources\EvisaApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditEvisaApplication extends EditRecord
{
    protected static string $resource = EvisaApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
