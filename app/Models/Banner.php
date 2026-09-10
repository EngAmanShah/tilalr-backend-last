<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory, \App\Traits\LogsActivity;

    protected $fillable = [
        'background_image',
        'background_image_pc',
        'background_image_tablet',
        'background_image_mobile',
        'sentence_en',
        'sentence_ar',
        'button_text_en',
        'button_text_ar',
        'url',
        'page',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    protected static function booted(): void
    {
        static::saving(function ($model) {
            if ($model->background_image) {
                $model->background_image_pc = $model->background_image;
                $model->background_image_tablet = $model->background_image;
                $model->background_image_mobile = $model->background_image;
            }
        });
    }

    public function getBackgroundImageAttribute($value)
    {
        return $value ?: ($this->attributes['background_image_pc'] ?? $this->attributes['background_image_mobile'] ?? null);
    }
}
