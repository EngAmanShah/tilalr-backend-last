<?php

namespace Tests\Feature;

use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class BookingPaymentTest extends TestCase
{
    use RefreshDatabase;

    public function test_create_booking_and_pay_success()
    {
        // Create a booking via API
        $payload = [
            'service_id' => 1,
            'date' => now()->addDays(5)->toDateString(),
            'guests' => 2,
            'details' => ['notes' => 'No allergies']
        ];

        $create = $this->postJson('/api/bookings', $payload);
        $create->assertStatus(201)->assertJsonStructure(['booking' => ['id','service_id','date','payment_status']]);

        $bookingId = $create->json('booking.id');

        $pay = $this->postJson('/api/payments', ['booking_id' => $bookingId, 'method' => 'dummy', 'simulate' => 'success']);
        $pay->assertStatus(200)->assertJsonPath('result.status', 'paid');

        $this->assertDatabaseHas('bookings', ['id' => $bookingId, 'payment_status' => 'paid']);
        $this->assertDatabaseHas('payments', ['booking_id' => $bookingId, 'status' => 'paid']);
    }

    public function test_moyasar_initiation_returns_payment_url_and_updates_booking()
    {
        Http::fake([
            'https://api.moyasar.com/v1/payments' => Http::response([
                'id' => 'payment-123',
                'status' => 'initiated',
                'source' => [
                    'transaction_url' => 'https://api.moyasar.com/v1/card_auth/payment-123/prepare',
                ],
            ], 201),
        ]);

        $booking = Booking::create([
            'booking_number' => Booking::generateBookingNumber(),
            'first_name' => 'Aman',
            'last_name' => 'Shah',
            'email' => 'aman@example.com',
            'price' => 100,
            'status' => 'pending',
        ]);

        $response = $this->postJson('/api/payments/moyasar/initiate', [
            'booking_id' => $booking->id,
            'amount' => 100,
            'lang' => 'en',
        ]);

        $response->assertStatus(200)
            ->assertJsonPath('success', true)
            ->assertJsonPath('payment_id', 'payment-123')
            ->assertJsonPath('payment_url', 'https://api.moyasar.com/v1/card_auth/payment-123/prepare');

        $this->assertDatabaseHas('bookings', [
            'id' => $booking->id,
            'payment_id' => 'payment-123',
            'payment_status' => 'initiated',
        ]);

        Http::assertSent(function ($request) {
            return $request->url() === 'https://api.moyasar.com/v1/payments'
                && $request['source']['type'] === 'creditcard'
                && $request['source']['number'] === '4111111111111111'
                && $request['callback_url'] === 'http://localhost:8000/api/payments/webhook/moyasar';
        });
    }
}
