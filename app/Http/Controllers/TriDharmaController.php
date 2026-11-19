<?php

namespace App\Http\Controllers;

use App\DataTables\TriDharmaDataTable;
use App\Http\Requests\TriDharmaRequest;
use App\Models\TriDharma;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TriDharmaController extends Controller
{
    /**
     * Tampilkan daftar Tri Dharma via DataTables.
     */
    public function index(TriDharmaDataTable $dataTables)
    {
        return $dataTables->render('pages.tridharma.index');
    }

    /**
     * Tampilkan form tambah item Tri Dharma.
     */
    public function create(): View
    {
        return view('pages.tridharma.create');
    }

    /**
     * Simpan data item Tri Dharma baru.
     */
    public function store(TriDharmaRequest $request): RedirectResponse
    {
        TriDharma::create([
            'icon' => $request->icon,
            'warna' => $request->warna ?? '#823ca2',
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        alert()->success('Berhasil!', 'Item Tri Dharma berhasil ditambahkan.');

        return redirect()->route('tridharma.index');
    }

    /**
     * Tampilkan form edit item Tri Dharma.
     */
    public function edit(TriDharma $tridharma): View
    {
        return view('pages.tridharma.edit', compact('tridharma'));
    }

    /**
     * Update data item Tri Dharma.
     */
    public function update(TriDharmaRequest $request, TriDharma $tridharma): RedirectResponse
    {
        $tridharma->update([
            'icon' => $request->icon,
            'warna' => $request->warna ?? '#823ca2',
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        alert()->success('Berhasil!', 'Item Tri Dharma berhasil diperbarui.');

        return redirect()->route('tridharma.index');
    }

    /**
     * Hapus data item Tri Dharma.
     */
    public function destroy(TriDharma $tridharma): RedirectResponse
    {
        $tridharma->delete();

        alert()->success('Berhasil!', 'Item Tri Dharma berhasil dihapus.');

        return redirect()->route('tridharma.index');
    }
}
