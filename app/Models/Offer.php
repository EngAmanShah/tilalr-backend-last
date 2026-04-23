<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'slug','image','title_en','title_ar','title_zh','description_en','description_ar','description_zh','duration',
        'duration_en','duration_ar','duration_zh','location_en','location_ar','location_zh','group_size','group_size_en','group_size_ar','group_size_zh',
        'discount','price','price_en','price_ar','price_zh','badge','badge_en','badge_ar','badge_zh','features','features_en','features_ar','features_zh','highlights','highlights_en','highlights_ar','highlights_zh','is_active','is_special_offer'
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
        'is_special_offer' => 'boolean',
        'price' => 'decimal:2',
        'price_en' => 'decimal:2',
        'price_ar' => 'decimal:2',
        'price_zh' => 'decimal:2',
    ];

    /**
     * Set the image - extract path from full URL if needed
     */
    public function setImageAttribute($value)
    {
        if (!$value) {
            $this->attributes['image'] = null;
            return;
        }

        // If it's a full URL, extract the path
        if (preg_match('/^https?:\/\//', $value)) {
            // Extract path from URL: https://admin.tilalr.com/storage/offers/filename.jpg -> offers/filename.jpg
            $parsed = parse_url($value);
            $path = ltrim($parsed['path'] ?? $value, '/');
            
            // Remove 'storage/' prefix if present to get relative path
            if (str_starts_with($path, 'storage/')) {
                $path = substr($path, 8); // Remove 'storage/' prefix
            }
            
            $this->attributes['image'] = $path;
        } else {
            // Store as-is if it's already a relative path
            $this->attributes['image'] = ltrim($value, '/');
        }
    }

    /**
     * Get the full image URL for the offer
     */
    public function getImageAttribute($value)
    {
        if (!$value) {
            return null;
        }

        // Normalize the image path
        $imagePath = ltrim($value, '/');

        // Check if already absolute URL
        if (preg_match('/^https?:\/\//', $imagePath)) {
            return $imagePath;
        }

        // Check if it's already a full storage path
        if (str_starts_with($imagePath, 'storage/') || str_starts_with($imagePath, '/storage/')) {
            return asset($imagePath);
        }

        // Otherwise treat as storage path relative to storage/app/public
        return asset('storage/' . $imagePath);
    }
}