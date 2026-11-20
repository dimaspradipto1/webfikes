<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class NewsCategory extends Model
{
    use HasFactory;

    protected $table = 'news_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'urutan' => 'integer',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $cat) {
            if (empty($cat->slug) || $cat->isDirty('name')) {
                $cat->slug = self::generateUniqueSlug($cat->name, $cat->id);
            }
        });
    }

    public static function generateUniqueSlug(string $name, ?int $ignoreId = null): string
    {
        $base = Str::slug($name) ?: 'kategori-berita';
        $slug = $base;
        $i = 1;

        while (self::where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }

    public static function defaultItems(): array
    {
        return [
            ['name' => 'Berita FIKES', 'icon' => 'bi-mortarboard-fill', 'color' => '#046B26', 'description' => 'Berita resmi kegiatan dan informasi utama kampus'],
            ['name' => 'Prestasi Mahasiswa', 'icon' => 'bi-trophy-fill', 'color' => '#f59e0b', 'description' => 'Berita capaian prestasi, kejuaraan, dan penghargaan mahasiswa (otomatis tampil di halaman Prestasi Mahasiswa)'],
            ['name' => 'Berita Humas', 'icon' => 'bi-megaphone-fill', 'color' => '#198754', 'description' => 'Rilis berita dan liputan kehumasan'],
            ['name' => 'Akademik & Kemahasiswaan', 'icon' => 'bi-book-fill', 'color' => '#0284c7', 'description' => 'Informasi perkuliahan, akademik, dan kegiatan mahasiswa'],
            ['name' => 'Teknologi & Rekayasa', 'icon' => 'bi-cpu-fill', 'color' => '#6610f2', 'description' => 'Inovasi teknologi dan rekayasa terapan'],
            ['name' => 'Bisnis & Manajemen', 'icon' => 'bi-briefcase-fill', 'color' => '#ea580c', 'description' => 'Kewirausahaan, ekonomi, dan manajemen'],
            ['name' => 'K3 & Lingkungan Industri', 'icon' => 'bi-shield-fill-check', 'color' => '#0d9488', 'description' => 'Keselamatan dan Kesehatan Kerja (K3) serta Kesehatan Lingkungan'],
            ['name' => 'Penelitian & Riset', 'icon' => 'bi-lightbulb-fill', 'color' => '#059669', 'description' => 'Publikasi ilmiah, riset dosen, dan mahasiswa'],
            ['name' => 'Pengabdian Masyarakat', 'icon' => 'bi-people-fill', 'color' => '#d63384', 'description' => 'Kegiatan pengabdian kepada masyarakat'],
            ['name' => 'Kerjasama Industri', 'icon' => 'bi-building-fill-check', 'color' => '#6f42c1', 'description' => 'MoU, kemitraan strategis, dan kolaborasi institusi'],
            ['name' => 'Pengumuman & Agenda', 'icon' => 'bi-calendar-event-fill', 'color' => '#d97706', 'description' => 'Pengumuman resmi dan jadwal agenda akademik'],
        ];
    }

    public static function ensureDefaults(): void
    {
        try {
            if (!Schema::hasTable('news_categories')) {
                return;
            }

            if (self::count() === 0) {
                $urutan = 1;
                foreach (self::defaultItems() as $item) {
                    self::create([
                        'name' => $item['name'],
                        'slug' => self::generateUniqueSlug($item['name']),
                        'description' => $item['description'],
                        'icon' => $item['icon'],
                        'color' => $item['color'],
                        'urutan' => $urutan++,
                        'is_active' => true,
                    ]);
                }
            } elseif (! self::where('name', 'Prestasi Mahasiswa')->exists()) {
                self::create([
                    'name' => 'Prestasi Mahasiswa',
                    'slug' => self::generateUniqueSlug('Prestasi Mahasiswa'),
                    'description' => 'Berita capaian prestasi, kejuaraan, dan penghargaan mahasiswa (otomatis tampil di halaman Prestasi Mahasiswa)',
                    'icon' => 'bi-trophy-fill',
                    'color' => '#f59e0b',
                    'urutan' => (self::max('urutan') ?? 0) + 1,
                    'is_active' => true,
                ]);
            }
        } catch (\Throwable $e) {
            // ignore
        }
    }

    public static function activeOptions(): Collection
    {
        try {
            if (!Schema::hasTable('news_categories')) {
                return collect(self::defaultItems())->map(fn ($item, $idx) => (object) [
                    'id' => $idx + 1,
                    'name' => $item['name'],
                    'slug' => Str::slug($item['name']),
                    'icon' => $item['icon'],
                    'color' => $item['color'],
                    'is_active' => true,
                ]);
            }

            self::ensureDefaults();

            return self::where('is_active', true)
                ->orderBy('urutan')
                ->orderBy('name')
                ->get();
        } catch (\Throwable $e) {
            return collect(self::defaultItems())->map(fn ($item, $idx) => (object) [
                'id' => $idx + 1,
                'name' => $item['name'],
                'slug' => Str::slug($item['name']),
                'icon' => $item['icon'],
                'color' => $item['color'],
                'is_active' => true,
            ]);
        }
    }

    public function getNewsCountAttribute(): int
    {
        try {
            return News::where('category', $this->name)->count();
        } catch (\Throwable $e) {
            return 0;
        }
    }
}
