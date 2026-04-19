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
        'description_en',
        'description_ar',
        'description_zh',
        'image',
        'duration_en',
        'duration_ar',
        'duration_zh',
        'price',
        'discount',
        'features_en',
        'features_ar',
        'features_zh',
        'highlight_en',
        'highlight_ar',
        'highlight_zh',
        'active',
    ];

    protected $casts = [
        'features_en' => 'array',
        'features_ar' => 'array',
        'features_zh' => 'array',
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];
}
