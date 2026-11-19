<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Prestasi extends Model
{
    protected $table = 'prestasis';

    protected $fillable = [
        'foto',
        'judul_prestasi',
        'slug',
        'nama_mahasiswa',
        'nim',
        'prodi',
        'tingkat',
        'peringkat',
        'penyelenggara',
        'tahun',
        'deskripsi',
        'is_active',
        'urutan',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    protected static function booted()
    {
        static::saving(function ($prestasi) {
            if (empty($prestasi->slug) || $prestasi->isDirty('judul_prestasi')) {
                $baseSlug = Str::slug($prestasi->judul_prestasi);
                $slug = $baseSlug;
                $counter = 1;

                while (static::where('slug', $slug)->where('id', '!=', $prestasi->id ?? 0)->exists()) {
                    $slug = "{$baseSlug}-{$counter}";
                    $counter++;
                }

                $prestasi->slug = $slug;
            }
        });
    }
}
