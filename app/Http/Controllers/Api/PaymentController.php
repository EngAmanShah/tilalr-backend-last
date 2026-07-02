<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PaymentController extends Controller
{
    public function initiateMoyasarPayment(Request $request)
    {
        Log::info('Initiate Moyasar payment:', $request->all());

        $validator = Validator::make($request->all(), [
            'booking_id' => 'required|integer|exists:bookings,id',
            'amount' => 'required|numeric|min:1',
            'payment_method' => 'required|in:credit_card,bank_transfer',
            'card_number' => 'required_if:payment_method,credit_card',
            'card_cvv' => 'required_if:payment_method,credit_card',
            'card_expiry' => 'required_if:payment_method,credit_card',
            'card_holder' => 'required_if:payment_method,credit_card',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            $booking = Booking::find($request->booking_id);

            if (!$booking) {
                return response()->json([
                    'success' => false,
                    'message' => 'Booking not found'
                ], 404);
            }

            $amount = (int) ($request->amount * 100);
            $callbackUrl = env('FRONTEND_URL', 'http://localhost:3000') . '/payment/callback';

            // Parse expiry date
            $expiry = explode('/', $request->card_expiry);
            $expMonth = trim($expiry[0]);
            $expYear = trim($expiry[1]);

            // Ensure year is 4 digits
            if (strlen($expYear) === 2) {
                $expYear = '20' . $expYear;
            }

            // Prepare payment data for Moyasar
            $paymentData = [
                'amount' => $amount,
                'currency' => 'SAR',
                'description' => 'Booking #' . $booking->booking_number . ' - ' . $booking->package_title,
                'callback_url' => $callbackUrl,
                'source' => [
                    'type' => 'creditcard',
                    'number' => str_replace(' ', '', $request->card_number),
                    'cvc' => $request->card_cvv,
                    'month' => $expMonth,
                    'year' => $expYear,
                    'name' => $request->card_holder,
                ],
                'metadata' => [
                    'booking_id' => $booking->id,
                    'booking_number' => $booking->booking_number,
                    'customer_email' => $booking->email,
                    'customer_name' => $booking->first_name . ' ' . $booking->last_name,
                ],
            ];

            Log::info('Sending to Moyasar:', $paymentData);

            // Send to Moyasar
            $response = Http::withBasicAuth(env('MOYASAR_SECRET_KEY'), '')
                ->withOptions([
                    'verify' => false,
                    'timeout' => 30,
                ])
                ->post('https://api.moyasar.com/v1/payments', $paymentData);

            $result = $response->json();
            $status = $response->status();

            Log::info('Moyasar response:', ['status' => $status, 'body' => $result]);

            if ($status === 200 || $status === 201) {
                if (isset($result['id'])) {
                    // Update booking with payment ID
                    $booking->update([
                        'payment_id' => $result['id'],
                        'payment_status' => 'initiated',
                    ]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Payment initiated successfully',
                        'payment_url' => $result['url'] ?? null,
                        'payment_id' => $result['id'],
                    ]);
                }
            }

            $errorMsg = $result['message'] ?? 'Payment initiation failed';
            if (isset($result['errors'])) {
                $errors = [];
                foreach ($result['errors'] as $key => $value) {
                    $errors[] = $key . ': ' . (is_array($value) ? implode(', ', $value) : $value);
                }
                $errorMsg = implode('; ', $errors);
            }

            return response()->json([
                'success' => false,
                'message' => $errorMsg,
                'debug' => $result
            ], 400);

        } catch (\Exception $e) {
            Log::error('Payment error:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Payment failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function moyasarWebhook(Request $request)
    {
        Log::info('Moyasar webhook received:', $request->all());

        $payload = $request->all();
        $data = $payload['data'] ?? $payload;

        if (!isset($data['id'])) {
            Log::warning('Invalid webhook payload: missing payment ID');
            return response()->json(['status' => 'error'], 400);
        }

        $paymentId = $data['id'];
        $status = $data['status'] ?? 'unknown';

        $booking = Booking::where('payment_id', $paymentId)->first();

        if (!$booking) {
            Log::warning('Booking not found for payment ID: ' . $paymentId);
            return response()->json(['status' => 'not_found'], 404);
        }

        $paymentStatus = match ($status) {
            'paid' => 'paid',
            'failed' => 'failed',
            'refunded' => 'refunded',
            default => $status,
        };

        $booking->update([
            'payment_status' => $paymentStatus,
            'status' => $status === 'paid' ? 'confirmed' : 'pending',
        ]);

        Log::info('Booking payment status updated:', [
            'booking_id' => $booking->id,
            'payment_id' => $paymentId,
            'status' => $paymentStatus
        ]);

        return response()->json(['status' => 'success']);
    }

    public function callback(Request $request)
    {
        $paymentId = $request->query('id');
        $status = $request->query('status');

        if (!$paymentId) {
            return redirect(env('FRONTEND_URL', 'http://localhost:3000') . '/payment?error=missing_payment_id');
        }

        $booking = Booking::where('payment_id', $paymentId)->first();

        if (!$booking) {
            return redirect(env('FRONTEND_URL', 'http://localhost:3000') . '/payment?error=booking_not_found');
        }

        try {
            $response = Http::withBasicAuth(env('MOYASAR_SECRET_KEY'), '')
                ->withOptions(['verify' => false])
                ->get('https://api.moyasar.com/v1/payments/' . $paymentId);

            $paymentData = $response->json();
            Log::info('Payment verification result:', $paymentData);

            if ($response->successful() && ($paymentData['status'] ?? '') === 'paid') {
                $booking->update([
                    'payment_status' => 'paid',
                    'status' => 'confirmed',
                ]);

                return redirect(env('FRONTEND_URL', 'http://localhost:3000') . '/payment/success?booking=' . $booking->booking_number);
            } else {
                $booking->update([
                    'payment_status' => 'failed',
                ]);

                return redirect(env('FRONTEND_URL', 'http://localhost:3000') . '/payment/failed?booking=' . $booking->booking_number);
            }
        } catch (\Exception $e) {
            Log::error('Payment verification error:', ['message' => $e->getMessage()]);
            return redirect(env('FRONTEND_URL', 'http://localhost:3000') . '/payment/error');
        }
    }

    public function getPaymentStatus($id)
    {
        $booking = Booking::where('id', $id)
            ->orWhere('booking_number', $id)
            ->first();

        if (!$booking) {
            return response()->json([
                'success' => false,
                'message' => 'Booking not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'booking_number' => $booking->booking_number,
                'payment_status' => $booking->payment_status,
                'status' => $booking->status,
                'amount' => $booking->price,
            ]
        ]);
    }
}
