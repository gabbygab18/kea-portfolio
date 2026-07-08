<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artwork extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'category',
        'description',
        'image',
        'hero_image',   // ← added
        'link',
        'tools',
        'featured',
        'meta',
        'gallery',      // ← added
        'stats',        // ← added
        'preview_image',
        'sort_order',    // ← added
    ];

    protected $casts = [
        'featured'   => 'boolean',
        'tools'      => 'array',
        'gallery'    => 'array',   // ← added
        'stats'      => 'array',   // ← added
    ];
}
