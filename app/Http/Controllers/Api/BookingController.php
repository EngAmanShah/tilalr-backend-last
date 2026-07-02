<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\TourismDestination;
use App\Models\TourismOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    // ... existing store method ...

    public function guestStore(Request $request)
    {
        \Log::info('=== GUEST BOOKING REQUEST ===');
        \Log::info('Request data:', $request->all());

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'travel_date' => 'required|date|after:today',
            'room_type' => 'required|in:DoubleRoom,SingleRoom',
            'package_id' => 'nullable|string',
            'package_code' => 'nullable|string',
            'notes' => 'nullable|string',
            'payment_method' => 'nullable|in:credit_card,bank_transfer',
            'booking_type' => 'nullable|in:destination,tourism_offer',
            'guests' => 'nullable|integer|min:1',
            'special_requests' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            \Log::error('Validation failed:', $errors);
            return response()->json([
                'success' => false,
                'errors' => $errors,
                'debug' => ['received_data' => $request->all()]
            ], 422);
        }

        // Determine booking type
        $bookingType = $request->booking_type ?? 'destination';
        $package = null;
        $packageTitle = 'Unknown Package';
        $price = 0;
        $basicInfo = [];

        if ($bookingType === 'tourism_offer') {
            // Find tourism offer
            $package = TourismOffer::where('id', $request->package_id)
                ->orWhere('slug', $request->package_id)
                ->first();

            if ($package) {
                $packageTitle = $package->title_en ?? $package->title_ar ?? 'Tourism Offer';
                $price = $package->price ?? 0;
                $basicInfo = $package->basic_info ?? [];
            }
        } else {
            // Find tourism destination (default)
            $package = TourismDestination::where('id', $request->package_id)
                ->orWhere('slug', $request->package_id)
                ->first();

            if ($package) {
                $packageTitle = $package->title_en ?? $package->title_ar ?? 'Destination';

                if (is_string($package->basic_info)) {
                    $basicInfo = json_decode($package->basic_info, true);
                } else {
                    $basicInfo = $package->basic_info ?? [];
                }

                $price = $request->room_type === 'DoubleRoom'
                    ? ($basicInfo['double_room'] ?? $basicInfo['doubleRoom'] ?? 0)
                    : ($basicInfo['single_room'] ?? $basicInfo['singleRoom'] ?? 0);
            }
        }

        if (!$package) {
            \Log::warning('Package not found for ID/Slug: ' . $request->package_id);
            return response()->json([
                'success' => false,
                'message' => 'Package not found'
            ], 404);
        }

        $packageCode = $request->package_code ?? 'PKG-' . $package->id;

        // Create booking
        $booking = Booking::create([
            'booking_number' => Booking::generateBookingNumber(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'travel_date' => $request->travel_date,
            'room_type' => $request->room_type,
            'package_id' => (string) $package->id,
            'package_code' => $packageCode,
            'package_title' => $packageTitle,
            'price' => $price,
            'status' => 'pending',
            'order_stat' => 'New',
            'user_id' => null,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method ?? 'bank_transfer',
            'payment_status' => 'pending',
            'booking_type' => $bookingType,
            'guests' => $request->guests ?? 1,
            'special_requests' => $request->special_requests ?? '',
        ]);

        \Log::info('Guest booking created:', [
            'id' => $booking->id,
            'number' => $booking->booking_number,
            'type' => $booking->booking_type,
            'payment_method' => $booking->payment_method,
            'price' => $booking->price
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully',
            'data' => $booking
        ], 201);
    }

    // ... rest of the methods ...
}
