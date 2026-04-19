<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class IslandDestination extends Model
{
    use HasFactory;

    protected $table = 'island_destinations';

    protected $fillable = [
        'slug',
        'title_en',
        'title_ar',
        'title_zh',
        'description_en',
        'description_ar',
        'description_zh',
        'highlights_en',
        'highlights_ar',
        'highlights_zh',
        'includes_en',
        'includes_ar',
        'includes_zh',
        'itinerary_en',
        'itinerary_ar',
        'itinerary_zh',
        'location_en',
        'location_ar',
        'location_zh',
        'duration_en',
        'duration_ar',
        'duration_zh',
        'groupSize_en',
        'groupSize_ar',
        'groupSize_zh',
        'features_en',
        'features_ar',
        'features_zh',
        'features',
        'image',
        'price',
        'rating',
        'city_id',
        'type',
        'type_en',
        'type_ar',
        'type_zh',
        'active',
    ];

    protected $casts = [
        'features' => 'array',
        'features_en' => 'array',
        'features_ar' => 'array',
        'features_zh' => 'array',
        'highlights_en' => 'array',
        'highlights_ar' => 'array',
        'highlights_zh' => 'array',
        'includes_en' => 'array',
        'includes_ar' => 'array',
        'includes_zh' => 'array',
        'price' => 'decimal:2',
        'rating' => 'float',
        'active' => 'boolean',
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function booted()
    {
        // Ensure a unique slug exists on creating/saving to prevent route generation errors
        static::creating(function ($model) {
            // Always generate a unique slug from title_en when creating
            if (!empty($model->title_en)) {
                $model->slug = self::generateUniqueSlug($model->title_en);
            }
        });

        static::updating(function ($model) {
            // If slug somehow emptied before update, regenerate from title_en
            if (empty($model->slug) && !empty($model->title_en)) {
                $model->slug = self::generateUniqueSlug($model->title_en, $model->id);
            }
        });
    }

    /**
     * Generate a unique slug from the given title
     */
    public static function generateUniqueSlug(string $title, ?int $excludeId = null): string
    {
        $base = Str::slug($title);
        
        // If base is empty (e.g., Arabic-only title), use a fallback
        if (empty($base)) {
            $base = 'destination-' . time();
        }
        
        $slug = $base;
        $i = 1;
        
        $query = self::where('slug', $slug);
        if ($excludeId) {
            $query->where('id', '!=', $excludeId);
        }
        
        while ($query->exists()) {
            $slug = $base . '-' . $i++;
            $query = self::where('slug', $slug);
            if ($excludeId) {
                $query->where('id', '!=', $excludeId);
            }
        }
        
        return $slug;
    }
}
