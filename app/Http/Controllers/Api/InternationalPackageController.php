<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InternationalPackage;
use Illuminate\Http\Request;

class InternationalPackageController extends Controller
{
    private function resolvePackageImageUrl(?string $imagePath, $updatedAt): ?string
    {
        $image = $imagePath ? ltrim($imagePath, '/') : null;
        if (!$image) {
            return null;
        }

        if (preg_match('/^https?:\/\//', $image)) {
            return $image;
        }

        if (str_starts_with($image, 'international/')) {
            return asset($image) . '?v=' . strtotime($updatedAt);
        }

        if (str_starts_with($image, 'packages/') || str_starts_with($image, 'islands/')) {
            // Stored under storage/app/public — serve via the storage symlink
            return asset('storage/' . $image) . '?v=' . strtotime($updatedAt);
        }

        if (str_starts_with($image, 'storage/')) {
            return asset($image) . '?v=' . strtotime($updatedAt);
        }

        // Legacy seed data stores only file names (e.g. 1.webp).
        if (!str_contains($image, '/')) {
            return asset('international/' . $image) . '?v=' . strtotime($updatedAt);
        }

        return asset($image) . '?v=' . strtotime($updatedAt);
    }

    public function index()
    {
        try {
            $packages = InternationalPackage::where('active', true)
                ->orderBy('created_at', 'desc')
                ->get()
                ->map(function ($p) {
                    $p->image = $this->resolvePackageImageUrl($p->image, $p->updated_at);
                    return $p;
                });

            return response()->json([
                'success' => true,
                'data' => $packages,
                'message' => 'Packages retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving packages: ' . $e->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $package = InternationalPackage::findOrFail($id);
            $package->image = $this->resolvePackageImageUrl($package->image, $package->updated_at);

            return response()->json([
                'success' => true,
                'data' => $package,
                'message' => 'Package retrieved successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error retrieving package: ' . $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'type_en' => 'required|string|max:255',
                'type_ar' => 'required|string|max:255',
                'type_zh' => 'nullable|string|max:255',
                'title_en' => 'required|string|max:255',
                'title_ar' => 'required|string|max:255',
                'title_zh' => 'nullable|string|max:255',
                'description_en' => 'required|string',
                'description_ar' => 'required|string',
                'description_zh' => 'nullable|string',
                'image' => 'nullable|string',
                'duration_en' => 'nullable|string',
                'duration_ar' => 'nullable|string',
                'duration_zh' => 'nullable|string',
                'price' => 'nullable|numeric|min:0',
                'discount' => 'nullable|string',
                'features_en' => 'nullable|array',
                'features_ar' => 'nullable|array',
                'features_zh' => 'nullable|array',
                'highlight_en' => 'nullable|string',
                'highlight_ar' => 'nullable|string',
                'highlight_zh' => 'nullable|string',
                'active' => 'boolean',
            ]);

            $package = InternationalPackage::create($validated);

            return response()->json([
                'success' => true,
                'data' => $package,
                'message' => 'Package created successfully'
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error creating package: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $package = InternationalPackage::findOrFail($id);

            $validated = $request->validate([
                'type_en' => 'string|max:255',
                'type_ar' => 'string|max:255',
                'type_zh' => 'nullable|string|max:255',
                'title_en' => 'string|max:255',
                'title_ar' => 'string|max:255',
                'title_zh' => 'nullable|string|max:255',
                'description_en' => 'string',
                'description_ar' => 'string',
                'description_zh' => 'nullable|string',
                'image' => 'nullable|string',
                'duration_en' => 'nullable|string',
                'duration_ar' => 'nullable|string',
                'duration_zh' => 'nullable|string',
                'price' => 'nullable|numeric|min:0',
                'discount' => 'nullable|string',
                'features_en' => 'nullable|array',
                'features_ar' => 'nullable|array',
                'features_zh' => 'nullable|array',
                'highlight_en' => 'nullable|string',
                'highlight_ar' => 'nullable|string',
                'highlight_zh' => 'nullable|string',
                'active' => 'boolean',
            ]);

            $package->update($validated);

            return response()->json([
                'success' => true,
                'data' => $package,
                'message' => 'Package updated successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error updating package: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $package = InternationalPackage::findOrFail($id);
            $package->delete();

            return response()->json([
                'success' => true,
                'message' => 'Package deleted successfully'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error deleting package: ' . $e->getMessage()
            ], 500);
        }
    }
}
