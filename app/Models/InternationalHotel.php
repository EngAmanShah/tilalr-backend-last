<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternationalHotel extends Model
{
    protected $fillable = [
        'name_en',
        'name_ar',
        'name_zh',
        'location_en',
        'location_ar',
        'location_zh',
        'description_en',
        'description_ar',
        'description_zh',
        'rating',
        'price',
        'image',
        'amenities_en',
        'amenities_ar',
        'amenities_zh',
        'active',
    ];

    protected $casts = [
        'amenities_en' => 'array',
        'amenities_ar' => 'array',
        'amenities_zh' => 'array',
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function setImageAttribute($value)
    {
        if (empty($value)) {
            $this->attributes['image'] = null;
            return;
        }

        // If a full URL was provided, extract the path part and normalize it
        if (preg_match('/^https?:\/\//', $value)) {
            $path = parse_url($value, PHP_URL_PATH) ?: $value;
            $path = ltrim($path, '/');
            $path = preg_replace('#^storage/#', '', $path);
            $this->attributes['image'] = $path;
            return;
        }

        // Normalize any leading slashes or storage/ prefix and store a relative path
        $this->attributes['image'] = preg_replace('#^/+storage/#', '', ltrim($value, '/'));
    }
}
