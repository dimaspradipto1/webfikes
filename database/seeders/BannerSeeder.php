<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Banner::truncate();

        $banners = [
            [
                'judul' => 'Mewujudkan Tenaga Kesehatan Unggul, Profesional & Berintegritas',
                'url' => 'banners/U5BsPjmGmPRWbcUG2FlnoBQjlHIYIksdUPwZYi2W.png',
                'urutan' => 1,
                'aktif' => true,
            ],
            [
                'judul' => 'Fasilitas Laboratorium Modern & Kerjasama Rumah Sakit Terpadu',
                'url' => 'banners/xWH57UmSDG5rm40tdAeLBk7Jor3IIGSJwhdG1oYK.png',
                'urutan' => 2,
                'aktif' => true,
            ],
        ];

        foreach ($banners as $b) {
            Banner::create($b);
        }
    }
}
