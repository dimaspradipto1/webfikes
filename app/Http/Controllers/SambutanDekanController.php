<?php

namespace App\Http\Controllers;

use App\Models\SambutanDekan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class SambutanDekanController extends Controller
{
    public function index(): View
    {
        $sambutanDekan = SambutanDekan::firstOrCreate([], [
            'nama_dekan'      => 'Dr. Apt. H. Dekan FIKES, M.Kes',
            'jabatan_dekan'   => 'Dekan Fakultas Ilmu Kesehatan UIS',
            'kutipan_singkat' => 'Selamat datang di Fakultas Ilmu Kesehatan Universitas Ibnu Sina. Kami bertekad membentuk generasi tenaga kesehatan yang tidak hanya unggul secara akademis dan terampil dalam praktik industri, namun juga memiliki integritas moral dan etika luhur dalam mengabdi kepada bangsa.',
        ]);

        return view('pages.sambutan-dekan.index', compact('sambutanDekan'));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_dekan'      => ['nullable', 'string', 'max:255'],
            'jabatan_dekan'   => ['nullable', 'string', 'max:255'],
            'foto_dekan'      => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'max:2048'],
            'kutipan_singkat' => ['nullable', 'string'],
            'sambutan_dekan'  => ['nullable', 'string'],
        ], [
            'foto_dekan.image' => 'File harus berupa gambar.',
            'foto_dekan.mimes' => 'Format gambar yang diperbolehkan: JPEG, PNG, JPG, WEBP.',
            'foto_dekan.max'   => 'Ukuran foto maksimal 2 MB.',
        ]);

        $sambutanDekan = SambutanDekan::firstOrCreate([]);

        if ($request->hasFile('foto_dekan')) {
            // Hapus foto lama jika ada
            if ($sambutanDekan->foto_dekan && Storage::disk('public')->exists($sambutanDekan->foto_dekan)) {
                Storage::disk('public')->delete($sambutanDekan->foto_dekan);
            }
            $validated['foto_dekan'] = $request->file('foto_dekan')->store('dekan', 'public');
        }

        $sambutanDekan->update($validated);

        return redirect()
            ->route('sambutan-dekan.index')
            ->with('success', 'Data Sambutan Dekan & Foto berhasil diperbarui.');
    }
}
