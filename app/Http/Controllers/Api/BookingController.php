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
    public function guestStore(Request $request)
    {
        \Log::info('=== GUEST BOOKING REQUEST ===');
        \Log::info('Request data:', $request->all());

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'mobile' => 'required|string|max:20',
            'travel_date' => 'required|date_format:Y-m-d',
            'room_type' => 'required|in:DoubleRoom,SingleRoom',
            'package_id' => 'nullable|string',
            'package_code' => 'nullable|string',
            'package_title' => 'nullable|string',
            'notes' => 'nullable|string',
            'payment_method' => 'nullable|in:credit_card,bank_transfer',
            'booking_type' => 'nullable|in:destination,tourism_offer',
            'guests' => 'nullable|integer|min:1',
            'special_requests' => 'nullable|string',
            'total_amount' => 'nullable|numeric|min:0',
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors()->toArray();
            \Log::error('Validation failed:', $errors);
            \Log::error('Full request body:', [
                'travel_date' => $request->travel_date,
                'travel_date_type' => gettype($request->travel_date),
                'all_data' => $request->all()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors' => $errors,
                'debug' => ['received_data' => $request->all()]
            ], 422);
        }

        $bookingType = $request->booking_type ?? 'destination';
        $package = null;
        $packageTitle = 'Unknown Package';
        $price = 0;
        $basicInfo = [];

        if ($bookingType === 'tourism_offer') {
            // For tourism offers, try to find in database but don't require it
            $package = TourismOffer::where('id', $request->package_id)
                ->orWhere('slug', $request->package_id)
                ->first();

            if ($package) {
                $packageTitle = $package->title_en ?? $package->title_ar ?? 'Tourism Offer';
                $price = $package->price ?? 0;
            } else {
                // If not found in database, use data from frontend request
                // This allows bookings for offers that exist on frontend but not yet in database
                $packageTitle = $request->package_title ?? 'Tourism Offer';
            }
        } else {
            // For destinations, require the package to exist
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
            } else {
                \Log::warning('Package not found for ID/Slug: ' . $request->package_id);
                return response()->json([
                    'success' => false,
                    'message' => 'Package not found'
                ], 404);
            }
        }

        // Use total_amount from frontend (preferred), fallback to calculated price
        $totalAmount = $request->total_amount ?? $price;

        $booking = Booking::create([
            'booking_number' => Booking::generateBookingNumber(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'mobile' => $request->mobile,
            'travel_date' => $request->travel_date,
            'room_type' => $request->room_type,
            'package_id' => (string) $package->id,
            'package_code' => $request->package_code ?? 'PKG-' . $package->id,
            'package_title' => $packageTitle,
            'price' => $price,
            'total_amount' => $totalAmount,
            'status' => 'pending',
            'order_stat' => 'New',
            'user_id' => null,
            'notes' => $request->notes,
            'payment_method' => $request->payment_method ?? 'credit_card',
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
            'price' => $booking->price,
            'total_amount' => $booking->total_amount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Booking created successfully',
            'data' => $booking
        ], 201);
    }

    public function paymentDetails($id)
    {
        $booking = Booking::find($id);
        if (!$booking) {
            return response()->json(['success' => false, 'message' => 'Booking not found'], 404);
        }
        return response()->json([
            'success' => true,
            'payment_id' => $booking->payment_id,
            'amount' => $booking->total_amount ?? $booking->price,
        ]);
    }
}
