<?php

namespace Database\Seeders;

use App\Models\Dosen;
use App\Models\Layanan;
use Illuminate\Database\Seeder;

class DosenSeeder extends Seeder
{
    public function run(): void
    {
        Dosen::truncate();

        $prodiK3 = Layanan::where('judul', 'like', '%Kesehatan dan Keselamatan Kerja%')->first();
        $prodiKesling = Layanan::where('judul', 'like', '%Kesehatan Lingkungan%')->first();
        $prodiKesmas = Layanan::where('judul', 'like', '%Kesehatan Masyarakat%')->first();

        // 1. Dosen S1 K3
        $k3Dosens = [
            [
                'nama_dosen' => 'Dr. Hengky Oktarizal, S.KM., M.KM',
                'jabatan_fungsional' => 'Lektor Kepala',
                'nidn' => '1021088101',
                'nuptk' => '7153759660110033',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
            [
                'nama_dosen' => 'Dr. Ns. Ahmad Fauzi, M.Kep., Sp.Kep.Kom',
                'jabatan_fungsional' => 'Lektor',
                'nidn' => '1015048502',
                'nuptk' => '8244761662200042',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
            [
                'nama_dosen' => 'Rina Marlina, S.KM., M.Kes (K3)',
                'jabatan_fungsional' => 'Lektor',
                'nidn' => '1008068903',
                'nuptk' => '5339767668210013',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
            [
                'nama_dosen' => 'Budi Santoso, S.T., M.KKK',
                'jabatan_fungsional' => 'Asisten Ahli',
                'nidn' => '1012119101',
                'nuptk' => '4251769670220021',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
            [
                'nama_dosen' => 'Siti Rahmawati, S.KM., M.Sc',
                'jabatan_fungsional' => 'Tenaga Pengajar',
                'nidn' => '1023029302',
                'nuptk' => '3162771672230015',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
        ];

        foreach ($k3Dosens as $idx => $d) {
            Dosen::create([
                'layanan_id' => $prodiK3?->id,
                'prodi_nama' => 'S1 Kesehatan dan Keselamatan Kerja',
                'nama_dosen' => $d['nama_dosen'],
                'jabatan_fungsional' => $d['jabatan_fungsional'],
                'nidn' => $d['nidn'],
                'nuptk' => $d['nuptk'],
                'link' => $d['link'],
                'urutan' => $idx + 1,
                'is_active' => true,
            ]);
        }

        // 2. Dosen S1 Kesehatan Lingkungan
        $keslingDosens = [
            [
                'nama_dosen' => 'Dr. Ir. Hendra Saputra, M.Si., M.Kes',
                'jabatan_fungsional' => 'Lektor Kepala',
                'nidn' => '1011037801',
                'nuptk' => '6142756658110022',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
            [
                'nama_dosen' => 'Nurul Hidayah, S.Si., M.Ling',
                'jabatan_fungsional' => 'Lektor',
                'nidn' => '1027098602',
                'nuptk' => '7253764665200031',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
            [
                'nama_dosen' => 'Eko Prasetyo, S.KM., M.Kes (KL)',
                'jabatan_fungsional' => 'Asisten Ahli',
                'nidn' => '1019089003',
                'nuptk' => '8364768669210044',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
            [
                'nama_dosen' => 'Dewi Lestari, S.Si., M.Sc',
                'jabatan_fungsional' => 'Tenaga Pengajar',
                'nidn' => '1005129201',
                'nuptk' => '9475770671220053',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
        ];

        foreach ($keslingDosens as $idx => $d) {
            Dosen::create([
                'layanan_id' => $prodiKesling?->id,
                'prodi_nama' => 'S1 Kesehatan Lingkungan',
                'nama_dosen' => $d['nama_dosen'],
                'jabatan_fungsional' => $d['jabatan_fungsional'],
                'nidn' => $d['nidn'],
                'nuptk' => $d['nuptk'],
                'link' => $d['link'],
                'urutan' => $idx + 1,
                'is_active' => true,
            ]);
        }

        // 3. Dosen S2 Kesehatan Masyarakat
        $kesmasDosens = [
            [
                'nama_dosen' => 'Prof. Dr. dr. H. Syamsudin, M.Kes., FISPH',
                'jabatan_fungsional' => 'Guru Besar',
                'nidn' => '1004016501',
                'nuptk' => '5132743645110011',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
            [
                'nama_dosen' => 'Dr. Ratna Juwita, S.KM., M.Epid',
                'jabatan_fungsional' => 'Lektor Kepala',
                'nidn' => '1018077502',
                'nuptk' => '6243753654200022',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
            [
                'nama_dosen' => 'Dr. Wahyu Hidayat, S.KM., M.Kes',
                'jabatan_fungsional' => 'Lektor',
                'nidn' => '1022108203',
                'nuptk' => '7354760661210033',
                'link' => 'https://pddikti.kemdiktisaintek.go.id',
            ],
        ];

        foreach ($kesmasDosens as $idx => $d) {
            Dosen::create([
                'layanan_id' => $prodiKesmas?->id,
                'prodi_nama' => 'S2 Kesehatan Masyarakat',
                'nama_dosen' => $d['nama_dosen'],
                'jabatan_fungsional' => $d['jabatan_fungsional'],
                'nidn' => $d['nidn'],
                'nuptk' => $d['nuptk'],
                'link' => $d['link'],
                'urutan' => $idx + 1,
                'is_active' => true,
            ]);
        }
    }
}
