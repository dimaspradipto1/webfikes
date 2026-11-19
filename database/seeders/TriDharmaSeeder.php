<?php

namespace Database\Seeders;

use App\Models\TriDharma;
use Illuminate\Database\Seeder;

class TriDharmaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            [
                'icon' => 'bi-journal-check',
                'warna' => '#823ca2',
                'judul' => 'Riset Terapan',
                'deskripsi' => 'Fokus riset ergonomi industri maritim dan sanitasi pesisir.',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'icon' => 'bi-globe-americas',
                'warna' => '#e67e22',
                'judul' => 'Publikasi SINTA',
                'deskripsi' => 'Publikasi rutin di jurnal nasional terakreditasi dan prosiding.',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'icon' => 'bi-heart-pulse-fill',
                'warna' => '#dc3545',
                'judul' => 'Pengmas Berkelanjutan',
                'deskripsi' => 'Edukasi K3 bagi pekerja UMKM dan pemeriksaan sanitasi warga.',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'icon' => 'bi-briefcase-fill',
                'warna' => '#198754',
                'judul' => 'Kerja Sama Riset',
                'deskripsi' => 'Kolaborasi penelitian bersama instansi pemerintah & swasta.',
                'urutan' => 4,
                'is_active' => true,
            ],
        ];

        foreach ($items as $item) {
            TriDharma::updateOrCreate(
                ['judul' => $item['judul']],
                $item
            );
        }
    }
}
