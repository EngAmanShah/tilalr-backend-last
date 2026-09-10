<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\HeaderBanner;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class HeaderBannerController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = HeaderBanner::where('active', true);

        if ($request->has('page') && filled($request->query('page'))) {
            $pageVal = strtolower(trim($request->query('page')));
            $query->whereRaw('LOWER(page) = ?', [$pageVal]);
        }

        $banners = $query->orderBy('id', 'asc')->get();

        return response()->json([
            'success' => true,
            'data' => $banners
        ]);
    }
}
