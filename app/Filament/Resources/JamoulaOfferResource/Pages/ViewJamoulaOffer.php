<?php

namespace App\Filament\Resources\JamoulaOfferResource\Pages;

use App\Filament\Resources\JamoulaOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewJamoulaOffer extends ViewRecord
{
    protected static string $resource = JamoulaOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
