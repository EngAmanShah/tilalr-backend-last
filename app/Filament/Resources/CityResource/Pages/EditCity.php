<?php

namespace App\Filament\Resources\CityResource\Pages;

use App\Filament\Resources\CityResource;
use Filament\Resources\Pages\EditRecord;

class EditCity extends EditRecord
{
    protected static string $resource = CityResource::class;

    protected function afterSave(): void
    {
        $city = $this->record;
        $selectedOfferIds = $this->data['tourismOffers'] ?? [];

        // Clear city from all offers currently assigned to this city's slug
        \App\Models\TourismOffer::where('city', $city->slug)->update(['city' => null]);

        // Assign this city's slug to the newly selected offers
        if (!empty($selectedOfferIds)) {
            \App\Models\TourismOffer::whereIn('id', $selectedOfferIds)->update(['city' => $city->slug]);
        }
    }
}
