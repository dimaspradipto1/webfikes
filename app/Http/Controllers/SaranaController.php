<?php

namespace App\Http\Controllers;

use App\DataTables\SaranaDataTable;
use App\Http\Requests\SaranaRequest;
use App\Models\Sarana;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SaranaController extends Controller
{
    /**
     * Tampilkan daftar sarana via DataTables.
     */
    public function index(SaranaDataTable $dataTables)
    {
        return $dataTables->render('pages.sarana.index');
    }

    /**
     * Tampilkan form tambah sarana.
     */
    public function create(): View
    {
        return view('pages.sarana.create');
    }

    /**
     * Simpan data sarana baru.
     */
    public function store(SaranaRequest $request): RedirectResponse
    {
        Sarana::create([
            'icon' => $request->icon,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        alert()->success('Berhasil!', 'Sarana berhasil ditambahkan.');

        return redirect()->route('sarana.index');
    }

    /**
     * Tampilkan form edit sarana.
     */
    public function edit(Sarana $sarana): View
    {
        return view('pages.sarana.edit', compact('sarana'));
    }

    /**
     * Update data sarana.
     */
    public function update(SaranaRequest $request, Sarana $sarana): RedirectResponse
    {
        $sarana->update([
            'icon' => $request->icon,
            'nama' => $request->nama,
            'deskripsi' => $request->deskripsi,
            'urutan' => $request->urutan ?? 0,
            'is_active' => $request->boolean('is_active', true),
        ]);

        alert()->success('Berhasil!', 'Sarana berhasil diperbarui.');

        return redirect()->route('sarana.index');
    }

    /**
     * Hapus data sarana.
     */
    public function destroy(Sarana $sarana): RedirectResponse
    {
        $sarana->delete();

        alert()->success('Berhasil!', 'Sarana berhasil dihapus.');

        return redirect()->route('sarana.index');
    }
}
