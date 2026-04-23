<?php

namespace App\Filament\Resources\SpecialOfferResource\Pages;

use App\Filament\Resources\SpecialOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Log;

class CreateSpecialOffer extends CreateRecord
{
    protected static string $resource = SpecialOfferResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        Log::info('CreateSpecialOffer: Creating with image', [
            'image_field' => $data['image'] ?? 'NOT SET',
            'all_data' => $data
        ]);
        
        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
