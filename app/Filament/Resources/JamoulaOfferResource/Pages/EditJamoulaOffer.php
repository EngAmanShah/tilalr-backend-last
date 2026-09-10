<?php

namespace App\Filament\Resources\JamoulaOfferResource\Pages;

use App\Filament\Resources\JamoulaOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditJamoulaOffer extends EditRecord
{
    protected static string $resource = JamoulaOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
