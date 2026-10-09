<?php

namespace Database\Seeders;

use App\Models\Unduhan;
use Illuminate\Database\Seeder;

class UnduhanSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            // Category: Image
            [
                'judul'       => 'Logo PKKMB UIR 2026',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '2.4 MB',
                'urutan'      => 1,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo UIR',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '1.8 MB',
                'urutan'      => 2,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo Akreditasi & Keanggotaan',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '950 KB',
                'urutan'      => 3,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Frame Instagram - Feed',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '3.1 MB',
                'urutan'      => 4,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Frame Instagram - Stories',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '2.8 MB',
                'urutan'      => 5,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo Milad 64 TH UIR',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '4.2 MB',
                'urutan'      => 6,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo Berdampak',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '1.2 MB',
                'urutan'      => 7,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo UMAP',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '1.0 MB',
                'urutan'      => 8,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo APAIE',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '1.1 MB',
                'urutan'      => 9,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo EAIE',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '1.3 MB',
                'urutan'      => 10,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo Unggul',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '1.5 MB',
                'urutan'      => 11,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo QS Stars',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '850 KB',
                'urutan'      => 12,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo UIR HEBAT',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '1.6 MB',
                'urutan'      => 13,
                'is_active'   => true,
            ],
            [
                'judul'       => 'LAYOUT AUDITORIUM L4 4 REKTORAT UIR',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '5.6 MB',
                'urutan'      => 14,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Logo Kampus Menuju Dunia',
                'kategori'    => 'image',
                'file_url'    => '#',
                'file_size'   => '1.1 MB',
                'urutan'      => 15,
                'is_active'   => true,
            ],

            // Category: Video
            [
                'judul'       => 'Video Profil Resmi Universitas Islam Riau (4K UHD)',
                'kategori'    => 'video',
                'file_url'    => '#',
                'file_size'   => '48.5 MB',
                'urutan'      => 1,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Teaser Video Penerimaan Mahasiswa Baru (PMB) 2026',
                'kategori'    => 'video',
                'file_url'    => '#',
                'file_size'   => '24.2 MB',
                'urutan'      => 2,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Video Animasi Logo 3D UIR (Transparan Alpha)',
                'kategori'    => 'video',
                'file_url'    => '#',
                'file_size'   => '18.7 MB',
                'urutan'      => 3,
                'is_active'   => true,
            ],

            // Category: Audio
            [
                'judul'       => 'Mars Universitas Islam Riau (Studio Master HQ Audio)',
                'kategori'    => 'audio',
                'file_url'    => '#',
                'file_size'   => '7.8 MB',
                'urutan'      => 1,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Hymne Universitas Islam Riau (Orchestral Master)',
                'kategori'    => 'audio',
                'file_url'    => '#',
                'file_size'   => '8.4 MB',
                'urutan'      => 2,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Jingle Resmi Kampus UIR',
                'kategori'    => 'audio',
                'file_url'    => '#',
                'file_size'   => '4.2 MB',
                'urutan'      => 3,
                'is_active'   => true,
            ],

            // Category: Template
            [
                'judul'       => 'Template Presentasi PowerPoint (PPTX) Resmi UIR 2026',
                'kategori'    => 'template',
                'file_url'    => '#',
                'file_size'   => '12.3 MB',
                'urutan'      => 1,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Template Sertifikat & Piagam Penghargaan Resmi UIR',
                'kategori'    => 'template',
                'file_url'    => '#',
                'file_size'   => '15.6 MB',
                'urutan'      => 2,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Template Kop Surat, Nota Dinas & Format Dokumen Resmi',
                'kategori'    => 'template',
                'file_url'    => '#',
                'file_size'   => '1.4 MB',
                'urutan'      => 3,
                'is_active'   => true,
            ],
            [
                'judul'       => 'Template Virtual Background Zoom / GMeet Acara Kampus',
                'kategori'    => 'template',
                'file_url'    => '#',
                'file_size'   => '5.2 MB',
                'urutan'      => 4,
                'is_active'   => true,
            ],
        ];

        foreach ($data as $item) {
            Unduhan::updateOrCreate(
                ['judul' => $item['judul']],
                $item
            );
        }
    }
}
