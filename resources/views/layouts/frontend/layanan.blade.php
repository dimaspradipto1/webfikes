@extends('layouts.frontend.template')

@section('title', 'Fakultas & Program Studi — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Jelajahi fakultas dan program studi unggulan serta fasilitas akademik terpadu di Universitas Ibnu Sina (UIS) Batam.')
@section('meta_keywords', 'program studi uis, fakultas teknik, fakultas ekonomi bisnis, fakultas ilmu kesehatan, magister manajemen, universitas ibnu sina batam')

@push('styles')
<style>
  .layanan-hero {
    position: relative;
    background: var(--obsidian-dark);
    padding: 70px 0 50px;
    border-bottom: 2px solid var(--uis-purple);
  }
  .layanan-hero-title {
    font-size: 38px;
    font-weight: 800;
    color: var(--white);
    margin-bottom: 8px;
  }
  .layanan-hero-title em {
    font-style: normal;
    color: var(--uis-orange);
  }
  .layanan-card-box {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 20px;
    padding: 32px;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }
  .layanan-card-box:hover {
    transform: translateY(-6px);
    border-color: var(--border-purple);
    box-shadow: var(--shadow-lg);
  }
  .layanan-card-head {
    display: flex;
    align-items: flex-start;
    gap: 18px;
    margin-bottom: 18px;
  }
  .layanan-card-icon {
    width: 58px;
    height: 58px;
    background: var(--uis-purple-light);
    color: var(--uis-purple);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    flex-shrink: 0;
  }
  .layanan-card-title {
    font-size: 20px;
    font-weight: 700;
    color: var(--text-main);
    margin-bottom: 4px;
  }
  .layanan-card-badge {
    display: inline-block;
    background: var(--uis-orange-light);
    color: var(--uis-orange-dark);
    font-size: 11px;
    font-weight: 700;
    padding: 2px 10px;
    border-radius: 50px;
    border: 1px solid var(--border-orange);
  }
  .layanan-card-desc {
    font-size: 14.5px;
    color: var(--text-muted);
    line-height: 1.7;
    margin-bottom: 20px;
  }
  .layanan-card-list {
    list-style: none;
    padding: 0;
    margin: 0 0 24px 0;
  }
  .layanan-card-list li {
    font-size: 13.5px;
    color: var(--text-main);
    display: flex;
    align-items: flex-start;
    gap: 8px;
    margin-bottom: 8px;
  }
  .layanan-card-list li i {
    color: var(--uis-purple);
    margin-top: 2px;
  }
  .layanan-detail-btn {
    background: var(--uis-purple-light);
    color: var(--uis-purple);
    border: 1px solid var(--border-purple);
    font-weight: 700;
    font-size: 13.5px;
    padding: 10px 20px;
    border-radius: 10px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.2s ease;
  }
  .layanan-detail-btn:hover {
    background: var(--uis-purple);
    color: var(--white);
    border-color: var(--uis-purple);
  }
</style>
@endpush

@section('content')

<!-- ═══════════════════════════════════════════════
     HERO BANNER
═══════════════════════════════════════════════ -->
<div class="layanan-hero">
  <div class="container">
    <div class="layanan-hero-content" data-aos="fade-up" data-aos-duration="800">
      <h1 class="layanan-hero-title">
        Program Studi & <em>Fasilitas</em>
      </h1>
      <div class="breadcrumb-custom">
        <a href="{{ route('homepage') }}" class="text-white-50"><i class="bi bi-house-fill me-1"></i>Beranda</a>
        <span class="mx-2 text-white-50">/</span>
        <span style="color: var(--uis-orange); font-weight:600;">Layanan & Fasilitas</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     LAYANAN LIST
═══════════════════════════════════════════════ -->
<section class="section-bg-white">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="section-label mx-auto">Akademik & Fasilitas</div>
      <h2 class="section-title">Pendidikan Berkualitas & <em>Fasilitas Modern</em></h2>
      <div class="divider-line centered"></div>
      <p class="section-desc mx-auto">
        Mencetak profesional muda yang unggul, kompeten, berjiwa entrepreneur, dan siap berkontribusi nyata bagi industri nasional maupun global.
      </p>
    </div>

    <div class="row g-4">
      @forelse($layanans as $layanan)
        @php
          $rincianItems = $layanan->rincian
            ? array_filter(array_map('trim', explode("\n", $layanan->rincian)))
            : [];
        @endphp
        <div class="col-lg-6" data-aos="fade-up">
          <div class="layanan-card-box">
            <div>
              <div class="layanan-card-head">
                <div class="layanan-card-icon"><i class="bi {{ $layanan->icon }}"></i></div>
                <div>
                  <h3 class="layanan-card-title">{{ $layanan->judul }}</h3>
                  @if($layanan->dasar_hukum)
                    <span class="layanan-card-badge">{{ $layanan->dasar_hukum }}</span>
                  @endif
                </div>
              </div>
              <div class="layanan-card-desc mb-3" style="line-height: 1.65; text-align: justify;">
                {!! $layanan->deskripsi !!}
              </div>
              @if(!empty($layanan->rincian))
                @if(str_contains($layanan->rincian, '<') && str_contains($layanan->rincian, '>'))
                  <div class="layanan-rich-rincian small mb-3">
                    {!! $layanan->rincian !!}
                  </div>
                @else
                  <ul class="layanan-card-list">
                    @foreach(array_slice($rincianItems, 0, 4) as $item)
                      <li><i class="bi bi-check-circle-fill"></i> {!! strip_tags($item) !!}</li>
                    @endforeach
                  </ul>
                @endif
              @endif
            </div>
            <div class="d-flex gap-2 flex-wrap">
              @if($layanan->link)
                <a href="{{ $layanan->link }}" target="_blank" rel="noopener noreferrer" class="layanan-detail-btn" style="background:var(--uis-purple); color:#fff; border-color:var(--uis-purple);">
                  Website Prodi <i class="bi bi-box-arrow-up-right ms-1"></i>
                </a>
              @endif
              <a href="{{ route('homepage.layanan.detail', $layanan->id) }}" class="layanan-detail-btn">
                Lihat Detail <i class="bi bi-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12 text-center py-5">
          <p class="text-muted">Belum ada data program studi atau fasilitas.</p>
        </div>
      @endforelse
    </div>
  </div>
</section>

@endsection
