<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug','image','title_en','title_ar','title_zh','description_en','description_ar','description_zh','duration',
        'duration_en','duration_ar','duration_zh','location_en','location_ar','location_zh','group_size','group_size_en','group_size_ar','group_size_zh',
        'discount','price','price_en','price_ar','price_zh','badge','badge_en','badge_ar','badge_zh','features','features_en','features_ar','features_zh',
        'highlights','highlights_en','highlights_ar','highlights_zh','is_active','order_position'
    ];

    protected $casts = [
        'features' => 'array',
        'features_en' => 'array',
        'features_ar' => 'array',
        'features_zh' => 'array',
        'highlights' => 'array',
        'highlights_en' => 'array',
        'highlights_ar' => 'array',
        'highlights_zh' => 'array',
        'is_active' => 'boolean',
        'price' => 'decimal:2',
        'price_en' => 'decimal:2',
        'price_ar' => 'decimal:2',
        'price_zh' => 'decimal:2',
        'discount' => 'decimal:2',
    ];

    public function getImageAttribute($value)
    {
        // If no image, return placeholder
        if (!$value) {
            return 'https://placehold.co/600x400/f0f0f0/999?text=No+Image+Available';
        }

        // If it's already a URL, return it
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }

        // If it starts with http, return as is
        if (str_starts_with($value, 'http')) {
            return $value;
        }

        // For stored images
        if (str_starts_with($value, 'offers/')) {
            if (Storage::disk('public')->exists($value)) {
                return Storage::url($value);
            }
        }

        // For islands images
        if (str_starts_with($value, 'islands/')) {
            return asset($value);
        }

        // Fallback placeholder
        return 'https://placehold.co/600x400/f0f0f0/999?text=No+Image+Available';
    }
}
