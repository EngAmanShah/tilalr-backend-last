<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TourismOffer;
use Illuminate\Http\Request;

class TourismOfferController extends Controller
{
    public function index()
    {
        $offers = TourismOffer::where('active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'data' => $offers
        ]);
    }

    public function show($id)
    {
        $offer = TourismOffer::find($id);

        if (!$offer) {
            return response()->json([
                'success' => false,
                'message' => 'Offer not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $offer
        ]);
    }
}
