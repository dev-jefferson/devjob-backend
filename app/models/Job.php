<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{

    protected $fillable = [
        'title',
        'location',
        'activities',
        'requirements',
        'technologies',
    ];

    protected $casts = [
        'location' => 'array',
        'activities' => 'array',
        'requirements' => 'array',
        'technologies' => 'array',
    ];
}
