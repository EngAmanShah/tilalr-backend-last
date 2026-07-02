<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourismDestination;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TourismDestinationController extends Controller
{
    public function index(Request $request)
    {
        $query = TourismDestination::where('active', true);

        if ($request->has('region')) {
            $query->where('region', $request->region);
        }

        $destinations = $query->get()->map(function ($destination) {
            return $this->formatDestination($destination);
        });

        return response()->json([
            'success' => true,
            'data' => $destinations
        ]);
    }

    public function show($slug)
    {
        $destination = TourismDestination::where('slug', $slug)
            ->where('active', true)
            ->firstOrFail();

        return response()->json([
            'success' => true,
            'data' => $this->formatDestination($destination)
        ]);
    }

    public function getByRegion($region)
    {
        $destinations = TourismDestination::where('region', $region)
            ->where('active', true)
            ->get()
            ->map(function ($destination) {
                return $this->formatDestination($destination);
            });

        return response()->json([
            'success' => true,
            'data' => $destinations
        ]);
    }

    public function getRegions()
    {
        $regions = TourismDestination::select('region')
            ->where('active', true)
            ->distinct()
            ->get()
            ->pluck('region');

        return response()->json([
            'success' => true,
            'data' => $regions
        ]);
    }

    private function formatDestination($destination)
    {
        $destination->image_url = $this->getImageUrl($destination->image);
        return $destination;
    }

    private function getImageUrl($image)
    {
        if (!$image) {
            return null;
        }

        // If it's already a full URL
        if (filter_var($image, FILTER_VALIDATE_URL)) {
            return $image;
        }

        // Check if the file exists in storage
        if (Storage::disk('public')->exists('tourism/' . $image)) {
            return asset('storage/tourism/' . $image);
        }

        // Check if the file exists directly in public
        if (file_exists(public_path('storage/tourism/' . $image))) {
            return asset('storage/tourism/' . $image);
        }

        return null;
    }

    // app/Http/Controllers/Api/BookingController.php



     public function getNavbarData()
    {
        $destinations = TourismDestination::where('active', true)->get();

        $grouped = [];
        foreach ($destinations as $dest) {
            $region = $dest->region ?? 'other';

            $regionIcons = [
                'Europe' => '🌍',
                'Asia' => '🌏',
                'Africa' => '🌍',
                'Australia' => '🌏',
            ];

            $regionArabic = [
                'Europe' => 'أوروبا',
                'Asia' => 'آسيا',
                'Africa' => 'أفريقيا',
                'Australia' => 'أستراليا ونيوزيلندا',
            ];

            if (!isset($grouped[$region])) {
                $grouped[$region] = [
                    'icon' => $regionIcons[$region] ?? '🌍',
                    'ar' => $regionArabic[$region] ?? ucfirst($region),
                    'countries' => []
                ];
            }

            $grouped[$region]['countries'][] = [
                'en' => $dest->title_en,
                'ar' => $dest->title_ar,
                'slug' => $dest->slug,
            ];
        }

        return response()->json([
            'success' => true,
            'data' => $grouped
        ]);
    }
}
