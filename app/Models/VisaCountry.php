<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisaCountry extends Model
{
    protected $table = 'visa_countries';

    protected $fillable = [
        'name_en',
        'name_ar',
        'name_zh',
        'slug',
        'flag_emoji',
        'flag_path',
        'visa_type_en',
        'visa_type_ar',
        'visa_type_zh',
        'processing_time_en',
        'processing_time_ar',
        'processing_time_zh',
        'cost_per_person',
        'description_en',
        'description_ar',
        'description_zh',
        'documents',
        'notes',
        'is_active',
        'sort_order',
    ];

    protected $casts = [
        'documents' => 'array',
        'notes' => 'array',
        'is_active' => 'boolean',
        'cost_per_person' => 'decimal:2',
    ];
}
