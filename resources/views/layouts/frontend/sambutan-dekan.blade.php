@extends('layouts.frontend.template')

@section('title', 'Sambutan Rektor — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Sambutan resmi Rektor Universitas Ibnu Sina (UIS) Batam — Kampusnya Profesional Muda.')
@section('meta_keywords', 'sambutan rektor uis, rektor universitas ibnu sina, pimpinan universitas ibnu sina, uis batam')

@push('styles')
<style>
  .rektor-hero {
    position: relative;
    background: #046B26;
    padding: 70px 0 50px;
    border-bottom: 3px solid #FED802;
  }
  .rektor-hero-title {
    font-size: 38px;
    font-weight: 800;
    color: #ffffff;
    margin-bottom: 8px;
  }
  .rektor-hero-title em {
    font-style: normal;
    color: #FED802;
  }
  .breadcrumb-custom {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    font-size: 13.5px;
    color: rgba(255, 255, 255, 0.75);
  }
  .breadcrumb-custom a { color: rgba(255, 255, 255, 0.9); text-decoration: none; }
  .breadcrumb-custom a:hover { color: #FED802; }
  .breadcrumb-custom .active { color: #FED802; font-weight: 600; }

  /* Rektor Card */
  .rektor-portrait-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 24px;
    padding: 28px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    text-align: center;
    position: sticky;
    top: 90px;
  }
  .rektor-portrait-img {
    width: 100%;
    max-width: 290px;
    height: auto;
    max-height: 420px;
    object-fit: contain;
    border-radius: 18px;
    margin: 0 auto 20px;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.08);
    border: 3px solid #046B26;
    background: #f8faf9;
    display: block;
  }
  .rektor-avatar-fallback {
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
    border: 3px solid #FED802;
  }
  .rektor-name-title {
    font-size: 20px;
    font-weight: 800;
    color: #1a202c;
    line-height: 1.3;
    margin-bottom: 6px;
  }
  .rektor-role-badge {
    display: inline-block;
    background: #eef8f1;
    color: #046B26;
    border: 1px solid #cce8d5;
    font-size: 13px;
    font-weight: 700;
    padding: 5px 16px;
    border-radius: 50px;
    margin-bottom: 15px;
  }
  .rektor-quote-callout {
    background: #f8faf9;
    border-left: 5px solid #046B26;
    border-radius: 0 16px 16px 0;
    padding: 20px 24px;
    font-style: italic;
    color: #2d3748;
    font-size: 15.5px;
    line-height: 1.8;
    margin-bottom: 28px;
    border-top: 1px solid #edf2f7;
    border-right: 1px solid #edf2f7;
    border-bottom: 1px solid #edf2f7;
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
<div class="rektor-hero">
  <div class="container">
    <div data-aos="fade-up">
      <h1 class="rektor-hero-title">
        Sambutan <em>Rektor</em>
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
     SAMBUTAN REKTOR CONTENT
═══════════════════════════════════════════════ -->
<section class="section-bg-white py-5">
  <div class="container py-3">
    <div class="row g-5">

      {{-- Left Column: Rektor Portrait --}}
      <div class="col-lg-4" data-aos="fade-right">
        <div class="rektor-portrait-box">
          @if(!empty($sambutanDekan?->foto_dekan))
            <img src="{{ asset('storage/' . $sambutanDekan->foto_dekan) }}" alt="{{ $sambutanDekan->nama_dekan ?? 'Rektor Universitas Ibnu Sina' }}" class="rektor-portrait-img">
          @else
            <div class="rektor-avatar-fallback">
              <i class="bi bi-person-badge"></i>
              <span style="font-size: 14px; font-weight: 600; margin-top: 10px;">Foto Rektor</span>
            </div>
          @endif

          <h3 class="rektor-name-title">{{ $sambutanDekan->nama_dekan ?? 'Assoc. Prof. Dr. Ir. Larisang, S.T., M.T., IPU., ASEAN Eng.' }}</h3>
          <span class="rektor-role-badge">
            <i class="bi bi-award-fill me-1"></i> {{ $sambutanDekan->jabatan_dekan ?? 'Rektor Universitas Ibnu Sina (UIS) Batam' }}
          </span>

          <div class="pt-3 border-top mt-3 text-muted small text-start">
            <div class="mb-2"><i class="bi bi-mortarboard me-2" style="color: #046B26;"></i> Universitas Ibnu Sina (UIS) Batam</div>
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
        <div class="rektor-quote-callout">
          <i class="bi bi-quote fs-3 d-block mb-1" style="color: #046B26;"></i>
          "{{ strip_tags($sambutanDekan->kutipan_singkat ?? ($sambutanDekan->sambutan_dekan ?? 'Selamat datang di Universitas Ibnu Sina (UIS) Batam — Kampusnya Profesional Muda. Kami bertekad membentuk generasi intelektual yang unggul, inovatif, berjiwa entrepreneur, dan berkarakter Imtaq yang siap memimpin industri di kancah nasional maupun global.')) }}"
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

      </div>

    </div>
  </div>
</section>

@endsection
