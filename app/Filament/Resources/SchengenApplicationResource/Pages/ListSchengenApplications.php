<?php

namespace App\Filament\Resources\SchengenApplicationResource\Pages;

use App\Filament\Resources\SchengenApplicationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSchengenApplications extends ListRecords
{
    protected static string $resource = SchengenApplicationResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
