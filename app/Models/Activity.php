<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\ActivityFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    /** @use HasFactory<ActivityFactory> */
    use HasFactory;

    protected $fillable = [
        'activity_type',
        'session_type',
        'name',
        'address',
        'city',
        'price',
        'rating',
        'start_date',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'rating' => 'float',
        'start_date' => 'datetime:Y-m-d H:i',
    ];
}
