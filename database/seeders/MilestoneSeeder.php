<?php

namespace Database\Seeders;

use App\Models\Milestone;
use Illuminate\Database\Seeder;

class MilestoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Catatan: tahun & isi di bawah masih placeholder generik karena histori resmi
     * perusahaan belum tersedia. Silakan sesuaikan lewat menu admin Milestone.
     */
    public function run(): void
    {
        $milestones = [
            [
                'tahun' => 2016,
                'judul' => 'Pendirian Perusahaan',
                'deskripsi' => 'PT Berkarya Jasa Inspeksi didirikan untuk melayani kebutuhan Riksa Uji K3, kalibrasi, dan sertifikasi teknis di wilayah Kepulauan Riau.',
            ],
            [
                'tahun' => 2019,
                'judul' => 'Perluasan Layanan',
                'deskripsi' => 'Menambah cakupan layanan meliputi Riksa Uji Pesawat Angkat & Angkut, Pesawat Tenaga Produksi, hingga Bejana Tekan dan Tangki Timbun.',
            ],
            [
                'tahun' => 2022,
                'judul' => 'Sertifikasi PJK3 Kemnaker',
                'deskripsi' => 'Memperoleh pengakuan sebagai Perusahaan Jasa Keselamatan dan Kesehatan Kerja (PJK3) resmi terdaftar Kementerian Ketenagakerjaan.',
            ],
            [
                'tahun' => 2026,
                'judul' => 'Ekspansi Klien Industri',
                'deskripsi' => 'Melayani klien dari berbagai sektor industri — migas, manufaktur, perkebunan, kesehatan, hingga konstruksi — di seluruh Indonesia.',
            ],
        ];

        foreach ($milestones as $item) {
            Milestone::create($item);
        }
    }
}
