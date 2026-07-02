<?php

namespace App\Filament\Resources\TourismOfferResource\Pages;

use App\Filament\Resources\TourismOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTourismOffers extends ListRecords
{
    protected static string $resource = TourismOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
