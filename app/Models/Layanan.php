<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
            if (empty($layanan->slug) && !empty($layanan->judul)) {
                $layanan->slug = \Illuminate\Support\Str::slug($layanan->judul);
            }
        });
    }
}
