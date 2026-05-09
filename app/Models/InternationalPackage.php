<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternationalPackage extends Model
{
    protected $fillable = [
        'type_en',
        'type_ar',
        'type_zh',
        'title_en',
        'title_ar',
        'title_zh',
        'destination_en',
        'destination_ar',
        'destination_zh',
        'region_en',
        'region_ar',
        'region_zh',
        'description_en',
        'description_ar',
        'description_zh',
        'image',
        'duration_en',
        'duration_ar',
        'duration_zh',
        'data_amount',
        'plan_type',
        'price',
        'starting_price',
        'discount',
        'features_en',
        'features_ar',
        'features_zh',
        'highlight_en',
        'highlight_ar',
        'highlight_zh',
        'networks',
        'supported_countries',
        'supported_countries_count',
        'hotspot_tethering',
        'rechargeability',
        'package_code',
        'active',
    ];

    protected $casts = [
        'features_en' => 'array',
        'features_ar' => 'array',
        'features_zh' => 'array',
        'networks' => 'array',
        'supported_countries' => 'array',
        'supported_countries_count' => 'integer',
        'hotspot_tethering' => 'boolean',
        'rechargeability' => 'boolean',
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];
}
