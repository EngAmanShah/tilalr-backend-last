<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InternetPackageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class InternetPackageRequestController extends Controller
{
    /**
     * Store a new internet package request.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country' => 'required|string|max:255',
            'mobile_number' => 'required|string|max:20',
            'package' => 'required|string|in:1GB,2GB,3GB,5GB,10GB,20GB,50GB,100GB',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $request_data = InternetPackageRequest::create([
                'country' => $request->country,
                'mobile_number' => $request->mobile_number,
                'package' => $request->package,
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Your internet package request has been sent successfully!',
                'data' => $request_data
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
     * Get all internet package requests (for admin).
     */
    public function index()
    {
        try {
            $requests = InternetPackageRequest::latest()->get();

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
