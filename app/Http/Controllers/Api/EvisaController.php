<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EvisaApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EvisaController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'country_name' => 'required|string',
            'country_slug' => 'required|string',
            'passport_type' => 'required|string',
            'visa_type' => 'required|string',
            'interview_city' => 'required|string',
            'date_of_birth' => 'required|date',
            'full_name' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
            'passport_number' => 'nullable|string',
            'passport_expiry' => 'nullable|date',
            'amount' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $application = EvisaApplication::create([
            ...$request->all(),
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'E-Visa application created successfully',
            'data' => $application,
        ], 201);
    }

    public function index(Request $request)
    {
        $applications = EvisaApplication::when($request->user(), fn($q) => $q->where('user_id', $request->user()->id))
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return response()->json($applications);
    }

    public function show($id)
    {
        $application = EvisaApplication::findOrFail($id);

        if (auth()->id() !== $application->user_id && !auth()->user()?->hasRole('admin')) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        return response()->json($application);
    }

    public function updateStatus(Request $request, $id)
    {
        $application = EvisaApplication::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,processing,approved,rejected,completed',
            'notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $application->update([
            'status' => $request->status,
            'notes' => $request->notes,
        ]);

        return response()->json([
            'message' => 'Application status updated',
            'data' => $application,
        ]);
    }
}
