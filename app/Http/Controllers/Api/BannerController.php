<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class BannerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Banner::where('active', true);

        if ($request->has('page')) {
            $query->where('page', $request->query('page'));
        }

        $banners = $query->orderBy('id', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $banners
        ]);
    }
}
