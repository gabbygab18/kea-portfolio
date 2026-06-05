<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsletterPhoto extends Model
{
    protected $fillable = [
        'image_path',
        'alt',
        'column',
        'order',
    ];

    /**
     * Full public URL for use in Blade templates.
     */
    public function getUrlAttribute(): string
    {
        return asset('storage/' . $this->image_path);
    }
}
