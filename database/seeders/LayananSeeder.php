<?php

namespace Database\Seeders;

use App\Models\Layanan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayananSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Layanan::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $layanans = [
            [
                'icon' => 'bi-mortarboard-fill',
                'judul' => 'Program Magister (S2) Kesehatan Masyarakat',
                'dasar_hukum' => 'SK LAM-PTKes & Kemendikbudristek',
                'link' => null,
                'deskripsi' => 'Program Magister Kesehatan Masyarakat (M.Kes) yang fokus pada kepemimpinan strategis kesehatan publik, epidemiologi lanjutan, manajemen kebijakan kesehatan, dan advokasi kesehatan kerja.',
                'rincian' => "Kurikulum terakreditasi berbasis riset terapan & kebijakan publik\nPeminatan: Manajemen Pelayanan Kesehatan, K3 Lanjut, & Epidemiologi\nBimbingan tesis oleh profesor dan doktor berpengalaman internasional\nJadwal kuliah fleksibel (Kelas Reguler & Kelas Eksekutif/Karyawan)",
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'icon' => 'bi-shield-plus',
                'judul' => 'Program Sarjana (S1) Kesehatan dan Keselamatan Kerja',
                'dasar_hukum' => 'SK LAM-PTKes & Kemendikbudristek',
                'link' => null,
                'deskripsi' => 'Menghasilkan sarjana K3 (S.K.K.K/S.Kes) yang kompeten dalam identifikasi bahaya, manajemen risiko, higiene industri, ergonomi, dan implementasi SMK3 PP 50/2012 serta ISO 45001.',
                'rincian' => "Kurikulum selaras standar sertifikasi Ahli K3 Umum & Higiene Industri\nPraktik lapangan di sektor migas, galangan kapal, dan manufaktur Batam\nLaboratorium pengukuran faktor fisik, kimia, dan ergonomi kerja\nJaminan Surat Keterangan Pendamping Ijazah (SKPI) sertifikasi BNSP",
                'urutan' => 2,
                'aktif' => true,
            ],
            [
                'icon' => 'bi-tree-fill',
                'judul' => 'Program Sarjana (S1) Kesehatan Lingkungan',
                'dasar_hukum' => 'SK LAM-PTKes & Kemendikbudristek',
                'link' => null,
                'deskripsi' => 'Mendidik sarjana kesehatan lingkungan (S.Ling/S.Kes) yang ahli dalam analisis dampak lingkungan (AMDAL), pengelolaan limbah B3 industri, pengolahan air bersih, dan sanitasi rumah sakit.',
                'rincian' => "Keahlian penyusunan dokumen AMDAL, UKL-UPL, dan audit lingkungan\nLaboratorium mikrobiologi kualitas air, udara, tanah, dan vektor penyakit\nMagang di instalasi sanitasi rumah sakit tipe A/B dan kawasan industri\nPeluang kerja luas di KLHK, Dinas Lingkungan Hidup, RS, dan industri",
                'urutan' => 3,
                'aktif' => true,
            ],
        ];

        foreach ($layanans as $l) {
            Layanan::create($l);
        }
    }
}
