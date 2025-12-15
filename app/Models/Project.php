<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'demo_url',
        'code_url',
        'show_demo_button',
        'show_code_button',
        'order',
    ];

    protected $casts = [
        'show_demo_button' => 'boolean',
        'show_code_button' => 'boolean',
    ];

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('order');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }
}
