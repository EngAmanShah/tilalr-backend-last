<?php

namespace App\Filament\Resources\PrivateJetRequestResource\Pages;

use App\Filament\Resources\PrivateJetRequestResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPrivateJetRequests extends ListRecords
{
    protected static string $resource = PrivateJetRequestResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
