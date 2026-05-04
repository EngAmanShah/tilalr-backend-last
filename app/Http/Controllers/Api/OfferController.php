<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    /**
     * Get all active special offers
     */
    public function specialOffers()
    {
        $offers = Offer::specialOffers()->get();

        // Transform to include full image URLs
        $offers->transform(function ($offer) {
            if ($offer->image) {
                $offer->image = $offer->image_url; // Using accessor
            }
            return [
                'id' => $offer->id,
                'image' => $offer->image_url,
                'order' => $offer->order_position
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $offers
        ]);
    }

    /**
     * Alternative: Simple JSON response for special offers only
     */
    public function simpleSpecialOffers()
    {
        $offers = Offer::specialOffers()->get(['id', 'image', 'order_position']);

        $images = $offers->map(function ($offer) {
            return $offer->image_url;
        })->filter()->values();

        return response()->json($images);
    }
}
