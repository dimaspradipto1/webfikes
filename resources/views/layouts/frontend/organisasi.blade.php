@extends('layouts.frontend.template')

@section('title', 'Organisasi & Kegiatan Mahasiswa — Universitas Ibnu Sina')
@section('meta_description', 'Daftar Lembaga, Organisasi Mahasiswa (BEM, HIMA, UKM, Komunitas), serta wadah kreativitas dan kegiatan mahasiswa UIS Universitas Ibnu Sina.')

@push('styles')
<style>
  :root {
    --uis-purple: #046B26;
    --uis-purple-dark: #023814;
    --uis-orange: #FED802;
  }

  .ormawa-hero {
    background: #032e12;
    padding: 70px 0 50px;
    position: relative;
    overflow: hidden;
    color: #ffffff;
  }
  .ormawa-hero::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -10%;
    width: 500px;
    height: 500px;
    background: transparent;
    border-radius: 50%;
    pointer-events: none;
  }
  .ormawa-hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 6px 16px;
    border-radius: 50px;
    font-size: 13px;
    font-weight: 600;
    color: #ffc107;
    margin-bottom: 16px;
  }

  /* Filter Pills */
  .category-pill {
    padding: 8px 18px;
    border-radius: 50px;
    font-size: 13.5px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.25s ease;
    border: 1px solid #e0d5e8;
    color: #555;
    background: #fff;
    display: inline-block;
  }
  .category-pill:hover {
    border-color: var(--uis-purple);
    color: var(--uis-purple);
    background: rgba(4, 107, 38, 0.05);
  }
  .category-pill.active {
    background: var(--uis-purple);
    color: #fff !important;
    border-color: var(--uis-purple);
    box-shadow: 0 4px 14px rgba(4, 107, 38, 0.3);
  }

  /* Card Ormawa */
  .ormawa-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #d8e8dc;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
    transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
    display: flex;
    flex-direction: column;
    height: 100%;
    overflow: hidden;
  }
  .ormawa-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 12px 30px rgba(4, 107, 38, 0.12);
    border-color: #c9a4dc;
  }

  .ormawa-card-header {
    background: rgba(4, 107, 38, 0.06);
    padding: 24px 20px 16px;
    position: relative;
    text-align: center;
    border-bottom: 1px solid #f0e6f5;
  }
  .ormawa-logo-container {
    width: 80px;
    height: 80px;
    border-radius: 50%;
    background: #ffffff;
    padding: 6px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 12px;
    border: 2px solid #d4edd9;
  }
  .ormawa-logo-img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    border-radius: 50%;
  }

  .ormawa-badge-cat {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 11.5px;
    font-weight: 700;
    background: #046B26;
    color: #ffffff;
    letter-spacing: 0.3px;
  }

  .ormawa-card-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex: 1;
  }

  .ormawa-title {
    font-size: 17px;
    font-weight: 700;
    color: #1e1e1e;
    line-height: 1.35;
    margin-bottom: 6px;
  }
  .ormawa-title a {
    color: #1e1e1e;
    text-decoration: none;
    transition: color 0.2s;
  }
  .ormawa-title a:hover {
    color: var(--uis-purple);
  }

  .ormawa-leader-box {
    background: #faf7fc;
    border-radius: 10px;
    padding: 10px 14px;
    font-size: 12.5px;
    border-left: 3px solid var(--uis-purple);
    margin-bottom: 14px;
  }

  .ormawa-desc {
    font-size: 13.5px;
    color: #666;
    line-height: 1.55;
    margin-bottom: 16px;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  .ormawa-card-footer {
    padding: 14px 20px;
    background: #ffffff;
    border-top: 1px solid #f2ecf6;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
  }

  .btn-ormawa-detail {
    background: #046B26;
    color: #ffffff;
    font-size: 13px;
    font-weight: 600;
    padding: 7px 16px;
    border-radius: 8px;
    text-decoration: none;
    transition: all 0.25s ease;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    border: none;
  }
  .btn-ormawa-detail:hover {
    background: #FED802;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(254, 216, 2, 0.35);
  }

  /* Pagination */
  .page-link {
    color: var(--uis-purple);
    border-radius: 8px !important;
    margin: 0 3px;
    border: 1px solid #e0d0e8;
  }
  .page-item.active .page-link {
    background-color: var(--uis-purple);
    border-color: var(--uis-purple);
    color: #fff;
  }
</style>
@endpush

@section('content')
<!-- HERO SECTION -->
<section class="ormawa-hero">
  <div class="container position-relative">
    <div class="row align-items-center">
      <div class="col-lg-8" data-aos="fade-up">
        <div class="ormawa-hero-badge">
          <i class="bi bi-people-fill"></i>
          <span>Kemahasiswaan Universitas Ibnu Sina</span>
        </div>
        <h1 class="fw-bold mb-3 text-white" style="font-size: clamp(26px, 3.5vw, 42px); line-height: 1.2;">
          Organisasi & Kegiatan Mahasiswa
        </h1>
        <p class="text-white-50 mb-0" style="font-size: 16px; max-width: 650px;">
          Wadah pengembangan potensi, kepemimpinan, riset keilmuan, kreativitas, serta kepedulian sosial mahasiswa Universitas Ibnu Sina.
        </p>
      </div>
      <div class="col-lg-4 text-lg-end mt-4 mt-lg-0" data-aos="fade-left">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb justify-content-lg-end mb-0 bg-transparent p-0">
            <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item text-white-50">Kemahasiswaan</li>
            <li class="breadcrumb-item text-warning active fw-semibold" aria-current="page">Organisasi Mahasiswa</li>
          </ol>
        </nav>
      </div>
    </div>
  </div>
</section>

<!-- MAIN CONTENT SECTION -->
<section class="py-5" style="background-color: #fbf9fc; min-height: 500px;">
  <div class="container">
    <!-- Filter & Search Toolbar -->
    <div class="bg-white p-3 p-md-4 rounded-4 shadow-sm border mb-4" data-aos="fade-up">
      <div class="row g-3 align-items-center justify-content-between">
        <!-- Category Filter Pills -->
        <div class="col-lg-8">
          <div class="d-flex flex-wrap gap-2">
            <a href="{{ route('homepage.organisasi', array_filter(['q' => $search])) }}"
               class="category-pill {{ empty($selectedKategori) ? 'active' : '' }}">
              <i class="bi bi-grid-fill me-1"></i> Semua Lembaga
            </a>
            @foreach($kategoriList as $kat)
              <a href="{{ route('homepage.organisasi', array_filter(['kategori' => $kat, 'q' => $search])) }}"
                 class="category-pill {{ $selectedKategori == $kat ? 'active' : '' }}">
                {{ $kat }}
              </a>
            @endforeach
          </div>
        </div>

        <!-- Search Input -->
        <div class="col-lg-4">
          <form action="{{ route('homepage.organisasi') }}" method="GET">
            @if(!empty($selectedKategori))
              <input type="hidden" name="kategori" value="{{ $selectedKategori }}">
            @endif
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Cari nama organisasi, ketua..." value="{{ $search }}" style="border-radius: 50px 0 0 50px; border-color: #e0d0e8; padding-left: 18px; font-size: 13.5px;">
              <button class="btn btn-primary px-4" type="submit" style="background: var(--uis-purple); border-color: var(--uis-purple); border-radius: 0 50px 50px 0;">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Active Search Filter Alert -->
    @if(!empty($search) || !empty($selectedKategori))
      <div class="d-flex align-items-center justify-content-between bg-light p-3 rounded-3 border mb-4">
        <div class="small">
          Menampilkan hasil untuk:
          @if(!empty($selectedKategori))
            <span class="badge bg-primary me-1">{{ $selectedKategori }}</span>
          @endif
          @if(!empty($search))
            <span class="badge bg-warning text-dark">Kata kunci: "{{ $search }}"</span>
          @endif
        </div>
        <a href="{{ route('homepage.organisasi') }}" class="btn btn-sm btn-outline-danger" style="font-size: 12px;">
          <i class="bi bi-x-circle me-1"></i> Reset Filter
        </a>
      </div>
    @endif

    <!-- Organisasi Cards Grid -->
    @if($organisasiList->count() > 0)
      <div class="row g-4">
        @foreach($organisasiList as $item)
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 80 }}">
            <div class="ormawa-card">
              <!-- Card Top Header with Logo -->
              <div class="ormawa-card-header">
                <div class="ormawa-logo-container">
                  @if(!empty($item->logo))
                    <img src="{{ asset('storage/' . $item->logo) }}" alt="{{ $item->nama_organisasi }}" class="ormawa-logo-img">
                  @else
                    <div class="w-100 h-100 rounded-circle d-flex align-items-center justify-content-center text-white fw-bold" style="background: #032e12; font-size: 18px;">
                      {{ strtoupper(substr($item->singkatan ?: $item->nama_organisasi, 0, 2)) }}
                    </div>
                  @endif
                </div>
                <div>
                  <span class="ormawa-badge-cat">{{ $item->kategori }}</span>
                </div>
                @if(!empty($item->singkatan))
                  <div class="fw-bold mt-2 text-dark" style="font-size: 15px; letter-spacing: 0.5px;">
                    {{ $item->singkatan }}
                  </div>
                @endif
              </div>

              <!-- Card Body -->
              <div class="ormawa-card-body">
                <h2 class="ormawa-title">
                  <a href="{{ route('homepage.organisasi.detail', $item->slug) }}">
                    {{ $item->nama_organisasi }}
                  </a>
                </h2>

                <div class="ormawa-leader-box">
                  <div class="d-flex justify-content-between mb-1">
                    <span class="text-muted"><i class="bi bi-person-fill text-primary me-1"></i>Ketua:</span>
                    <strong class="text-dark">{{ $item->nama_ketua ?: 'Belum diisi' }}</strong>
                  </div>
                  @if(!empty($item->periode))
                    <div class="d-flex justify-content-between">
                      <span class="text-muted"><i class="bi bi-calendar3 text-warning me-1"></i>Periode:</span>
                      <span class="text-secondary fw-semibold">{{ $item->periode }}</span>
                    </div>
                  @endif
                </div>

                <div class="ormawa-desc">
                  {{ strip_tags($item->deskripsi ?: ($item->visi ?: 'Lembaga kemahasiswaan Universitas Ibnu Sina.')) }}
                </div>
              </div>

              <!-- Card Footer -->
              <div class="ormawa-card-footer">
                <!-- Social links -->
                <div class="d-flex align-items-center gap-2">
                  @if(!empty($item->instagram))
                    <a href="{{ $item->instagram }}" target="_blank" class="badge bg-light text-danger border p-2" title="Instagram Resmi">
                      <i class="bi bi-instagram" style="font-size: 13px;"></i>
                    </a>
                  @endif
                  @if(!empty($item->email))
                    <a href="mailto:{{ $item->email }}" class="badge bg-light text-primary border p-2" title="Email Resmi">
                      <i class="bi bi-envelope" style="font-size: 13px;"></i>
                    </a>
                  @endif
                  @if(!empty($item->link_pendaftaran))
                    <a href="{{ $item->link_pendaftaran }}" target="_blank" class="badge bg-success text-white border p-2" title="Pendaftaran / Oprec">
                      <i class="bi bi-pencil-square" style="font-size: 13px;"></i>
                    </a>
                  @endif
                </div>

                <a href="{{ route('homepage.organisasi.detail', $item->slug) }}" class="btn-ormawa-detail">
                  <span>Profil & Kegiatan</span>
                  <i class="bi bi-arrow-right"></i>
                </a>
              </div>
            </div>
          </div>
        @endforeach
      </div>

      <!-- Pagination -->
      <div class="d-flex justify-content-center mt-5">
        {{ $organisasiList->links('pagination::bootstrap-5') }}
      </div>
    @else
      <div class="text-center py-5 bg-white rounded-4 border shadow-sm my-4">
        <i class="bi bi-people text-muted" style="font-size: 50px;"></i>
        <h5 class="fw-bold mt-3 text-dark">Data Organisasi Tidak Ditemukan</h5>
        <p class="text-muted mb-3">Silakan gunakan kata kunci lain atau pilih kategori yang tersedia.</p>
        <a href="{{ route('homepage.organisasi') }}" class="btn btn-primary btn-sm px-4" style="background: var(--uis-purple); border-color: var(--uis-purple);">
          Lihat Semua Organisasi
        </a>
      </div>
    @endif
  </div>
</section>
@endsection
