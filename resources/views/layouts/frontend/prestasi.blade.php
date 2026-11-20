@extends('layouts.frontend.template')

@section('title', 'Prestasi Mahasiswa — Fakultas Ilmu Kesehatan (FIKES) UIS')
@section('meta_description', 'Daftar capaian prestasi, kejuaraan, dan penghargaan mahasiswa Fakultas Ilmu Kesehatan (FIKES) Universitas Ibnu Sina di tingkat regional, nasional, dan internasional.')

@section('content')
<!-- Header Banner -->
<div class="prestasi-hero text-white">
  <div class="container text-center">
    <div class="badge px-3 py-2 rounded-pill mb-3" style="background: rgba(254, 216, 2, 0.18); color: #FED802; border: 1px solid rgba(254, 216, 2, 0.45); font-weight: 700; font-size: 13px; letter-spacing: 0.5px;">
      <i class="bi bi-trophy-fill me-1"></i> Hall of Fame & Prestasi
    </div>
    <h1 class="fw-bold mb-3 text-white" style="font-size: 38px; color: #ffffff !important; text-shadow: 0 2px 10px rgba(0,0,0,0.35);">Prestasi Mahasiswa FIKES</h1>
    <p class="mx-auto text-white mb-2" style="max-width: 680px; line-height: 1.7; color: rgba(255, 255, 255, 0.92) !important; font-size: 15.5px;">
      Koleksi prestasi gemilang, medali kejuaraan, dan publikasi ilmiah mahasiswa Fakultas Ilmu Kesehatan (FIKES) Universitas Ibnu Sina di tingkat regional, nasional, dan internasional.
    </p>
    <div class="breadcrumb-custom justify-content-center mt-3">
      <a href="{{ route('homepage') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
      <span>/</span>
      <span class="active">Prestasi Mahasiswa</span>
    </div>
  </div>
</div>

<!-- Main Content -->
<section class="section-bg-sand py-5">
  <div class="container py-3">

    <!-- Filter & Search Bar -->
    <div class="bg-white p-4 rounded-4 shadow-sm border mb-5">
      <div class="d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div class="d-flex flex-wrap align-items-center gap-2">
          <a href="{{ route('homepage.prestasi') }}" class="cat-pill-item {{ empty($selectedTahun) && empty($search) ? 'active' : '' }}">
            <i class="bi bi-grid-fill"></i> Semua Tahun
          </a>
          @foreach($tahunList ?? [] as $tahun)
            <a href="{{ route('homepage.prestasi', ['tahun' => $tahun]) }}" class="cat-pill-item {{ (string) ($selectedTahun ?? '') === (string) $tahun ? 'active' : '' }}">
              <i class="bi bi-calendar3"></i> {{ $tahun }}
            </a>
          @endforeach
        </div>

        <form action="{{ route('homepage.prestasi') }}" method="GET" class="d-flex align-items-center gap-2">
          @if(!empty($selectedTahun))
            <input type="hidden" name="tahun" value="{{ $selectedTahun }}">
          @endif
          <input type="text" name="q" value="{{ $search ?? '' }}" class="form-control form-control-sm rounded-pill px-3" placeholder="Cari prestasi mahasiswa..." style="max-width: 240px;">
          <button type="submit" class="btn btn-sm btn-primary rounded-pill px-3" style="background: var(--uis-green, #046B26); border-color: var(--uis-green, #046B26);">
            <i class="bi bi-search"></i>
          </button>
        </form>
      </div>

      @if(!empty($selectedTahun) || !empty($search))
        <div class="d-flex align-items-center justify-content-between pt-3 mt-3 border-top small text-muted">
          <div>
            @if(!empty($selectedTahun))
              Menampilkan tahun: <strong class="text-dark">{{ $selectedTahun }}</strong>
            @endif
            @if(!empty($search))
              {{ !empty($selectedTahun) ? '• ' : '' }}Pencarian: <strong class="text-dark">"{{ $search }}"</strong>
            @endif
          </div>
          <a href="{{ route('homepage.prestasi') }}" class="text-danger fw-bold text-decoration-none small">
            <i class="bi bi-x-circle me-1"></i> Reset Filter
          </a>
        </div>
      @endif
    </div>

    <!-- Grid Kartu Prestasi (Sinkron Otomatis dari Berita Kategori Prestasi Mahasiswa) -->
    @if(isset($prestasiList) && $prestasiList->count() > 0)
      <div class="row g-4">
        @foreach($prestasiList as $prestasi)
          @php
            $prestasiDate = $prestasi->published_at ?? $prestasi->created_at;
            $excerptSource = !empty($prestasi->description) ? $prestasi->description : ($prestasi->content ?? '');
          @endphp
          <div class="col-md-6 col-lg-4" data-aos="fade-up">
            <div class="prestasi-card-portal">
              <div class="prestasi-thumb-wrap">
                @if(!empty($prestasi->thumbnail))
                  <img src="{{ asset('storage/' . $prestasi->thumbnail) }}" alt="{{ $prestasi->title }}" class="prestasi-thumb">
                @else
                  <div class="d-flex align-items-center justify-content-center h-100 text-white flex-column gap-2" style="background: var(--uis-green, #046B26);">
                    <i class="bi bi-trophy-fill" style="font-size: 44px; color: #FED802;"></i>
                    <span class="small fw-semibold text-white-50">Prestasi Mahasiswa FIKES</span>
                  </div>
                @endif
                <span class="prestasi-tingkat-badge badge bg-warning text-dark">
                  <i class="bi bi-trophy-fill me-1"></i>{{ $prestasi->category ?? 'Prestasi Mahasiswa' }}
                </span>
                @if($prestasiDate)
                  <span class="prestasi-rank-badge">
                    <i class="bi bi-calendar3 me-1"></i>{{ $prestasiDate->translatedFormat('d M Y') }}
                  </span>
                @endif
              </div>

              <div class="p-4 d-flex flex-column justify-content-between flex-grow-1">
                <div>
                  <h4 class="fw-bold mb-2 text-dark" style="font-size: 16.5px; line-height: 1.45;">
                    <a href="{{ route('homepage.news.detail', $prestasi->slug) }}" class="text-dark text-decoration-none">
                      {{ $prestasi->title }}
                    </a>
                  </h4>

                  <div class="d-flex align-items-center justify-content-between text-muted small py-2 px-3 rounded-3 mb-3 mt-3" style="background: #f8f9fa; font-size: 11.5px;">
                    <span class="text-truncate me-2"><i class="bi bi-person-fill me-1 text-primary"></i>{{ $prestasi->user->name ?? 'Admin FIKES' }}</span>
                    <span class="fw-bold text-dark flex-shrink-0">{{ $prestasiDate ? $prestasiDate->format('Y') : '' }}</span>
                  </div>

                  @if(!empty($excerptSource))
                    <div class="text-muted small mb-3" style="font-size: 12.5px; line-height: 1.6;">
                      {{ Str::limit(strip_tags(html_entity_decode($excerptSource)), 115) }}
                    </div>
                  @endif
                </div>

                <div class="pt-3 border-top">
                  <a href="{{ route('homepage.news.detail', $prestasi->slug) }}" class="fw-bold text-decoration-none d-flex align-items-center justify-content-between" style="color: var(--uis-purple); font-size: 13.5px;">
                    <span>Baca Selengkapnya</span>
                    <i class="bi bi-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      @if(method_exists($prestasiList, 'hasPages') && $prestasiList->hasPages())
        <div class="mt-5 d-flex justify-content-center">
          {{ $prestasiList->links('pagination::bootstrap-5') }}
        </div>
      @endif
    @else
      <div class="p-5 text-center bg-white rounded-4 shadow-sm">
        <i class="bi bi-trophy fs-1 text-muted mb-3 d-block"></i>
        <h4 class="fw-bold text-dark">Belum Ada Data Prestasi</h4>
        <p class="text-muted small">Berita dengan kategori <strong>Prestasi Mahasiswa</strong> akan otomatis tampil di halaman ini.</p>
        <a href="{{ route('homepage.prestasi') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-4 mt-2">
          Lihat Semua Prestasi
        </a>
      </div>
    @endif

  </div>
</section>
@endsection
