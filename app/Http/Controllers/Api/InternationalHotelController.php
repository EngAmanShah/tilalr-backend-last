<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InternationalHotel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InternationalHotelController extends Controller
{
    public function index()
    {
        try {
            $hotels = InternationalHotel::where('active', true)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($h) {
                    // normalize stored image values and always serve via the storage symlink
                    $raw = $h->getAttributes()['image'] ?? null;
                    $image = $raw ? preg_replace('#^/+|^storage/#', '', $raw) : null;

                    if ($image && preg_match('/^https?:\/\//', $image)) {
                        // if DB somehow contains a full URL, treat as external & return as-is
                        $url = $image;
                    } elseif ($image) {
                        $path = preg_replace('#^/+|^storage/#', '', $image);
                        $url = asset('storage/' . $path) . '?v=' . strtotime($h->updated_at);
                    } else {
                        $url = null;
                    }

                    // return a plain array (avoid model mutator side-effects on assignment)
                    $hArr = $h->toArray();
                    $hArr['image'] = $url;

                    Log::debug('hotel.image resolved', ['id' => $h->id, 'resolved' => $url, 'raw' => $raw]);

                    return $hArr;
                });

            return response()->json([
                'success' => true,
                'data' => $hotels,
                'message' => 'Hotels retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving hotels: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $hotel = InternationalHotel::findOrFail($id);

            // normalize stored image values and always serve via the storage symlink
            $raw = $hotel->getAttributes()['image'] ?? null;
            $image = $raw ? preg_replace('#^/+|^storage/#', '', $raw) : null;

            if ($image && preg_match('/^https?:\/\//', $image)) {
                $url = $image;
            } elseif ($image) {
                $path = preg_replace('#^/+|^storage/#', '', $image);
                $url = asset('storage/' . $path) . '?v=' . strtotime($hotel->updated_at);
            } else {
                $url = null;
            }

            $hotelArr = $hotel->toArray();
            $hotelArr['image'] = $url;

            return response()->json([
                'success' => true,
                'data' => $hotelArr,
                'message' => 'Hotel retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving hotel: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_en' => 'required|string|max:255',
                'name_ar' => 'required|string|max:255',
                'location_en' => 'required|string|max:255',
                'location_ar' => 'required|string|max:255',
                'description_en' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'rating' => 'integer|min:1|max:5',
                'price' => 'nullable|numeric|min:0',
                'image' => 'nullable|string',
                'amenities_en' => 'nullable|array',
                'amenities_ar' => 'nullable|array',
                'amenities_zh' => 'nullable|array',
                'active' => 'boolean',
            ]);

            $hotel = InternationalHotel::create($validated);

            return response()->json([
                'success' => true,
                'data' => $hotel,
                'message' => 'Hotel created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating hotel: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $hotel = InternationalHotel::findOrFail($id);

            $validated = $request->validate([
                'name_en' => 'string|max:255',
                'name_ar' => 'string|max:255',
                'location_en' => 'string|max:255',
                'location_ar' => 'string|max:255',
                'description_en' => 'nullable|string',
                'description_ar' => 'nullable|string',
                'rating' => 'integer|min:1|max:5',
                'price' => 'nullable|numeric|min:0',
                'image' => 'nullable|string',
                'amenities_en' => 'nullable|array',
                'amenities_ar' => 'nullable|array',
                'amenities_zh' => 'nullable|array',
                'active' => 'boolean',
            ]);

            $hotel->update($validated);

            return response()->json([
                'success' => true,
                'data' => $hotel,
                'message' => 'Hotel updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating hotel: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $hotel = InternationalHotel::findOrFail($id);
            $hotel->delete();

            return response()->json([
                'success' => true,
                'message' => 'Hotel deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting hotel: ' . $e->getMessage()
            ], 500);
        }
    }
}
