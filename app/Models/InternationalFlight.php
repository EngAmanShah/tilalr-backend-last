<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternationalFlight extends Model
{
    protected $fillable = [
        'airline_en',
        'airline_ar',
        'airline_zh',
        'route_en',
        'route_ar',
        'route_zh',
        'departure_time',
        'arrival_time',
        'duration',
        'stops_en',
        'stops_ar',
        'stops_zh',
        'price',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];
}
