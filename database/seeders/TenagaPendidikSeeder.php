<?php

namespace Database\Seeders;

use App\Models\Layanan;
use App\Models\TenagaPendidik;
use Illuminate\Database\Seeder;

class TenagaPendidikSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Layanan::count() === 0) {
            $this->call(LayananSeeder::class);
        }

        $prodis = Layanan::orderBy('urutan')->get();

        // Cari prodi berdasarkan kata kunci
        $prodiK3     = $prodis->first(fn($p) => str_contains(strtolower($p->judul), 'keselamatan') || str_contains(strtolower($p->judul), 'k3'));
        $prodiKesmas = $prodis->first(fn($p) => str_contains(strtolower($p->judul), 'masyarakat') || str_contains(strtolower($p->judul), 'magister'));
        $prodiKesling= $prodis->first(fn($p) => str_contains(strtolower($p->judul), 'lingkungan'));

        $items = [
            [
                'nama'        => 'Dosen Bidang K3',
                'bidang'      => 'Spesialis Ergonomi & SMK3',
                'keterangan'  => 'Ahli K3 Umum & Auditor ISO 45001 Kemnaker RI.',
                'layanan_id'  => $prodiK3?->id ?? null,
                'icon'        => 'bi-person-fill',
                'tombol_teks' => 'Lihat Dosen K3',
                'urutan'      => 1,
                'is_active'   => true,
            ],
            [
                'nama'        => 'Dosen Higiene Industri',
                'bidang'      => 'Toksikologi & Bahaya Fisik',
                'keterangan'  => 'Pengalaman 15+ tahun di industri manufaktur & galangan.',
                'layanan_id'  => $prodiKesmas?->id ?? null,
                'icon'        => 'bi-person-fill',
                'tombol_teks' => 'Lihat Dosen Kesmas',
                'urutan'      => 2,
                'is_active'   => true,
            ],
            [
                'nama'        => 'Dosen Kesehatan Lingkungan',
                'bidang'      => 'AMDAL & Pengolahan Limbah B3',
                'keterangan'  => 'Konsultan AMDAL bersertifikasi & Penilai KLHK.',
                'layanan_id'  => $prodiKesling?->id ?? null,
                'icon'        => 'bi-person-fill',
                'tombol_teks' => 'Lihat Dosen Kesling',
                'urutan'      => 3,
                'is_active'   => true,
            ],
        ];

        foreach ($items as $item) {
            TenagaPendidik::updateOrCreate(
                ['nama' => $item['nama']],
                $item
            );
        }
    }
}
