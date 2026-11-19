<?php

namespace Database\Seeders;

use App\Models\Prestasi;
use Illuminate\Database\Seeder;

class PrestasiSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'foto' => null,
                'judul_prestasi' => 'Juara 1 Lomba Karya Tulis Ilmiah Nasional K3 (LKTI) 2026',
                'nama_mahasiswa' => 'Ahmad Rizki Maulana & Tim',
                'nim' => '231055201012',
                'prodi' => 'S1 Kesehatan dan Keselamatan Kerja',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 1 (Medali Emas)',
                'penyelenggara' => 'Kementerian Ketenagakerjaan RI & Asosiasi K3 Indonesia',
                'tahun' => '2026',
                'deskripsi' => 'Inovasi sistem deteksi dini bahaya kebisingan berbasis IoT dan sensor cerdas pada sektor industri maritim galangan kapal Batam.',
                'is_active' => true,
                'urutan' => 1,
            ],
            [
                'foto' => null,
                'judul_prestasi' => 'Best Paper Award — International Conference on Public Health & Environmental Safety',
                'nama_mahasiswa' => 'Siti Nur Aisyah',
                'nim' => '221055202008',
                'prodi' => 'S2 Kesehatan Masyarakat',
                'tingkat' => 'Internasional',
                'peringkat' => 'Best Presentation & Paper',
                'penyelenggara' => 'Southeast Asia Public Health Consortium (SEAPHC)',
                'tahun' => '2026',
                'deskripsi' => 'Riset epidemiologi komparatif mengenai pemantauan kualitas udara pesisir dan mitigasi infeksi saluran pernapasan pada masyarakat pulau terluar.',
                'is_active' => true,
                'urutan' => 2,
            ],
            [
                'foto' => null,
                'judul_prestasi' => 'Juara 2 National Environmental Sanitation & Green Technology Challenge',
                'nama_mahasiswa' => 'Budi Prasetyo & Dian Lestari',
                'nim' => '231055203019',
                'prodi' => 'S1 Kesehatan Lingkungan',
                'tingkat' => 'Nasional',
                'peringkat' => 'Juara 2 (Medali Perak)',
                'penyelenggara' => 'Himpunan Ahli Kesehatan Lingkungan Indonesia (HAKLI)',
                'tahun' => '2025',
                'deskripsi' => 'Rancang bangun prototipe fitoremediasi air limbah cair medis rumah sakit dengan eceng gondok teraktivasi karbon mikro.',
                'is_active' => true,
                'urutan' => 3,
            ],
        ];

        foreach ($data as $item) {
            Prestasi::updateOrCreate(
                ['judul_prestasi' => $item['judul_prestasi']],
                $item
            );
        }
    }
}
