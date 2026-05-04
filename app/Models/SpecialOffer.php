<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialOffer extends Model
{
    use HasFactory;

    protected $table = 'special_offers';

    protected $fillable = [
        'image',
        'is_active',
        'order_position'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'order_position' => 'integer',
    ];

    /**
     * Scope for active special offers only
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true)
                     ->orderBy('order_position', 'asc');
    }

    /**
     * Get the full image URL
     */
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }

        // If already full URL
        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        // Return storage URL
        return asset('storage/' . ltrim($this->image, '/'));
    }
}
