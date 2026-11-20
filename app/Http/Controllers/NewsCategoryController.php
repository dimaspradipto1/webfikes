<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class NewsCategoryController extends Controller
{
    public function index(Request $request): View
    {
        NewsCategory::ensureDefaults();

        $search = trim((string) $request->query('search', ''));
        $query = NewsCategory::query();

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('slug', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $categories = $query->orderBy('urutan')->orderBy('name')->get();

        return view('pages.news-category.index', compact('categories', 'search'));
    }

    public function store(Request $request): RedirectResponse
    {
        NewsCategory::ensureDefaults();

        $validated = $request->validate([
            'name'        => 'required|string|max:120|unique:news_categories,name',
            'description' => 'nullable|string|max:255',
            'icon'        => 'nullable|string|max:60',
            'color'       => 'nullable|string|max:20',
            'urutan'      => 'nullable|integer|min:1',
        ], [
            'name.required' => 'Nama kategori berita wajib diisi.',
            'name.unique'   => 'Nama kategori berita tersebut sudah ada.',
        ]);

        $validated['icon'] = $validated['icon'] ?: 'bi-tag-fill';
        $validated['color'] = $validated['color'] ?: '#046B26';
        $validated['urutan'] = $validated['urutan'] ?? ((int) NewsCategory::max('urutan') + 1);
        $validated['is_active'] = $request->has('is_active');

        NewsCategory::create($validated);

        Alert::success('Berhasil!', "Kategori berita '{$validated['name']}' berhasil ditambahkan.");
        return redirect()->route('news-category.index');
    }

    public function update(Request $request, NewsCategory $newsCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:120|unique:news_categories,name,' . $newsCategory->id,
            'description' => 'nullable|string|max:255',
            'icon'        => 'nullable|string|max:60',
            'color'       => 'nullable|string|max:20',
            'urutan'      => 'nullable|integer|min:1',
        ], [
            'name.required' => 'Nama kategori berita wajib diisi.',
            'name.unique'   => 'Nama kategori berita tersebut sudah ada.',
        ]);

        $oldName = $newsCategory->name;
        $newName = trim($validated['name']);

        $validated['name'] = $newName;
        $validated['icon'] = $validated['icon'] ?: 'bi-tag-fill';
        $validated['color'] = $validated['color'] ?: '#046B26';
        $validated['urutan'] = $validated['urutan'] ?? $newsCategory->urutan;
        $validated['is_active'] = $request->has('is_active');

        $newsCategory->update($validated);

        // Sinkronisasi otomatis ke semua berita yang memakai nama kategori lama
        if ($oldName !== $newName) {
            News::where('category', $oldName)->update(['category' => $newName]);
        }

        Alert::success('Diperbarui!', "Kategori berita '{$newName}' berhasil diperbarui dan disinkronkan ke data berita.");
        return redirect()->route('news-category.index');
    }

    public function toggle(NewsCategory $newsCategory): RedirectResponse
    {
        $newsCategory->update([
            'is_active' => !$newsCategory->is_active,
        ]);

        $statusText = $newsCategory->is_active ? 'diaktifkan' : 'dinonaktifkan';
        Alert::success('Status Diubah!', "Kategori '{$newsCategory->name}' berhasil {$statusText}.");

        return redirect()->route('news-category.index');
    }

    public function destroy(NewsCategory $newsCategory): RedirectResponse
    {
        $name = $newsCategory->name;
        $newsCategory->delete();

        Alert::success('Dihapus!', "Kategori berita '{$name}' berhasil dihapus.");
        return redirect()->route('news-category.index');
    }
}
