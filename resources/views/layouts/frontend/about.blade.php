@extends('layouts.frontend.template')

@section('title', 'Tentang Kami — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Kenali lebih dekat Universitas Ibnu Sina (UIS) — profil, visi misi, nilai karakter akademik, dan fasilitas unggulan kami.')
@section('meta_keywords', 'tentang uis, profil universitas ibnu sina, visi misi uis, struktur organisasi uis, pendidikan kesehatan')

@push('styles')
<style>
  .about-hero {
    position: relative;
    background: var(--obsidian-dark);
    padding: 70px 0 50px;
    border-bottom: 2px solid var(--uis-purple);
  }
  .about-hero-title {
    font-size: 38px;
    font-weight: 800;
    color: var(--white);
    margin-bottom: 8px;
  }
  .about-hero-title em {
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
  .breadcrumb-custom a { color: rgba(255, 255, 255, 0.85); }
  .breadcrumb-custom a:hover { color: var(--uis-orange); }
  .breadcrumb-custom .active { color: var(--uis-orange); font-weight: 600; }

  .visual-card-frame {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 24px;
    padding: 36px;
    box-shadow: var(--shadow-md);
    text-align: center;
    position: relative;
    overflow: hidden;
  }
  .visual-card-frame::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 6px;
    background: var(--uis-purple);
  }
  .visual-badge-pill {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: var(--uis-purple-light);
    color: var(--uis-purple);
    font-weight: 700;
    font-size: 13px;
    padding: 6px 18px;
    border-radius: 50px;
    margin-bottom: 20px;
  }
</style>
@endpush

@section('content')
@php
  $cleanWa = '';
  if (!empty($contact->no_wa)) {
      $cleanWa = preg_replace('/[^0-9]/', '', $contact->no_wa);
      if (strpos($cleanWa, '08') === 0) {
          $cleanWa = '628' . substr($cleanWa, 2);
      }
  }
@endphp

<!-- ═══════════════════════════════════════════════
     ABOUT HERO BANNER
═══════════════════════════════════════════════ -->
<div class="about-hero">
  <div class="container">
    <div class="about-hero-content" data-aos="fade-up" data-aos-duration="800">
      <h1 class="about-hero-title">
        Tentang <em>UIS</em>
      </h1>
      <div class="breadcrumb-custom">
        <a href="{{ route('homepage') }}"><i class="bi bi-house-fill me-1"></i>Beranda</a>
        <span>/</span>
        <span class="active">Tentang Kami</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     PROFIL FAKULTAS
═══════════════════════════════════════════════ -->
<section class="section-bg-white">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-11 col-xl-10" data-aos="fade-up" data-aos-duration="800">
        <div class="section-label">Profil Universitas</div>
        <h2 class="section-title">{!! $about->judul_profil ?? 'Kampusnya Profesional Muda — <em>Universitas Ibnu Sina</em>' !!}</h2>
        <div class="divider-line"></div>
        <div class="section-desc mb-4" style="text-align: justify; font-size: 16px; line-height: 1.85;">
          {!! $about->deskripsi_profil_1 ?? 'Universitas Ibnu Sina (UIS) Batam berdedikasi menyelenggarakan pendidikan tinggi multidisiplin berkualitas di bidang Teknik, Ekonomi & Bisnis, Ilmu Kesehatan, dan Pascasarjana dengan kurikulum modern yang berorientasi pada capaian kompetensi, riset inovatif, dan kemitraan industri global.' !!}
        </div>
        @if($about?->deskripsi_profil_2)
        <div class="section-desc mb-4" style="text-align: justify; font-size: 16px; line-height: 1.85;">
          {!! $about->deskripsi_profil_2 !!}
        </div>
        @endif
      </div>
    </div>
  </div>
</section>

<!-- ═══════════════════════════════════════════════
     KEUNGGULAN FAKULTAS
═══════════════════════════════════════════════ -->
@if(isset($features) && $features->count() > 0)
<section class="section-bg-sand py-5">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="section-label mx-auto">Keunggulan UIS</div>
      <h2 class="section-title">Mengapa Memilih <em>Universitas Ibnu Sina?</em></h2>
      <div class="divider-line centered"></div>
      <p class="section-desc mx-auto">
        Kombinasi kurikulum berstandar industri, tenaga pendidik berkompeten, dan sarana pembelajaran mutakhir.
      </p>
    </div>

    <div class="row g-4">
      @foreach($features as $index => $feature)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
          <div class="value-card" style="height: 100%;">
            <div class="value-icon-wrap">
              <i class="bi {{ $feature->icon ?? 'bi-check-circle' }}"></i>
            </div>
            <div class="value-title">{{ $feature->judul }}</div>
            <p class="value-desc">{{ $feature->deskripsi }}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>
@endif

<!-- ═══════════════════════════════════════════════
     NAVIGASI CEPAT INFORMASI PROFIL
═══════════════════════════════════════════════ -->
<section class="section-bg-white py-5">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="section-label mx-auto">Eksplorasi Profil</div>
      <h2 class="section-title">Informasi Lengkap <em>Universitas</em></h2>
      <div class="divider-line centered"></div>
    </div>

    <div class="row g-4 justify-content-center">
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <a href="{{ route('homepage.visi-misi') }}" class="text-decoration-none">
          <div class="p-4 rounded-4 text-center border h-100 shadow-sm bg-white hover-lift" style="transition: all 0.3s ease;">
            <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: var(--uis-green-light); color: var(--uis-green); width: 60px; height: 60px; font-size: 24px;">
              <i class="bi bi-bullseye"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">Visi & Misi</h5>
            <p class="text-muted small mb-0">Arah strategis dan nilai budaya civitas akademika.</p>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <a href="{{ route('homepage.sambutan-dekan') }}" class="text-decoration-none">
          <div class="p-4 rounded-4 text-center border h-100 shadow-sm bg-white hover-lift" style="transition: all 0.3s ease;">
            <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: var(--uis-yellow-light); color: var(--uis-green); width: 60px; height: 60px; font-size: 24px;">
              <i class="bi bi-person-badge"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">Sambutan Rektor</h5>
            <p class="text-muted small mb-0">Pesan resmi dan komitmen pimpinan universitas.</p>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <a href="{{ route('homepage.struktur-organisasi') }}" class="text-decoration-none">
          <div class="p-4 rounded-4 text-center border h-100 shadow-sm bg-white hover-lift" style="transition: all 0.3s ease;">
            <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: #e0f2fe; color: #0284c7; width: 60px; height: 60px; font-size: 24px;">
              <i class="bi bi-diagram-3"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">Struktur Organisasi</h5>
            <p class="text-muted small mb-0">Bagan tata kelola dan susunan pimpinan universitas.</p>
          </div>
        </a>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <a href="{{ route('homepage.sejarah') }}" class="text-decoration-none">
          <div class="p-4 rounded-4 text-center border h-100 shadow-sm bg-white hover-lift" style="transition: all 0.3s ease;">
            <div class="p-3 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="background: #fef3c7; color: #d97706; width: 60px; height: 60px; font-size: 24px;">
              <i class="bi bi-hourglass-split"></i>
            </div>
            <h5 class="fw-bold text-dark mb-2">Sejarah & Milestone</h5>
            <p class="text-muted small mb-0">Linimasa perjalanan dan pencapaian universitas.</p>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>


<!-- ═══════════════════════════════════════════════
     CTA KONTAK
═══════════════════════════════════════════════ -->
<section class="counter-section" style="background: var(--obsidian-dark);">
  <div class="container text-center" data-aos="fade-up">
    <h2 class="text-white mb-3" style="font-size:32px; font-weight:800;">
      Ingin Mengetahui Lebih Jauh Tentang UIS?
    </h2>
    <p class="text-white-50 mx-auto mb-4" style="max-width: 600px; font-size:15px;">
      Hubungi kami untuk konsultasi program akademik, fasilitas laboratorium, serta kemitraan riset.
    </p>
    <div class="d-flex justify-content-center flex-wrap gap-3">
      @if(!empty($contact->no_wa))
        <a href="https://wa.me/{{ $cleanWa }}" target="_blank" class="btn-primary-hero">
          <i class="bi bi-whatsapp"></i>
          Konsultasi WhatsApp
        </a>
      @endif
      <a href="{{ route('homepage.kontak') }}" class="btn-outline-hero">
        <i class="bi bi-envelope"></i>
        Kontak Kami
      </a>
    </div>
  </div>
</section>

@endsection
