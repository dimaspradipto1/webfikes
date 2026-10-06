@extends('layouts.frontend.template')

@section('title', 'Berita & Informasi Terkini — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Ikuti berita kampus, pengumuman akademik, riset teknologi & bisnis, dan publikasi terbaru dari Universitas Ibnu Sina (UIS) Batam.')
@section('meta_keywords', 'berita uis, pengumuman akademik uis, riset kampus batam, kegiatan mahasiswa uis, universitas ibnu sina batam')

@push('styles')
<style>
  .news-hero {
    position: relative;
    background: var(--obsidian-dark);
    padding: 75px 0 55px;
    border-bottom: 2px solid var(--uis-purple);
  }
  .news-hero-title {
    font-size: 38px;
    font-weight: 800;
    color: var(--white);
    margin-bottom: 12px;
  }
  .news-hero-title em {
    font-style: normal;
    color: var(--uis-orange);
  }
  .news-card-portal {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 20px;
    overflow: hidden;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .news-card-portal:hover {
    transform: translateY(-6px);
    box-shadow: var(--shadow-lg);
    border-color: var(--border-purple);
  }
  .news-card-thumb-wrap {
    position: relative;
    height: 210px;
    overflow: hidden;
    background: var(--uis-purple-light);
  }
  .news-card-thumb {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
  }
  .news-card-portal:hover .news-card-thumb {
    transform: scale(1.05);
  }
  .news-gallery-badge {
    position: absolute;
    bottom: 10px;
    right: 10px;
    background: rgba(25, 10, 36, 0.85);
    color: var(--uis-orange);
    border: 1px solid rgba(254, 216, 2, 0.4);
    font-size: 11px;
    font-weight: 700;
    padding: 3px 9px;
    border-radius: 50px;
    backdrop-filter: blur(4px);
  }
  .news-cat-badge {
    position: absolute;
    top: 12px;
    left: 12px;
    background: var(--uis-purple);
    color: var(--white);
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 50px;
    box-shadow: var(--shadow-sm);
  }
  .news-card-body {
    padding: 22px;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .news-featured-box {
    background: var(--white);
    border: 2px solid var(--uis-purple);
    border-radius: 24px;
    overflow: hidden;
    box-shadow: var(--shadow-md);
    margin-bottom: 35px;
  }

  /* Filter Category Bar */
  .news-filter-bar {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 18px;
    padding: 16px 20px;
    box-shadow: var(--shadow-sm);
    margin-bottom: 35px;
  }
  .cat-pill-item {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 7px 16px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    text-decoration: none !important;
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    color: #475569 !important;
    transition: all 0.2s ease;
    white-space: nowrap;
  }
  .cat-pill-item:hover {
    background: var(--uis-purple-light);
    border-color: var(--uis-purple);
    color: var(--uis-purple) !important;
    transform: translateY(-2px);
  }
  .cat-pill-item.active {
    background: var(--uis-purple);
    border-color: var(--uis-purple);
    color: #ffffff !important;
    box-shadow: 0 2px 8px rgba(4, 107, 38, 0.3);
  }
  .news-search-input-box {
    position: relative;
    display: flex;
    align-items: center;
    background: var(--surface-light);
    border: 1px solid var(--border-light);
    border-radius: 50px;
    padding: 6px 16px;
    width: 260px;
    max-width: 100%;
  }
  .news-search-input-box:focus-within {
    border-color: var(--uis-purple);
    background: #ffffff;
    box-shadow: 0 0 0 3px rgba(4, 107, 38, 0.12);
  }
  .news-search-input-box input {
    border: none;
    outline: none;
    background: transparent;
    font-size: 13px;
    width: 100%;
    color: #334155;
  }
  .news-search-input-box button {
    border: none;
    background: transparent;
    color: var(--uis-purple);
    cursor: pointer;
    padding: 0;
    display: flex;
    align-items: center;
  }
</style>
@endpush

@section('content')

<!-- ═══════════════════════════════════════════════
     HERO BANNER
═══════════════════════════════════════════════ -->
<div class="news-hero">
  <div class="container">
    <div data-aos="fade-up">
      <div class="badge px-3 py-2 rounded-pill mb-3" style="background: rgba(4, 107, 38, 0.45); color: var(--uis-orange); border: 1px solid rgba(254, 216, 2, 0.4);">
        <i class="bi bi-newspaper me-1"></i> Warta & Informasi Universitas Ibnu Sina
      </div>
      <h1 class="news-hero-title">Berita & <em>Warta Kampus</em> UIS</h1>
      <p class="text-white-50 mb-3" style="max-width: 650px;">
        Kumpulan warta kegiatan universitas, pengumuman akademik, prestasi mahasiswa, riset terapan, dan inovasi civitas akademika Universitas Ibnu Sina Batam.
      </p>
      <div class="d-flex align-items-center gap-2 text-white-50 small">
        <a href="{{ route('homepage') }}" class="text-white text-decoration-none">Beranda</a>
        <span>/</span>
        <span style="color: var(--uis-orange);">Berita & Artikel</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     NEWS PORTAL CONTENT
═══════════════════════════════════════════════ -->
<section class="section-bg-sand py-5">
  <div class="container">

    {{-- Featured / Berita Utama --}}
    @if(isset($featured) && $featured)
      <div class="news-featured-box" data-aos="fade-up">
        <div class="row g-0">
          <div class="col-lg-6">
            <div class="position-relative h-100" style="min-height: 280px;">
              @if($featured->thumbnail)
                <img src="{{ asset('storage/' . $featured->thumbnail) }}" alt="{{ $featured->title }}" class="w-100 h-100" style="object-fit: cover;">
              @else
                <div class="w-100 h-100 d-flex align-items-center justify-content-center bg-secondary text-white">
                  <i class="bi bi-image fs-1"></i>
                </div>
              @endif
              <span class="badge position-absolute top-0 start-0 m-3 px-3 py-2" style="background: var(--uis-orange); color: #032e12; font-weight: 800;">
                <i class="bi bi-star-fill me-1"></i> BERITA UTAMA
              </span>
              @if(!empty($featured->gallery) && count($featured->gallery) > 0)
                <span class="news-gallery-badge">
                  <i class="bi bi-images me-1"></i> +{{ count($featured->gallery) }} Foto Galeri
                </span>
              @endif
            </div>
          </div>
          <div class="col-lg-6 p-4 p-md-5 d-flex flex-column justify-content-between">
            <div>
              <div class="d-flex align-items-center gap-3 text-muted small mb-2">
                <span><i class="bi bi-calendar3 me-1"></i> {{ $featured->created_at->format('d M Y') }}</span>
                <span>•</span>
                <span class="badge bg-light text-dark border">{{ $featured->category ?? 'Berita Universitas' }}</span>
              </div>
              <h3 class="fw-bold mb-3 text-dark">{{ $featured->title }}</h3>
              <p class="text-muted small mb-4" style="line-height: 1.7;">
                {{ $featured->description ?? Str::limit(strip_tags($featured->content), 180) }}
              </p>
            </div>
            <div>
              <a href="{{ route('homepage.news.detail', $featured->slug ?? $featured->id) }}" class="btn-primary-hero" style="font-size: 13.5px; padding: 10px 22px;">
                Baca Berita Lengkap <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      </div>
    @endif

    {{-- Filter Kategori & Pencarian --}}
    <div class="news-filter-bar" data-aos="fade-up">
      <div class="d-flex flex-column flex-lg-row align-items-lg-center justify-content-between gap-3">
        
        {{-- Category Pills --}}
        <div class="d-flex flex-wrap align-items-center gap-2">
          <a href="{{ route('homepage.news') }}" class="cat-pill-item {{ empty($selectedCat) && empty($search) ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i> Semua Kategori
          </a>

          @php
            $portalCategories = [
              'Berita Universitas'         => 'bi-newspaper',
              'Akademik & Mahasiswa'    => 'bi-mortarboard',
              'K3 & Keselamatan Kerja'  => 'bi-shield-check',
              'Kesehatan Lingkungan'    => 'bi-tree',
              'Penelitian & Riset'      => 'bi-journal-medical',
              'Pengabdian Masyarakat'   => 'bi-people',
              'Pengumuman & Agenda'     => 'bi-megaphone',
            ];
          @endphp

          @foreach($portalCategories as $cName => $cIcon)
            <a href="{{ route('homepage.news', ['category' => $cName]) }}" class="cat-pill-item {{ ($selectedCat ?? '') === $cName ? 'active' : '' }}">
              <i class="bi {{ $cIcon }}"></i> {{ $cName }}
            </a>
          @endforeach
        </div>

        {{-- Search Input --}}
        <form action="{{ route('homepage.news') }}" method="GET" class="news-search-input-box ms-lg-auto">
          @if(!empty($selectedCat))
            <input type="hidden" name="category" value="{{ $selectedCat }}">
          @endif
          <input type="text" name="q" value="{{ $search ?? '' }}" placeholder="Cari artikel...">
          <button type="submit" aria-label="Cari"><i class="bi bi-search"></i></button>
        </form>

      </div>

      {{-- Active Filter Notification --}}
      @if(!empty($selectedCat) || !empty($search))
        <div class="d-flex align-items-center justify-content-between pt-3 mt-3 border-top small text-muted">
          <div>
            @if(!empty($selectedCat))
              Menampilkan kategori: <strong class="text-dark">{{ $selectedCat }}</strong>
            @endif
            @if(!empty($search))
              {{ !empty($selectedCat) ? '• ' : '' }}Pencarian: <strong class="text-dark">"{{ $search }}"</strong>
            @endif
          </div>
          <a href="{{ route('homepage.news') }}" class="text-danger fw-bold text-decoration-none small">
            <i class="bi bi-x-circle me-1"></i> Reset Filter
          </a>
        </div>
      @endif
    </div>

    {{-- Grid Semua Berita --}}
    @if(isset($newsList) && $newsList->count() > 0)
      <div class="row g-4">
        @foreach($newsList as $article)
          <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <div class="news-card-portal">
              <div class="news-card-thumb-wrap">
                @if($article->thumbnail)
                  <img src="{{ asset('storage/' . $article->thumbnail) }}" alt="{{ $article->title }}" class="news-card-thumb">
                @else
                  <div class="w-100 h-100 d-flex align-items-center justify-content-center text-muted">
                    <i class="bi bi-newspaper fs-1"></i>
                  </div>
                @endif
                <span class="news-cat-badge">{{ $article->category ?? 'Berita' }}</span>
                @if(!empty($article->gallery) && count($article->gallery) > 0)
                  <span class="news-gallery-badge">
                    <i class="bi bi-images me-1"></i> +{{ count($article->gallery) }} Foto
                  </span>
                @endif
              </div>

              <div class="news-card-body">
                <div>
                  <div class="text-muted small mb-2">
                    <i class="bi bi-calendar3 me-1"></i> {{ $article->created_at->format('d M Y') }}
                    <span class="mx-1">•</span>
                    <i class="bi bi-person me-1"></i> {{ $article->user?->name ?? 'Admin UIS' }}
                  </div>
                  <h5 class="fw-bold mb-2 text-dark">{{ Str::limit($article->title, 65) }}</h5>
                  <p class="text-muted small mb-3">
                    {{ Str::limit($article->description ?? strip_tags($article->content), 110) }}
                  </p>
                </div>
                <div class="pt-3 border-top d-flex justify-content-between align-items-center">
                  <a href="{{ route('homepage.news.detail', $article->slug ?? $article->id) }}" class="fw-bold text-decoration-none" style="color: var(--uis-purple); font-size: 13.5px;">
                    Selengkapnya <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      {{-- Pagination --}}
      @if(method_exists($newsList, 'links'))
        <div class="mt-5 d-flex justify-content-center">
          {{ $newsList->links('pagination::bootstrap-5') }}
        </div>
      @endif
    @else
      @if(!isset($featured) || !$featured)
        <div class="p-5 text-center bg-white rounded-4 shadow-sm">
          <i class="bi bi-newspaper fs-1 text-muted mb-3 d-block"></i>
          <h4 class="fw-bold text-dark">Belum Ada Berita</h4>
          <p class="text-muted small">Berita dan artikel terbaru Universitas Ibnu Sina akan segera dipublikasikan di sini.</p>
        </div>
      @endif
    @endif

  </div>
</section>

@endsection
