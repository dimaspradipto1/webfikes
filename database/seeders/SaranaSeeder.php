<?php

namespace Database\Seeders;

use App\Models\Sarana;
use Illuminate\Database\Seeder;

class SaranaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Sarana::truncate();

        $saranas = [
            [
                'icon' => 'bi-shield-check',
                'nama' => 'Lab K3 & Higiene Industri',
                'deskripsi' => 'Alat uji intensitas cahaya (Lux meter), kebisingan (Sound Level Meter), gas detektor, dan pengukuran getaran kerja.',
                'urutan' => 1,
                'is_active' => true,
            ],
            [
                'icon' => 'bi-droplet-half',
                'nama' => 'Lab Kesehatan Lingkungan',
                'deskripsi' => 'Uji parameter kualitas air bersih, spektrofotometer, inkubator BOD/COD, dan pengujian mikrobiologi bakteri E. coli.',
                'urutan' => 2,
                'is_active' => true,
            ],
            [
                'icon' => 'bi-heart-pulse',
                'nama' => 'Ruang Simulasi & Praktikum',
                'deskripsi' => 'Fasilitas simulasi tanggap darurat pertolongan pertama (P3K), penanganan kecelakaan kerja, dan evakuasi.',
                'urutan' => 3,
                'is_active' => true,
            ],
            [
                'icon' => 'bi-journal-bookmark-fill',
                'nama' => 'Perpustakaan & Ruang Riset',
                'deskripsi' => 'Ribuan koleksi buku teks kesehatan, jurnal internasional terindeks Scopus/SINTA, dan akses e-library 24 jam.',
                'urutan' => 4,
                'is_active' => true,
            ],
            [
                'icon' => 'bi-display',
                'nama' => 'Smart Classroom',
                'deskripsi' => 'Ruang kuliah ber-AC dilengkapi multimedia proyektor interaktif dan koneksi internet serat optik kecepatan tinggi.',
                'urutan' => 5,
                'is_active' => true,
            ],
            [
                'icon' => 'bi-people-fill',
                'nama' => 'Auditorium & Ruang Seminar',
                'deskripsi' => 'Gedung pertemuan representatif untuk penyelenggaraan seminar nasional, kuliah umum pakar, dan wisuda.',
                'urutan' => 6,
                'is_active' => true,
            ],
        ];

        foreach ($saranas as $sarana) {
            Sarana::create($sarana);
        }
    }
}
