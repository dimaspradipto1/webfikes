<?php

namespace App\Http\Controllers;

use App\DataTables\NewsDataTable;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;

class NewsController extends Controller
{
    public function index(NewsDataTable $dataTable)
    {
        return $dataTable->render('pages.news.index');
    }

    public function create(): View
    {
        return view('pages.news.create');
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $this->processThumbnail($request->file('thumbnail'));
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $photo) {
                $galleryPaths[] = $photo->store('news/gallery', 'public');
            }
        }

        $publishedAt = $request->filled('published_at')
            ? \Illuminate\Support\Carbon::parse($request->published_at)
            : now();

        News::create([
            'user_id'      => Auth::id(),
            'thumbnail'    => $thumbnailPath,
            'gallery'      => !empty($galleryPaths) ? $galleryPaths : null,
            'title'        => $request->title,
            'description'  => $request->description,
            'content'      => $request->content,
            'status'       => $request->status,
            'category'     => $request->category,
            'is_featured'  => $request->boolean('is_featured'),
            'published_at' => $publishedAt,
        ]);

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita berhasil diterbitkan.');
    }

    public function edit(News $news): View
    {
        if (Auth::user()->hasExactRole('penulis') && !Auth::user()->isAdmin() && $news->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda hanya dapat mengedit berita yang Anda buat sendiri.');
        }

        return view('pages.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        if (Auth::user()->hasExactRole('penulis') && !Auth::user()->isAdmin() && $news->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda hanya dapat memperbarui berita yang Anda buat sendiri.');
        }

        $thumbnailPath = $news->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $thumbnailPath = $this->processThumbnail($request->file('thumbnail'));
        }

        $currentGallery = is_array($news->gallery) ? $news->gallery : [];

        // Hapus gambar yang dicentang hapus
        if ($request->filled('delete_gallery_images')) {
            $deleteList = (array) $request->input('delete_gallery_images');
            foreach ($deleteList as $delPath) {
                if (Storage::disk('public')->exists($delPath)) {
                    Storage::disk('public')->delete($delPath);
                }
                $currentGallery = array_values(array_filter($currentGallery, fn ($item) => $item !== $delPath));
            }
        }

        // Tambah gambar baru jika diupload
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $photo) {
                $currentGallery[] = $photo->store('news/gallery', 'public');
            }
        }

        $publishedAt = $request->filled('published_at')
            ? \Illuminate\Support\Carbon::parse($request->published_at)
            : ($news->published_at ?? $news->created_at ?? now());

        $news->update([
            'thumbnail'    => $thumbnailPath,
            'gallery'      => !empty($currentGallery) ? array_values($currentGallery) : null,
            'title'        => $request->title,
            'description'  => $request->description,
            'content'      => $request->content,
            'status'       => $request->status,
            'category'     => $request->category,
            'is_featured'  => $request->boolean('is_featured'),
            'published_at' => $publishedAt,
        ]);

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita dan galeri berhasil diperbarui.');
    }

    public function destroy(News $news): RedirectResponse
    {
        if (Auth::user()->hasExactRole('penulis') && !Auth::user()->isAdmin() && $news->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda hanya dapat menghapus berita yang Anda buat sendiri.');
        }

        if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
            Storage::disk('public')->delete($news->thumbnail);
        }

        if (is_array($news->gallery)) {
            foreach ($news->gallery as $imgPath) {
                if (Storage::disk('public')->exists($imgPath)) {
                    Storage::disk('public')->delete($imgPath);
                }
            }
        }

        // Hapus juga file gambar konten TinyMCE jika tersimpan di local storage
        if (!empty($news->content)) {
            preg_match_all('/src="[^"]*\/storage\/(news\/content\/[^"]+)"/i', $news->content, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $contentImg) {
                    if (Storage::disk('public')->exists($contentImg)) {
                        Storage::disk('public')->delete($contentImg);
                    }
                }
            }
        }

        $news->delete();

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita dan file gambar terkait berhasil dihapus.');
    }

    public function uploadImage(Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:2048',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('news/content', 'public');
            return response()->json([
                'location' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'Gagal mengunggah gambar'], 400);
    }

    /**
     * Kompresi dan optimasi thumbnail berita (Maks 1200px lebar, <300KB)
     * agar preview WhatsApp dan medsos tampil kartu besar (Large Banner di atas).
     */
    private function processThumbnail($file): string
    {
        $filename = 'news/' . Str::random(40) . '.jpg';
        $fullTarget = storage_path('app/public/' . $filename);

        if (!is_dir(dirname($fullTarget))) {
            mkdir(dirname($fullTarget), 0755, true);
        }

        if (extension_loaded('gd')) {
            $srcPath = $file->getRealPath();
            $info = @getimagesize($srcPath);

            if ($info && in_array($info['mime'], ['image/jpeg', 'image/png', 'image/webp'])) {
                $origW = $info[0];
                $origH = $info[1];

                $srcImg = match ($info['mime']) {
                    'image/jpeg' => @imagecreatefromjpeg($srcPath),
                    'image/png'  => @imagecreatefrompng($srcPath),
                    'image/webp' => @imagecreatefromwebp($srcPath),
                    default      => null,
                };

                if ($srcImg) {
                    // Maksimal lebar 1200px (standar OpenGraph 1200x630)
                    $targetW = min(1200, $origW);
                    $targetH = (int) round(($origH / $origW) * $targetW);

                    $dstImg = imagecreatetruecolor($targetW, $targetH);
                    $white = imagecolorallocate($dstImg, 255, 255, 255);
                    imagefill($dstImg, 0, 0, $white);

                    imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $targetW, $targetH, $origW, $origH);
                    imagejpeg($dstImg, $fullTarget, 82);

                    imagedestroy($srcImg);
                    imagedestroy($dstImg);

                    return $filename;
                }
            }
        }

        return $file->store('news', 'public');
    }

    /**
     * Download Format Template Excel untuk Impor Berita / Post
     */
    public function downloadTemplate(): StreamedResponse
    {
        $spreadsheet = new Spreadsheet();

        // -------------------------------------------------------------
        // SHEET 1: DATA BERITA (Hanya memuat tabel input data & contoh)
        // -------------------------------------------------------------
        $sheetData = $spreadsheet->getActiveSheet();
        $sheetData->setTitle('Data Berita');

        // Header Kolom Sesuai Database & news/create
        $headers = [
            'A1' => 'No',
            'B1' => 'Judul Berita *',
            'C1' => 'Kategori *',
            'D1' => 'Status *',
            'E1' => 'Artikel Unggulan',
            'F1' => 'Deskripsi Singkat *',
            'G1' => 'Konten Berita *',
            'H1' => 'Thumbnail (Boleh Dikosongkan)',
        ];

        foreach ($headers as $cell => $text) {
            $sheetData->setCellValue($cell, $text);
        }

        // Header Styling (Hijau UIS #046B26 dengan teks putih tebal)
        $headerStyle = [
            'font' => [
                'bold'  => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size'  => 11,
            ],
            'fill' => [
                'fillType'   => Fill::FILL_SOLID,
                'startColor' => ['rgb' => '046B26'],
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'vertical'   => Alignment::VERTICAL_CENTER,
                'wrapText'   => true,
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color'       => ['rgb' => '023814'],
                ],
            ],
        ];
        $sheetData->getStyle('A1:H1')->applyFromArray($headerStyle);
        $sheetData->getRowDimension(1)->setRowHeight(32);

        // Data Contoh Sesuai Form news/create (2 Baris Contoh)
        $sampleData = [
            [
                1,
                'Mahasiswa UIS Berhasil Meraih Juara 1 Kompetisi Inovasi Nasional 2026',
                'Berita Universitas',
                'published',
                'Ya',
                'Prestasi membanggakan kembali ditorehkan mahasiswa Universitas Ibnu Sina dalam kompetisi inovasi tingkat nasional.',
                '<p>Universitas Ibnu Sina kembali menorehkan prestasi gemilang di tingkat nasional. Tim mahasiswa berhasil meraih juara pertama setelah menyisihkan puluhan kampus lainnya dalam ajang inovasi teknologi terapan...</p>',
                '', // Kosong (gambar boleh dikosongkan)
            ],
            [
                2,
                'Pelatihan dan Simulasi Penerapan Manajemen K3 di Laboratorium Terpadu',
                'K3 & Lingkungan Industri',
                'published',
                'Tidak',
                'Peningkatan standar keselamatan dan kesehatan kerja lingkungan laboratorium bagi sivitas akademika UIS.',
                '<p>Fakultas menyelenggarakan workshop praktis mengenai keselamatan dan kesehatan kerja di lingkungan kampus untuk menjamin kenyamanan dan standar operasional laboratorium...</p>',
                '', // Kosong (gambar boleh dikosongkan)
            ],
        ];

        $rowNum = 2;
        foreach ($sampleData as $row) {
            $sheetData->setCellValue('A' . $rowNum, $row[0]);
            $sheetData->setCellValue('B' . $rowNum, $row[1]);
            $sheetData->setCellValue('C' . $rowNum, $row[2]);
            $sheetData->setCellValue('D' . $rowNum, $row[3]);
            $sheetData->setCellValue('E' . $rowNum, $row[4]);
            $sheetData->setCellValue('F' . $rowNum, $row[5]);
            $sheetData->setCellValue('G' . $rowNum, $row[6]);
            $sheetData->setCellValue('H' . $rowNum, $row[7]);

            // Styling baris data
            $sheetData->getStyle("A{$rowNum}:H{$rowNum}")->applyFromArray([
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => Border::BORDER_THIN,
                        'color'       => ['rgb' => 'D0D5DD'],
                    ],
                ],
                'alignment' => [
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ]);
            $sheetData->getStyle("A{$rowNum}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheetData->getStyle("C{$rowNum}:E{$rowNum}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            $sheetData->getRowDimension($rowNum)->setRowHeight(28);
            $rowNum++;
        }

        // Lebar kolom yang proporsional
        $sheetData->getColumnDimension('A')->setWidth(8);
        $sheetData->getColumnDimension('B')->setWidth(45);
        $sheetData->getColumnDimension('C')->setWidth(28);
        $sheetData->getColumnDimension('D')->setWidth(16);
        $sheetData->getColumnDimension('E')->setWidth(20);
        $sheetData->getColumnDimension('F')->setWidth(45);
        $sheetData->getColumnDimension('G')->setWidth(55);
        $sheetData->getColumnDimension('H')->setWidth(32);

        // -------------------------------------------------------------
        // SHEET 2: PETUNJUK & PANDUAN (Terpisah agar data bersih)
        // -------------------------------------------------------------
        $sheetGuide = $spreadsheet->createSheet();
        $sheetGuide->setTitle('Petunjuk & Panduan');

        $sheetGuide->setCellValue('A1', 'PANDUAN & PETUNJUK PENGISIAN IMPORT BERITA UIS');
        $sheetGuide->getStyle('A1')->getFont()->setBold(true)->setSize(14)->getColor()->setRGB('046B26');
        $sheetGuide->getRowDimension(1)->setRowHeight(26);

        $sheetGuide->setCellValue('A2', '* Sheet ini hanya sebagai panduan referensi pengisian data dan tidak akan diimpor ke sistem.');
        $sheetGuide->getStyle('A2')->getFont()->setItalic(true)->setSize(10)->getColor()->setRGB('777777');

        $guideData = [
            ['No', 'Nama Kolom', 'Keterangan & Aturan Pengisian'],
            ['1', 'Judul Berita *', 'WAJIB diisi. Maksimal 250 karakter. Judul berita yang informatif dan menarik.'],
            ['2', 'Kategori *', 'WAJIB diisi salah satu dari: "Berita Universitas", "Berita Humas", "Akademik & Kemahasiswaan", "Teknologi & Rekayasa", "Bisnis & Manajemen", "K3 & Lingkungan Industri", "Penelitian & Riset", "Pengabdian Masyarakat", "Kerjasama Industri", atau "Pengumuman & Agenda".'],
            ['3', 'Status *', 'WAJIB diisi. Pilihan: "published" (langsung tampil ke publik) atau "draft" (disimpan sebagai draf).'],
            ['4', 'Artikel Unggulan', 'Pilihan: "Ya" (ditampilkan di banner sorotan utama) atau "Tidak". Default: Tidak.'],
            ['5', 'Deskripsi Singkat *', 'WAJIB diisi ringkasan/kutipan berita (maks 1000 karakter). Jika kosong, sistem otomatis mengambil cuplikan dari Konten Berita.'],
            ['6', 'Konten Berita *', 'WAJIB diisi isi lengkap artikel. Boleh teks biasa maupun format paragraf HTML (<p>...</p>).'],
            ['7', 'Thumbnail', 'OPSIONAL / BOLEH DIKOSONGKAN. Jika dikosongkan, berita akan menggunakan logo/ikon bawaan UIS. Anda dapat mengunggah cover foto kemudian melalui menu Edit Berita.'],
        ];

        $gRow = 4;
        foreach ($guideData as $idx => $r) {
            $sheetGuide->setCellValue("A{$gRow}", $r[0]);
            $sheetGuide->setCellValue("B{$gRow}", $r[1]);
            $sheetGuide->setCellValue("C{$gRow}", $r[2]);

            if ($idx === 0) {
                $sheetGuide->getStyle("A{$gRow}:C{$gRow}")->applyFromArray([
                    'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                    'fill' => ['fillType' => Fill::FILL_SOLID, 'startColor' => ['rgb' => '03521d']],
                    'alignment' => ['horizontal' => Alignment::HORIZONTAL_CENTER, 'vertical' => Alignment::VERTICAL_CENTER],
                ]);
                $sheetGuide->getRowDimension($gRow)->setRowHeight(26);
            } else {
                $sheetGuide->getStyle("A{$gRow}:C{$gRow}")->applyFromArray([
                    'borders' => ['allBorders' => ['borderStyle' => Border::BORDER_THIN, 'color' => ['rgb' => 'D0D5DD']]],
                    'alignment' => ['vertical' => Alignment::VERTICAL_CENTER],
                ]);
                $sheetGuide->getStyle("A{$gRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheetGuide->getRowDimension($gRow)->setRowHeight(24);
            }
            $gRow++;
        }

        $sheetGuide->getColumnDimension('A')->setWidth(8);
        $sheetGuide->getColumnDimension('B')->setWidth(26);
        $sheetGuide->getColumnDimension('C')->setWidth(80);

        // Pastikan Sheet 1 (Data Berita) yang aktif saat dibuka
        $spreadsheet->setActiveSheetIndex(0);

        $fileName = 'Template_Import_Post_Berita_UIS.xlsx';

        return response()->streamDownload(function () use ($spreadsheet) {
            $writer = new Xlsx($spreadsheet);
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type'  => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Cache-Control' => 'max-age=0',
        ]);
    }

    /**
     * Import Data Berita dari File Excel / CSV
     */
    public function importExcel(Request $request): RedirectResponse
    {
        $request->validate([
            'file_excel' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'],
        ], [
            'file_excel.required' => 'Silakan pilih file Excel / CSV yang akan diimpor.',
            'file_excel.mimes'    => 'Format file harus berupa .xlsx, .xls, atau .csv.',
            'file_excel.max'      => 'Ukuran file maksimal 10MB.',
        ]);

        try {
            $file = $request->file('file_excel');
            $spreadsheet = IOFactory::load($file->getRealPath());

            // Selalu ambil Sheet Pertama (Data Berita), abaikan sheet petunjuk/panduan
            $sheet = $spreadsheet->getSheet(0);
            $rows = $sheet->toArray(null, true, true, true);

            if (count($rows) <= 1) {
                return redirect()
                    ->route('news.index')
                    ->with('error', 'File Excel kosong atau tidak memiliki data.');
            }

            $validCategories = [
                'Berita Universitas',
                'Berita Humas',
                'Akademik & Kemahasiswaan',
                'Teknologi & Rekayasa',
                'Bisnis & Manajemen',
                'K3 & Lingkungan Industri',
                'Penelitian & Riset',
                'Pengabdian Masyarakat',
                'Kerjasama Industri',
                'Pengumuman & Agenda',
            ];

            $importedCount = 0;
            $currentUserId = Auth::id() ?? 1;

            foreach ($rows as $index => $row) {
                if ($index === 1) {
                    continue; // Lewati baris judul header
                }

                $colA  = trim((string) ($row['A'] ?? ''));
                $title = trim((string) ($row['B'] ?? ''));

                // Jika judul kosong, lewati
                if ($title === '') {
                    continue;
                }

                // -------------------------------------------------------------
                // Filter ketat: Petunjuk pengisian TIDAK BOLEH dihitung/diimpor!
                // Hentikan proses jika mencapai teks petunjuk atau instruksi.
                // -------------------------------------------------------------
                if (
                    str_starts_with(strtoupper($title), 'PETUNJUK') ||
                    str_starts_with(strtoupper($title), 'CATATAN') ||
                    str_starts_with(strtoupper($title), 'PANDUAN') ||
                    preg_match('/^\d+\.\s*(Kolom|Anda|Petunjuk|Format|Kategori|Status|Gambar)/i', $title) ||
                    stripos($title, 'WAJIB diisi') !== false ||
                    stripos($title, 'Kolom Kategori dapat diisi') !== false ||
                    stripos($title, 'Kolom Status dapat diisi') !== false ||
                    stripos($title, 'Kolom Artikel Unggulan') !== false ||
                    stripos($title, 'Kolom Thumbnail') !== false
                ) {
                    break; // Berhenti seketika, jangan proses petunjuk sebagai berita!
                }

                // Jika kolom No bukan angka dan kolom Kategori serta Status kosong, lewati baris catatan
                if (!is_numeric($colA) && empty($row['C']) && empty($row['D'])) {
                    continue;
                }

                // Pengaman panjang judul (maksimal 250 karakter)
                if (mb_strlen($title) > 250) {
                    $title = mb_substr($title, 0, 250);
                }

                $rawCategory = trim((string) ($row['C'] ?? ''));
                $rawStatus   = strtolower(trim((string) ($row['D'] ?? '')));
                $rawFeatured = strtolower(trim((string) ($row['E'] ?? '')));
                $description = trim((string) ($row['F'] ?? ''));
                $content     = trim((string) ($row['G'] ?? ''));
                $thumbnail   = trim((string) ($row['H'] ?? ''));

                // Pencocokan kategori dari opsi news/create
                $category = 'Berita Universitas';
                if (!empty($rawCategory)) {
                    foreach ($validCategories as $validCat) {
                        if (strcasecmp($validCat, $rawCategory) === 0 || stripos($validCat, $rawCategory) !== false || stripos($rawCategory, $validCat) !== false) {
                            $category = $validCat;
                            break;
                        }
                    }
                }

                // Status: 'published' atau 'draft'
                $status = (str_contains($rawStatus, 'draft')) ? 'draft' : 'published';

                // Featured / Artikel Unggulan
                $isFeatured = in_array($rawFeatured, ['ya', 'y', '1', 'true', 'yes'], true);

                // Konten & Deskripsi Singkat Fallback
                if (empty($content) && !empty($description)) {
                    $content = '<p>' . nl2br(e($description)) . '</p>';
                } elseif (!empty($content) && !str_starts_with($content, '<')) {
                    $content = '<p>' . nl2br(e($content)) . '</p>';
                }

                if (empty($description)) {
                    $description = Str::limit(strip_tags($content ?: $title), 200);
                }

                if (mb_strlen($description) > 1000) {
                    $description = mb_substr($description, 0, 1000);
                }

                if (empty($content)) {
                    $content = '<p>' . e($title) . '</p>';
                }

                // Thumbnail: Gambar boleh dikosongkan (default null)
                $thumbnailPath = null;
                if (!empty($thumbnail) && Storage::disk('public')->exists($thumbnail)) {
                    $thumbnailPath = $thumbnail;
                }

                News::create([
                    'user_id'     => $currentUserId,
                    'thumbnail'   => $thumbnailPath,
                    'gallery'     => null,
                    'title'       => $title,
                    'description' => $description,
                    'content'     => $content,
                    'status'      => $status,
                    'category'    => $category,
                    'is_featured' => $isFeatured,
                ]);

                $importedCount++;
            }

            if ($importedCount === 0) {
                return redirect()
                    ->route('news.index')
                    ->with('error', 'Tidak ada data berita yang valid untuk diimpor. Pastikan kolom judul berita sudah terisi.');
            }

            return redirect()
                ->route('news.index')
                ->with('success', "Proses impor selesai! Sebanyak {$importedCount} data berita berhasil diimpor ke database.");

        } catch (\Exception $e) {
            return redirect()
                ->route('news.index')
                ->with('error', 'Terjadi kesalahan saat memproses file Excel: ' . $e->getMessage());
        }
    }
}
