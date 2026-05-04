<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaApplication extends Model
{
    use HasFactory;

    protected $table = 'visa_applications';

    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'nationality',
        'passport_number',
        'visa_type',
        'travel_date',
        'notes',
        'application_type',
        'locale',
        'status',
        'passport_copy_path',
        'photo_path',
        'other_documents_path',
    ];

    protected $casts = [
        'travel_date' => 'date',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Get the full URL for passport copy
     */
    public function getPassportCopyUrlAttribute()
    {
        if (!$this->passport_copy_path) {
            return null;
        }
        return asset('storage/' . $this->passport_copy_path);
    }

    /**
     * Get the full URL for photo
     */
    public function getPhotoUrlAttribute()
    {
        if (!$this->photo_path) {
            return null;
        }
        return asset('storage/' . $this->photo_path);
    }

    /**
     * Get the full URL for other documents
     */
    public function getOtherDocumentsUrlAttribute()
    {
        if (!$this->other_documents_path) {
            return null;
        }
        return asset('storage/' . $this->other_documents_path);
    }
}
