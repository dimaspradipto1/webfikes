<?php

namespace App\Services;

use App\Models\Dosen;
use App\Models\Layanan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class DosenExcelService
{
    /**
     * Generate and stream download Excel template for importing lecturer (Dosen) data.
     */
    public function downloadTemplate(): StreamedResponse
    {
        $spreadsheet = new Spreadsheet;
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Template Dosen FIKES');

        $headers = [
            'A1' => 'No',
            'B1' => 'Nama Lengkap & Gelar Dosen *',
            'C1' => 'Program Studi *',
            'D1' => 'Jabatan Fungsional',
            'E1' => 'NIDN',
            'F1' => 'NUPTK',
            'G1' => 'Link Profil (PDDIKTI / SINTA / GScholar)',
        ];

        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '823CA2'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical' => Alignment::VERTICAL_CENTER,
                'wrapText' => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => '5A2475'],
                ],
            ],
        ];
        $sheet->getStyle('A1:G1')->applyFromArray($headerStyle);
        $sheet->getRowDimension(1)->setRowHeight(32);

        $prodis = Layanan::where('aktif', true)->pluck('judul')->toArray();
        $prodi1 = $prodis[0] ?? 'S1 Kesehatan dan Keselamatan Kerja';
        $prodi2 = $prodis[1] ?? 'S1 Kesehatan Lingkungan';
        $prodi3 = $prodis[2] ?? 'S2 Kesehatan Masyarakat';

        $sampleData = [
            [1, 'Dr. Hengky Oktarizal, S.KM., M.KM', $prodi1, 'Lektor Kepala', '1021088101', '7153759660110033', 'https://pddikti.kemdiktisaintek.go.id'],
            [2, 'Dr. Ir. Hendra Saputra, M.Si., M.Kes', $prodi2, 'Lektor Kepala', '1011037801', '6142756658110022', 'https://pddikti.kemdiktisaintek.go.id'],
            [3, 'Prof. Dr. dr. H. Syamsudin, M.Kes., FISPH', $prodi3, 'Guru Besar', '1004016501', '5132743645110011', 'https://pddikti.kemdiktisaintek.go.id'],
        ];

        $rowNum = 2;
        foreach ($sampleData as $row) {
            $sheet->setCellValue('A'.$rowNum, $row[0]);
            $sheet->setCellValue('B'.$rowNum, $row[1]);
            $sheet->setCellValue('C'.$rowNum, $row[2]);
            $sheet->setCellValue('D'.$rowNum, $row[3]);
            $sheet->setCellValueExplicit('E'.$rowNum, $row[4], DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('F'.$rowNum, $row[5], DataType::TYPE_STRING);
            $sheet->setCellValue('G'.$rowNum, $row[6]);

            $sheet->getStyle("A{$rowNum}:G{$rowNum}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color' => ['rgb' => 'D0D5DD'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);
            $sheet->getStyle("A{$rowNum}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle("E{$rowNum}:F{$rowNum}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheet->getRowDimension($rowNum)->setRowHeight(24);
            $rowNum++;
        }

        $sheet->getColumnDimension('A')->setWidth(8);
        $sheet->getColumnDimension('B')->setWidth(40);
        $sheet->getColumnDimension('C')->setWidth(38);
        $sheet->getColumnDimension('D')->setWidth(24);
        $sheet->getColumnDimension('E')->setWidth(20);
        $sheet->getColumnDimension('F')->setWidth(24);
        $sheet->getColumnDimension('G')->setWidth(45);

        $noteRow = $rowNum + 1;
        $sheet->setCellValue("B{$noteRow}", 'PETUNJUK PENGISIAN:');
        $sheet->getStyle("B{$noteRow}")->getFont()->setBold(true)->getColor()->setRGB('D32F2F');

        $notes = [
            '1. Kolom bertanda (*) Nama Lengkap & Gelar Dosen serta Program Studi WAJIB diisi.',
            "2. Kolom Program Studi dapat diisi dengan nama prodi yang ada di FIKES (contoh: {$prodi1}, {$prodi2}, {$prodi3}).",
            '3. Kolom Jabatan Fungsional dapat diisi: Tenaga Pengajar, Asisten Ahli, Lektor, Lektor Kepala, atau Guru Besar.',
            '4. Kolom NIDN, NUPTK, dan Link Profil bersifat opsional. Pastikan format angka NIDN/NUPTK tidak terpotong (disimpan sebagai teks).',
            '5. Anda dapat menghapus baris contoh sebelum mengunggah file hasil inputan.',
        ];

        foreach ($notes as $idx => $note) {
            $currRow = $noteRow + 1 + $idx;
            $sheet->setCellValue("B{$currRow}", $note);
            $sheet->getStyle("B{$currRow}")->getFont()->setSize(10)->getColor()->setRGB('555555');
        }

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, 'Template_Import_Dosen_FIKES.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Import lecturers data from uploaded spreadsheet file.
     *
     * @throws \Exception
     */
    public function importExcel(UploadedFile $file): int
    {
        $spreadsheet = IOFactory::load($file->getRealPath());
        $sheet = $spreadsheet->getActiveSheet();
        $rows = $sheet->toArray(null, true, true, true);

        if (count($rows) <= 1) {
            throw new \Exception('File Excel kosong atau tidak memiliki data.');
        }

        $allProdis = Layanan::all();

        return DB::transaction(function () use ($rows, $allProdis) {
            $importedCount = 0;

            foreach ($rows as $index => $row) {
                if ($index === 1) {
                    continue;
                }

                $namaDosen = trim($row['B'] ?? '');
                $namaProdi = trim($row['C'] ?? '');
                $jabatanFungsional = trim($row['D'] ?? '');
                $nidn = trim($row['E'] ?? '');
                $nuptk = trim($row['F'] ?? '');
                $link = trim($row['G'] ?? '');

                if (empty($namaDosen) || str_starts_with(strtoupper($namaDosen), 'PETUNJUK')) {
                    continue;
                }

                $matchedProdi = null;
                if (! empty($namaProdi)) {
                    $matchedProdi = $allProdis->first(function ($p) use ($namaProdi) {
                        return stripos($p->judul, $namaProdi) !== false || stripos($namaProdi, $p->judul) !== false;
                    });
                }

                Dosen::create([
                    'layanan_id' => $matchedProdi?->id,
                    'prodi_nama' => $matchedProdi?->judul ?? $namaProdi,
                    'nama_dosen' => $namaDosen,
                    'jabatan_fungsional' => $jabatanFungsional ?: null,
                    'nidn' => $nidn ?: null,
                    'nuptk' => $nuptk ?: null,
                    'link' => $link ?: null,
                    'is_active' => true,
                ]);

                $importedCount++;
            }

            return $importedCount;
        });
    }
}
