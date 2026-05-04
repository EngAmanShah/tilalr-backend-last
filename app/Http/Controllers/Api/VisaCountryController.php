<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\VisaCountry;
use Illuminate\Http\Request;

class VisaCountryController extends Controller
{
    public function index(Request $request)
    {
        $countries = VisaCountry::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name_en')
            ->get();

        // Transform data to match frontend expected format with multilingual support
        $transformed = $countries->map(function ($country) {
            // Parse documents and notes if they are JSON strings
            $documents = $country->documents;
            if (is_string($documents)) {
                $documents = json_decode($documents, true);
            }
            if (!is_array($documents)) {
                $documents = [];
            }

            $notes = $country->notes;
            if (is_string($notes)) {
                $notes = json_decode($notes, true);
            }
            if (!is_array($notes)) {
                $notes = [];
            }

            return [
                // Multilingual name fields
                'name_en' => $country->name_en,
                'name_ar' => $country->name_ar,
                'name_zh' => $country->name_zh,
                'slug' => $country->slug,
                'flag_emoji' => $country->flag_emoji,
                'flag_path' => $country->flag_path,

                // Multilingual visa type fields
                'visa_type_en' => $country->visa_type_en,
                'visa_type_ar' => $country->visa_type_ar,
                'visa_type_zh' => $country->visa_type_zh,

                // Multilingual processing time fields
                'processing_time_en' => $country->processing_time_en,
                'processing_time_ar' => $country->processing_time_ar,
                'processing_time_zh' => $country->processing_time_zh,

                // Multilingual description fields
                'description_en' => $country->description_en,
                'description_ar' => $country->description_ar,
                'description_zh' => $country->description_zh,

                'cost_per_person' => (float) $country->cost_per_person,

                // Documents and notes (already multilingual JSON)
                'documents' => $documents,
                'notes' => $notes,

                'is_active' => $country->is_active,
                'sort_order' => $country->sort_order,
            ];
        });

        return response()->json([
            'success' => true,
            'data' => $transformed,
        ]);
    }

    public function show($slug)
    {
        $country = VisaCountry::where('slug', $slug)
            ->where('is_active', true)
            ->first();

        if (!$country) {
            return response()->json([
                'success' => false,
                'message' => 'Country not found'
            ], 404);
        }

        // Parse documents and notes if they are JSON strings
        $documents = $country->documents;
        if (is_string($documents)) {
            $documents = json_decode($documents, true);
        }
        if (!is_array($documents)) {
            $documents = [];
        }

        $notes = $country->notes;
        if (is_string($notes)) {
            $notes = json_decode($notes, true);
        }
        if (!is_array($notes)) {
            $notes = [];
        }

        return response()->json([
            'success' => true,
            'data' => [
                // Multilingual name fields
                'name_en' => $country->name_en,
                'name_ar' => $country->name_ar,
                'name_zh' => $country->name_zh,
                'slug' => $country->slug,
                'flag_emoji' => $country->flag_emoji,
                'flag_path' => $country->flag_path,

                // Multilingual visa type fields
                'visa_type_en' => $country->visa_type_en,
                'visa_type_ar' => $country->visa_type_ar,
                'visa_type_zh' => $country->visa_type_zh,

                // Multilingual processing time fields
                'processing_time_en' => $country->processing_time_en,
                'processing_time_ar' => $country->processing_time_ar,
                'processing_time_zh' => $country->processing_time_zh,

                // Multilingual description fields
                'description_en' => $country->description_en,
                'description_ar' => $country->description_ar,
                'description_zh' => $country->description_zh,

                'cost_per_person' => (float) $country->cost_per_person,

                // Documents and notes
                'documents' => $documents,
                'notes' => $notes,

                'is_active' => $country->is_active,
                'sort_order' => $country->sort_order,
            ],
        ]);
    }
}
