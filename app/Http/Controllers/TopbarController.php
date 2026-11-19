<?php

namespace App\Http\Controllers;

use App\DataTables\TopbarDataTable;
use App\Http\Requests\TopbarRequest;
use App\Models\Topbar;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TopbarController extends Controller
{
    public function index(TopbarDataTable $dataTable)
    {
        return $dataTable->render('pages.topbar.index');
    }

    public function create(): View
    {
        return view('pages.topbar.create');
    }

    public function store(TopbarRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        // Filter valid social media rows
        $socialMedia = [];
        if ($request->has('social_media') && is_array($request->social_media)) {
            foreach ($request->social_media as $item) {
                if (! empty($item['url'])) {
                    $socialMedia[] = [
                        'platform' => $item['platform'] ?? 'Link',
                        'icon' => ! empty($item['icon']) ? $item['icon'] : 'bi-globe',
                        'url' => $item['url'],
                    ];
                }
            }
        }
        $data['social_media'] = $socialMedia;

        // Jika diset aktif, nonaktifkan topbar lain jika ada
        if ($data['is_active']) {
            Topbar::where('is_active', true)->update(['is_active' => false]);
        }

        Topbar::create($data);

        return redirect()
            ->route('topbar.index')
            ->with('success', 'Pengaturan Topbar berhasil ditambahkan.');
    }

    public function edit(Topbar $topbar): View
    {
        return view('pages.topbar.edit', compact('topbar'));
    }

    public function update(TopbarRequest $request, Topbar $topbar): RedirectResponse
    {
        $data = $request->validated();
        $data['is_active'] = $request->has('is_active');

        // Filter valid social media rows
        $socialMedia = [];
        if ($request->has('social_media') && is_array($request->social_media)) {
            foreach ($request->social_media as $item) {
                if (! empty($item['url'])) {
                    $socialMedia[] = [
                        'platform' => $item['platform'] ?? 'Link',
                        'icon' => ! empty($item['icon']) ? $item['icon'] : 'bi-globe',
                        'url' => $item['url'],
                    ];
                }
            }
        }
        $data['social_media'] = $socialMedia;

        if ($data['is_active']) {
            Topbar::where('id', '!=', $topbar->id)->update(['is_active' => false]);
        }

        $topbar->update($data);

        return redirect()
            ->route('topbar.index')
            ->with('success', 'Pengaturan Topbar berhasil diperbarui.');
    }

    public function destroy(Topbar $topbar): RedirectResponse
    {
        $topbar->delete();

        return redirect()
            ->route('topbar.index')
            ->with('success', 'Pengaturan Topbar berhasil dihapus.');
    }
}
