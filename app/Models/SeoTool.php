<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class SeoTool extends Model
{
    protected $fillable = [
        'name',
        'category',
        'description',
        'icon_path',
        'icon',       // ← uploaded file path
        'order',
    ];
}
