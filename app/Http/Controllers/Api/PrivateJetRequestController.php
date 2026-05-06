<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PrivateJetRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PrivateJetRequestController extends Controller
{
    /**
     * Store a new private jet request.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'client_type' => 'required|string|in:Businessman,Hajj,Football Team,Government Entity,Medical Evacuation,Other',
            'mobile_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'number_of_people' => 'required|integer|min:1',
            'destination' => 'required|string|max:255',
            'departure_airport' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'nullable|date',
            'special_requirements' => 'nullable|string|max:5000',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $private_jet_request = PrivateJetRequest::create([
                'name' => $request->name,
                'client_type' => $request->client_type,
                'mobile_number' => $request->mobile_number,
                'email' => $request->email,
                'number_of_people' => $request->number_of_people,
                'destination' => $request->destination,
                'departure_airport' => $request->departure_airport,
                'departure_date' => $request->departure_date,
                'return_date' => $request->return_date,
                'special_requirements' => $request->special_requirements,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your private jet request has been sent successfully!',
                'data' => $private_jet_request
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all private jet requests (for admin).
     */
    public function index()
    {
        try {
            $requests = PrivateJetRequest::latest()->get();

            return response()->json([
                'success' => true,
                'data' => $requests
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'An error occurred while fetching requests.',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
