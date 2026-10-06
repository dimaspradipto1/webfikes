<?php

namespace App\Http\Controllers;

use App\DataTables\FacultyStatDataTable;
use App\Models\FacultyStat;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class FacultyStatController extends Controller
{
    /**
     * Tampilkan daftar statistik fakultas via DataTables.
     */
    public function index(FacultyStatDataTable $dataTables)
    {
        return $dataTables->render('pages.faculty-stat.index');
    }

    /**
     * Tampilkan form tambah data statistik.
     */
    public function create(): View
    {
        return view('pages.faculty-stat.create');
    }

    /**
     * Simpan data statistik baru.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'image'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'jumlah_prodi'    => ['required', 'integer', 'min:0'],
            'total_mahasiswa' => ['required', 'integer', 'min:0'],
            'total_dosen'     => ['nullable', 'integer', 'min:0'],
            'total_alumni'    => ['required', 'integer', 'min:0'],
            'is_active'       => ['nullable', 'boolean'],
        ], [
            'title.required'           => 'Judul section wajib diisi.',
            'image.image'              => 'File harus berupa gambar.',
            'image.max'                => 'Ukuran gambar maksimal 2MB.',
            'jumlah_prodi.required'    => 'Jumlah Program Studi wajib diisi.',
            'total_mahasiswa.required' => 'Total Mahasiswa wajib diisi.',
            'total_alumni.required'    => 'Total Alumni wajib diisi.',
        ]);

        $data = [
            'title'           => $validated['title'],
            'jumlah_prodi'    => $validated['jumlah_prodi'],
            'total_mahasiswa' => $validated['total_mahasiswa'],
            'total_dosen'     => $validated['total_dosen'] ?? 0,
            'total_alumni'    => $validated['total_alumni'],
            'is_active'       => $request->has('is_active') ? true : false,
        ];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('faculty-stats', 'public');
        }

        FacultyStat::create($data);

        alert()->success('Berhasil!', 'Data statistik fakultas berhasil ditambahkan.');

        return redirect()->route('faculty-stat.index');
    }

    /**
     * Tampilkan form edit data statistik.
     */
    public function edit(FacultyStat $facultyStat): View
    {
        return view('pages.faculty-stat.edit', compact('facultyStat'));
    }

    /**
     * Update data statistik fakultas.
     */
    public function update(Request $request, FacultyStat $facultyStat): RedirectResponse
    {
        $validated = $request->validate([
            'title'           => ['required', 'string', 'max:255'],
            'image'           => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'jumlah_prodi'    => ['required', 'integer', 'min:0'],
            'total_mahasiswa' => ['required', 'integer', 'min:0'],
            'total_dosen'     => ['nullable', 'integer', 'min:0'],
            'total_alumni'    => ['required', 'integer', 'min:0'],
            'is_active'       => ['nullable', 'boolean'],
        ], [
            'title.required'           => 'Judul section wajib diisi.',
            'image.image'              => 'File harus berupa gambar.',
            'image.max'                => 'Ukuran gambar maksimal 2MB.',
            'jumlah_prodi.required'    => 'Jumlah Program Studi wajib diisi.',
            'total_mahasiswa.required' => 'Total Mahasiswa wajib diisi.',
            'total_alumni.required'    => 'Total Alumni wajib diisi.',
        ]);

        $data = [
            'title'           => $validated['title'],
            'jumlah_prodi'    => $validated['jumlah_prodi'],
            'total_mahasiswa' => $validated['total_mahasiswa'],
            'total_dosen'     => $validated['total_dosen'] ?? 0,
            'total_alumni'    => $validated['total_alumni'],
            'is_active'       => $request->has('is_active') ? true : false,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($facultyStat->image && Storage::disk('public')->exists($facultyStat->image)) {
                Storage::disk('public')->delete($facultyStat->image);
            }
            $data['image'] = $request->file('image')->store('faculty-stats', 'public');
        }

        // Hapus gambar jika admin centang "hapus gambar"
        if ($request->boolean('remove_image') && !$request->hasFile('image')) {
            if ($facultyStat->image && Storage::disk('public')->exists($facultyStat->image)) {
                Storage::disk('public')->delete($facultyStat->image);
            }
            $data['image'] = null;
        }

        $facultyStat->update($data);

        alert()->success('Berhasil!', 'Data statistik fakultas berhasil diperbarui.');

        return redirect()->route('faculty-stat.index');
    }

    /**
     * Hapus data statistik dan gambarnya.
     */
    public function destroy(FacultyStat $facultyStat): RedirectResponse
    {
        if ($facultyStat->image && Storage::disk('public')->exists($facultyStat->image)) {
            Storage::disk('public')->delete($facultyStat->image);
        }

        $facultyStat->delete();

        alert()->success('Berhasil!', 'Data statistik fakultas berhasil dihapus.');

        return redirect()->route('faculty-stat.index');
    }
}
