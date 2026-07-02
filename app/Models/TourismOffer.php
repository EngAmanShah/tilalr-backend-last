<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TourismOffer extends Model
{
    use HasFactory;

    protected $table = 'tourism_offers';

    protected $fillable = [
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'long_description_en',
        'long_description_ar',
        'slug',
        'image',
        'gallery',
        'price',
        'original_price',
        'discount',
        'rating',
        'duration_en',
        'duration_ar',
        'location_en',
        'location_ar',
        'group_size_en',
        'group_size_ar',
        'features_en',
        'features_ar',
        'includes_en',
        'includes_ar',
        'not_includes_en',
        'not_includes_ar',
        'itinerary_en',
        'itinerary_ar',
        'basic_info',
        'contact_info',
        'payment_methods',
        'type',
        'active',
        'popular',
        'limited',
        'region',
        'country',
        'city',
        'meta_title_en',
        'meta_title_ar',
        'meta_description_en',
        'meta_description_ar',
        'meta_keywords_en',
        'meta_keywords_ar',
    ];

    protected $casts = [
        'gallery' => 'array',
        'features_en' => 'array',
        'features_ar' => 'array',
        'includes_en' => 'array',
        'includes_ar' => 'array',
        'not_includes_en' => 'array',
        'not_includes_ar' => 'array',
        'itinerary_en' => 'array',
        'itinerary_ar' => 'array',
        'basic_info' => 'array',
        'contact_info' => 'array',
        'payment_methods' => 'array',
        'active' => 'boolean',
        'popular' => 'boolean',
        'limited' => 'boolean',
    ];
}
