<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InternationalDestination;
use Illuminate\Http\Request;

class InternationalDestinationController extends Controller
{
    public function index()
    {
        try {
            $destinations = InternationalDestination::where('active', true)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($d) {
                    $image = $d->image ? ltrim($d->image, '/') : null;
                    if ($image) {
                        if (preg_match('/^https?:\/\//', $image)) {
                            $d->image = $image;
                        } elseif (str_starts_with($image, 'international/') || str_starts_with($image, 'destinations/') || str_starts_with($image, 'islands/')) {
                            // Stored under storage/app/public — serve via the storage symlink
                            $d->image = asset('storage/' . $image) . '?v=' . strtotime($d->updated_at);
                        } elseif (str_starts_with($image, 'storage/') || str_starts_with($image, '/storage/')) {
                            $d->image = asset($image) . '?v=' . strtotime($d->updated_at);
                        } else {
                            $d->image = asset($image) . '?v=' . strtotime($d->updated_at);
                        }
                    } else {
                        $d->image = null;
                    }
                    return $d;
                });

            return response()->json([
                'success' => true,
                'data' => $destinations,
                'message' => 'Destinations retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving destinations: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $destination = InternationalDestination::findOrFail($id);

            $image = $destination->image ? ltrim($destination->image, '/') : null;
            if ($image) {
                if (preg_match('/^https?:\/\//', $image)) {
                    $destination->image = $image;
                } elseif (str_starts_with($image, 'international/') || str_starts_with($image, 'destinations/') || str_starts_with($image, 'islands/')) {
                    // Stored under storage/app/public — serve via the storage symlink
                    $destination->image = asset('storage/' . $image) . '?v=' . strtotime($destination->updated_at);
                } elseif (str_starts_with($image, 'storage/') || str_starts_with($image, '/storage/')) {
                    $destination->image = asset($image) . '?v=' . strtotime($destination->updated_at);
                } else {
                    $destination->image = asset($image) . '?v=' . strtotime($destination->updated_at);
                }
            } else {
                $destination->image = null;
            }

            return response()->json([
                'success' => true,
                'data' => $destination,
                'message' => 'Destination retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving destination: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name_en' => 'required|string|max:255',
                'name_ar' => 'required|string|max:255',
                'description_en' => 'required|string',
                'description_ar' => 'required|string',
                'description_zh' => 'nullable|string',
                'image' => 'nullable|string',
                'price' => 'nullable|numeric|min:0',
                'active' => 'boolean',
            ]);

            $destination = InternationalDestination::create($validated);

            return response()->json([
                'success' => true,
                'data' => $destination,
                'message' => 'Destination created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating destination: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $destination = InternationalDestination::findOrFail($id);

            $validated = $request->validate([
                'name_en' => 'string|max:255',
                'name_ar' => 'string|max:255',
                'description_en' => 'string',
                'description_ar' => 'string',
                'description_zh' => 'nullable|string',
                'image' => 'nullable|string',
                'price' => 'nullable|numeric|min:0',
                'active' => 'boolean',
            ]);

            $destination->update($validated);

            return response()->json([
                'success' => true,
                'data' => $destination,
                'message' => 'Destination updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating destination: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $destination = InternationalDestination::findOrFail($id);
            $destination->delete();

            return response()->json([
                'success' => true,
                'message' => 'Destination deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting destination: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get unique countries from international destinations for dropdown
     */
    public function countries()
    {
        try {
            $countries = InternationalDestination::where('active', true)
                ->whereNotNull('country_en')
                ->select('country_en', 'country_ar')
                ->distinct()
                ->orderBy('country_en')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => strtolower(str_replace(' ', '_', $item->country_en)),
                        'name_en' => $item->country_en,
                        'name_ar' => $item->country_ar ?? $item->country_en,
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $countries,
                'message' => 'Countries retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving countries: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get cities for a specific country from international destinations
     */
    public function cities(Request $request)
    {
        try {
            $countryEn = $request->query('country');
            
            $query = InternationalDestination::where('active', true)
                ->whereNotNull('city_en');

            if ($countryEn) {
                $query->where('country_en', 'like', '%' . $countryEn . '%');
            }

            $cities = $query
                ->select('city_en', 'city_ar', 'country_en')
                ->distinct()
                ->orderBy('city_en')
                ->get()
                ->map(function ($item) {
                    return [
                        'id' => strtolower(str_replace(' ', '_', $item->city_en)),
                        'name_en' => $item->city_en,
                        'name_ar' => $item->city_ar ?? $item->city_en,
                        'country_en' => $item->country_en,
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => $cities,
                'message' => 'Cities retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving cities: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get destinations filtered by country and/or city
     */
    public function filter(Request $request)
    {
        try {
            $query = InternationalDestination::where('active', true);

            if ($request->has('country') && $request->country) {
                $query->where('country_en', 'like', '%' . $request->country . '%');
            }

            if ($request->has('city') && $request->city) {
                $query->where('city_en', 'like', '%' . $request->city . '%');
            }

            $destinations = $query
                ->orderBy('name_en')
                ->get()
                ->map(function ($d) {
                    $image = $d->image ? ltrim($d->image, '/') : null;
                    if ($image && !preg_match('/^https?:\/\//', $image)) {
                        if (str_starts_with($image, 'international/') || str_starts_with($image, 'destinations/') || str_starts_with($image, 'islands/')) {
                            $d->image = asset('storage/' . $image) . '?v=' . strtotime($d->updated_at);
                        } else {
                            $d->image = asset($image) . '?v=' . strtotime($d->updated_at);
                        }
                    }
                    return $d;
                });

            return response()->json([
                'success' => true,
                'data' => $destinations,
                'message' => 'Destinations filtered successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error filtering destinations: ' . $e->getMessage()
            ], 500);
        }
    }
}
