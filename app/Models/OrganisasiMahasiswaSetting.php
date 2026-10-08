<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisasiMahasiswaSetting extends Model
{
    use HasFactory;

    protected $table = 'organisasi_mahasiswa_settings';

    protected $fillable = [
        'badge_teks',
        'judul',
        'judul_highlight',
        'deskripsi',
        'tombol_teks',
        'tombol_url',
        'hint_teks',
    ];
}
