<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class City extends Model
{
    use HasTranslations;

    protected $fillable = [
        'name', 'slug', 'description', 'image', 'images',
        'country', 'order', 'is_active',
        'best_time', 'activities', 'landmarks'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'images' => 'array',
        'activities' => 'array',
        'landmarks' => 'array',
    ];

    public $translatable = [
        'name', 'description', 'best_time', 'activities', 'landmarks'
    ];

    public function toArray()
    {
        $attributes = parent::toArray();
        foreach ($this->getTranslatableAttributes() as $field) {
            $attributes[$field] = $this->getTranslation($field, app()->getLocale());
        }
        return $attributes;
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }

    public function tourismOffers()
    {
        return $this->hasMany(TourismOffer::class, 'city', 'slug');
    }
}
