<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = [
        'company', 'role', 'date_range', 'location', 'type', 'bullets', 'order',
    ];

    protected $casts = [
        'bullets' => 'array',
    ];
}
