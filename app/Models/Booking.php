<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_number',
        'first_name',
        'last_name',
        'email',
        'mobile',
        'travel_date',
        'room_type',
        'package_id',
        'package_code',
        'package_title',
        'price',
        'status',
        'notes',
        'order_stat',
        'user_id',
        'payment_method',
        'payment_status',
        'payment_id',
        'booking_type',
        'guests',
        'special_requests',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'price' => 'decimal:2',
    ];

    public static function generateBookingNumber()
    {
        $prefix = 'BK';
        $number = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
        $code = $prefix . $number . date('y');

        while (self::where('booking_number', $code)->exists()) {
            $number = str_pad(mt_rand(1, 99999), 5, '0', STR_PAD_LEFT);
            $code = $prefix . $number . date('y');
        }

        return $code;
    }

    public function isTourismOffer()
    {
        return $this->booking_type === 'tourism_offer';
    }

    public function isDestination()
    {
        return $this->booking_type === 'destination';
    }
}
