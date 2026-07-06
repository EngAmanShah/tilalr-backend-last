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

            $amountInHalalas = (int) round($request->amount * 100);
            if ($amountInHalalas < 100) $amountInHalalas = 100;

            $customerName = trim(($booking->first_name ?? '') . ' ' . ($booking->last_name ?? ''));
            $customerName = preg_replace('/[^A-Za-z\s\.]/', '', $customerName);
            if (empty($customerName) || strlen($customerName) < 2) {
                $customerName = 'Guest User';
            }

            $lang = $request->lang ?? 'en';
            $webhookUrl = env('APP_URL', 'http://localhost:8000') . '/api/payments/webhook/moyasar';
            $successUrl = env('FRONTEND_URL', 'http://localhost:3000') . '/' . $lang . '/payment-success?booking_id=' . $booking->id;
            $cancelUrl = env('FRONTEND_URL', 'http://localhost:3000') . '/' . $lang . '/payment-cancel?booking_id=' . $booking->id;

            $paymentData = [
                'amount' => $amountInHalalas,
                'currency' => 'SAR',
                'description' => 'Booking #' . ($booking->booking_number ?? $booking->id),
                'metadata' => [
                    'booking_id' => $booking->id,
                    'customer_name' => $customerName,
                    'customer_email' => $booking->email ?? '',
                ],
                // Send the minimal required Moyasar source shape without any card details.
                'source' => [
                    'type' => 'creditcard',
                ],
                'callback_url' => $webhookUrl,
                'redirect_url' => $successUrl,
                'cancel_url' => $cancelUrl,
            ];

            Log::info('Sending to Moyasar:', $paymentData);

            $response = Http::withBasicAuth(env('MOYASAR_SECRET_KEY'), '')
                ->withOptions([
                    'verify' => false,
                    'timeout' => 60,
                ])
                ->asJson()
                ->post('https://api.moyasar.com/v1/payments', $paymentData);

            $status = $response->status();
            $result = $response->json();

            Log::info('Moyasar response:', ['status' => $status, 'body' => $result]);

            if ($status === 200 || $status === 201) {
                if (isset($result['id'])) {
                    $booking->update([
                        'payment_id' => $result['id'],
                        'payment_status' => 'initiated',
                        'transaction_id' => $result['id'],
                    ]);

                    // Prefer the public hosted URL fields Moyasar returns.
                    $paymentUrl = data_get($result, 'source.transaction_url')
                        ?? $result['transaction_url']
                        ?? $result['url']
                        ?? null;

                    if ($paymentUrl) {
                        return response()->json([
                            'success' => true,
                            'payment_url' => $paymentUrl,
                            'payment_id' => $result['id'],
                        ]);
                    }

                    return response()->json([
                        'success' => false,
                        'message' => 'Payment created but no hosted URL returned by Moyasar.',
                        'debug' => $result,
                    ], 500);
                }
            }

            // If the gateway responds with a validation error that requests
            // card fields when we intentionally did not send them, return
            // that validation message back to the frontend so the integrator
            // can decide how to proceed (do NOT send dummy card details).
            if ($status === 400 && isset($result['type']) && $result['type'] === 'validation_error') {
                Log::warning('Moyasar requires card fields for this account:', $result);
                return response()->json([
                    'success' => false,
                    'message' => $result['message'] ?? 'Moyasar validation failed',
                    'errors' => $result['errors'] ?? null,
                    'debug' => $result,
                ], 400);
            }

            $errorMessage = $result['message'] ?? 'Payment initiation failed';
            if (isset($result['errors'])) {
                $errorDetails = [];
                foreach ($result['errors'] as $key => $value) {
                    $errorDetails[] = $key . ': ' . (is_array($value) ? implode(', ', $value) : $value);
                }
                $errorMessage = implode('; ', $errorDetails);
            }

            return response()->json([
                'success' => false,
                'message' => $errorMessage,
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
            'paid', 'captured' => 'paid',
            'failed' => 'failed',
            'refunded' => 'refunded',
            default => $status,
        };

        $bookingStatus = match ($status) {
            'paid', 'captured' => 'confirmed',
            'failed' => 'cancelled',
            default => 'pending',
        };

        $booking->update([
            'payment_status' => $paymentStatus,
            'status' => $bookingStatus,
        ]);

        Log::info('Booking payment status updated:', [
            'booking_id' => $booking->id,
            'payment_id' => $paymentId,
            'status' => $paymentStatus,
        ]);

        return response()->json(['status' => 'success']);
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
                'amount' => $booking->total_amount ?? $booking->price,
                'payment_id' => $booking->payment_id,
            ]
        ]);
    }
}
