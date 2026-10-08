<?php

namespace App\Http\Controllers;

use App\Models\BahasaSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BahasaSettingController extends Controller
{
    /**
     * Display language settings list.
     */
    public function index(): View
    {
        $bahasas = BahasaSetting::orderBy('urutan')->orderBy('id')->get();
        return view('pages.bahasa.index', compact('bahasas'));
    }

    /**
     * Store a new language.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'kode'        => 'required|string|max:10|unique:bahasa_settings,kode',
            'nama'        => 'required|string|max:100',
            'kode_negara' => 'nullable|string|max:10',
            'urutan'      => 'nullable|integer',
        ]);

        $maxOrder = BahasaSetting::max('urutan') ?? 0;
        $validated['urutan'] = $validated['urutan'] ?? ($maxOrder + 1);
        $validated['is_active'] = $request->has('is_active');
        $validated['is_default'] = false;

        BahasaSetting::create($validated);

        if (function_exists('alert')) {
            alert()->success('Berhasil!', 'Bahasa baru berhasil ditambahkan.');
        }

        return redirect()->route('bahasa.index')->with('success', 'Bahasa baru berhasil ditambahkan.');
    }

    /**
     * Update an existing language.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $bahasa = BahasaSetting::findOrFail($id);

        $validated = $request->validate([
            'kode'        => 'required|string|max:10|unique:bahasa_settings,kode,' . $bahasa->id,
            'nama'        => 'required|string|max:100',
            'kode_negara' => 'nullable|string|max:10',
            'urutan'      => 'required|integer',
        ]);

        $bahasa->update($validated);

        if (function_exists('alert')) {
            alert()->success('Berhasil!', 'Pengaturan bahasa berhasil diperbarui.');
        }

        return redirect()->route('bahasa.index')->with('success', 'Pengaturan bahasa berhasil diperbarui.');
    }

    /**
     * Toggle active status.
     */
    public function toggle($id): RedirectResponse
    {
        $bahasa = BahasaSetting::findOrFail($id);

        if ($bahasa->is_default && $bahasa->is_active) {
            if (function_exists('alert')) {
                alert()->error('Gagal!', 'Bahasa default tidak dapat dinonaktifkan.');
            }
            return redirect()->route('bahasa.index')->with('error', 'Bahasa default tidak dapat dinonaktifkan.');
        }

        $bahasa->is_active = !$bahasa->is_active;
        $bahasa->save();

        $statusText = $bahasa->is_active ? 'diaktifkan' : 'dinonaktifkan';
        if (function_exists('alert')) {
            alert()->success('Berhasil!', "Bahasa {$bahasa->nama} berhasil {$statusText}.");
        }

        return redirect()->route('bahasa.index')->with('success', "Bahasa {$bahasa->nama} berhasil {$statusText}.");
    }

    /**
     * Set a language as default.
     */
    public function setDefault($id): RedirectResponse
    {
        $bahasa = BahasaSetting::findOrFail($id);

        BahasaSetting::where('is_default', true)->update(['is_default' => false]);

        $bahasa->is_default = true;
        $bahasa->is_active = true;
        $bahasa->save();

        if (function_exists('alert')) {
            alert()->success('Berhasil!', "Bahasa {$bahasa->nama} dijadikan sebagai bahasa default.");
        }

        return redirect()->route('bahasa.index')->with('success', "Bahasa {$bahasa->nama} dijadikan sebagai bahasa default.");
    }

    /**
     * Batch update languages.
     */
    public function updateAll(Request $request): RedirectResponse
    {
        $items = $request->input('bahasas', []);

        foreach ($items as $id => $data) {
            $bahasa = BahasaSetting::find($id);
            if ($bahasa) {
                $bahasa->urutan = isset($data['urutan']) ? (int)$data['urutan'] : $bahasa->urutan;
                $bahasa->is_active = isset($data['is_active']) && $data['is_active'] == '1';
                
                if ($bahasa->is_default) {
                    $bahasa->is_active = true;
                }
                
                $bahasa->save();
            }
        }

        if (function_exists('alert')) {
            alert()->success('Berhasil!', 'Semua pengaturan bahasa berhasil diperbarui.');
        }

        return redirect()->route('bahasa.index')->with('success', 'Semua pengaturan bahasa berhasil diperbarui.');
    }

    /**
     * Delete language.
     */
    public function destroy($id): RedirectResponse
    {
        $bahasa = BahasaSetting::findOrFail($id);

        if ($bahasa->is_default) {
            if (function_exists('alert')) {
                alert()->error('Gagal!', 'Bahasa default tidak boleh dihapus.');
            }
            return redirect()->route('bahasa.index')->with('error', 'Bahasa default tidak boleh dihapus.');
        }

        if (!empty($bahasa->bendera) && str_starts_with($bahasa->bendera, 'assets/img/flags/flag_') && file_exists(public_path($bahasa->bendera))) {
            @unlink(public_path($bahasa->bendera));
        }

        $bahasa->delete();

        if (function_exists('alert')) {
            alert()->success('Berhasil!', 'Bahasa berhasil dihapus.');
        }

        return redirect()->route('bahasa.index')->with('success', 'Bahasa berhasil dihapus.');
    }
}
