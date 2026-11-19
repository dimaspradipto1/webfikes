<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMediaSetting extends Model
{
    use HasFactory;

    protected $table = 'social_media_settings';

    protected $fillable = [
        'judul_seksi',
        'subjudul_seksi',
    ];
}
