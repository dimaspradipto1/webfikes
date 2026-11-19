<?php

namespace Database\Seeders;

use App\Models\Kurikulum;
use App\Models\Layanan;
use Illuminate\Database\Seeder;

class KurikulumSeeder extends Seeder
{
    public function run(): void
    {
        Kurikulum::truncate();

        // Cari prodi
        $prodiK3 = Layanan::where('judul', 'like', '%Kesehatan dan Keselamatan Kerja%')->first();
        $prodiKesling = Layanan::where('judul', 'like', '%Kesehatan Lingkungan%')->first();
        $prodiKesmas = Layanan::where('judul', 'like', '%Kesehatan Masyarakat%')->first();

        // 1. S1 K3 (Kesehatan dan Keselamatan Kerja)
        $k3Courses = [
            // Semester 1
            ['semester' => 1, 'kode_mk' => '1MBTF1301', 'nama_mk' => 'Pendidikan Agama & Etika Profesi', 'sks' => 2, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1MBTF1102', 'nama_mk' => 'Pendidikan Pancasila & Kewarganegaraan', 'sks' => 2, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1MBIS1201', 'nama_mk' => 'Bahasa Indonesia & Penulisan Ilmiah', 'sks' => 2, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1MBIS1202', 'nama_mk' => 'Dasar-Dasar Kesehatan Masyarakat', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1MBIS1203', 'nama_mk' => 'Pengantar Keselamatan & Kesehatan Kerja (K3)', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1MBIS1204', 'nama_mk' => 'Anatomi & Fisiologi Manusia', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1MBIS1305', 'nama_mk' => 'Biostatistik Deskriptif', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1MBTF1303', 'nama_mk' => 'Bahasa Inggris Profesi Kesehatan', 'sks' => 2, 'kategori' => 'Wajib'],

            // Semester 2
            ['semester' => 2, 'kode_mk' => '2MBTF1307', 'nama_mk' => 'Higiene Industri & Toksikologi Lingkungan Kerja', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2MBTF1108', 'nama_mk' => 'Prak. Higiene Industri & Pengukuran Lingkungan', 'sks' => 1, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2MBTF1309', 'nama_mk' => 'Ergonomi Industri & Biomekanika Kerja', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2MBIS1207', 'nama_mk' => 'Epidemiologi Kesehatan Kerja', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2MBTF1310', 'nama_mk' => 'Sistem Manajemen K3 (SMK3 & ISO 45001)', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2MBTF1311', 'nama_mk' => 'Keselamatan Kerja di Sektor Manufaktur & Galangan', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2MBIS1208', 'nama_mk' => 'Hukum & Regulasi Ketenagakerjaan K3', 'sks' => 2, 'kategori' => 'Wajib'],

            // Semester 3
            ['semester' => 3, 'kode_mk' => '3MBTF1313', 'nama_mk' => 'Manajemen Risiko & Analisis Bahaya (HIRADC/JSA)', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 3, 'kode_mk' => '3MBTF1314', 'nama_mk' => 'Tanggap Darurat & Penanggulangan Kebakaran', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 3, 'kode_mk' => '3MBTF1315', 'nama_mk' => 'K3 Sektor Maritim, Offshore & Pelabuhan', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 3, 'kode_mk' => '3MBTF1316', 'nama_mk' => 'Investigasi & Analisis Kecelakaan Kerja', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 3, 'kode_mk' => '3MBTF1317', 'nama_mk' => 'Gizi Kerja & Promosi Kesehatan di Tempat Kerja', 'sks' => 2, 'kategori' => 'Wajib'],
            ['semester' => 3, 'kode_mk' => '3MBTF1318', 'nama_mk' => 'Psikologi Industri & Manajemen Stres Kerja', 'sks' => 2, 'kategori' => 'Wajib'],

            // Semester 4
            ['semester' => 4, 'kode_mk' => '4MBTF1319', 'nama_mk' => 'Auditing Sistem Manajemen K3 & Lingkungan', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 4, 'kode_mk' => '4MBTF1320', 'nama_mk' => 'K3 Konstruksi & Pekerjaan Ketinggian', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 4, 'kode_mk' => '4MBTF1321', 'nama_mk' => 'Pengolahan & Pengelolaan Limbah B3 Industri', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 4, 'kode_mk' => '4MBTF1322', 'nama_mk' => 'Metodologi Penelitian K3 & Kesmas', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 4, 'kode_mk' => '4MBTF1323', 'nama_mk' => 'Praktek Kerja Lapangan (PKL) Industri', 'sks' => 4, 'kategori' => 'Wajib'],
        ];

        foreach ($k3Courses as $idx => $c) {
            Kurikulum::create([
                'layanan_id' => $prodiK3?->id,
                'prodi_nama' => 'S1 Kesehatan dan Keselamatan Kerja',
                'kode_mk' => $c['kode_mk'],
                'nama_mk' => $c['nama_mk'],
                'semester' => $c['semester'],
                'sks' => $c['sks'],
                'kategori' => $c['kategori'],
                'urutan' => $idx + 1,
                'is_active' => true,
            ]);
        }

        // 2. S1 Kesehatan Lingkungan (Kesling)
        $keslingCourses = [
            // Semester 1
            ['semester' => 1, 'kode_mk' => '1KLIS1301', 'nama_mk' => 'Pendidikan Agama & Budi Pekerti', 'sks' => 2, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1KLIS1102', 'nama_mk' => 'Pancasila & Kewarganegaraan', 'sks' => 2, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1KLIS1201', 'nama_mk' => 'Pengantar Ilmu Kesehatan Lingkungan', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1KLIS1202', 'nama_mk' => 'Kimia Lingkungan & Laboratorium Air', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1KLIS1203', 'nama_mk' => 'Mikrobiologi Lingkungan Terapan', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1KLIS1305', 'nama_mk' => 'Ekologi & Pencemaran Lingkungan', 'sks' => 3, 'kategori' => 'Wajib'],

            // Semester 2
            ['semester' => 2, 'kode_mk' => '2KLIS1307', 'nama_mk' => 'Penyediaan & Pengolahan Air Bersih', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2KLIS1108', 'nama_mk' => 'Pengelolaan Air Limbah Domestik & Industri', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2KLIS1309', 'nama_mk' => 'Sanitasi Makanan, Minuman & HACCP', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2KLIS1207', 'nama_mk' => 'Pengendalian Vektor & Binatang Pembawa Penyakit', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2KLIS1310', 'nama_mk' => 'Kualitas Udara & Pengendalian Emisi', 'sks' => 3, 'kategori' => 'Wajib'],

            // Semester 3
            ['semester' => 3, 'kode_mk' => '3KLIS1313', 'nama_mk' => 'Analisis Mengenai Dampak Lingkungan (AMDAL)', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 3, 'kode_mk' => '3KLIS1314', 'nama_mk' => 'Sanitasi Rumah Sakit & Pengolahan Limbah Medis', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 3, 'kode_mk' => '3KLIS1315', 'nama_mk' => 'Pengelolaan Sampah Terpadu & 3R', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 3, 'kode_mk' => '3KLIS1316', 'nama_mk' => 'Toksikologi Lingkungan & Kesehatan Masyarakat', 'sks' => 3, 'kategori' => 'Wajib'],
        ];

        foreach ($keslingCourses as $idx => $c) {
            Kurikulum::create([
                'layanan_id' => $prodiKesling?->id,
                'prodi_nama' => 'S1 Kesehatan Lingkungan',
                'kode_mk' => $c['kode_mk'],
                'nama_mk' => $c['nama_mk'],
                'semester' => $c['semester'],
                'sks' => $c['sks'],
                'kategori' => $c['kategori'],
                'urutan' => $idx + 1,
                'is_active' => true,
            ]);
        }

        // 3. S2 Kesehatan Masyarakat
        $kesmasCourses = [
            // Semester 1
            ['semester' => 1, 'kode_mk' => '1KMIS2301', 'nama_mk' => 'Filsafat Ilmu & Etika Kebijakan Kesehatan', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1KMIS2302', 'nama_mk' => 'Epidemiologi Lanjut & Surveilans Kesehatan', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1KMIS2303', 'nama_mk' => 'Biostatistik Terapan & Manajemen Data Riset', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 1, 'kode_mk' => '1KMIS2304', 'nama_mk' => 'Manajemen Pelayanan Kesehatan & Rumah Sakit', 'sks' => 3, 'kategori' => 'Wajib'],

            // Semester 2
            ['semester' => 2, 'kode_mk' => '2KMIS2305', 'nama_mk' => 'Kebijakan, Hukum & Pembiayaan Kesehatan', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2KMIS2306', 'nama_mk' => 'Ekonomi Kesehatan & Asuransi Kesehatan Sosial', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2KMIS2307', 'nama_mk' => 'Metodologi Penelitian Lanjut & Penulisan Tesis', 'sks' => 3, 'kategori' => 'Wajib'],
            ['semester' => 2, 'kode_mk' => '2KMIS2308', 'nama_mk' => 'Manajemen K3 & Lingkungan Lanjut', 'sks' => 3, 'kategori' => 'Pilihan'],

            // Semester 3 & 4
            ['semester' => 3, 'kode_mk' => '3KMIS2309', 'nama_mk' => 'Seminar Proposal Tesis & Publikasi Jurnal Internasional', 'sks' => 2, 'kategori' => 'Wajib'],
            ['semester' => 4, 'kode_mk' => '4KMIS2610', 'nama_mk' => 'Tesis Magister Kesehatan Masyarakat', 'sks' => 6, 'kategori' => 'Wajib'],
        ];

        foreach ($kesmasCourses as $idx => $c) {
            Kurikulum::create([
                'layanan_id' => $prodiKesmas?->id,
                'prodi_nama' => 'S2 Kesehatan Masyarakat',
                'kode_mk' => $c['kode_mk'],
                'nama_mk' => $c['nama_mk'],
                'semester' => $c['semester'],
                'sks' => $c['sks'],
                'kategori' => $c['kategori'],
                'urutan' => $idx + 1,
                'is_active' => true,
            ]);
        }
    }
}
