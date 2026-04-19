<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternationalDestination extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'name_zh',
        'country_en',
        'country_ar',
        'country_zh',
        'city_en',
        'city_ar',
        'city_zh',
        'description_en',
        'description_ar',
        'description_zh',
        'image',
        'price',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];
}
