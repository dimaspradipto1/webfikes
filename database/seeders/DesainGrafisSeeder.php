<?php

namespace Database\Seeders;

use App\Models\DesainGrafis;
use Illuminate\Database\Seeder;

class DesainGrafisSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            [
                'judul'          => 'LED Tengah Audit #1',
                'kategori'       => 'audit',
                'badge_teks'     => 'Landscape (704 x 320 px)',
                'spesifikasi'    => 'Ukuran: LED TENGAH untuk gedung Auditorium lt. 4 gedung H. Rasit Kurnain (Format 704 x 320 px / Landscape)',
                'deskripsi'      => 'Tema Hijau & Emas Formal',
                'canva_url'      => 'https://www.canva.com',
                'warna_gradient' => 'linear-gradient(135deg, #0b6828 0%, #15803d 100%)',
                'urutan'         => 1,
                'is_active'      => true,
            ],
            [
                'judul'          => 'LED Tengah Audit #2',
                'kategori'       => 'audit',
                'badge_teks'     => 'Landscape (704 x 320 px)',
                'spesifikasi'    => 'Ukuran: LED TENGAH untuk gedung Auditorium lt. 4 gedung H. Rasit Kurnain (Format 704 x 320 px / Landscape)',
                'deskripsi'      => 'Tema Modern Hijau UIS',
                'canva_url'      => 'https://www.canva.com',
                'warna_gradient' => 'linear-gradient(135deg, #044b1c 0%, #066d2a 100%)',
                'urutan'         => 2,
                'is_active'      => true,
            ],
            [
                'judul'          => 'LED Tengah Audit #3',
                'kategori'       => 'audit',
                'badge_teks'     => 'Landscape (704 x 320 px)',
                'spesifikasi'    => 'Ukuran: LED TENGAH untuk gedung Auditorium lt. 4 gedung H. Rasit Kurnain (Format 704 x 320 px / Landscape)',
                'deskripsi'      => 'Tema Hijau Fresh Seminar',
                'canva_url'      => 'https://www.canva.com',
                'warna_gradient' => 'linear-gradient(135deg, #166534 0%, #22c55e 100%)',
                'urutan'         => 3,
                'is_active'      => true,
            ],
            [
                'judul'          => 'LED Tengah Audit #4',
                'kategori'       => 'audit',
                'badge_teks'     => 'Landscape (704 x 320 px)',
                'spesifikasi'    => 'Ukuran: LED TENGAH untuk gedung Auditorium lt. 4 gedung H. Rasit Kurnain (Format 704 x 320 px / Landscape)',
                'deskripsi'      => 'Tema Elegan Kuning Emas',
                'canva_url'      => 'https://www.canva.com',
                'warna_gradient' => 'linear-gradient(135deg, #ca8a04 0%, #eab308 100%)',
                'urutan'         => 4,
                'is_active'      => true,
            ],
            [
                'judul'          => 'Ruang Sidang #1',
                'kategori'       => 'sidang',
                'badge_teks'     => '16:9 (1920 x 1080 px)',
                'spesifikasi'    => 'Ukuran Layar LCD & Proyektor Ruang Sidang Utama lt. 2 (Format 1920 x 1080 px / 16:9 Full HD)',
                'deskripsi'      => 'Presentasi & Rapat Senat',
                'canva_url'      => 'https://www.canva.com',
                'warna_gradient' => 'linear-gradient(135deg, #065f46 0%, #059669 100%)',
                'urutan'         => 1,
                'is_active'      => true,
            ],
            [
                'judul'          => 'Ruang Sidang #2',
                'kategori'       => 'sidang',
                'badge_teks'     => '16:9 (1920 x 1080 px)',
                'spesifikasi'    => 'Ukuran Layar LCD & Proyektor Ruang Sidang Utama lt. 2 (Format 1920 x 1080 px / 16:9 Full HD)',
                'deskripsi'      => 'Sidang Terbuka & Yudisium',
                'canva_url'      => 'https://www.canva.com',
                'warna_gradient' => 'linear-gradient(135deg, #0b6828 0%, #16a34a 100%)',
                'urutan'         => 2,
                'is_active'      => true,
            ],
            [
                'judul'          => 'Rapat Dekanat #1',
                'kategori'       => 'dekanat',
                'badge_teks'     => '16:9 (1920 x 1080 px)',
                'spesifikasi'    => 'Format Display TV Ruang Rapat Fakultas / Dekanat (Format 1920 x 1080 px / Full HD)',
                'deskripsi'      => 'Agenda Rapat Koordinasi',
                'canva_url'      => 'https://www.canva.com',
                'warna_gradient' => 'linear-gradient(135deg, #1e3a8a 0%, #0284c7 100%)',
                'urutan'         => 1,
                'is_active'      => true,
            ],
            [
                'judul'          => 'Spanduk Gerbang 3x1m',
                'kategori'       => 'spanduk',
                'badge_teks'     => 'Ratio 3:1 Banner',
                'spesifikasi'    => 'Spanduk Gerbang Depan & Backdrop Panggung Utama (Format 3 x 1 meter & 4 x 2 meter)',
                'deskripsi'      => 'Penyambutan & Ucapan Selamat',
                'canva_url'      => 'https://www.canva.com',
                'warna_gradient' => 'linear-gradient(135deg, #044b1c 0%, #15803d 100%)',
                'urutan'         => 1,
                'is_active'      => true,
            ],
        ];

        foreach ($items as $data) {
            DesainGrafis::create($data);
        }
    }
}
