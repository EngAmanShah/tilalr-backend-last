<?php

namespace App\Filament\Resources\SpecialOfferResource\Pages;

use App\Filament\Resources\SpecialOfferResource;
use Filament\Resources\Pages\CreateRecord;

class CreateSpecialOffer extends CreateRecord
{
    protected static string $resource = SpecialOfferResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
