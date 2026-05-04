<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class EvisaApplication extends Model
{
    protected $fillable = [
        'country_name',
        'country_slug',
        'passport_type',
        'visa_type',
        'interview_city',
        'date_of_birth',
        'full_name',
        'email',
        'phone',
        'passport_number',
        'passport_expiry',
        'amount',
        'status',
        'documents',
        'notes',
        'user_id',
    ];

    protected $casts = [
        'date_of_birth' => 'date',
        'passport_expiry' => 'date',
        'documents' => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusBadgeColorAttribute(): string
    {
        return match($this->status) {
            'pending' => 'warning',
            'processing' => 'info',
            'approved' => 'success',
            'rejected' => 'danger',
            'completed' => 'success',
            default => 'secondary',
        };
    }
}
