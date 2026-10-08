@extends('layouts.frontend.template')

@section('title', $layanan->judul . ' — Universitas Ibnu Sina (UIS)')
@section('meta_description', Str::limit(strip_tags($layanan->deskripsi), 160))
@section('meta_keywords', 'uis, ' . strtolower($layanan->judul) . ', universitas ibnu sina')

@push('styles')
<style>
  .layanan-hero {
    position: relative;
    background: var(--obsidian-dark);
    padding: 70px 0 50px;
    border-bottom: 2px solid var(--uis-purple);
  }
  .layanan-hero-title {
    font-size: 34px;
    font-weight: 800;
    color: var(--white);
    margin-bottom: 8px;
    text-align: center;
  }
  .ld-sidebar {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 20px;
    padding: 24px;
    box-shadow: var(--shadow-sm);
  }
  .ld-sidebar-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 16px;
    color: var(--text-main);
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--border-light);
  }
  .ld-sidebar-list { list-style: none; padding: 0; margin: 0; }
  .ld-sidebar-list li { margin-bottom: 6px; }
  .ld-sidebar-link {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border-radius: 10px;
    font-size: 13.5px;
    font-weight: 600;
    color: var(--text-muted);
    transition: all 0.2s ease;
  }
  .ld-sidebar-link:hover, .ld-sidebar-link.active {
    background: var(--uis-purple-light);
    color: var(--uis-purple);
  }
  .ld-content-card {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 24px;
    padding: 40px;
    box-shadow: var(--shadow-sm);
  }
  .ld-badge {
    background: var(--uis-orange-light);
    color: var(--uis-orange-dark);
    border: 1px solid var(--border-orange);
    font-weight: 700;
    font-size: 12px;
    padding: 4px 14px;
    border-radius: 50px;
    display: inline-block;
    margin-bottom: 16px;
  }
</style>
@endpush

@section('content')
@php
  $rincianItems = $layanan->rincian
    ? array_filter(array_map('trim', explode("\n", $layanan->rincian)))
    : [];
@endphp

<!-- ═══════════════════════════════════════════════
     HERO BANNER
═══════════════════════════════════════════════ -->
<div class="layanan-hero">
  <div class="container">
    <div class="layanan-hero-content" data-aos="fade-up" data-aos-duration="700">
      <h1 class="layanan-hero-title">{{ $layanan->judul }}</h1>
      <div class="breadcrumb-custom" style="justify-content: center;">
        <a href="{{ route('homepage') }}" class="text-white-50"><i class="bi bi-house-fill me-1"></i>Beranda</a>
        <span class="mx-2 text-white-50">/</span>
        <a href="{{ route('homepage.layanan') }}" class="text-white-50">Layanan & Fasilitas</a>
        <span class="mx-2 text-white-50">/</span>
        <span style="color: var(--uis-orange); font-weight:600;">Detail</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════════ -->
<section class="section-bg-sand">
  <div class="container">
    <div class="row g-5">

      <!-- LEFT: Sidebar Navigation -->
      <div class="col-lg-4" data-aos="fade-right">
        <div class="ld-sidebar">
          <div class="ld-sidebar-title">
            <i class="bi bi-grid me-2 text-primary" style="color:var(--uis-purple) !important;"></i>Program & Fasilitas Lainnya
          </div>
          <ul class="ld-sidebar-list">
            @foreach($layanans as $item)
              <li>
                <a href="{{ route('homepage.layanan.detail', $item->id) }}"
                   class="ld-sidebar-link {{ $item->id === $layanan->id ? 'active' : '' }}">
                  <i class="bi {{ $item->icon }}"></i>
                  <span>{{ $item->judul }}</span>
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      <!-- RIGHT: Main Detail -->
      <div class="col-lg-8" data-aos="fade-left">
        <div class="ld-content-card">
          @if($layanan->dasar_hukum)
            <span class="ld-badge"><i class="bi bi-award-fill me-1"></i> {{ $layanan->dasar_hukum }}</span>
          @endif

          <h2 class="fw-bold mb-3">{{ $layanan->judul }}</h2>
          <div class="divider-line"></div>

          <div class="fs-6 text-muted mb-4" style="line-height: 1.8; text-align: justify;">
            {!! $layanan->deskripsi !!}
          </div>

          @if(!empty($layanan->rincian))
            <h4 class="fw-bold mb-3 mt-4">Keunggulan & Cakupan Kurikulum / Layanan</h4>
            @if(str_contains($layanan->rincian, '<') && str_contains($layanan->rincian, '>'))
              <div class="p-3 rounded-3 mb-4" style="background: var(--surface-light); border: 1px solid var(--border-light);">
                {!! $layanan->rincian !!}
              </div>
            @else
              <div class="row g-3 mb-4">
                @foreach($rincianItems as $item)
                  <div class="col-12">
                    <div class="p-3 rounded-3" style="background: var(--surface-light); border: 1px solid var(--border-light); display: flex; align-items: flex-start; gap: 12px;">
                      <i class="bi bi-check2-circle fs-5" style="color: var(--uis-purple); margin-top: -2px;"></i>
                      <span class="fw-medium text-dark">{!! strip_tags($item) !!}</span>
                    </div>
                  </div>
                @endforeach
              </div>
            @endif
          @endif

          <div class="p-4 rounded-4 mt-5" style="background: var(--obsidian-dark); color: white;">
            <h5 class="fw-bold text-white mb-2">Tertarik dengan Program Ini?</h5>
            <p class="text-white-50 small mb-3">Dapatkan informasi pendaftaran, kurikulum, dan jadwal seleksi dengan menghubungi tim layanan UIS.</p>
            <div class="d-flex flex-wrap gap-2">
              @if($layanan->link)
                <a href="{{ $layanan->link }}" target="_blank" rel="noopener noreferrer" class="btn-primary-hero" style="font-size: 13.5px; padding: 10px 20px; background: #046B26; color: #ffffff; border:none;">
                  <i class="bi bi-box-arrow-up-right"></i> Website Resmi Prodi
                </a>
              @endif
              <a href="{{ route('homepage.kontak') }}" class="btn-primary-hero" style="font-size: 13.5px; padding: 10px 20px;">
                <i class="bi bi-envelope"></i> Hubungi Kami
              </a>
              <a href="{{ route('homepage.layanan') }}" class="btn-outline-hero" style="font-size: 13.5px; padding: 10px 20px;">
                <i class="bi bi-arrow-left"></i> Kembali ke Daftar
              </a>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>

@endsection
