<?php

namespace Database\Seeders;

use App\Models\VisiMisi;
use Illuminate\Database\Seeder;

class VisiMisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        VisiMisi::truncate();

        $data = [
            [
                'tipe' => 'visi',
                'isi' => 'Menjadi Fakultas Ilmu Kesehatan yang unggul, terkemuka, dan berdaya saing global dalam penyelenggaraan Tri Dharma Perguruan Tinggi di bidang ilmu kesehatan yang berlandaskan nilai integritas dan kemanusiaan.',
                'urutan' => 1,
            ],
            [
                'tipe' => 'misi',
                'isi' => 'Menyelenggarakan pendidikan akademik dan profesi kesehatan yang berkualitas dan berstandar nasional/internasional.',
                'urutan' => 1,
            ],
            [
                'tipe' => 'misi',
                'isi' => 'Mengembangkan penelitian terapan dan inovatif di bidang ilmu kesehatan yang bermanfaat bagi masyarakat.',
                'urutan' => 2,
            ],
            [
                'tipe' => 'misi',
                'isi' => 'Melaksanakan pengabdian kepada masyarakat secara berkelanjutan demi meningkatkan derajat kesehatan publik.',
                'urutan' => 3,
            ],
            [
                'tipe' => 'misi',
                'isi' => 'Menjalin kerjasama strategis dengan institusi pelayanan kesehatan, rumah sakit, dan mitra global.',
                'urutan' => 4,
            ],
        ];

        foreach ($data as $item) {
            VisiMisi::create($item);
        }
    }
}
