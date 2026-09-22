<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\AboutSeeder;
use Database\Seeders\BannerSeeder;
use Database\Seeders\ContactSeeder;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\GallerySeeder;
use Database\Seeders\LayananSeeder;
use Database\Seeders\MilestoneSeeder;
use Database\Seeders\SaranaSeeder;
use Database\Seeders\NilaiPerusahaanSeeder;
use Database\Seeders\PartnerSeeder;
use Database\Seeders\StrukturOrganisasiSeeder;
use Database\Seeders\TestimonialSeeder;
use Database\Seeders\VisiMisiSeeder;
use Database\Seeders\FacultyStatSeeder;
use Database\Seeders\TriDharmaSeeder;
use Database\Seeders\TenagaPendidikSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            FaqSeeder::class,
            AboutSeeder::class,
            VisiMisiSeeder::class,
            NilaiPerusahaanSeeder::class,
            MilestoneSeeder::class,
            ContactSeeder::class,
            BannerSeeder::class,
            FeatureSeeder::class,
            SaranaSeeder::class,
            TriDharmaSeeder::class,
            LayananSeeder::class,
            TenagaPendidikSeeder::class,
            GallerySeeder::class,
            FacultyStatSeeder::class,
            StrukturOrganisasiSeeder::class,
            PartnerSeeder::class,
            TestimonialSeeder::class,
            LayananTerkaitSeeder::class,
        ]);
    }
}
