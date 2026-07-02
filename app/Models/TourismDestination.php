<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TourismDestination extends Model
{
    use HasFactory;

    protected $table = 'tourism_destinations';

    protected $fillable = [
        'slug',
        'title_en',
        'title_ar',
        'description_en',
        'description_ar',
        'long_description_en',
        'long_description_ar',
        'location_en',
        'location_ar',
        'duration_en',
        'duration_ar',
        'price',
        'rating',
        'image',
        'images',
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
        'region',
        'trip_code',
        'available_to',
        'double_room_price',
        'single_room_price',
        'active',
    ];

    protected $casts = [
        'images' => 'array',
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
        'price' => 'decimal:2',
        'double_room_price' => 'decimal:2',
        'single_room_price' => 'decimal:2',
        'rating' => 'float',
        'available_to' => 'date',
        'active' => 'boolean',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    // Get localized field
    public function getLocalized($field, $lang = null)
    {
        $lang = $lang ?? app()->getLocale();
        $fieldKey = $field . '_' . $lang;
        return $this->$fieldKey ?? $this->{$field . '_en'} ?? $this->$field ?? null;
    }

    // Accessors for Arabic content
    public function getTitleArAttribute($value)
    {
        return $value ?? $this->title_en;
    }

    public function getDescriptionArAttribute($value)
    {
        return $value ?? $this->description_en;
    }

    public function getLongDescriptionArAttribute($value)
    {
        return $value ?? $this->long_description_en;
    }

    public function getFeaturesArAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? $this->features_en ?? [];
        }
        return $value ?? $this->features_en ?? [];
    }

    public function getIncludesArAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? $this->includes_en ?? [];
        }
        return $value ?? $this->includes_en ?? [];
    }

    public function getNotIncludesArAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? $this->not_includes_en ?? [];
        }
        return $value ?? $this->not_includes_en ?? [];
    }

    public function getItineraryArAttribute($value)
    {
        if (is_string($value)) {
            return json_decode($value, true) ?? $this->itinerary_en ?? [];
        }
        return $value ?? $this->itinerary_en ?? [];
    }
}
