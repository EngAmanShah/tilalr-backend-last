<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SchengenApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class SchengenController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'nationality' => 'nullable|string|max:100',
            'passport_number' => 'nullable|string|max:50',
            'applicant_type' => 'required|in:saudi,resident',
            'travel_date' => 'nullable|date',
            'notes' => 'nullable|string',
            'is_family' => 'boolean',
            'travelers' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle file uploads
        $documents = [];
        if ($request->hasFile('documents')) {
            foreach ($request->file('documents') as $key => $file) {
                $path = $file->store('schengen/documents', 'public');
                $documents[$key] = $path;
            }
        }

        $application = SchengenApplication::create([
            'full_name' => $request->full_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'nationality' => $request->nationality,
            'passport_number' => $request->passport_number,
            'applicant_type' => $request->applicant_type,
            'travel_date' => $request->travel_date,
            'notes' => $request->notes,
            'is_family' => $request->is_family ?? false,
            'travelers' => $request->travelers,
            'documents' => $documents,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Application submitted successfully',
            'data' => $application
        ], 201);
    }

    public function index(Request $request)
    {
        $applications = SchengenApplication::orderBy('created_at', 'desc')->paginate(20);
        return response()->json($applications);
    }

    public function show($id)
    {
        $application = SchengenApplication::findOrFail($id);
        return response()->json($application);
    }

    public function updateStatus(Request $request, $id)
    {
        $application = SchengenApplication::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:pending,processing,approved,rejected,completed',
            'admin_notes' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $application->update([
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return response()->json([
            'message' => 'Status updated successfully',
            'data' => $application
        ]);
    }
}
