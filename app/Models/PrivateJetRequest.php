<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateJetRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'client_type',
        'mobile_number',
        'email',
        'number_of_people',
        'destination',
        'departure_airport',
        'departure_date',
        'return_date',
        'special_requirements',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'return_date' => 'date',
        'number_of_people' => 'integer',
    ];
}
