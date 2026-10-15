<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sarana extends Model
{
    protected $table = 'saranas';

    protected $fillable = [
        'icon',
        'nama',
        'deskripsi',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    /**
     * Scope: hanya data aktif, urut tampil.
     */
    public function scopeAktif($query)
    {
        return $query->where('is_active', true)->orderBy('urutan');
    }
}
