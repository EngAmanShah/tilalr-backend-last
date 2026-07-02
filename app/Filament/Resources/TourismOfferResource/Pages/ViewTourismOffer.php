<?php

namespace App\Filament\Resources\TourismOfferResource\Pages;

use App\Filament\Resources\TourismOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewTourismOffer extends ViewRecord
{
    protected static string $resource = TourismOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
