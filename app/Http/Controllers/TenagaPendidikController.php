<?php

namespace App\Http\Controllers;

use App\DataTables\TenagaPendidikDataTable;
use App\Http\Requests\TenagaPendidikRequest;
use App\Models\Layanan;
use App\Models\TenagaPendidik;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TenagaPendidikController extends Controller
{
    /**
     * Tampilkan daftar Tenaga Pendidik via DataTables.
     */
    public function index(TenagaPendidikDataTable $dataTables)
    {
        return $dataTables->render('pages.tenaga-pendidik.index');
    }

    /**
     * Tampilkan form tambah Tenaga Pendidik.
     */
    public function create(): View
    {
        $prodis = Layanan::where('aktif', true)->orderBy('urutan')->get();

        return view('pages.tenaga-pendidik.create', compact('prodis'));
    }

    /**
     * Simpan data Tenaga Pendidik baru.
     */
    public function store(TenagaPendidikRequest $request): RedirectResponse
    {
        $data = [
            'layanan_id' => $request->layanan_id ?: null,
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'keterangan' => $request->keterangan,
            'icon' => $request->icon ?: 'bi-person-fill',
            'link' => $request->link,
            'tombol_teks' => $request->tombol_teks ?: 'Lihat Dosen Prodi',
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('tenaga-pendidik', 'public');
        }

        TenagaPendidik::create($data);

        alert()->success('Berhasil!', 'Data Tenaga Pendidik berhasil ditambahkan.');

        return redirect()->route('tenaga-pendidik.index');
    }

    /**
     * Tampilkan form edit Tenaga Pendidik.
     */
    public function edit(TenagaPendidik $tenagaPendidik): View
    {
        $prodis = Layanan::where('aktif', true)->orderBy('urutan')->get();

        return view('pages.tenaga-pendidik.edit', compact('tenagaPendidik', 'prodis'));
    }

    /**
     * Update data Tenaga Pendidik.
     */
    public function update(TenagaPendidikRequest $request, TenagaPendidik $tenagaPendidik): RedirectResponse
    {
        $data = [
            'layanan_id' => $request->layanan_id ?: null,
            'nama' => $request->nama,
            'bidang' => $request->bidang,
            'keterangan' => $request->keterangan,
            'icon' => $request->icon ?: 'bi-person-fill',
            'link' => $request->link,
            'tombol_teks' => $request->tombol_teks ?: 'Lihat Dosen Prodi',
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ];

        if ($request->hasFile('foto')) {
            if ($tenagaPendidik->foto && Storage::disk('public')->exists($tenagaPendidik->foto)) {
                Storage::disk('public')->delete($tenagaPendidik->foto);
            }
            $data['foto'] = $request->file('foto')->store('tenaga-pendidik', 'public');
        }

        $tenagaPendidik->update($data);

        alert()->success('Berhasil!', 'Data Tenaga Pendidik berhasil diperbarui.');

        return redirect()->route('tenaga-pendidik.index');
    }

    /**
     * Hapus data Tenaga Pendidik.
     */
    public function destroy(TenagaPendidik $tenagaPendidik): RedirectResponse
    {
        if ($tenagaPendidik->foto && Storage::disk('public')->exists($tenagaPendidik->foto)) {
            Storage::disk('public')->delete($tenagaPendidik->foto);
        }

        $tenagaPendidik->delete();

        alert()->success('Berhasil!', 'Data Tenaga Pendidik berhasil dihapus.');

        return redirect()->route('tenaga-pendidik.index');
    }
}
