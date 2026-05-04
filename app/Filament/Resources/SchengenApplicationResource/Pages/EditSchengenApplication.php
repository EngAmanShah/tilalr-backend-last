<?php

namespace App\Filament\Resources\SchengenApplicationResource\Pages;

use App\Filament\Resources\SchengenApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSchengenApplication extends EditRecord
{
    protected static string $resource = SchengenApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
