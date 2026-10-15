<?php

namespace App\Http\Controllers;

use App\DataTables\BannerDataTable;
use App\Http\Requests\BannerRequest;
use App\Models\Banner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class BannerController extends Controller
{
    /**
     * Tampilkan daftar banner via DataTables.
     */
    public function index(BannerDataTable $dataTables)
    {
        return $dataTables->render('pages.banner.index');
    }

    /**
     * Tampilkan form tambah banner.
     */
    public function create(): View
    {
        return view('pages.banner.create');
    }

    /**
     * Simpan banner baru ke storage dan database.
     */
    public function store(BannerRequest $request): RedirectResponse
    {
        $path = $request->file('foto')->store('banners', 'public');

        Banner::create([
            'judul' => $request->judul,
            'url' => $path,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif') ? true : false,
        ]);

        alert()->success('Berhasil!', 'Banner berhasil ditambahkan.');

        return redirect()->route('banner.index');
    }

    /**
     * Tampilkan form edit banner.
     */
    public function edit(Banner $banner): View
    {
        return view('pages.banner.edit', compact('banner'));
    }

    /**
     * Update data banner.
     */
    public function update(BannerRequest $request, Banner $banner): RedirectResponse
    {
        $data = [
            'judul' => $request->judul,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif') ? true : false,
        ];

        if ($request->hasFile('foto')) {
            // Hapus foto lama dari storage jika ada
            if ($banner->url && Storage::disk('public')->exists($banner->url)) {
                Storage::disk('public')->delete($banner->url);
            }
            // Simpan foto baru
            $data['url'] = $request->file('foto')->store('banners', 'public');
        }

        $banner->update($data);

        alert()->success('Berhasil!', 'Banner berhasil diperbarui.');

        return redirect()->route('banner.index');
    }

    /**
     * Hapus banner dari storage dan database.
     */
    public function destroy(Banner $banner): RedirectResponse
    {
        if ($banner->url && Storage::disk('public')->exists($banner->url)) {
            Storage::disk('public')->delete($banner->url);
        }

        $banner->delete();

        alert()->success('Berhasil!', 'Banner berhasil dihapus.');

        return redirect()->route('banner.index');
    }
}
