<?php

namespace App\Filament\Resources\TourismOfferResource\Pages;

use App\Filament\Resources\TourismOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTourismOffer extends EditRecord
{
    protected static string $resource = TourismOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\ViewAction::make(),
        ];
    }
}
