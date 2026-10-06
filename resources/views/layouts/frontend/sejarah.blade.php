@extends('layouts.frontend.template')

@section('title', 'Sejarah & Milestone — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Sejarah perjalanan, pendirian, dan tonggak sejarah milestone Universitas Ibnu Sina.')
@section('meta_keywords', 'sejarah uis, milestone universitas ibnu sina, pendirian universitas ibnu sina')

@push('styles')
<style>
  .sejarah-hero {
    position: relative;
    background: var(--obsidian-dark);
    padding: 70px 0 50px;
    border-bottom: 2px solid var(--uis-purple);
  }
  .sejarah-hero-title {
    font-size: 38px;
    font-weight: 800;
    color: var(--white);
    margin-bottom: 8px;
  }
  .sejarah-hero-title em {
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

  /* Timeline Styles */
  .timeline-container {
    position: relative;
    padding: 20px 0;
  }
  .timeline-container::before {
    content: '';
    position: absolute;
    top: 0;
    bottom: 0;
    left: 50%;
    width: 3px;
    background: #046B26;
    transform: translateX(-50%);
    border-radius: 4px;
  }
  @media (max-width: 768px) {
    .timeline-container::before {
      left: 24px;
    }
  }

  .timeline-item {
    position: relative;
    margin-bottom: 40px;
  }
  .timeline-item:last-child {
    margin-bottom: 0;
  }

  .timeline-badge {
    position: absolute;
    top: 20px;
    left: 50%;
    transform: translateX(-50%);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: var(--uis-purple);
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 800;
    font-size: 13px;
    box-shadow: 0 0 0 5px rgba(4, 107, 38, 0.2);
    z-index: 2;
  }
  @media (max-width: 768px) {
    .timeline-badge {
      left: 24px;
      width: 40px;
      height: 40px;
      font-size: 11px;
    }
  }

  .timeline-content {
    background: #ffffff;
    border: 1px solid var(--border-light);
    border-radius: 20px;
    padding: 30px;
    box-shadow: var(--shadow-sm);
    width: 45%;
    position: relative;
    transition: all 0.3s ease;
  }
  .timeline-content:hover {
    transform: translateY(-4px);
    box-shadow: var(--shadow-md);
    border-color: var(--border-purple);
  }

  .timeline-item:nth-child(odd) .timeline-content {
    margin-right: auto;
  }
  .timeline-item:nth-child(even) .timeline-content {
    margin-left: auto;
  }

  @media (max-width: 768px) {
    .timeline-item:nth-child(odd) .timeline-content,
    .timeline-item:nth-child(even) .timeline-content {
      width: calc(100% - 64px);
      margin-left: 64px;
    }
  }

  .timeline-year-tag {
    display: inline-block;
    background: var(--uis-purple-light);
    color: var(--uis-purple);
    font-weight: 800;
    font-size: 13px;
    padding: 4px 14px;
    border-radius: 20px;
    margin-bottom: 12px;
  }
</style>
@endpush

@section('content')

<!-- ═══════════════════════════════════════════════
     HERO BANNER
═══════════════════════════════════════════════ -->
<div class="sejarah-hero">
  <div class="container">
    <div data-aos="fade-up">
      <h1 class="sejarah-hero-title">
        Sejarah & <em>Milestone</em>
      </h1>
      <div class="breadcrumb-custom">
        <a href="{{ route('homepage') }}"><i class="bi bi-house-fill me-1"></i>Beranda</a>
        <span>/</span>
        <a href="{{ route('homepage.tentang') }}">Profil</a>
        <span>/</span>
        <span class="active">Sejarah & Milestone</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     SEJARAH NARASI SECTION
═══════════════════════════════════════════════ -->
<section class="section-bg-white py-5">
  <div class="container">
    <div class="row align-items-center g-5">
      <div class="col-lg-6" data-aos="fade-right">
        <div class="section-label">Jejak Langkah Universitas</div>
        <h2 class="section-title">Perjalanan Berkelanjutan <em>Mencetak Profesional Muda</em></h2>
        <div class="divider-line"></div>
        <div class="section-desc" style="text-align: justify; line-height: 1.8; color: #4a5568;">
          <p>
            Universitas Ibnu Sina (UIS) Batam berdiri dari tonggak sejarah panjang pengabdian Yayasan Pendidikan Ibnu Sina Batam (YAPISNA) sejak tahun 1993 dalam memajukan kualitas sumber daya manusia di kawasan strategis perbatasan Kepulauan Riau.
          </p>
          <p>
            Melalui penggabungan tiga institusi pendidikan tinggi terkemuka—Sekolah Tinggi Teknik (STT), Sekolah Tinggi Ilmu Ekonomi (STIE), dan Sekolah Tinggi Ilmu Kesehatan (STIKES)—lembaga ini resmi bertransformasi menjadi <strong>Universitas Ibnu Sina</strong> berdasarkan Surat Keputusan Menristekdikti RI. Kini UIS menaungi Fakultas Teknik, Fakultas Ekonomi & Bisnis (FEB), Fakultas Ilmu Kesehatan (FIKES), dan Program Pascasarjana.
          </p>
        </div>
      </div>

      <div class="col-lg-6" data-aos="fade-left">
        <div class="p-4 rounded-4 text-white" style="background: #032e12; border: 2px solid var(--uis-green);">
          <div class="d-flex align-items-center gap-3 mb-3">
            <div class="p-3 rounded-3" style="background: var(--uis-yellow); color: #032e12;">
              <i class="bi bi-mortarboard-fill fs-2"></i>
            </div>
            <div>
              <h5 class="fw-bold text-white mb-0">Kampusnya Profesional Muda</h5>
              <div class="text-white-50 small">Pendidikan, Riset Terapan & Kemitraan Industri Global</div>
            </div>
          </div>
          <p class="text-white-50 small mb-0" style="line-height: 1.8;">
            Setiap fase perkembangan Universitas Ibnu Sina diarahkan untuk memperkuat mutu pembelajaran berbasis teknologi informasi, riset terapan bernilai guna bagi industri manufaktur dan maritim, serta membentuk lulusan berjiwa entrepreneur berbasis Imtaq.
          </p>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════
     TIMELINE MILESTONES
═══════════════════════════════════════════════ -->
<section class="section-bg-sand py-5">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="section-label mx-auto">Linimasa Perkembangan</div>
      <h2 class="section-title">Milestone & <em>Tonggak Sejarah</em></h2>
      <div class="divider-line centered"></div>
      <p class="section-desc mx-auto">
        Catatan pencapaian dan peristiwa penting dalam perjalanan Universitas Ibnu Sina UIS.
      </p>
    </div>

    @if(isset($milestones) && $milestones->count() > 0)
      <div class="timeline-container">
        @foreach($milestones as $index => $m)
          <div class="timeline-item" data-aos="{{ $index % 2 == 0 ? 'fade-right' : 'fade-left' }}">
            <div class="timeline-badge">
              {{ $m->tahun ?: ($index + 1) }}
            </div>
            <div class="timeline-content">
              <span class="timeline-year-tag"><i class="bi bi-calendar-event me-1"></i> {{ $m->tahun }}</span>
              <h4 class="fw-bold text-dark mb-2">{{ $m->judul }}</h4>
              <p class="text-muted small mb-0" style="line-height: 1.7; text-align: justify;">
                {{ $m->deskripsi }}
              </p>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="p-5 text-center bg-white rounded-4 shadow-sm">
        <i class="bi bi-hourglass fs-1 text-muted mb-3 d-block"></i>
        <h5 class="fw-bold text-dark">Data Milestone Belum Tersedia</h5>
        <p class="text-muted small">Data linimasa sejarah dapat ditambahkan melalui panel admin di menu <strong>Sejarah & Milestone</strong>.</p>
      </div>
    @endif

  </div>
</section>

@endsection
