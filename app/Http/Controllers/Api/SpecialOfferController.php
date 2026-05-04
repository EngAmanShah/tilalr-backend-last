<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SpecialOfferController extends Controller
{
    /**
     * Get all active special offers for slider
     */
    public function index()
    {
        try {
            $offers = SpecialOffer::active()->get();

            $formattedOffers = $offers->map(function ($offer) {
                return [
                    'id' => $offer->id,
                    'image' => $offer->image_url,
                    'order' => $offer->order_position,
                ];
            });

            return response()->json([
                'success' => true,
                'data' => $formattedOffers
            ]);
        } catch (\Exception $e) {
            Log::error('SpecialOffer API Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error loading special offers'
            ], 500);
        }
    }

    /**
     * Get simple array of image URLs only
     */
    public function simple()
    {
        try {
            $images = SpecialOffer::active()->pluck('image')
                ->map(function ($image) {
                    return asset('storage/' . ltrim($image, '/'));
                })
                ->values();

            return response()->json($images);
        } catch (\Exception $e) {
            return response()->json([], 500);
        }
    }

    /**
     * Store a new special offer (Admin)
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
                'is_active' => 'boolean',
                'order_position' => 'integer'
            ]);

            $path = $request->file('image')->store('special-offers', 'public');

            $offer = SpecialOffer::create([
                'image' => $path,
                'is_active' => $request->is_active ?? true,
                'order_position' => $request->order_position ?? 0,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Special offer created successfully',
                'data' => $offer
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating special offer: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Update special offer (Admin)
     */
    public function update(Request $request, $id)
    {
        try {
            $offer = SpecialOffer::findOrFail($id);

            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
                'is_active' => 'boolean',
                'order_position' => 'integer'
            ]);

            if ($request->hasFile('image')) {
                // Delete old image
                if ($offer->image) {
                    Storage::disk('public')->delete($offer->image);
                }
                $path = $request->file('image')->store('special-offers', 'public');
                $offer->image = $path;
            }

            if ($request->has('is_active')) {
                $offer->is_active = $request->is_active;
            }

            if ($request->has('order_position')) {
                $offer->order_position = $request->order_position;
            }

            $offer->save();

            return response()->json([
                'success' => true,
                'message' => 'Special offer updated successfully',
                'data' => $offer
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating special offer'
            ], 500);
        }
    }

    /**
     * Delete special offer (Admin)
     */
    public function destroy($id)
    {
        try {
            $offer = SpecialOffer::findOrFail($id);

            // Delete image file
            if ($offer->image) {
                Storage::disk('public')->delete($offer->image);
            }

            $offer->delete();

            return response()->json([
                'success' => true,
                'message' => 'Special offer deleted successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting special offer'
            ], 500);
        }
    }
}
