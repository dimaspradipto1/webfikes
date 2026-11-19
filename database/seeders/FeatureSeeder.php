<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Seeder;

class FeatureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Feature::truncate();

        $features = [
            [
                'icon' => 'bi-patch-check-fill',
                'judul' => 'Akreditasi Unggul',
                'deskripsi' => 'Program studi telah terakreditasi oleh LAM-PTKes dan BAN-PT dengan jaminan mutu pendidikan tinggi kesehatan berstandar nasional.',
                'urutan' => 1,
            ],
            [
                'icon' => 'bi-hospital-fill',
                'judul' => 'Laboratorium Terpadu Modern',
                'deskripsi' => 'Dilengkapi laboratorium klinik, simulasi keperawatan, kebidanan, dan farmasi dengan alat praktikum medis terkini.',
                'urutan' => 2,
            ],
            [
                'icon' => 'bi-mortarboard-fill',
                'judul' => 'Dosen Ahli & Berpengalaman',
                'deskripsi' => 'Tenaga pengajar berkualifikasi magister dan doktor bidang kesehatan yang aktif dalam riset, publikasi, dan praktik klinis.',
                'urutan' => 3,
            ],
            [
                'icon' => 'bi-diagram-3-fill',
                'judul' => 'Jejaring Rumah Sakit Luas',
                'deskripsi' => 'Kemitraan strategis dengan rumah sakit umum, rumah sakit swasta, dan dinas kesehatan untuk praktik klinik dan karir alumni.',
                'urutan' => 4,
            ],
        ];

        foreach ($features as $f) {
            Feature::create($f);
        }
    }
}
