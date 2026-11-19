<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Partner::truncate();

        $partners = [
            'RSUD Umum Daerah' => null,
            'RSUP Dr. Cipto Mangunkusumo' => null,
            'RS Siloam Hospitals' => null,
            'RS Awal Bros' => null,
            'RS Hermina Group' => null,
            'Kimia Farma Apotek' => null,
            'Kalbe Farma' => null,
            'Dinas Kesehatan Provinsi' => null,
            'Palang Merah Indonesia' => null,
            'Puskesmas Pembina' => null,
        ];

        $index = 0;
        foreach ($partners as $nama => $logo) {
            $index++;
            Partner::create([
                'nama' => $nama,
                'logo' => $logo,
                'urutan' => $index,
                'aktif' => true,
            ]);
        }
    }
}
