<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Faq::truncate();

        $faqs = [
            // Akademik & Program Studi
            [
                'question' => 'Apa saja program studi yang tersedia di Fakultas Ilmu Kesehatan (FIKES)?',
                'answer' => 'FIKES menyelenggarakan berbagai program studi unggulan seperti S1 Ilmu Keperawatan & Profesi Ners, Kebidanan (D3/S1 & Profesi), S1 Farmasi, S1 Ilmu Gizi, serta S1 Kesehatan Masyarakat.',
                'category' => 'akademik',
            ],
            [
                'question' => 'Bagaimana status akreditasi program studi di FIKES?',
                'answer' => 'Seluruh program studi di FIKES telah terakreditasi oleh Lembaga Akreditasi Mandiri Pendidikan Tinggi Kesehatan Indonesia (LAM-PTKes) dan Badan Akreditasi Nasional Perguruan Tinggi (BAN-PT).',
                'category' => 'akademik',
            ],
            [
                'question' => 'Apakah lulusan FIKES langsung mendapatkan gelar profesi?',
                'answer' => 'Untuk program studi yang memiliki jenjang profesi (seperti Keperawatan Ners dan Bidan), mahasiswa dapat melanjutkan ke tahap pendidikan profesi setelah menyelesaikan tahap sarjana untuk memperoleh Surat Tanda Registrasi (STR).',
                'category' => 'akademik',
            ],

            // Pendaftaran & Penerimaan Mahasiswa Baru
            [
                'question' => 'Bagaimana alur pendaftaran mahasiswa baru di FIKES?',
                'answer' => 'Pendaftaran dapat dilakukan secara online melalui portal resmi PMB atau datang langsung ke sekretariat pendaftaran FIKES dengan membawa berkas persyaratan akademik dan kesehatan.',
                'category' => 'pendaftaran',
            ],
            [
                'question' => 'Apakah ada tes kesehatan khusus dalam seleksi masuk FIKES?',
                'answer' => 'Ya, calon mahasiswa wajib mengikuti pemeriksaan kesehatan (seperti tes bebas buta warna untuk program studi tertentu, bebas narkoba, dan pemeriksaan fisik dasar) demi memastikan kesiapan praktek klinik.',
                'category' => 'pendaftaran',
            ],
            [
                'question' => 'Apakah tersedia program beasiswa di FIKES?',
                'answer' => 'Tersedia berbagai pilihan beasiswa, antara lain KIP-Kuliah, Beasiswa Prestasi Akademik/Non-Akademik, Beasiswa Yayasan, dan Beasiswa Kemitraan Instansi.',
                'category' => 'pendaftaran',
            ],

            // Fasilitas & Praktek Kerja
            [
                'question' => 'Di mana saja mahasiswa FIKES melaksanakan praktek klinik / lapangan?',
                'answer' => 'Mahasiswa melaksanakan praktek di rumah sakit pendidikan tipe A & B, RSUD, RS swasta terakreditasi paripurna, Puskesmas, laboratorium klinik, dan industri farmasi mitra resmi FIKES.',
                'category' => 'fasilitas',
            ],
            [
                'question' => 'Fasilitas laboratorium apa saja yang disediakan di kampus FIKES?',
                'answer' => 'Kampus menyediakan Laboratorium Keterampilan Medis (OSCE Center), Mini Hospital, Laboratorium Farmakologi & Kimia, Laboratorium Dietetika & Pangan, serta Laboratorium Simulasi Kebidanan.',
                'category' => 'fasilitas',
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create($faq);
        }
    }
}
