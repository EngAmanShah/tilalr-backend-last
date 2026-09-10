<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InternetPackageRequest extends Model
{
    use HasFactory, \App\Traits\LogsActivity;

    protected $fillable = [
        'country',
        'mobile_number',
        'package',
    ];
}
