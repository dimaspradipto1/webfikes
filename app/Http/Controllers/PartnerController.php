<?php

namespace App\Http\Controllers;

use App\DataTables\PartnerDataTable;
use App\Http\Requests\PartnerRequest;
use App\Models\Partner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PartnerController extends Controller
{
    public function index(PartnerDataTable $dataTable)
    {
        return $dataTable->render('pages.partner.index');
    }

    public function create(): View
    {
        return view('pages.partner.create');
    }

    public function store(PartnerRequest $request): RedirectResponse
    {
        $path = $request->hasFile('logo') ? $request->file('logo')->store('partners', 'public') : null;

        Partner::create([
            'nama' => $request->nama,
            'logo' => $path,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif') ? true : false,
        ]);

        alert()->success('Berhasil!', 'Partner berhasil ditambahkan.');

        return redirect()->route('partner.index');
    }

    public function edit(Partner $partner): View
    {
        return view('pages.partner.edit', compact('partner'));
    }

    public function update(PartnerRequest $request, Partner $partner): RedirectResponse
    {
        $data = [
            'nama' => $request->nama,
            'urutan' => $request->urutan ?? 0,
            'aktif' => $request->has('aktif') ? true : false,
        ];

        if ($request->hasFile('logo')) {
            if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
                Storage::disk('public')->delete($partner->logo);
            }
            $data['logo'] = $request->file('logo')->store('partners', 'public');
        }

        $partner->update($data);

        alert()->success('Berhasil!', 'Partner berhasil diperbarui.');

        return redirect()->route('partner.index');
    }

    public function destroy(Partner $partner): RedirectResponse
    {
        if ($partner->logo && Storage::disk('public')->exists($partner->logo)) {
            Storage::disk('public')->delete($partner->logo);
        }

        $partner->delete();

        alert()->success('Berhasil!', 'Partner berhasil dihapus.');

        return redirect()->route('partner.index');
    }
}
