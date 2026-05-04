<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchengenApplication extends Model
{
    protected $fillable = [
        'full_name',
        'phone',
        'email',
        'nationality',
        'passport_number',
        'applicant_type',
        'travel_date',
        'notes',
        'is_family',
        'travelers',
        'documents',
        'status',
        'admin_notes',
    ];

    protected $casts = [
        'travelers' => 'array',
        'documents' => 'array',
        'is_family' => 'boolean',
        'travel_date' => 'date',
    ];

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
