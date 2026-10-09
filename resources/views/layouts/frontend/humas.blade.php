@extends('layouts.frontend.template')

@section('title', 'Biro Humas & Protokoler — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Portal Resmi Biro Hubungan Masyarakat dan Protokoler Universitas Ibnu Sina (UIS) Batam — Informasi publik, rilis pers, majalah profil, media sosial, dan layanan aduan.')
@section('meta_keywords', 'humas uis, biro humas universitas ibnu sina, ppid uis, siaran pers uis, berita kampus uis')

@section('content')
@php
  $cleanWa = $cleanWa ?? '';
  if (empty($cleanWa) && !empty($contact->no_wa)) {
      $cleanWa = preg_replace('/[^0-9]/', '', $contact->no_wa);
      if (strpos($cleanWa, '08') === 0) {
          $cleanWa = '628' . substr($cleanWa, 2);
      }
  }
  $pmbNavUrl = $pmbSetting->tombol_link_1 ?? route('homepage.kontak');
  if (!str_starts_with($pmbNavUrl, 'http') && !str_starts_with($pmbNavUrl, '/')) {
      $pmbNavUrl = '/' . $pmbNavUrl;
  }
  $pmbNavTarget = str_starts_with($pmbNavUrl, 'http') ? '_blank' : '_self';
@endphp

<style>
  /* ══════════════════════════════════════════════════════
     HUMAS THEME STYLES (Reflected from reference layout)
  ══════════════════════════════════════════════════════ */
  :root {
    --uis-humas-dark: #02260e;
    --uis-humas-green: #044b1c;
    --uis-humas-emerald: #066d2a;
    --uis-humas-gold: #e5a900;
    --uis-humas-yellow: #ffc107;
  }

  .humas-hero-section {
    position: relative;
    background: #1e293b;
    padding: 60px 0 90px 0;
    color: #ffffff;
    overflow: hidden;
  }
  .humas-hero-bg-overlay {
    display: none;
  }
  .humas-hero-title {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-size: 38px;
    font-weight: 800;
    letter-spacing: -0.5px;
    color: #ffffff;
    margin-bottom: 6px;
    text-shadow: 0 2px 12px rgba(0, 0, 0, 0.7);
  }
  .humas-hero-subtitle {
    font-size: 16px;
    color: #ffffff;
    margin-bottom: 32px;
    font-weight: 500;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.7);
  }
  .humas-hero-badge {
    display: inline-block;
    color: #ffffff;
    font-size: 15px;
    font-weight: 700;
    letter-spacing: 0.5px;
    margin-bottom: 18px;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.7);
  }

  /* Quick Services White Bar */
  .humas-quick-bar {
    background: #ffffff;
    border-radius: 20px;
    padding: 18px 24px;
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.18);
    display: flex;
    justify-content: space-around;
    align-items: center;
    flex-wrap: wrap;
    gap: 12px;
    max-width: 1060px;
    margin: 0 auto 28px auto;
  }
  .humas-quick-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none;
    color: #212529;
    padding: 8px 12px;
    border-radius: 12px;
    transition: all 0.25s ease;
    min-width: 90px;
  }
  .humas-quick-item:hover {
    transform: translateY(-4px);
    background: #f0fdf4;
    color: var(--uis-humas-green);
  }
  .humas-quick-icon-wrap {
    width: 44px;
    height: 44px;
    border-radius: 12px;
    background: #e8f5e9;
    color: #0b6828;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px;
    margin-bottom: 6px;
    transition: all 0.25s ease;
  }
  .humas-quick-item:hover .humas-quick-icon-wrap {
    background: #0b6828;
    color: #ffffff;
    box-shadow: 0 6px 14px rgba(11, 104, 40, 0.3);
  }
  .humas-quick-label {
    font-size: 12px;
    font-weight: 600;
    text-align: center;
    line-height: 1.2;
  }

  /* Floating Info Pills */
  .humas-pill-container {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 14px;
    max-width: 1060px;
    margin: 0 auto;
  }
  .humas-info-pill {
    background: #fbf0b9;
    color: #533f03;
    border: 1px solid #fae27d;
    padding: 10px 18px;
    border-radius: 50px;
    font-size: 13.5px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    transition: all 0.25s ease;
  }
  .humas-info-pill:hover {
    background: #fce881;
    transform: translateY(-2px);
    color: #3b2c01;
  }
  .humas-info-pill.pill-green {
    background: #074e1d;
    color: #ffffff;
    border-color: #0b6e2b;
  }
  .humas-info-pill.pill-green:hover {
    background: #095f24;
    color: #ffffff;
  }
  .humas-pill-btn {
    background: #212529;
    color: #ffffff;
    font-size: 11px;
    font-weight: 700;
    padding: 4px 12px;
    border-radius: 20px;
    text-transform: uppercase;
  }
  .humas-info-pill.pill-green .humas-pill-btn {
    background: #ffd600;
    color: #111;
  }

  /* Award Banner Section */
  .humas-award-section {
    padding: 60px 0 40px 0;
    background: #ffffff;
    text-align: center;
  }
  .humas-rank-title {
    color: #0b6828;
    font-size: 40px;
    font-weight: 800;
    margin-bottom: 4px;
    letter-spacing: -0.5px;
  }
  .humas-rank-subtitle {
    font-size: 16px;
    color: #4b5563;
    font-weight: 500;
    margin-bottom: 30px;
  }
  .humas-award-banner-card {
    background: radial-gradient(circle at center, #0a5c24 0%, #043815 65%, #02260e 100%);
    border-radius: 28px;
    position: relative;
    overflow: hidden;
    color: #ffffff;
    padding: 40px 24px;
    box-shadow: 0 20px 40px rgba(4, 56, 21, 0.2);
    border: 3px solid rgba(255, 215, 0, 0.35);
  }
  .humas-award-confetti {
    position: absolute;
    inset: 0;
    background-image: 
      radial-gradient(#ffd700 15%, transparent 16%),
      radial-gradient(#ffffff 15%, transparent 16%);
    background-size: 60px 60px;
    background-position: 0 0, 30px 30px;
    opacity: 0.12;
    pointer-events: none;
  }
  .humas-award-banner-footer {
    background: linear-gradient(90deg, #d49a00 0%, #f7c942 50%, #d49a00 100%);
    color: #1e1500;
    font-weight: 800;
    padding: 12px 20px;
    font-size: 14.5px;
    letter-spacing: 0.3px;
    border-radius: 0 0 24px 24px;
    margin: 30px -24px -40px -24px;
  }

  /* Social Media Explore Phones */
  .humas-social-section {
    padding: 60px 0;
    background: #f8fafc;
    text-align: center;
  }
  .humas-section-heading {
    font-size: 32px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 36px;
  }
  .humas-phone-card {
    background: #ffffff;
    border-radius: 28px;
    border: 4px solid #1e293b;
    padding: 24px 18px 20px 18px;
    box-shadow: 0 16px 32px rgba(15, 23, 42, 0.1);
    position: relative;
    transition: all 0.3s ease;
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100%;
  }
  .humas-phone-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 24px 44px rgba(15, 23, 42, 0.18);
  }
  .humas-phone-speaker {
    width: 60px;
    height: 6px;
    background: #cbd5e1;
    border-radius: 10px;
    margin-bottom: 16px;
  }
  .humas-phone-logo {
    width: 54px;
    height: 54px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 12px;
    color: #ffffff;
  }
  .humas-phone-avatar {
    width: 140px;
    height: 170px;
    object-fit: cover;
    border-radius: 18px;
    margin-bottom: 14px;
    background: #e2e8f0;
  }
  .humas-phone-handle {
    font-weight: 800;
    font-size: 16px;
    color: #0f172a;
    margin-bottom: 2px;
  }
  .humas-phone-label {
    font-size: 12px;
    color: #64748b;
    margin-bottom: 16px;
  }
  .humas-phone-btn {
    width: 100%;
    background: #ffd600;
    color: #111;
    font-weight: 700;
    font-size: 13.5px;
    padding: 9px 0;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.2s ease;
    display: block;
  }
  .humas-phone-btn:hover {
    background: #f1c40f;
    color: #000;
    transform: scale(1.02);
  }

  /* PMB Horizontal Banner */
  .humas-pmb-strip {
    background: linear-gradient(135deg, #044b1c 0%, #066d2a 100%);
    border-radius: 20px;
    padding: 24px 32px;
    color: #ffffff;
    box-shadow: 0 12px 28px rgba(4, 75, 28, 0.2);
    margin: 40px auto;
    max-width: 1100px;
  }

  /* 4 Media Cards (Hubungi Kami / Publikasi) */
  .humas-hubungi-section {
    padding: 60px 0;
    background: #ffffff;
    text-align: center;
  }
  .humas-media-box {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    padding: 24px 18px 20px 18px;
    text-align: center;
    transition: all 0.3s ease;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: space-between;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
  }
  .humas-media-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 36px rgba(0, 0, 0, 0.1);
    border-color: #0b6828;
  }
  .humas-media-art {
    width: 80px;
    height: 80px;
    margin: 0 auto 16px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
    font-size: 38px;
  }
  .humas-media-btn {
    background: #ffd600;
    color: #111;
    font-weight: 700;
    font-size: 13px;
    padding: 7px 22px;
    border-radius: 50px;
    text-decoration: none;
    display: inline-block;
    transition: all 0.2s ease;
    margin-top: 12px;
  }
  .humas-media-btn:hover {
    background: #e6c200;
    color: #000;
  }

  /* Helpdesk Strip */
  .humas-helpdesk-strip {
    background: linear-gradient(135deg, #044b1c 0%, #066d2a 100%);
    border-radius: 20px;
    padding: 24px 32px;
    color: #ffffff;
    margin: 40px auto;
    max-width: 1100px;
    box-shadow: 0 12px 28px rgba(4, 75, 28, 0.2);
  }

  /* Latest News on Dark Green Background */
  .humas-news-section {
    background: linear-gradient(180deg, #032b10 0%, #054218 100%);
    padding: 70px 0;
    color: #ffffff;
  }
  .humas-news-card {
    background: #ffffff;
    border-radius: 18px;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    box-shadow: 0 12px 28px rgba(0, 0, 0, 0.25);
    transition: all 0.3s ease;
    text-decoration: none;
    color: #1e293b;
  }
  .humas-news-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.35);
    color: #044b1c;
  }
  .humas-news-img {
    height: 200px;
    width: 100%;
    object-fit: cover;
  }
  .humas-news-body {
    padding: 20px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    justify-content: space-between;
  }
  .humas-news-title {
    font-size: 16px;
    font-weight: 700;
    line-height: 1.4;
    margin-bottom: 12px;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
  }

  /* E-Magazine Section with Side Students Cutout */
  .humas-emagz-section {
    padding: 70px 0 90px 0;
    background: #ffffff;
    position: relative;
    overflow: hidden;
  }
  .humas-emagz-container {
    background: #f8fafc;
    border: 2px dashed #cbd5e1;
    border-radius: 28px;
    padding: 40px 24px;
    text-align: center;
    box-shadow: 0 16px 36px rgba(0, 0, 0, 0.05);
  }
  .humas-emagz-btn-tab {
    font-size: 13.5px;
    font-weight: 700;
    padding: 8px 22px;
    border-radius: 50px;
    border: none;
    transition: all 0.2s ease;
  }
  .humas-emagz-btn-tab.active {
    background: #044b1c;
    color: #ffffff;
  }
  .humas-emagz-btn-tab:not(.active) {
    background: #e2e8f0;
    color: #475569;
  }
</style>

@php
  $heroBgUrl = $heroHumas?->background_image_url;
  $heroJudul = $heroHumas?->judul ?: 'Selamat Datang';
  $heroSubjudul = $heroHumas?->subjudul ?: 'di Biro Hubungan Masyarakat dan Protokoler Universitas Ibnu Sina';
  $heroBadge = $heroHumas?->badge_text ?: 'Layanan';
  $pillText1 = $heroHumas?->pill_text_1 ?: 'Informasi Khusus PMB TA 2026/2027';
  $pillUrl1 = $heroHumas?->pill_url_1 ?: $pmbNavUrl;
  $pillText2 = $heroHumas?->pill_text_2 ?: 'Pengumuman Prestasi & Kejuaraan Kampus';
  $pillUrl2 = $heroHumas?->pill_url_2 ?: route('homepage.prestasi');
  $pillText3 = $heroHumas?->pill_text_3 ?: 'Live Chat Layanan Humas';
  $pillUrl3 = $heroHumas?->pill_url_3 ?: (!empty($cleanWa) ? 'https://wa.me/' . $cleanWa : route('homepage.kontak'));
@endphp

<!-- ══════════════════════════════════════════════════════
     1. HERO BANNER HUMAS UIS
══════════════════════════════════════════════════════ -->
<section class="humas-hero-section text-center" style="@if(!empty($heroBgUrl)) background: linear-gradient(180deg, rgba(0, 0, 0, 0.45) 0%, rgba(0, 0, 0, 0.20) 50%, rgba(0, 0, 0, 0.55) 100%), url('{{ $heroBgUrl }}') center/cover no-repeat; @else background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%); @endif">
  <div class="container position-relative">
    <div data-aos="fade-down" data-aos-duration="700">
      <h1 class="humas-hero-title">{{ $heroJudul }}</h1>
      <p class="humas-hero-subtitle">{{ $heroSubjudul }}</p>
      
      @if(!empty($heroBadge))
      <div class="humas-hero-badge">
        <i class="bi bi-grid-fill me-1"></i> {{ $heroBadge }}
      </div>
      @endif
    </div>

    <!-- Quick Access Icons (Horizontal White Bar) -->
    <div class="humas-quick-bar" data-aos="fade-up" data-aos-duration="800">
      <a href="{{ route('homepage.tentang') }}" class="humas-quick-item" title="Profil Humas">
        <div class="humas-quick-icon-wrap"><i class="bi bi-building"></i></div>
        <span class="humas-quick-label">Profil</span>
      </a>
      <a href="{{ route('homepage.news', ['category' => 'Berita Humas']) }}" class="humas-quick-item" title="Siaran & Rilis Berita">
        <div class="humas-quick-icon-wrap"><i class="bi bi-newspaper"></i></div>
        <span class="humas-quick-label">Siaran Pers</span>
      </a>
      <a href="{{ route('homepage.faq') }}" class="humas-quick-item" title="Layanan Informasi & PPID">
        <div class="humas-quick-icon-wrap"><i class="bi bi-file-earmark-text"></i></div>
        <span class="humas-quick-label">PPID / Info</span>
      </a>
      <a href="{{ route('homepage.galeri') }}" class="humas-quick-item" title="Galeri Dokumentasi & Video">
        <div class="humas-quick-icon-wrap"><i class="bi bi-camera-video"></i></div>
        <span class="humas-quick-label">Galeri Media</span>
      </a>
      <a href="#eksplorasi-medsos" class="humas-quick-item" title="Media Sosial Resmi">
        <div class="humas-quick-icon-wrap"><i class="bi bi-share-fill"></i></div>
        <span class="humas-quick-label">Sosial Media</span>
      </a>
      <a href="#emagazine-section" class="humas-quick-item" title="E-Magazine UIS">
        <div class="humas-quick-icon-wrap"><i class="bi bi-journal-richtext"></i></div>
        <span class="humas-quick-label">E-Magazine</span>
      </a>
      <a href="{{ route('homepage.kontak') }}" class="humas-quick-item" title="Kemitraan & Liputan Media">
        <div class="humas-quick-icon-wrap"><i class="bi bi-people-fill"></i></div>
        <span class="humas-quick-label">Kemitraan</span>
      </a>
      <a href="{{ route('homepage.kontak') }}" class="humas-quick-item" title="Layanan Pengaduan & Aspirasi">
        <div class="humas-quick-icon-wrap"><i class="bi bi-chat-left-dots"></i></div>
        <span class="humas-quick-label">Pengaduan</span>
      </a>
    </div>

    <!-- Notification Info Action Pills -->
    <div class="humas-pill-container" data-aos="fade-up" data-aos-delay="150">
      @if(!empty($pillText1))
      <a href="{{ $pillUrl1 }}" class="humas-info-pill">
        <span><i class="bi bi-megaphone-fill text-warning me-1"></i> {{ $pillText1 }}</span>
        <span class="humas-pill-btn">Pilih</span>
      </a>
      @endif

      @if(!empty($pillText2))
      <a href="{{ $pillUrl2 }}" class="humas-info-pill">
        <span><i class="bi bi-trophy-fill text-warning me-1"></i> {{ $pillText2 }}</span>
        <span class="humas-pill-btn">Pilih</span>
      </a>
      @endif

      @if(!empty($pillText3))
      <a href="{{ $pillUrl3 }}" target="{{ str_starts_with($pillUrl3, 'http') ? '_blank' : '_self' }}" class="humas-info-pill pill-green">
        <span><i class="bi bi-whatsapp me-1"></i> {{ $pillText3 }}</span>
        <span class="humas-pill-btn">Pilih</span>
      </a>
      @endif
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════
     2. PERINGKAT #1 HUMAS TERBAIK (AWARD BANNER)
══════════════════════════════════════════════════════ -->
<section class="humas-award-section">
  <div class="container">
    <div data-aos="fade-up">
      <h2 class="humas-rank-title">Peringkat #1</h2>
      <p class="humas-rank-subtitle">Humas Terbaik di Lingkungan LLDIKTI Wilayah XVII Tahun 2024</p>
    </div>

    <div class="humas-award-banner-card mx-auto max-w-1000" data-aos="zoom-in" data-aos-duration="800">
      <div class="humas-award-confetti"></div>
      
      <div class="position-relative z-1 py-2">
        <h4 style="font-family: 'Brush Script MT', cursive, sans-serif; font-size: 36px; color: #ffd700; margin-bottom: 2px;">Alhamdulillah</h4>
        <p class="text-white-50 small mb-4">Apresiasi & Komitmen Pelayanan Informasi Terbaik</p>

        <div class="d-flex align-items-center justify-content-center gap-4 flex-wrap my-3">
          <!-- Smartphone Icon Badge -->
          <div class="d-none d-md-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 50%; background: rgba(255, 215, 0, 0.15); border: 2px solid rgba(255, 215, 0, 0.4); color: #ffd700; font-size: 32px;">
            <i class="bi bi-phone"></i>
          </div>

          <!-- Trophy Golden Center Badge -->
          <div class="text-center">
            <div style="display: inline-block; background: linear-gradient(135deg, #ffd700 0%, #ffae00 100%); color: #022b10; padding: 18px 36px; border-radius: 50px; font-weight: 900; font-size: 26px; box-shadow: 0 12px 28px rgba(0, 0, 0, 0.35); border: 4px solid #ffffff;">
              <i class="bi bi-award-fill me-2"></i> JUARA 1
            </div>
            <div class="mt-2 text-warning fw-bold text-uppercase" style="font-size: 13px; letter-spacing: 1px;">Kategori Kinerja Pengelolaan Media Humas</div>
          </div>

          <!-- Web Globe Icon Badge -->
          <div class="d-none d-md-flex align-items-center justify-content-center" style="width: 70px; height: 70px; border-radius: 50%; background: rgba(255, 215, 0, 0.15); border: 2px solid rgba(255, 215, 0, 0.4); color: #ffd700; font-size: 32px;">
            <i class="bi bi-globe2"></i>
          </div>
        </div>

        <p class="text-light fw-semibold mx-auto mt-3 mb-0" style="max-width: 650px; font-size: 15px;">
          Perguruan Tinggi Terbaik Kategori Pengelolaan Website & Media Sosial<br class="d-none d-md-block">
          dalam Anugerah Humas Diktiristek & LLDIKTI Wilayah XVII
        </p>
      </div>

      <div class="humas-award-banner-footer">
        <i class="bi bi-trophy-fill me-1"></i> Terus Berinovasi Menghadirkan Informasi Akurat, Cepat, dan Transparan
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════
     3. EKSPLORASI DI SOSIAL MEDIA
══════════════════════════════════════════════════════ -->
<section class="humas-social-section" id="eksplorasi-medsos">
  <div class="container">
    <h2 class="humas-section-heading" data-aos="fade-up">Eksplorasi di Sosial Media</h2>

    <div class="row g-4 justify-content-center">
      <!-- 1. Instagram -->
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="100">
        <div class="humas-phone-card">
          <div class="humas-phone-speaker"></div>
          <div class="humas-phone-logo" style="background: radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%);">
            <i class="bi bi-instagram"></i>
          </div>
          <div class="d-flex align-items-center justify-content-center w-100 mb-3" style="height: 170px; background: linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%); border-radius: 18px;">
            <i class="bi bi-camera-reels text-danger" style="font-size: 64px; opacity: 0.85;"></i>
          </div>
          <div class="humas-phone-handle">@universitasibnusina</div>
          <div class="humas-phone-label">Instagram Resmi UIS</div>
          <a href="https://www.instagram.com/universitasibnusina/" target="_blank" rel="noopener" class="humas-phone-btn">
            <i class="bi bi-instagram me-1"></i> Ikuti
          </a>
        </div>
      </div>

      <!-- 2. TikTok -->
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="200">
        <div class="humas-phone-card">
          <div class="humas-phone-speaker"></div>
          <div class="humas-phone-logo" style="background: #000000;">
            <i class="bi bi-tiktok"></i>
          </div>
          <div class="d-flex align-items-center justify-content-center w-100 mb-3" style="height: 170px; background: linear-gradient(135deg, #e0f2fe 0%, #f0fdfa 100%); border-radius: 18px;">
            <i class="bi bi-play-circle-fill text-dark" style="font-size: 64px; opacity: 0.85;"></i>
          </div>
          <div class="humas-phone-handle">@humas_uis</div>
          <div class="humas-phone-label">TikTok Resmi Kampus</div>
          <a href="https://www.tiktok.com" target="_blank" rel="noopener" class="humas-phone-btn">
            <i class="bi bi-tiktok me-1"></i> Ikuti
          </a>
        </div>
      </div>

      <!-- 3. Facebook / YouTube -->
      <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="300">
        <div class="humas-phone-card">
          <div class="humas-phone-speaker"></div>
          <div class="humas-phone-logo" style="background: #1877f2;">
            <i class="bi bi-facebook"></i>
          </div>
          <div class="d-flex align-items-center justify-content-center w-100 mb-3" style="height: 170px; background: linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%); border-radius: 18px;">
            <i class="bi bi-people-fill text-primary" style="font-size: 64px; opacity: 0.85;"></i>
          </div>
          <div class="humas-phone-handle">Universitas Ibnu Sina</div>
          <div class="humas-phone-label">Facebook & YouTube Humas</div>
          <a href="https://www.facebook.com/universitasibnusina/" target="_blank" rel="noopener" class="humas-phone-btn">
            <i class="bi bi-box-arrow-up-right me-1"></i> Kunjungi
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════
     4. BANNER HORIZONTAL PMB
══════════════════════════════════════════════════════ -->
<div class="container px-3">
  <div class="humas-pmb-strip" data-aos="fade-up">
    <div class="row align-items-center g-3">
      <div class="col-auto d-none d-md-block">
        <div class="d-flex align-items-center justify-content-center" style="width: 68px; height: 68px; background: rgba(255, 255, 255, 0.15); border-radius: 50%; font-size: 32px; color: #ffd600;">
          <i class="bi bi-mortarboard-fill"></i>
        </div>
      </div>
      <div class="col">
        <h4 class="fw-bold mb-1 text-white">Informasi Penerimaan Mahasiswa Baru</h4>
        <p class="text-white-50 mb-0 small">Pendaftaran Mahasiswa Baru Tahun Akademik 2026/2027 Telah Dibuka Secara Online.</p>
      </div>
      <div class="col-md-auto text-md-end">
        <a href="{{ $pmbNavUrl }}" target="{{ $pmbNavTarget }}" class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm" style="color: #032e12;">
          <i class="bi bi-pencil-square me-1"></i> Daftar Sekarang
        </a>
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════
     5. HUBUNGI KAMI / PUSAT PUBLIKASI (4 CARDS)
══════════════════════════════════════════════════════ -->
<section class="humas-hubungi-section">
  <div class="container">
    <h2 class="humas-section-heading" data-aos="fade-up">Hubungi Kami & Pusat Informasi</h2>

    <div class="row g-4 justify-content-center">
      <!-- 1. Siaran Pers & Liputan -->
      <div class="col-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="humas-media-box">
          <div>
            <div class="humas-media-art" style="background: #e0f2fe; color: #0284c7;">
              <i class="bi bi-broadcast"></i>
            </div>
            <h5 class="fw-bold fs-6 mb-1">Siaran Pers & Rilis</h5>
            <p class="text-muted small mb-0">Rilis berita dan konferensi pers resmi universitas.</p>
          </div>
          <a href="{{ route('homepage.news') }}" class="humas-media-btn">Baca</a>
        </div>
      </div>

      <!-- 2. Formulir PPID -->
      <div class="col-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <div class="humas-media-box">
          <div>
            <div class="humas-media-art" style="background: #dcfce7; color: #16a34a;">
              <i class="bi bi-file-earmark-spreadsheet"></i>
            </div>
            <h5 class="fw-bold fs-6 mb-1">Formulir PPID</h5>
            <p class="text-muted small mb-0">Permohonan informasi publik dan dokumen resmi.</p>
          </div>
          <a href="{{ route('homepage.faq') }}" class="humas-media-btn">Akses</a>
        </div>
      </div>

      <!-- 3. E-Katalog & Booklet -->
      <div class="col-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="humas-media-box">
          <div>
            <div class="humas-media-art" style="background: #fef3c7; color: #d97706;">
              <i class="bi bi-book-half"></i>
            </div>
            <h5 class="fw-bold fs-6 mb-1">Booklet Profil UIS</h5>
            <p class="text-muted small mb-0">Buku saku dan panduan akademik universitas.</p>
          </div>
          <a href="#emagazine-section" class="humas-media-btn">Lihat</a>
        </div>
      </div>

      <!-- 4. Warta & Tabloid -->
      <div class="col-6 col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="humas-media-box">
          <div>
            <div class="humas-media-art" style="background: #f1f5f9; color: #475569;">
              <i class="bi bi-newspaper"></i>
            </div>
            <h5 class="fw-bold fs-6 mb-1">Warta & Majalah</h5>
            <p class="text-muted small mb-0">Majalah berkala kegiatan civitas kampus.</p>
          </div>
          <a href="{{ route('homepage.news') }}" class="humas-media-btn">Buka</a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════
     6. BANNER HELPDESK / CALL CENTER
══════════════════════════════════════════════════════ -->
<div class="container px-3">
  <div class="humas-helpdesk-strip" data-aos="fade-up">
    <div class="row align-items-center g-3">
      <div class="col-auto d-none d-md-block">
        <div class="d-flex align-items-center justify-content-center" style="width: 68px; height: 68px; background: rgba(255, 255, 255, 0.15); border-radius: 50%; font-size: 32px; color: #ffd600;">
          <i class="bi bi-headset"></i>
        </div>
      </div>
      <div class="col">
        <h4 class="fw-bold mb-1 text-white">Ada yang ingin ditanyakan? Kami siap bantu!</h4>
        <p class="text-white-50 mb-0 small">Tim Layanan Humas & Informasi UIS siap melayani pertanyaan dan permohonan informasi Anda.</p>
      </div>
      <div class="col-md-auto text-md-end">
        @if(!empty($cleanWa))
          <a href="https://wa.me/{{ $cleanWa }}" target="_blank" class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm" style="color: #032e12;">
            <i class="bi bi-whatsapp me-1"></i> Hubungi WhatsApp
          </a>
        @else
          <a href="{{ route('homepage.kontak') }}" class="btn btn-warning fw-bold px-4 py-2 rounded-pill shadow-sm" style="color: #032e12;">
            <i class="bi bi-telephone me-1"></i> Kontak Humas
          </a>
        @endif
      </div>
    </div>
  </div>
</div>

<!-- ══════════════════════════════════════════════════════
     7. BERITA TERBARU HUMAS (CAMPUS GREEN BACKGROUND)
══════════════════════════════════════════════════════ -->
<section class="humas-news-section">
  <div class="container">
    <div class="text-center mb-5" data-aos="fade-up">
      <h2 class="fw-bold text-white mb-2" style="font-size: 32px;">Berita & Siaran Pers Humas</h2>
      <p class="text-white-50 small mb-0">Informasi resmi dan rilis liputan kegiatan kehumasan terkini Universitas Ibnu Sina</p>
    </div>

    <div class="row g-4 justify-content-center">
      @forelse($latestNews as $item)
        @php
          $thumbUrl = asset('frontend/img/gedung-uis.jpg');
          if (!empty($item->thumbnail)) {
              if (str_starts_with($item->thumbnail, 'http://') || str_starts_with($item->thumbnail, 'https://')) {
                  $thumbUrl = $item->thumbnail;
              } elseif (str_starts_with($item->thumbnail, 'assets/')) {
                  $thumbUrl = asset($item->thumbnail);
              } else {
                  $thumbUrl = asset('storage/' . $item->thumbnail);
              }
          }
        @endphp
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
          <a href="{{ route('homepage.news.detail', $item->slug ?? $item->id) }}" class="humas-news-card">
            <img src="{{ $thumbUrl }}" alt="{{ $item->title }}" class="humas-news-img" onerror="this.onerror=null; this.src='{{ asset('frontend/img/gedung-uis.jpg') }}';">
            <div class="humas-news-body">
              <div>
                <span class="badge bg-success mb-2" style="font-size: 11px;">{{ $item->category ?: 'Berita Humas' }}</span>
                <h4 class="humas-news-title">{{ $item->title }}</h4>
              </div>
              <div class="d-flex align-items-center justify-content-between text-muted small mt-2 pt-2 border-top">
                <span><i class="bi bi-calendar3 me-1"></i> {{ $item->created_at ? $item->created_at->translatedFormat('d M Y') : 'Terbaru' }}</span>
                <span class="text-success fw-bold">Baca <i class="bi bi-arrow-right"></i></span>
              </div>
            </div>
          </a>
        </div>
      @empty
        <div class="col-12 text-center text-white-50 py-4">
          <i class="bi bi-newspaper fs-1 mb-2 d-block"></i>
          Belum ada berita humas yang dipublikasikan.
        </div>
      @endforelse
    </div>

    <div class="text-center mt-5" data-aos="fade-up">
      <a href="{{ route('homepage.news', ['category' => 'Berita Humas']) }}" class="btn btn-warning fw-bold px-5 py-2 rounded-pill shadow-sm" style="color: #032e12;">
        Lihat Semua Berita Humas <i class="bi bi-arrow-right ms-1"></i>
      </a>
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════
     8. E-MAGAZINE PROFIL UNIVERSITAS IBNU SINA
══════════════════════════════════════════════════════ -->
<section class="humas-emagz-section" id="emagazine-section">
  <div class="container">
    <div class="humas-emagz-container" data-aos="fade-up">
      <h2 class="fw-bold mb-3" style="color: #0f172a; font-size: 28px;">E-Magazine Profil Universitas Ibnu Sina</h2>
      
      <div class="d-flex align-items-center justify-content-center gap-2 mb-4">
        <button class="humas-emagz-btn-tab active" id="tabEmagzBtn" onclick="switchMagTab('emagz')">
          <i class="bi bi-book-half me-1"></i> E-Magazine
        </button>
        <button class="humas-emagz-btn-tab" id="tabBukuSakuBtn" onclick="switchMagTab('buku-saku')">
          <i class="bi bi-journal-bookmark me-1"></i> Buku Saku
        </button>
      </div>

      <!-- Flipbook / Interactive Preview Container -->
      <div class="card border-0 shadow-sm mx-auto overflow-hidden" style="max-width: 780px; border-radius: 20px; background: #ffffff;">
        <div class="p-4 p-md-5 text-center">
          <div class="mb-4">
            <div class="d-inline-flex align-items-center justify-content-center shadow-lg" style="width: 140px; height: 180px; background: linear-gradient(135deg, #044b1c 0%, #032e12 100%); border-radius: 12px; color: #ffd600; border: 4px solid #fff;">
              <div class="text-center p-2">
                <i class="bi bi-journal-richtext fs-1 d-block mb-1"></i>
                <span style="font-size: 11px; font-weight: 800; color: #fff; line-height: 1.2; display: block;">PROFIL UIS 2026</span>
              </div>
            </div>
          </div>

          <h4 class="fw-bold mb-2 text-dark" id="emagzTitle">E-Magazine Edisi Eksklusif Profil Kampus</h4>
          <p class="text-muted small mx-auto mb-4" style="max-width: 500px;">
            Jelajahi informasi lengkap mengenai fasilitas laboratorium, profil fakultas, program beasiswa, dan prestasi mahasiswa UIS Batam.
          </p>

          <div class="d-flex align-items-center justify-content-center gap-2 flex-wrap">
            <a href="{{ asset('frontend/img/gedung-uis.jpg') }}" target="_blank" class="btn btn-outline-success rounded-pill px-4 fw-semibold">
              <i class="bi bi-eye me-1"></i> Pratinjau Interaktif
            </a>
            <a href="{{ route('homepage.tentang') }}" class="btn btn-success rounded-pill px-4 fw-semibold" style="background: #044b1c; border-color: #044b1c;">
              <i class="bi bi-download me-1"></i> Unduh Dokumen
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>
  function switchMagTab(tab) {
    const btn1 = document.getElementById('tabEmagzBtn');
    const btn2 = document.getElementById('tabBukuSakuBtn');
    const title = document.getElementById('emagzTitle');

    if (tab === 'emagz') {
      btn1.classList.add('active');
      btn2.classList.remove('active');
      title.innerText = 'E-Magazine Edisi Eksklusif Profil Kampus';
    } else {
      btn2.classList.add('active');
      btn1.classList.remove('active');
      title.innerText = 'Buku Saku Panduan Mahasiswa & Akademik UIS';
    }
  }
</script>

@endsection
