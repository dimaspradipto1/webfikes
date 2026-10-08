@extends('layouts.frontend.template')

@section('title', ($gallery->judul ?? 'Dokumentasi Visual') . ' — Galeri Universitas Ibnu Sina')
@section('meta_description', Str::limit(strip_tags($gallery->deskripsi ?? $gallery->judul), 160))

@section('content')
<!-- Header Hero -->
<div class="detail-hero text-white">
  <div class="container">
    <div class="breadcrumb-custom mb-3">
      <a href="{{ route('homepage') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
      <span>/</span>
      <a href="{{ route('homepage.galeri') }}">Galeri Dokumentasi</a>
      <span>/</span>
      <span class="active">{{ Str::limit($gallery->judul ?? 'Detail Dokumentasi', 35) }}</span>
    </div>
    <div class="d-flex flex-wrap align-items-center gap-2 mb-3">
      <span class="badge px-3 py-2 rounded-pill font-weight-bold" style="background: var(--uis-purple); color: white; font-size: 12px;">
        <i class="bi bi-camera-fill me-1"></i>Dokumentasi Visual
      </span>
      <span class="badge bg-light text-dark px-3 py-2 rounded-pill fw-bold" style="font-size: 12px;">
        <i class="bi bi-calendar3 me-1"></i>{{ $gallery->created_at->translatedFormat('d F Y') }}
      </span>
    </div>
    <h1 class="fw-bold mb-0 text-white" style="font-size: 32px; line-height: 1.4;">
      {{ $gallery->judul ?? 'Dokumentasi Kegiatan Universitas Ibnu Sina' }}
    </h1>
  </div>
</div>

<section class="section-bg-sand py-5">
  <div class="container py-3">
    <div class="row g-4 g-lg-5">

      <!-- Kolom Kiri: Foto Utama & Deskripsi Rinci -->
      <div class="col-lg-8" data-aos="fade-up">
        
        <!-- Foto Dokumentasi Utama -->
        @if(!empty($gallery->url))
          <div class="mb-4 text-center position-relative">
            <img src="{{ asset('storage/' . $gallery->url) }}" alt="{{ $gallery->judul ?? 'Dokumentasi UIS' }}" class="galeri-img-main img-fluid">
            <a href="{{ asset('storage/' . $gallery->url) }}" target="_blank" class="btn btn-sm btn-dark position-absolute bottom-0 end-0 m-3 opacity-75 hover-opacity-100 rounded-pill px-3 shadow" style="font-size: 12px;">
              <i class="bi bi-arrows-fullscreen me-1"></i> Buka Ukuran Penuh
            </a>
          </div>
        @else
          <div class="p-5 rounded-4 text-center text-white mb-4" style="background: #046B26;">
            <i class="bi bi-camera-fill" style="font-size: 64px; color: #FED802;"></i>
            <h4 class="fw-bold mt-2 mb-0">Dokumentasi Universitas Ibnu Sina</h4>
          </div>
        @endif

        <!-- Card Deskripsi Lengkap -->
        <div class="bg-white p-4 p-md-5 rounded-4 shadow-sm border mb-4">
          <h3 class="fw-bold mb-3 text-dark" style="font-size: 22px;">
            <i class="bi bi-info-circle-fill text-primary me-2" style="color: var(--uis-purple) !important;"></i>Keterangan & Informasi Kegiatan
          </h3>
          <div class="divider-line mb-4"></div>

          @if(!empty($gallery->deskripsi))
            <div class="article-content" style="line-height: 1.85; font-size: 15.5px; color: #334155;">
              {!! nl2br(e($gallery->deskripsi)) !!}
            </div>
          @else
            <p class="text-muted">
              Dokumentasi visual kegiatan dan aktivitas sivitas akademika Universitas Ibnu Sina (UIS).
            </p>
          @endif

          <div class="mt-4 pt-3 border-top d-flex flex-wrap justify-content-between align-items-center gap-3">
            <a href="{{ route('homepage.galeri') }}" class="btn btn-outline-secondary rounded-pill px-4" style="font-size: 13.5px;">
              <i class="bi bi-arrow-left me-1"></i> Kembali ke Semua Galeri
            </a>

            @php
              $shareUrl  = urlencode(url()->current());
              $shareText = urlencode('Dokumentasi Universitas Ibnu Sina: ' . ($gallery->judul ?? 'Dokumentasi Visual'));
            @endphp
            <div class="d-flex align-items-center gap-2">
              <span class="text-muted small fw-semibold">Bagikan:</span>
              <a href="https://wa.me/?text={{ $shareText }}%20{{ $shareUrl }}" target="_blank" class="btn btn-sm btn-success rounded-circle" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;" title="Bagikan ke WhatsApp">
                <i class="bi bi-whatsapp"></i>
              </a>
              <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}" target="_blank" class="btn btn-sm btn-primary rounded-circle" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;" title="Bagikan ke Facebook">
                <i class="bi bi-facebook"></i>
              </a>
              <button type="button" onclick="navigator.clipboard.writeText(window.location.href); alert('Tautan dokumentasi berhasil disalin!');" class="btn btn-sm btn-secondary rounded-circle" style="width:34px;height:34px;display:flex;align-items:center;justify-content:center;" title="Salin Tautan">
                <i class="bi bi-link-45deg"></i>
              </button>
            </div>
          </div>
        </div>

      </div>

      <!-- Kolom Kanan: Info Metadata & Galeri Lainnya -->
      <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">

        <!-- Card Informasi Metadata -->
        <div class="info-badge-card mb-4">
          <h5 class="fw-bold mb-3 text-dark d-flex align-items-center gap-2" style="font-size: 17px;">
            <i class="bi bi-camera-reels text-warning"></i>
            <span>Informasi Dokumentasi</span>
          </h5>

          <div class="info-meta-row">
            <span class="info-meta-label">Kategori</span>
            <span class="info-meta-val text-primary" style="color: var(--uis-purple) !important;">Dokumentasi Visual</span>
          </div>

          <div class="info-meta-row">
            <span class="info-meta-label">Fakultas</span>
            <span class="info-meta-val">Universitas Ibnu Sina</span>
          </div>

          <div class="info-meta-row">
            <span class="info-meta-label">Tanggal Terbit</span>
            <span class="info-meta-val">{{ $gallery->created_at->translatedFormat('d F Y') }}</span>
          </div>
        </div>

        <!-- Card Galeri Lainnya -->
        @if(isset($otherGalleries) && $otherGalleries->count() > 0)
          <div class="info-badge-card">
            <h5 class="fw-bold mb-3 text-dark d-flex align-items-center justify-content-between" style="font-size: 17px;">
              <span class="d-flex align-items-center gap-2">
                <i class="bi bi-images text-primary" style="color: var(--uis-purple) !important;"></i>
                Dokumentasi Lainnya
              </span>
              <a href="{{ route('homepage.galeri') }}" class="small fw-semibold text-decoration-none" style="font-size: 12.5px; color: var(--uis-purple);">Lihat Semua</a>
            </h5>

            <div>
              @foreach($otherGalleries as $other)
                <a href="{{ route('homepage.galeri.detail', $other->slug ?? $other->id) }}" class="other-galeri-item">
                  @if(!empty($other->url))
                    <img src="{{ asset('storage/' . $other->url) }}" alt="{{ $other->judul }}" class="other-galeri-img">
                  @else
                    <div class="other-galeri-img d-flex align-items-center justify-content-center text-white" style="background: #046B26;">
                      <i class="bi bi-camera-fill small"></i>
                    </div>
                  @endif
                  <div class="d-flex flex-column justify-content-center">
                    <span class="other-galeri-title text-truncate-2">{{ Str::limit($other->judul, 50) }}</span>
                    <span class="text-muted small mt-1" style="font-size: 11.5px;">
                      <i class="bi bi-calendar3 me-1"></i>{{ $other->created_at->translatedFormat('d M Y') }}
                    </span>
                  </div>
                </a>
              @endforeach
            </div>
          </div>
        @endif

      </div>

    </div>
  </div>
</section>

@endsection
