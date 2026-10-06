@extends('layouts.frontend.template')

@section('title', 'Sambutan Rektor — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Sambutan resmi Dekan Universitas Ibnu Sina (UIS) Universitas Ibnu Sina.')
@section('meta_keywords', 'sambutan dekan uis, dekan universitas ibnu sina, pimpinan universitas ibnu sina')

@push('styles')
<style>
  .dekan-hero {
    position: relative;
    background: var(--obsidian-dark);
    padding: 70px 0 50px;
    border-bottom: 2px solid var(--uis-purple);
  }
  .dekan-hero-title {
    font-size: 38px;
    font-weight: 800;
    color: var(--white);
    margin-bottom: 8px;
  }
  .dekan-hero-title em {
    font-style: normal;
    color: var(--uis-orange);
  }
  .breadcrumb-custom {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    color: rgba(255, 255, 255, 0.6);
  }
  .breadcrumb-custom a { color: rgba(255, 255, 255, 0.85); text-decoration: none; }
  .breadcrumb-custom a:hover { color: var(--uis-orange); }
  .breadcrumb-custom .active { color: var(--uis-orange); font-weight: 600; }

  /* Dekan Card */
  .dekan-portrait-box {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 24px;
    padding: 28px;
    box-shadow: var(--shadow-md);
    text-align: center;
    position: sticky;
    top: 90px;
  }
  .dekan-portrait-img {
    width: 100%;
    max-width: 280px;
    height: 340px;
    object-fit: cover;
    border-radius: 18px;
    margin-bottom: 20px;
    box-shadow: var(--shadow-sm);
    border: 3px solid var(--uis-purple-light);
  }
  .dekan-avatar-fallback {
    width: 100%;
    max-width: 280px;
    height: 340px;
    margin: 0 auto 20px;
    background: #046B26;
    color: #ffffff;
    border-radius: 18px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    font-size: 80px;
  }
  .dekan-name-title {
    font-size: 20px;
    font-weight: 800;
    color: var(--text-main);
    line-height: 1.3;
    margin-bottom: 6px;
  }
  .dekan-role-badge {
    display: inline-block;
    background: var(--uis-purple-light);
    color: var(--uis-purple);
    font-size: 13px;
    font-weight: 700;
    padding: 5px 16px;
    border-radius: 50px;
    margin-bottom: 15px;
  }
  .dekan-quote-callout {
    background: var(--uis-purple-light);
    border-left: 4px solid var(--uis-purple);
    border-radius: 0 16px 16px 0;
    padding: 20px 24px;
    font-style: italic;
    color: #3b284c;
    font-size: 15.5px;
    line-height: 1.8;
    margin-bottom: 28px;
  }
  .sambutan-content-body {
    font-size: 15.5px;
    line-height: 1.9;
    color: #334155;
    text-align: justify;
  }
  .sambutan-content-body p {
    margin-bottom: 18px;
  }
</style>
@endpush

@section('content')

<!-- ═══════════════════════════════════════════════
     HERO BANNER
═══════════════════════════════════════════════ -->
<div class="dekan-hero">
  <div class="container">
    <div data-aos="fade-up">
      <h1 class="dekan-hero-title">
        Sambutan <em>Dekan</em>
      </h1>
      <div class="breadcrumb-custom">
        <a href="{{ route('homepage') }}"><i class="bi bi-house-fill me-1"></i>Beranda</a>
        <span>/</span>
        <a href="{{ route('homepage.tentang') }}">Profil</a>
        <span>/</span>
        <span class="active">Sambutan Rektor</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     SAMBUTAN DEKAN CONTENT
═══════════════════════════════════════════════ -->
<section class="section-bg-white py-5">
  <div class="container py-3">
    <div class="row g-5">

      {{-- Left Column: Dekan Portrait --}}
      <div class="col-lg-4" data-aos="fade-right">
        <div class="dekan-portrait-box">
          @if(!empty($sambutanDekan?->foto_dekan))
            <img src="{{ asset('storage/' . $sambutanDekan->foto_dekan) }}" alt="{{ $sambutanDekan->nama_dekan ?? 'Dekan Universitas Ibnu Sina' }}" class="dekan-portrait-img">
          @else
            <div class="dekan-avatar-fallback">
              <i class="bi bi-person-circle"></i>
              <span style="font-size: 14px; font-weight: 600; margin-top: 10px;">Foto Dekan</span>
            </div>
          @endif

          <h3 class="dekan-name-title">{{ $sambutanDekan->nama_dekan ?? 'Pimpinan Pimpinan Universitas Ibnu Sina' }}</h3>
          <span class="dekan-role-badge">
            <i class="bi bi-award-fill me-1"></i> {{ $sambutanDekan->jabatan_dekan ?? 'Dekan Universitas Ibnu Sina' }}
          </span>

          <div class="pt-3 border-top mt-3 text-muted small text-start">
            <div class="mb-2"><i class="bi bi-mortarboard me-2 text-primary"></i> Universitas Ibnu Sina (UIS) Batam</div>
            <div><i class="bi bi-geo-alt me-2 text-danger"></i> Kampus Utama Universitas Ibnu Sina</div>
          </div>
        </div>
      </div>

      {{-- Right Column: Full Message --}}
      <div class="col-lg-8" data-aos="fade-left">
        <div class="section-label">Amanat & Sambutan Resmi</div>
        <h2 class="section-title mb-4">
          Mewujudkan Generasi Unggul <em>Entrepreneur & Berkarakter Imtaq</em>
        </h2>

        {{-- Kutipan Singkat --}}
        <div class="dekan-quote-callout">
          <i class="bi bi-quote fs-3 d-block mb-1" style="color: var(--uis-green);"></i>
          "{{ strip_tags($sambutanDekan->kutipan_singkat ?? ($sambutanDekan->sambutan_dekan ?? 'Selamat datang di Universitas Ibnu Sina (UIS) Batam — Kampusnya Profesional Muda. Kami bertekad membentuk generasi intelektual yang unggul, inovatif, berjiwa entrepreneur, dan berkarakter Imtaq yang siap berkontribusi nyata bagi kemajuan industri dan bangsa di era global.')) }}"
        </div>

        {{-- Isi Lengkap Sambutan --}}
        <div class="sambutan-content-body" style="line-height: 1.85; font-size: 15.5px; color: #334155;">
          @if(!empty($sambutanDekan?->sambutan_dekan))
            {!! $sambutanDekan->sambutan_dekan !!}
          @else
            <p>
              <em>Assalamu’alaikum Warahmatullahi Wabarakatuh,</em><br>
              Salam sejahtera untuk kita semua.
            </p>
            <p>
              Puji dan syukur senantiasa kita panjatkan ke hadirat Allah SWT, Tuhan Yang Maha Esa, atas limpahan rahmat dan karunia-Nya sehingga <strong>Universitas Ibnu Sina (UIS) Batam</strong> terus tumbuh dan berkembang menjadi institusi pendidikan tinggi terkemuka di kawasan Kepulauan Riau dan Indonesia.
            </p>
            <p>
              Sebagai kampus yang berakar di jantung industri Batam dengan slogan <em>"Kampusnya Profesional Muda"</em>, Universitas Ibnu Sina mengintegrasikan keunggulan akademik di bidang <strong>Fakultas Teknik (Sains & Teknologi)</strong>, <strong>Fakultas Ekonomi dan Bisnis (FEB)</strong>, <strong>Fakultas Ilmu Kesehatan (FIKES)</strong>, dan <strong>Program Pascasarjana</strong> dengan kebutuhan nyata dunia usaha dan industri global.
            </p>
            <p>
              Kepada seluruh civitas akademika, mahasiswa, alumni, dan masyarakat luas, mari bersama-sama melangkah maju mewujudkan visi UIS 2029 sebagai universitas unggul, bermartabat, dan bereputasi internasional berbasis Imtaq.
            </p>
            <p class="fw-bold mt-4 mb-1">
              <em>Wassalamu’alaikum Warahmatullahi Wabarakatuh.</em>
            </p>
            <p class="text-muted">
              <strong>{{ $sambutanDekan->nama_dekan ?? 'Assoc. Prof. Dr. Ir. Larisang, S.T., M.T., IPU., ASEAN Eng.' }}</strong><br>
              <small>{{ $sambutanDekan->jabatan_dekan ?? 'Rektor Universitas Ibnu Sina (UIS) Batam' }}</small>
            </p>
          @endif
        </div>

        {{-- Link Navigasi Cepat --}}
        <div class="d-flex flex-wrap gap-3 mt-5 pt-4 border-top">
          <a href="{{ route('homepage.layanan') }}" class="btn-primary-hero" style="font-size: 13.5px; padding: 10px 22px;">
            <i class="bi bi-grid-fill me-1"></i> Program Studi Kami
          </a>
          <a href="{{ route('homepage.kontak') }}" class="btn-outline-hero" style="font-size: 13.5px; padding: 10px 22px; color: var(--uis-purple); border-color: var(--uis-purple);">
            <i class="bi bi-envelope me-1"></i> Hubungi Pimpinan
          </a>
        </div>

      </div>

    </div>
  </div>
</section>

@endsection
