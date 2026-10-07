<?php

namespace App\Http\Controllers;

use App\DataTables\SocialMediaDataTable;
use App\Models\SocialMedia;
use App\Models\SocialMediaSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SocialMediaController extends Controller
{
    /**
     * Tampilkan data media sosial dan setting header seksi.
     */
    public function index(SocialMediaDataTable $dataTable)
    {
        $setting = SocialMediaSetting::firstOrCreate(
            ['id' => 1],
            [
                'judul_seksi'    => 'IKUTI UIS DI MEDIA SOSIAL',
                'subjudul_seksi' => '"Dapatkan update terbaru, berita inspiratif, dan berbagai informasi menarik lainnya langsung dari platform media sosial kami. Jangan lewatkan momen penting dari UIS klik ikon di bawah untuk terhubung sekarang juga!"',
            ]
        );

        return $dataTable->render('pages.social-media.index', compact('setting'));
    }

    /**
     * Update pengaturan Judul & Subjudul Header Seksi Media Sosial.
     */
    public function updateSetting(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'judul_seksi'    => ['required', 'string', 'max:255'],
            'subjudul_seksi' => ['required', 'string'],
        ], [
            'judul_seksi.required'    => 'Judul Seksi wajib diisi.',
            'subjudul_seksi.required' => 'Subjudul / Kalimat Deskripsi wajib diisi.',
        ]);

        $setting = SocialMediaSetting::firstOrCreate(['id' => 1]);
        $setting->update($validated);

        alert()->success('Berhasil!', 'Pengaturan Seksi Media Sosial berhasil diperbarui.');

        return redirect()->route('social-media.index');
    }

    /**
     * Tampilkan form tambah media sosial baru.
     */
    public function create(): View
    {
        $nextUrutan = (SocialMedia::max('urutan') ?? 0) + 1;
        return view('pages.social-media.create', compact('nextUrutan'));
    }

    /**
     * Simpan media sosial baru dengan upload PNG logo.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama'      => ['required', 'string', 'max:255'],
            'logo'      => ['required', 'file', 'mimes:png,webp,svg,jpg,jpeg', 'max:2048'],
            'url'       => ['required', 'string', 'max:500'],
            'urutan'    => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'nama.required' => 'Nama media sosial wajib diisi.',
            'logo.required' => 'File Logo PNG wajib diunggah.',
            'logo.mimes'    => 'Logo harus berformat gambar PNG (atau webp/svg).',
            'logo.max'      => 'Ukuran file logo maksimal 2MB.',
            'url.required'  => 'URL / Link media sosial wajib diisi.',
        ]);

        $url = trim($validated['url']);
        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://') && !str_starts_with($url, '/') && !str_starts_with($url, '#')) {
            $url = 'https://' . $url;
        }

        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('social-media', 'public');
        }

        SocialMedia::create([
            'nama'      => $validated['nama'],
            'logo'      => $logoPath,
            'icon'      => null,
            'url'       => $url,
            'urutan'    => $validated['urutan'] ?? ((SocialMedia::max('urutan') ?? 0) + 1),
            'is_active' => $request->has('is_active') ? true : false,
        ]);

        alert()->success('Berhasil!', 'Link Media Sosial baru berhasil ditambahkan.');

        return redirect()->route('social-media.index');
    }

    /**
     * Tampilkan form edit media sosial.
     */
    public function edit(SocialMedia $socialMedia): View
    {
        return view('pages.social-media.edit', compact('socialMedia'));
    }

    /**
     * Update media sosial yang ada (termasuk upload logo baru jika ada).
     */
    public function update(Request $request, SocialMedia $socialMedia): RedirectResponse
    {
        $validated = $request->validate([
            'nama'      => ['required', 'string', 'max:255'],
            'logo'      => ['nullable', 'file', 'mimes:png,webp,svg,jpg,jpeg', 'max:2048'],
            'url'       => ['required', 'string', 'max:500'],
            'urutan'    => ['nullable', 'integer', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ], [
            'nama.required' => 'Nama media sosial wajib diisi.',
            'logo.mimes'    => 'Logo harus berformat gambar PNG (atau webp/svg).',
            'logo.max'      => 'Ukuran file logo maksimal 2MB.',
            'url.required'  => 'URL / Link media sosial wajib diisi.',
        ]);

        $url = trim($validated['url']);
        if (!str_starts_with($url, 'http://') && !str_starts_with($url, 'https://') && !str_starts_with($url, '/') && !str_starts_with($url, '#')) {
            $url = 'https://' . $url;
        }

        $data = [
            'nama'      => $validated['nama'],
            'url'       => $url,
            'urutan'    => $validated['urutan'] ?? $socialMedia->urutan,
            'is_active' => $request->has('is_active') ? true : false,
        ];

        if ($request->hasFile('logo')) {
            // Hapus file logo lama jika ada
            if ($socialMedia->logo && Storage::disk('public')->exists($socialMedia->logo)) {
                Storage::disk('public')->delete($socialMedia->logo);
            }
            $data['logo'] = $request->file('logo')->store('social-media', 'public');
        }

        $socialMedia->update($data);

        alert()->success('Berhasil!', 'Data Link Media Sosial berhasil diperbarui.');

        return redirect()->route('social-media.index');
    }

    /**
     * Hapus media sosial beserta file logo jika ada.
     */
    public function destroy(SocialMedia $socialMedia): RedirectResponse
    {
        if ($socialMedia->logo && Storage::disk('public')->exists($socialMedia->logo)) {
            Storage::disk('public')->delete($socialMedia->logo);
        }

        $socialMedia->delete();

        alert()->success('Berhasil!', 'Link Media Sosial berhasil dihapus.');

        return redirect()->route('social-media.index');
    }
}
