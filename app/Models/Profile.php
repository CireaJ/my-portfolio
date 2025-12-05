<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'bio',
        'about_description',
        'profile_image',
        'email',
        'github_url',
        'linkedin_url',
        'twitter_url',
        'youtube_url',
        'website_url',
    ];
}
