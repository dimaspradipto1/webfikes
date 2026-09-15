<?php

namespace App\Http\Controllers;

use App\DataTables\NewsDataTable;
use App\Http\Requests\NewsRequest;
use App\Models\News;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(NewsDataTable $dataTable)
    {
        return $dataTable->render('pages.news.index');
    }

    public function create(): View
    {
        return view('pages.news.create');
    }

    public function store(NewsRequest $request): RedirectResponse
    {
        $thumbnailPath = null;
        if ($request->hasFile('thumbnail')) {
            $thumbnailPath = $this->processThumbnail($request->file('thumbnail'));
        }

        $galleryPaths = [];
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $photo) {
                $galleryPaths[] = $photo->store('news/gallery', 'public');
            }
        }

        News::create([
            'user_id'     => Auth::id(),
            'thumbnail'   => $thumbnailPath,
            'gallery'     => !empty($galleryPaths) ? $galleryPaths : null,
            'title'       => $request->title,
            'description' => $request->description,
            'content'     => $request->content,
            'status'      => $request->status,
            'category'    => $request->category,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita berhasil diterbitkan.');
    }

    public function edit(News $news): View
    {
        if (Auth::user()->hasExactRole('penulis') && !Auth::user()->isAdmin() && $news->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda hanya dapat mengedit berita yang Anda buat sendiri.');
        }

        return view('pages.news.edit', compact('news'));
    }

    public function update(NewsRequest $request, News $news): RedirectResponse
    {
        if (Auth::user()->hasExactRole('penulis') && !Auth::user()->isAdmin() && $news->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda hanya dapat memperbarui berita yang Anda buat sendiri.');
        }

        $thumbnailPath = $news->thumbnail;

        if ($request->hasFile('thumbnail')) {
            if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
                Storage::disk('public')->delete($news->thumbnail);
            }
            $thumbnailPath = $this->processThumbnail($request->file('thumbnail'));
        }

        $currentGallery = is_array($news->gallery) ? $news->gallery : [];

        // Hapus gambar yang dicentang hapus
        if ($request->filled('delete_gallery_images')) {
            $deleteList = (array) $request->input('delete_gallery_images');
            foreach ($deleteList as $delPath) {
                if (Storage::disk('public')->exists($delPath)) {
                    Storage::disk('public')->delete($delPath);
                }
                $currentGallery = array_values(array_filter($currentGallery, fn ($item) => $item !== $delPath));
            }
        }

        // Tambah gambar baru jika diupload
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $photo) {
                $currentGallery[] = $photo->store('news/gallery', 'public');
            }
        }

        $news->update([
            'thumbnail'   => $thumbnailPath,
            'gallery'     => !empty($currentGallery) ? array_values($currentGallery) : null,
            'title'       => $request->title,
            'description' => $request->description,
            'content'     => $request->content,
            'status'      => $request->status,
            'category'    => $request->category,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita dan galeri berhasil diperbarui.');
    }

    public function destroy(News $news): RedirectResponse
    {
        if (Auth::user()->hasExactRole('penulis') && !Auth::user()->isAdmin() && $news->user_id !== Auth::id()) {
            abort(403, 'Akses ditolak. Anda hanya dapat menghapus berita yang Anda buat sendiri.');
        }

        if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
            Storage::disk('public')->delete($news->thumbnail);
        }

        if (is_array($news->gallery)) {
            foreach ($news->gallery as $imgPath) {
                if (Storage::disk('public')->exists($imgPath)) {
                    Storage::disk('public')->delete($imgPath);
                }
            }
        }

        // Hapus juga file gambar konten TinyMCE jika tersimpan di local storage
        if (!empty($news->content)) {
            preg_match_all('/src="[^"]*\/storage\/(news\/content\/[^"]+)"/i', $news->content, $matches);
            if (!empty($matches[1])) {
                foreach ($matches[1] as $contentImg) {
                    if (Storage::disk('public')->exists($contentImg)) {
                        Storage::disk('public')->delete($contentImg);
                    }
                }
            }
        }

        $news->delete();

        return redirect()
            ->route('news.index')
            ->with('success', 'Berita dan file gambar terkait berhasil dihapus.');
    }

    public function uploadImage(\Illuminate\Http\Request $request): \Illuminate\Http\JsonResponse
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp,svg|max:10240',
        ]);

        if ($request->hasFile('file')) {
            $path = $request->file('file')->store('news/content', 'public');
            return response()->json([
                'location' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'Gagal mengunggah gambar'], 400);
    }

    /**
     * Kompresi dan optimasi thumbnail berita (Maks 1200px lebar, <300KB)
     * agar preview WhatsApp dan medsos tampil kartu besar (Large Banner di atas).
     */
    private function processThumbnail($file): string
    {
        $filename = 'news/' . Str::random(40) . '.jpg';
        $fullTarget = storage_path('app/public/' . $filename);

        if (!is_dir(dirname($fullTarget))) {
            mkdir(dirname($fullTarget), 0755, true);
        }

        if (extension_loaded('gd')) {
            $srcPath = $file->getRealPath();
            $info = @getimagesize($srcPath);

            if ($info && in_array($info['mime'], ['image/jpeg', 'image/png', 'image/webp'])) {
                $origW = $info[0];
                $origH = $info[1];

                $srcImg = match ($info['mime']) {
                    'image/jpeg' => @imagecreatefromjpeg($srcPath),
                    'image/png'  => @imagecreatefrompng($srcPath),
                    'image/webp' => @imagecreatefromwebp($srcPath),
                    default      => null,
                };

                if ($srcImg) {
                    // Maksimal lebar 1200px (standar OpenGraph 1200x630)
                    $targetW = min(1200, $origW);
                    $targetH = (int) round(($origH / $origW) * $targetW);

                    $dstImg = imagecreatetruecolor($targetW, $targetH);
                    $white = imagecolorallocate($dstImg, 255, 255, 255);
                    imagefill($dstImg, 0, 0, $white);

                    imagecopyresampled($dstImg, $srcImg, 0, 0, 0, 0, $targetW, $targetH, $origW, $origH);
                    imagejpeg($dstImg, $fullTarget, 82);

                    imagedestroy($srcImg);
                    imagedestroy($dstImg);

                    return $filename;
                }
            }
        }

        return $file->store('news', 'public');
    }
}
