<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;

class OfferController extends Controller
{
    /**
     * Get all active offers (for the main offers page)
     */
    public function index()
    {
        $offers = Offer::where('is_active', true)
            ->orderBy('order_position', 'asc')
            ->get();

        // Transform to include full image URLs and format for frontend
        $offers->transform(function ($offer) {
            return [
                'id' => $offer->id,
                'title' => $offer->title_en,
                'description' => $offer->description_en,
                'duration' => $offer->duration_en,
                'location' => $offer->location_en,
                'groupSize' => $offer->group_size_en,
                'badge' => $offer->badge_en,
                'features' => $offer->features_en,
                'highlights' => $offer->highlights_en,
                'image' => $offer->image, // This will now use the accessor
                'price' => $offer->price,
                'is_active' => $offer->is_active,
                'slug' => $offer->slug,
                'created_at' => $offer->created_at,
                'updated_at' => $offer->updated_at,
            ];
        });

        return response()->json($offers);
    }

    /**
     * Get all active special offers (for homepage or special section)
     */
    public function specialOffers()
    {
        $offers = Offer::specialOffers()->get();

        // Transform to include full image URLs
        $offers->transform(function ($offer) {
            return [
                'id' => $offer->id,
                'image' => $offer->image, // This will use the accessor
                'order' => $offer->order_position
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $offers
        ]);
    }

    /**
     * Alternative: Simple JSON response for special offers only (returns just image URLs)
     */
    public function simpleSpecialOffers()
    {
        $offers = Offer::specialOffers()->get(['id', 'image', 'order_position']);

        $images = $offers->map(function ($offer) {
            return $offer->image; // This will use the accessor
        })->filter()->values();

        return response()->json($images);
    }
}
