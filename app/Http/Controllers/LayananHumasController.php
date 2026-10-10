<?php

namespace App\Http\Controllers;

use App\Models\LayananHumasItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class LayananHumasController extends Controller
{
    /**
     * Tampilkan overview semua 8 menu Layanan Humas.
     */
    public function index(): View
    {
        $items = LayananHumasItem::orderBy('urutan')->get();
        return view('pages.layanan-humas.index', compact('items'));
    }

    /**
     * Form edit item Layanan Humas spesifik.
     */
    public function editItem(string $kode): View
    {
        $item = LayananHumasItem::where('kode', $kode)->firstOrFail();
        $permintaanRilisSetting = null;
        $pendampinganAcaraSetting = null;

        if ($kode === 'permintaan-rilis') {
            $permintaanRilisSetting = \App\Models\PermintaanRilisSetting::firstOrCreate(['id' => 1]);
        } elseif ($kode === 'pendampingan-acara') {
            $pendampinganAcaraSetting = \App\Models\PendampinganAcaraSetting::firstOrCreate(['id' => 1]);
        }

        return view('pages.layanan-humas.edit', compact('item', 'permintaanRilisSetting', 'pendampinganAcaraSetting'));
    }

    /**
     * Simpan pembaruan item Layanan Humas.
     */
    public function updateItem(Request $request, string $kode): RedirectResponse
    {
        $item = LayananHumasItem::where('kode', $kode)->firstOrFail();

        $validated = $request->validate([
            'nama'              => ['required', 'string', 'max:100'],
            'badge_text'        => ['nullable', 'string', 'max:50'],
            'deskripsi'         => ['nullable', 'string'],
            'icon'              => ['nullable', 'string', 'max:50'],
            'url'               => ['nullable', 'string', 'max:1000'],
            'file'              => ['nullable', 'file', 'max:20480'], // max 20MB
            'target_blank'      => ['nullable'],
            'is_active'         => ['nullable'],

            // Pengaturan Khusus Halaman
            'judul_seksi'       => ['nullable', 'string', 'max:255'],
            'deskripsi_seksi'   => ['nullable', 'string'],
            'link_form'         => ['nullable', 'string', 'max:1000'],
            'no_wa'             => ['nullable', 'string', 'max:50'],
            'email_tujuan'      => ['nullable', 'string', 'max:100'],
            'min_kata'          => ['nullable', 'integer', 'min:50'],
            'min_paragraf'      => ['nullable', 'integer', 'min:1'],
            'catatan_tambahan'  => ['nullable', 'string'],

            // Khusus Pendampingan Acara
            'sapaan'            => ['nullable', 'string', 'max:255'],
            'konten'            => ['nullable', 'string'],
            'paragraf_1'        => ['nullable', 'string'],
            'paragraf_2'        => ['nullable', 'string'],
            'poin_bantuan'      => ['nullable', 'string'],
            'paragraf_3'        => ['nullable', 'string'],
            'tombol_teks'       => ['nullable', 'string', 'max:100'],
        ], [
            'nama.required' => 'Nama layanan wajib diisi.',
            'file.max'      => 'Ukuran file maksimal 20 MB.',
        ]);

        $url = trim($validated['url'] ?? ($validated['link_form'] ?? ''));
        if (!empty($url) && !str_starts_with($url, 'http://') && !str_starts_with($url, 'https://') && !str_starts_with($url, '/') && !str_starts_with($url, '#')) {
            $url = 'https://' . $url;
        }

        $data = [
            'nama'         => $validated['nama'],
            'badge_text'   => $validated['badge_text'] ?? null,
            'deskripsi'    => $request->input('deskripsi', $item->deskripsi),
            'icon'         => $validated['icon'] ?? $item->icon,
            'url'          => !empty($url) ? $url : null,
            'target_blank' => $request->has('target_blank'),
            'is_active'    => $request->has('is_active'),
        ];

        // Opsi hapus file lama jika dicentang
        if ($request->has('hapus_file') && $item->file_path) {
            if (Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            $data['file_path'] = null;
        }

        // Upload file baru
        if ($request->hasFile('file')) {
            if ($item->file_path && Storage::disk('public')->exists($item->file_path)) {
                Storage::disk('public')->delete($item->file_path);
            }
            $data['file_path'] = $request->file('file')->store('layanan-humas', 'public');
        }

        $item->update($data);

        // Update pengaturan khusus jika kode adalah permintaan-rilis
        if ($kode === 'permintaan-rilis') {
            $setting = \App\Models\PermintaanRilisSetting::firstOrCreate(['id' => 1]);
            $settingData = [
                'judul_seksi'      => $validated['judul_seksi'] ?? $setting->judul_seksi,
                'deskripsi_seksi'  => $request->input('deskripsi_seksi', $setting->deskripsi_seksi),
                'link_form'        => !empty($url) ? $url : $setting->link_form,
                'no_wa'            => $validated['no_wa'] ?? $setting->no_wa,
                'email_tujuan'     => $validated['email_tujuan'] ?? $setting->email_tujuan,
                'min_kata'         => $validated['min_kata'] ?? $setting->min_kata,
                'min_paragraf'     => $validated['min_paragraf'] ?? $setting->min_paragraf,
                'catatan_tambahan' => $request->input('catatan_tambahan', $setting->catatan_tambahan),
            ];
            if (isset($data['file_path'])) {
                $settingData['file_sop'] = $data['file_path'];
            } elseif ($request->has('hapus_file')) {
                $settingData['file_sop'] = null;
            }
            $setting->update($settingData);
        }

        // Update pengaturan khusus jika kode adalah pendampingan-acara
        if ($kode === 'pendampingan-acara') {
            $setting = \App\Models\PendampinganAcaraSetting::firstOrCreate(['id' => 1]);
            $settingData = [
                'judul_seksi'  => $validated['judul_seksi'] ?? $setting->judul_seksi,
                'sapaan'       => $validated['sapaan'] ?? $setting->sapaan,
                'konten'       => $request->input('konten', $setting->konten),
                'link_form'    => !empty($url) ? $url : $setting->link_form,
                'tombol_teks'  => $validated['tombol_teks'] ?? $setting->tombol_teks,
                'no_wa'        => $validated['no_wa'] ?? $setting->no_wa,
            ];
            if (isset($data['file_path'])) {
                $settingData['file_sop'] = $data['file_path'];
            } elseif ($request->has('hapus_file')) {
                $settingData['file_sop'] = null;
            }
            $setting->update($settingData);
        }

        alert()->success('Berhasil!', 'Pengaturan layanan "' . $item->nama . '" berhasil diperbarui.');

        return redirect()->route('layanan-humas.edit-item', $item->kode);
    }
}
