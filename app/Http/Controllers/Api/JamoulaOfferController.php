<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\JamoulaOffer;
use Illuminate\Http\Request;

class JamoulaOfferController extends Controller
{
    public function index()
    {
        $offers = JamoulaOffer::with(['tourismOffer', 'tourismDestination'])
            ->where('active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        $formattedOffers = $offers->map(function ($offer) {
            return $this->formatOffer($offer);
        });

        return response()->json([
            'success' => true,
            'data' => $formattedOffers
        ]);
    }

    public function show($id)
    {
        // Try to find by numeric ID first
        $offer = JamoulaOffer::with(['tourismOffer', 'tourismDestination'])->find($id);

        // If not found, try to find by slug
        if (!$offer) {
            $offer = JamoulaOffer::with(['tourismOffer', 'tourismDestination'])->where('slug', $id)->first();
        }

        if (!$offer) {
            return response()->json([
                'success' => false,
                'message' => 'Offer not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $this->formatOffer($offer)
        ]);
    }

    private function formatOffer($offer)
    {
        if ($offer->tourismOffer) {
            $merged = clone $offer;
            foreach ($offer->tourismOffer->toArray() as $key => $value) {
                if ($key !== 'id' && $key !== 'created_at' && $key !== 'updated_at') {
                    $merged->{$key} = $value;
                }
            }
            $merged->id = $offer->id;
            $merged->slug = $offer->slug;
            $merged->tourism_offer_id = $offer->tourism_offer_id;
            return $merged;
        }

        if ($offer->tourismDestination) {
            $merged = clone $offer;
            foreach ($offer->tourismDestination->toArray() as $key => $value) {
                if ($key !== 'id' && $key !== 'created_at' && $key !== 'updated_at') {
                    $merged->{$key} = $value;
                }
            }
            $merged->id = $offer->id;
            $merged->slug = $offer->slug;
            $merged->tourism_destination_id = $offer->tourism_destination_id;
            return $merged;
        }

        return $offer;
    }
}
