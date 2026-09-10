<?php

namespace App\Filament\Resources\CityResource\Pages;

use App\Filament\Resources\CityResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCity extends CreateRecord
{
    protected static string $resource = CityResource::class;

    protected function afterCreate(): void
    {
        $city = $this->record;
        $selectedOfferIds = $this->data['tourismOffers'] ?? [];

        if (!empty($selectedOfferIds)) {
            \App\Models\TourismOffer::whereIn('id', $selectedOfferIds)->update(['city' => $city->slug]);
        }
    }
}
