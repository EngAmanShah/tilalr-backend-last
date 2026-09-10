<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $lang = $request->get('lang', 'ar');
        if (!in_array($lang, ['en', 'ar'])) {
            $lang = 'en';
        }
        
        \Illuminate\Support\Facades\App::setLocale($lang);

        $cities = City::where('is_active', true)->orderBy('order', 'asc')->get();
        return response()->json($cities);
    }

    public function show(Request $request, $slug)
    {
        $lang = $request->get('lang', 'ar');
        if (!in_array($lang, ['en', 'ar'])) {
            $lang = 'en';
        }
        
        \Illuminate\Support\Facades\App::setLocale($lang);

        $city = City::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        $city->load(['tourismOffers' => function ($query) {
            $query->where('active', true);
        }]);

        return response()->json($city);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|array',
            'slug' => 'required|string|unique:cities,slug',
            'description' => 'nullable|array',
            'image' => 'nullable|string',
            'images' => 'nullable|json',
            'country' => 'string',
            'order' => 'integer',
            'is_active' => 'boolean',
            'best_time' => 'nullable|array',
            'activities' => 'nullable|array',
            'landmarks' => 'nullable|array',
        ]);
        $city = City::create($validated);
        return response()->json($city, 201);
    }

    public function update(Request $request, $id)
    {
        $city = City::findOrFail($id);
        $validated = $request->validate([
            'name' => 'array',
            'slug' => 'string|unique:cities,slug,' . $id,
            'description' => 'nullable|array',
            'image' => 'nullable|string',
            'images' => 'nullable|json',
            'country' => 'string',
            'order' => 'integer',
            'is_active' => 'boolean',
            'best_time' => 'nullable|array',
            'activities' => 'nullable|array',
            'landmarks' => 'nullable|array',
        ]);
        $city->update($validated);
        return response()->json($city);
    }

    public function destroy($id)
    {
        $city = City::findOrFail($id);
        $city->delete();
        return response()->json(['message' => 'City deleted successfully']);
    }
}