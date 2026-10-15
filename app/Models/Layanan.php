<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Layanan extends Model
{
    protected $table = 'layanans';

    protected $fillable = [
        'icon',
        'judul',
        'slug',
        'dasar_hukum',
        'link',
        'deskripsi',
        'rincian',
        'urutan',
        'aktif',
    ];

    protected $casts = [
        'aktif' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($layanan) {
            if (empty($layanan->slug) && ! empty($layanan->judul)) {
                $layanan->slug = Str::slug($layanan->judul);
            }
        });
    }
}
