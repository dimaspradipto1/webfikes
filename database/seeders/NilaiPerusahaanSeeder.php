<?php

namespace Database\Seeders;

use App\Models\NilaiPerusahaan;
use Illuminate\Database\Seeder;

class NilaiPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        NilaiPerusahaan::truncate();

        $data = [
            [
                'icon' => 'bi-shield-fill-check',
                'judul' => 'Integritas',
                'deskripsi' => 'Menjunjung tinggi etika profesi, kejujuran akademik, dan moralitas dalam setiap tindakan dan riset.',
                'urutan' => 1,
            ],
            [
                'icon' => 'bi-award-fill',
                'judul' => 'Keunggulan',
                'deskripsi' => 'Berkomitmen menghasilkan lulusan berdaya saing tinggi dengan standar kompetensi profesional terbaik.',
                'urutan' => 2,
            ],
            [
                'icon' => 'bi-heart-fill',
                'judul' => 'Humanis',
                'deskripsi' => 'Mengutamakan empati, kepedulian tulus, dan pelayanan penuh kasih dalam pengabdian kesehatan.',
                'urutan' => 3,
            ],
            [
                'icon' => 'bi-lightning-charge-fill',
                'judul' => 'Inovatif',
                'deskripsi' => 'Mendorong pemikiran kritis dan pemanfaatan teknologi mutakhir dalam pengembangan ilmu kesehatan.',
                'urutan' => 4,
            ],
        ];

        foreach ($data as $item) {
            NilaiPerusahaan::create($item);
        }
    }
}
