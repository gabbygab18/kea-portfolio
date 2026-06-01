<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SeoProject extends Model
{
    protected $fillable = [
        'title',
        'client',
        'category',
        'description',
        'overview',
        'link',
        'featured',
        'tools',
        'results',
        'skills',
        'order',
    ];

    protected $casts = [
        'featured' => 'boolean',
        'tools'    => 'array',
        'results'  => 'array',
    ];
}
