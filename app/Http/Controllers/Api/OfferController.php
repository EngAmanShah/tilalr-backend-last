<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Offer;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        try {
            $offers = Offer::where('is_active', true)->orderBy('created_at', 'desc')->get()->map(function ($o) {
                // Image is now always a relative path (stored by setImageAttribute mutator)
                // getImageAttribute accessor will generate the full URL
                // Just add cache buster to ensure fresh images
                if ($o->image && !preg_match('/^https?:\/\//', $o->image)) {
                    $o->image = $o->image . '?v=' . strtotime($o->updated_at);
                }

                // provide safe fallbacks so API consumers can use localized keys
                $o->duration_en = $o->duration_en ?? $o->duration;
                $o->duration_ar = $o->duration_ar ?? $o->duration;
                $o->group_size_en = $o->group_size_en ?? $o->group_size;
                $o->group_size_ar = $o->group_size_ar ?? $o->group_size;
                $o->badge_en = $o->badge_en ?? $o->badge;
                $o->badge_ar = $o->badge_ar ?? $o->badge;
                $o->features_en = $o->features_en ?? $o->features ?? [];
                $o->features_ar = $o->features_ar ?? [];
                $o->highlights_en = $o->highlights_en ?? $o->highlights ?? [];
                $o->highlights_ar = $o->highlights_ar ?? [];

                return $o;
            });

            return response()->json(['success' => true, 'data' => $offers], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        $offer = Offer::findOrFail($id);
        
        // Image is now always a relative path (stored by setImageAttribute mutator)
        // getImageAttribute accessor will generate the full URL
        // Just add cache buster to ensure fresh images
        if ($offer->image && !preg_match('/^https?:\/\//', $offer->image)) {
            $offer->image = $offer->image . '?v=' . strtotime($offer->updated_at);
        }

        // add localized fallbacks for API consumers
        $offer->duration_en = $offer->duration_en ?? $offer->duration;
        $offer->duration_ar = $offer->duration_ar ?? $offer->duration;
        $offer->group_size_en = $offer->group_size_en ?? $offer->group_size;
        $offer->group_size_ar = $offer->group_size_ar ?? $offer->group_size;
        $offer->badge_en = $offer->badge_en ?? $offer->badge;
        $offer->badge_ar = $offer->badge_ar ?? $offer->badge;
        $offer->features_en = $offer->features_en ?? $offer->features ?? [];
        $offer->features_ar = $offer->features_ar ?? [];
        $offer->highlights_en = $offer->highlights_en ?? $offer->highlights ?? [];
        $offer->highlights_ar = $offer->highlights_ar ?? [];

        return response()->json(['success' => true, 'data' => $offer], 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|string',
            'duration' => 'nullable|string',
            'duration_en' => 'nullable|string',
            'duration_ar' => 'nullable|string',
            'location_en' => 'nullable|string',
            'location_ar' => 'nullable|string',
            'group_size' => 'nullable|string',
            'group_size_en' => 'nullable|string',
            'group_size_ar' => 'nullable|string',
            'discount' => 'nullable|string',
            'badge' => 'nullable|string',
            'badge_en' => 'nullable|string',
            'badge_ar' => 'nullable|string',
            'features' => 'nullable|array',
            'features_en' => 'nullable|array',
            'features_ar' => 'nullable|array',
            'highlights' => 'nullable|array',
            'highlights_en' => 'nullable|array',
            'highlights_ar' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $offer = Offer::create($validated);

        return response()->json(['success' => true, 'data' => $offer], 201);
    }

    public function update(Request $request, $id)
    {
        $offer = Offer::findOrFail($id);

        $validated = $request->validate([
            'title_en' => 'string|max:255',
            'title_ar' => 'string|max:255',
            'description_en' => 'nullable|string',
            'description_ar' => 'nullable|string',
            'image' => 'nullable|string',
            'duration' => 'nullable|string',
            'duration_en' => 'nullable|string',
            'duration_ar' => 'nullable|string',
            'location_en' => 'nullable|string',
            'location_ar' => 'nullable|string',
            'group_size' => 'nullable|string',
            'group_size_en' => 'nullable|string',
            'group_size_ar' => 'nullable|string',
            'discount' => 'nullable|string',
            'badge' => 'nullable|string',
            'badge_en' => 'nullable|string',
            'badge_ar' => 'nullable|string',
            'features' => 'nullable|array',
            'features_en' => 'nullable|array',
            'features_ar' => 'nullable|array',
            'highlights' => 'nullable|array',
            'highlights_en' => 'nullable|array',
            'highlights_ar' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $offer->update($validated);

        return response()->json(['success' => true, 'data' => $offer], 200);
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);
        $offer->delete();

        return response()->json(['success' => true, 'message' => 'Deleted'], 200);
    }
}
