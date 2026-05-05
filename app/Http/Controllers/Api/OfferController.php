<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Support\Facades\Storage;

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
                'title_en' => $offer->title_en,
                'title_ar' => $offer->title_ar,
                'description_en' => $offer->description_en,
                'description_ar' => $offer->description_ar,
                'duration_en' => $offer->duration_en,
                'duration_ar' => $offer->duration_ar,
                'location_en' => $offer->location_en,
                'location_ar' => $offer->location_ar,
                'group_size_en' => $offer->group_size_en,
                'group_size_ar' => $offer->group_size_ar,
                'badge_en' => $offer->badge_en,
                'badge_ar' => $offer->badge_ar,
                'features_en' => $offer->features_en,
                'features_ar' => $offer->features_ar,
                'highlights_en' => $offer->highlights_en,
                'highlights_ar' => $offer->highlights_ar,
                'image' => $offer->image_url, // using accessor
                'order_position' => $offer->order_position,
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
     * Alternative: Simple JSON response for special offers only (returns just image URLs)
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
