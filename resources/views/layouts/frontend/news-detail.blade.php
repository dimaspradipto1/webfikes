@extends('layouts.frontend.template')

@section('title', $news->title . ' — FIKES UIS')
@section('meta_description', Str::limit($news->description ?? strip_tags($news->content), 160))
@section('meta_keywords', 'berita fikes, fikes uis, ' . ($news->category ?? 'artikel kesehatan'))
@section('meta_author', $news->user?->name ?? 'Admin FIKES')

@php
  $ogImage = !empty($news->thumbnail) ? asset('storage/' . $news->thumbnail) : asset('assets/img/logouis.png');
  $ogWidth = '1200';
  $ogHeight = '630';
  $ogType = 'image/jpeg';
  if (!empty($news->thumbnail)) {
      $localThumbPath = storage_path('app/public/' . $news->thumbnail);
      if (file_exists($localThumbPath)) {
          $imgInfo = @getimagesize($localThumbPath);
          if ($imgInfo) {
              $ogWidth = (string) $imgInfo[0];
              $ogHeight = (string) $imgInfo[1];
              $ogType = $imgInfo['mime'] ?? 'image/jpeg';
          }
      }
  }
@endphp

{{-- Open Graph & Social Share Preview Meta Data --}}
@section('og_type', 'article')
@section('og_title', $news->title)
@section('og_description', Str::limit($news->description ?? strip_tags($news->content), 160))
@section('og_image', $ogImage)
@section('og_image_width', $ogWidth)
@section('og_image_height', $ogHeight)
@section('og_image_type', $ogType)

@push('styles')
<style>
  .article-hero {
    position: relative;
    background: var(--obsidian-dark);
    padding: 65px 0 45px;
    border-bottom: 2px solid var(--fikes-purple);
  }
  .article-meta-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(130, 60, 162, 0.45);
    color: var(--fikes-orange);
    border: 1px solid rgba(255, 156, 0, 0.4);
    font-size: 12px;
    font-weight: 700;
    padding: 5px 14px;
    border-radius: 50px;
    margin-bottom: 16px;
  }
  .article-title-main {
    font-size: 36px;
    font-weight: 800;
    color: var(--white);
    line-height: 1.25;
    margin-bottom: 16px;
  }
  .article-main-card {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 24px;
    padding: 36px;
    box-shadow: var(--shadow-sm);
  }
  .article-main-thumb {
    width: 100%;
    max-height: 480px;
    object-fit: cover;
    border-radius: 18px;
    margin-bottom: 30px;
    box-shadow: var(--shadow-sm);
  }
  .article-typography {
    font-size: 15.5px;
    line-height: 1.85;
    color: #2b2b2b;
  }
  .article-typography p { margin-bottom: 1.25rem; }
  .article-typography img { max-width: 100%; height: auto; border-radius: 12px; }

  /* Grid Gambar Otomatis di Dalam Konten (1, 2, atau 3 Kolom) */
  .content-image-single {
    margin: 24px 0;
    text-align: center;
  }
  .content-image-single img {
    max-width: 100%;
    max-height: 480px;
    object-fit: cover;
    border-radius: 14px;
    box-shadow: var(--shadow-sm);
    transition: transform 0.25s ease;
  }
  .content-image-single img:hover {
    transform: scale(1.01);
  }

  .content-image-grid {
    display: grid;
    gap: 14px;
    margin: 26px 0;
  }
  .content-image-grid-2 {
    grid-template-columns: repeat(2, 1fr);
  }
  .content-image-grid-3 {
    grid-template-columns: repeat(3, 1fr);
  }
  @media (max-width: 576px) {
    .content-image-grid-2,
    .content-image-grid-3 {
      grid-template-columns: 1fr;
    }
  }
  .content-image-item {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    height: 230px;
    box-shadow: var(--shadow-sm);
    background: #f3f4f6;
    cursor: zoom-in;
  }
  .content-image-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    margin: 0 !important;
    border-radius: 0 !important;
    transition: transform 0.35s ease;
  }
  .content-image-item:hover img {
    transform: scale(1.06);
  }

  /* Gallery Grid Adaptif */
  .gallery-section-box {
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 20px;
    padding: 28px;
    margin-top: 40px;
  }
  .gallery-grid-dynamic {
    display: grid;
    gap: 14px;
  }
  .gallery-grid-1 {
    grid-template-columns: 1fr;
  }
  .gallery-grid-1 .gallery-item-wrap {
    height: 380px;
  }
  .gallery-grid-2 {
    grid-template-columns: repeat(2, 1fr);
  }
  .gallery-grid-2 .gallery-item-wrap {
    height: 240px;
  }
  .gallery-grid-3 {
    grid-template-columns: repeat(3, 1fr);
  }
  .gallery-grid-3 .gallery-item-wrap {
    height: 200px;
  }
  @media (max-width: 576px) {
    .gallery-grid-2,
    .gallery-grid-3 {
      grid-template-columns: 1fr;
    }
  }
  .gallery-item-wrap {
    position: relative;
    border-radius: 14px;
    overflow: hidden;
    cursor: pointer;
    box-shadow: var(--shadow-sm);
    transition: all 0.25s ease;
    background: #f3f4f6;
  }
  .gallery-item-wrap:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
  }
  .gallery-item-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
  }
  .gallery-item-wrap:hover img {
    transform: scale(1.06);
  }
  .gallery-item-overlay {
    position: absolute;
    inset: 0;
    background: rgba(25, 10, 36, 0.4);
    opacity: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 22px;
    transition: opacity 0.2s ease;
  }
  .gallery-item-wrap:hover .gallery-item-overlay {
    opacity: 1;
  }

  /* Author Card */
  .author-box {
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 16px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 16px;
    margin-top: 35px;
  }
  .author-avatar {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    background: var(--fikes-purple);
    color: var(--white);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    font-weight: 700;
  }

  /* Sidebar Widget */
  .sidebar-box {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 20px;
    padding: 24px;
    box-shadow: var(--shadow-sm);
    margin-bottom: 24px;
  }
  .related-thumb {
    width: 75px;
    height: 65px;
    border-radius: 10px;
    object-fit: cover;
    flex-shrink: 0;
  }

  /* Category Widget List */
  .category-widget-list {
    display: flex;
    flex-direction: column;
    gap: 8px;
  }
  .category-widget-link {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 14px;
    border-radius: 12px;
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    color: #334155 !important;
    text-decoration: none !important;
    font-size: 13.5px;
    font-weight: 600;
    transition: all 0.2s ease;
  }
  .category-widget-link:hover {
    background: var(--fikes-purple-light);
    border-color: var(--fikes-purple);
    color: var(--fikes-purple) !important;
    transform: translateX(4px);
  }
  .category-widget-link.active {
    background: var(--fikes-purple);
    color: #ffffff !important;
    border-color: var(--fikes-purple);
  }
  .category-widget-link .cat-icon {
    font-size: 15px;
    color: var(--fikes-purple);
    transition: color 0.2s ease;
  }
  .category-widget-link:hover .cat-icon {
    color: var(--fikes-purple);
  }
  .category-widget-link.active .cat-icon {
    color: #ffffff;
  }
  .cat-count-badge {
    background: #e2e8f0;
    color: #475569;
    font-size: 11.5px;
    font-weight: 700;
    padding: 2px 8px;
    border-radius: 50px;
    transition: all 0.2s ease;
  }
  .category-widget-link:hover .cat-count-badge {
    background: rgba(130, 60, 162, 0.15);
    color: var(--fikes-purple);
  }
  .category-widget-link.active .cat-count-badge {
    background: rgba(255, 255, 255, 0.25);
    color: #ffffff;
  }
</style>
@endpush

@section('content')

<!-- ═══════════════════════════════════════════════
     HERO / TITLE BANNER
═══════════════════════════════════════════════ -->
<div class="article-hero">
  <div class="container">
    <div data-aos="fade-up">
      <div class="article-meta-badge">
        <i class="bi bi-tag-fill"></i>
        <span>{{ $news->category ?? 'Berita Fakultas' }}</span>
      </div>
      <h1 class="article-title-main">{{ $news->title }}</h1>
      <div class="d-flex flex-wrap align-items-center gap-3 text-white-50 small">
        <span><i class="bi bi-calendar3 me-1" style="color:var(--fikes-orange);"></i> {{ $news->created_at->translatedFormat('d F Y') }}</span>
        <span>•</span>
        <span><i class="bi bi-person me-1" style="color:var(--fikes-orange);"></i> {{ $news->user?->name ?? 'Redaksi FIKES UIS' }}</span>
        <span>•</span>
        <span><i class="bi bi-clock me-1" style="color:var(--fikes-orange);"></i> {{ ceil(str_word_count(strip_tags($news->content ?? '')) / 200) ?: 1 }} menit baca</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     ARTICLE CONTENT & GALLERY
═══════════════════════════════════════════════ -->
<section class="section-bg-sand py-5">
  <div class="container">
    <div class="row g-5">

      <!-- Kolom Konten Berita -->
      <div class="col-lg-8" data-aos="fade-right">
        <div class="article-main-card">

          {{-- Thumbnail Utama --}}
          @if($news->thumbnail)
            <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="{{ $news->title }}" class="article-main-thumb">
          @endif

          {{-- Isi Berita --}}
          <div class="article-typography">
            {!! $news->content !!}
          </div>

          {{-- DOKUMENTASI GALERI FOTO BERITA (JIKA ADA) --}}
          @if(!empty($news->gallery) && is_array($news->gallery) && count($news->gallery) > 0)
            @php
              $photoCount = count($news->gallery);
              $gridClass = $photoCount === 1 ? 'gallery-grid-1' : ($photoCount === 2 ? 'gallery-grid-2' : 'gallery-grid-3');
            @endphp
            <div class="gallery-section-box">
              <div class="d-flex align-items-center justify-content-between mb-3">
                <h5 class="fw-bold mb-0 text-dark">
                  <i class="bi bi-images me-2" style="color:var(--fikes-purple);"></i>Dokumentasi Foto Kegiatan ({{ $photoCount }} Foto)
                </h5>
                <span class="badge" style="background: var(--fikes-orange); color:#190a24;">Galeri Foto</span>
              </div>
              <p class="text-muted small mb-3">Klik gambar untuk melihat tampilan resolusi penuh.</p>

              <div class="gallery-grid-dynamic {{ $gridClass }}">
                @foreach($news->gallery as $gIndex => $photoPath)
                  <div class="gallery-item-wrap" onclick="showImageModal('{{ asset('storage/' . $photoPath) }}')">
                    <img src="{{ asset('storage/' . $photoPath) }}" alt="Foto Dokumentasi #{{ $gIndex + 1 }}">
                    <div class="gallery-item-overlay">
                      <i class="bi bi-zoom-in"></i>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>
          @endif

          {{-- Author Card --}}
          <div class="author-box">
            <div class="author-avatar">{{ strtoupper(substr($news->user?->name ?? 'A', 0, 1)) }}</div>
            <div>
              <div class="small text-muted">Diterbitkan oleh:</div>
              <div class="fw-bold text-dark">{{ $news->user?->name ?? 'Redaksi FIKES UIS' }}</div>
              <div class="small text-muted">Fakultas Ilmu Kesehatan — Universitas Ibnu Sina</div>
            </div>
          </div>

          {{-- Share & Back --}}
          <div class="d-flex flex-wrap justify-content-between align-items-center gap-3 pt-4 mt-4 border-top">
            <a href="{{ route('homepage.news') }}" class="btn-outline-hero" style="color:var(--fikes-purple); border-color:var(--fikes-purple); font-size:13px; padding:8px 18px;">
              <i class="bi bi-arrow-left"></i> Kembali ke Daftar Berita
            </a>
            <div class="d-flex align-items-center gap-2">
              <span class="small fw-semibold text-muted">Bagikan:</span>
              <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . url()->current()) }}" target="_blank" class="btn btn-sm btn-success rounded-circle" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;">
                <i class="bi bi-whatsapp"></i>
              </a>
              <button onclick="copyCurrentUrl()" class="btn btn-sm btn-outline-secondary rounded-circle" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;" title="Salin Tautan">
                <i class="bi bi-link-45deg"></i>
              </button>
            </div>
          </div>

        </div>
      </div>

      <!-- Sidebar -->
      <div class="col-lg-4" data-aos="fade-left">

        {{-- Ringkasan --}}
        <div class="sidebar-box">
          <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-info-circle me-2" style="color:var(--fikes-purple);"></i>Sekilas Berita</h5>
          <p class="text-muted small mb-0" style="line-height:1.7;">
            {{ $news->description ?? Str::limit(strip_tags($news->content), 180) }}
          </p>
        </div>

        {{-- Berita Terkait --}}
        @if(isset($relatedNews) && $relatedNews->count() > 0)
          <div class="sidebar-box">
            <h5 class="fw-bold mb-3 text-dark"><i class="bi bi-newspaper me-2" style="color:var(--fikes-orange);"></i>Berita Lainnya</h5>
            <div class="d-flex flex-column gap-3">
              @foreach($relatedNews as $related)
                <a href="{{ route('homepage.news.detail', $related->slug ?? $related->id) }}" class="d-flex gap-3 text-decoration-none text-dark group-hover">
                  @if($related->thumbnail)
                    <img src="{{ asset('storage/' . $related->thumbnail) }}" alt="{{ $related->title }}" class="related-thumb">
                  @else
                    <div class="related-thumb bg-light border d-flex align-items-center justify-content-center text-muted">
                      <i class="bi bi-image"></i>
                    </div>
                  @endif
                  <div>
                    <h6 class="fw-bold mb-1 small text-dark" style="line-height:1.4;">{{ Str::limit($related->title, 55) }}</h6>
                    <span class="text-muted" style="font-size:11px;"><i class="bi bi-calendar3 me-1"></i>{{ $related->created_at->format('d M Y') }}</span>
                  </div>
                </a>
              @endforeach
            </div>
          </div>
        @endif

        {{-- Widget Kategori Berita --}}
        <div class="sidebar-box">
          <h5 class="fw-bold mb-3 text-dark">
            <i class="bi bi-grid-fill me-2" style="color:var(--fikes-purple);"></i>Kategori Berita
          </h5>
          <div class="category-widget-list">
            @php
              $allCategories = [
                'Berita Fakultas'         => 'bi-newspaper',
                'Akademik & Mahasiswa'    => 'bi-mortarboard',
                'K3 & Keselamatan Kerja'  => 'bi-shield-check',
                'Kesehatan Lingkungan'    => 'bi-tree',
                'Penelitian & Riset'      => 'bi-journal-medical',
                'Pengabdian Masyarakat'   => 'bi-people',
                'Pengumuman & Agenda'     => 'bi-megaphone',
              ];
              $counts = isset($categories) ? $categories->pluck('total', 'category')->toArray() : [];
            @endphp

            @foreach($allCategories as $catName => $icon)
              @php $count = $counts[$catName] ?? 0; @endphp
              <a href="{{ route('homepage.news', ['category' => $catName]) }}" class="category-widget-link {{ ($news->category ?? '') === $catName ? 'active' : '' }}">
                <div class="d-flex align-items-center gap-2">
                  <i class="bi {{ $icon }} cat-icon"></i>
                  <span>{{ $catName }}</span>
                </div>
                <span class="cat-count-badge">{{ $count }}</span>
              </a>
            @endforeach
          </div>
        </div>

        {{-- Banner PMB Mini --}}
        <div class="sidebar-box text-white" style="background: var(--obsidian-dark); border: 2px solid var(--fikes-purple);">
          <span class="badge mb-2" style="background: var(--fikes-orange); color:#190a24; font-weight:800;">PMB 2026/2027</span>
          <h5 class="fw-bold mb-2">Ingin Kuliah di FIKES UIS?</h5>
          <p class="text-white-50 small mb-3">Tersedia Program Studi S2 Kesehatan Masyarakat, S1 K3, dan S1 Kesehatan Lingkungan.</p>
          <a href="{{ route('homepage.kontak') }}" class="btn-primary-hero w-100 justify-content-center" style="font-size:13px; padding:9px 14px;">
            Daftar Sekarang <i class="bi bi-arrow-right"></i>
          </a>
        </div>

      </div>

    </div>
  </div>
</section>

<!-- Modal Lightbox Galeri Foto -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content bg-transparent border-0">
      <div class="modal-body p-0 text-center position-relative">
        <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" data-bs-dismiss="modal" aria-label="Close"></button>
        <img id="modalImg" src="" class="img-fluid rounded shadow-lg" style="max-height:85vh; object-fit:contain;">
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
  function showImageModal(src) {
    document.getElementById('modalImg').src = src;
    var myModal = new bootstrap.Modal(document.getElementById('imageModal'));
    myModal.show();
  }

  function copyCurrentUrl() {
    navigator.clipboard.writeText(window.location.href);
    alert('Tautan berita berhasil disalin ke clipboard!');
  }

  /* Susun Otomatis Gambar di Dalam Teks Artikel Menjadi Grid Rapi */
  document.addEventListener('DOMContentLoaded', function() {
    const typography = document.querySelector('.article-typography');
    if (!typography) return;

    const children = Array.from(typography.children);
    let currentGroup = [];

    function processGroup(group) {
      if (group.length === 0) return;

      let imgs = [];
      group.forEach(el => {
        if (el.tagName === 'IMG') {
          imgs.push(el);
        } else {
          imgs.push(...el.querySelectorAll('img'));
        }
      });

      if (imgs.length === 0) return;

      if (imgs.length === 1) {
        // 1 Gambar: Tampil Penuh (100% Full Width)
        const wrap = document.createElement('div');
        wrap.className = 'content-image-single';
        const singleImg = document.createElement('img');
        singleImg.src = imgs[0].src;
        singleImg.alt = imgs[0].alt || 'Gambar Berita';
        singleImg.setAttribute('onclick', `showImageModal('${imgs[0].src}')`);
        singleImg.style.cursor = 'zoom-in';
        wrap.appendChild(singleImg);
        group[0].replaceWith(wrap);
        for (let i = 1; i < group.length; i++) group[i].remove();
        return;
      }

      // Jika 2 gambar = 2 kolom (50% - 50%)
      // Jika 3 gambar = 3 kolom (kiri, tengah, kanan)
      // Jika 4+ gambar = grid 3 kolom per baris
      const colCount = Math.min(imgs.length, 3);
      const grid = document.createElement('div');
      grid.className = `content-image-grid content-image-grid-${colCount}`;

      imgs.forEach((img, idx) => {
        const item = document.createElement('div');
        item.className = 'content-image-item';
        const newImg = document.createElement('img');
        newImg.src = img.src;
        newImg.alt = img.alt || `Gambar Dokumentasi ${idx + 1}`;
        newImg.setAttribute('onclick', `showImageModal('${img.src}')`);
        item.appendChild(newImg);
        grid.appendChild(item);
      });

      group[0].replaceWith(grid);
      for (let i = 1; i < group.length; i++) {
        group[i].remove();
      }
    }

    children.forEach(el => {
      // Cek apakah elemen hanya berupa gambar atau paragraf kosong yang berisi gambar
      const hasImg = el.querySelector('img') || el.tagName === 'IMG';
      const textOnly = el.textContent.replace(/\u00a0/g, ' ').trim();

      if (hasImg && textOnly === '') {
        currentGroup.push(el);
      } else {
        processGroup(currentGroup);
        currentGroup = [];
      }
    });

    processGroup(currentGroup);
  });
</script>
@endpush
