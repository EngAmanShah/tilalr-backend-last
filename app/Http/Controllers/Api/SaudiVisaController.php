<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisaApplication; // Make sure this import exists
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class SaudiVisaController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'full_name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'email' => 'required|email|max:255',
                'nationality' => 'required|string|max:100',
                'passport_number' => 'required|string|max:50',
                'visa_type' => 'required|string|in:electronic,arrival,transit,embassy',
                'travel_date' => 'nullable|date',
                'notes' => 'nullable|string',
                'locale' => 'nullable|string',
                'passport_copy' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
                'photo' => 'nullable|file|mimes:jpg,jpeg,png|max:2048',
                'other_documents' => 'nullable|file|mimes:pdf,jpg,jpeg,png|max:5120',
            ]);

            $application = new VisaApplication();
            $application->full_name = $validated['full_name'];
            $application->phone = $validated['phone'];
            $application->email = $validated['email'];
            $application->nationality = $validated['nationality'];
            $application->passport_number = $validated['passport_number'];
            $application->visa_type = $validated['visa_type'];
            $application->travel_date = $validated['travel_date'] ?? null;
            $application->notes = $validated['notes'] ?? null;
            $application->application_type = 'saudi_visa';
            $application->locale = $validated['locale'] ?? 'ar';
            $application->status = 'pending';

            // Handle file uploads
            if ($request->hasFile('passport_copy')) {
                $path = $request->file('passport_copy')->store('visa-applications/passports', 'public');
                $application->passport_copy_path = $path;
            }

            if ($request->hasFile('photo')) {
                $path = $request->file('photo')->store('visa-applications/photos', 'public');
                $application->photo_path = $path;
            }

            if ($request->hasFile('other_documents')) {
                $path = $request->file('other_documents')->store('visa-applications/others', 'public');
                $application->other_documents_path = $path;
            }

            $application->save();

            return response()->json([
                'success' => true,
                'message' => 'Visa application submitted successfully',
                'data' => $application
            ], 201);

        } catch (\Exception $e) {
            Log::error('Saudi Visa Application Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'An error occurred: ' . $e->getMessage()
            ], 500);
        }
    }
}
