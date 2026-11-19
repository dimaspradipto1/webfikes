<?php

namespace Database\Seeders;

use App\Models\Contact;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Contact::truncate();

        Contact::create([
            'latitude' => '-6.200000',
            'longitude' => '106.816666',
            'map' => '<iframe src="https://www.google.com/maps?q=Fakultas+Ilmu+Kesehatan&output=embed" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>',
            'no_wa' => '6281234567890',
            'email' => 'info@fikes.ac.id',
            'alamat' => 'Gedung Fakultas Ilmu Kesehatan (FIKES), Kampus Terpadu, Indonesia',
        ]);
    }
}
