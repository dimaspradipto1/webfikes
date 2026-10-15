<?php

namespace Database\Seeders;

use App\Models\Testimonial;
use Illuminate\Database\Seeder;

class TestimonialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testimonial::truncate();

        $testimonials = [
            [
                'nama' => 'Ns. Siti Nurhaliza, S.Kep',
                'pekerjaan' => 'Alumni Keperawatan (Perawat di RSUD)',
                'kategori' => 'Alumni',
                'bintang' => 5,
                'pesan' => 'Kuliah di FIKES memberikan pengalaman klinis yang luar biasa. Laboratorium OSCE dan simulasi gawat daruratnya sangat mirip dengan kondisi rumah sakit nyata.',
                'aktif' => true,
            ],
            [
                'nama' => 'Bdn. Dewi Anggraini, S.Tr.Keb',
                'pekerjaan' => 'Bidan Praktik Mandiri',
                'kategori' => 'Alumni',
                'bintang' => 5,
                'pesan' => 'Dosen-dosen di FIKES sangat membimbing dan penuh dedikasi. Bekal ilmu kebidanan dan etika profesi yang ditanamkan sangat membantu saya dalam melayani ibu dan anak.',
                'aktif' => true,
            ],
            [
                'nama' => 'apt. Rizky Pratama, S.Farm',
                'pekerjaan' => 'Apoteker di Industri Farmasi Nasional',
                'kategori' => 'Alumni',
                'bintang' => 5,
                'pesan' => 'Kurikulum Farmasi FIKES sangat up-to-date dengan kebutuhan industri dan riset bahan alam. Praktikum laboratorium yang intensif memudahkan adaptasi di dunia kerja.',
                'aktif' => true,
            ],
            [
                'nama' => 'dr. Hendra Wijaya, Sp.PD',
                'pekerjaan' => 'Direktur Pelayanan Medis RS Mitra',
                'kategori' => 'Mitra Rumah Sakit',
                'bintang' => 5,
                'pesan' => 'Lulusan FIKES memiliki etos kerja yang tinggi, terampil secara klinis, dan selalu mengedepankan empati caring kepada pasien. Sangat kami rekomendasikan.',
                'aktif' => true,
            ],
            [
                'nama' => 'Muhammad Fajar',
                'pekerjaan' => 'Mahasiswa Tingkat Akhir Kesehatan Masyarakat',
                'kategori' => 'Mahasiswa',
                'bintang' => 5,
                'pesan' => 'Program Pengalaman Belajar Lapangan (PBL) FIKES sangat seru dan mengasah kemampuan analisis epidemiologi serta advokasi kesehatan di tengah masyarakat.',
                'aktif' => true,
            ],
        ];

        foreach ($testimonials as $t) {
            Testimonial::create($t);
        }
    }
}
