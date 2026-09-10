<?php

namespace App\Filament\Resources\JamoulaOfferResource\Pages;

use App\Filament\Resources\JamoulaOfferResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListJamoulaOffers extends ListRecords
{
    protected static string $resource = JamoulaOfferResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('add_tourism_offer')
                ->label('Promote Saudi Offer')
                ->icon('heroicon-o-gift')
                ->color('success')
                ->form([
                    \Filament\Forms\Components\Select::make('tourism_offer_id')
                        ->label('Select Tourism Offer')
                        ->options(\App\Models\TourismOffer::query()->where('active', true)->pluck('title_en', 'id'))
                        ->required()
                        ->searchable()
                ])
                ->action(function (array $data) {
                    $offer = \App\Models\TourismOffer::find($data['tourism_offer_id']);
                    if ($offer) {
                        \App\Models\JamoulaOffer::create([
                            'slug' => 'tourism-offer-' . $offer->id . '-' . time(),
                            'tourism_offer_id' => $offer->id,
                            'active' => true,
                        ]);
                    }
                }),

            Actions\Action::make('add_tourism_destination')
                ->label('Promote International Destination')
                ->icon('heroicon-o-map-pin')
                ->color('info')
                ->form([
                    \Filament\Forms\Components\Select::make('tourism_destination_id')
                        ->label('Select Tourism Destination')
                        ->options(\App\Models\TourismDestination::query()->where('active', true)->pluck('title_en', 'id'))
                        ->required()
                        ->searchable()
                ])
                ->action(function (array $data) {
                    $dest = \App\Models\TourismDestination::find($data['tourism_destination_id']);
                    if ($dest) {
                        \App\Models\JamoulaOffer::create([
                            'slug' => 'tourism-destination-' . $dest->id . '-' . time(),
                            'tourism_destination_id' => $dest->id,
                            'active' => true,
                        ]);
                    }
                }),
        ];
    }
}
