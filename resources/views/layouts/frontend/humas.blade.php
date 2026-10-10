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

  .humas-hero-section .container {
    max-width: 1320px;
  }

  /* Quick Services White Bar (8 Items Single Row) */
  .humas-quick-bar {
    background: #ffffff;
    border-radius: 24px;
    padding: 18px 16px;
    box-shadow: 0 16px 40px rgba(0, 0, 0, 0.20);
    display: grid !important;
    grid-template-columns: repeat(8, minmax(0, 1fr)) !important;
    align-items: stretch;
    gap: 8px;
    width: 100%;
    max-width: 1280px;
    margin: 0 auto 30px auto;
  }
  .humas-quick-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: flex-start;
    text-decoration: none;
    color: #212529;
    padding: 8px 4px;
    border-radius: 14px;
    transition: all 0.25s ease;
    width: 100%;
    min-width: 0;
  }
  .humas-quick-item:hover {
    transform: translateY(-4px);
    background: #f0fdf4;
    color: var(--uis-humas-green);
  }
  .humas-quick-icon-wrap {
    width: 46px;
    height: 46px;
    border-radius: 14px;
    background: #e8f5e9;
    color: #0b6828;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 8px;
    flex-shrink: 0;
    transition: all 0.25s ease;
  }
  .humas-quick-item:hover .humas-quick-icon-wrap {
    background: #0b6828;
    color: #ffffff;
    box-shadow: 0 6px 14px rgba(11, 104, 40, 0.3);
  }
  .humas-quick-label {
    font-size: 11.5px;
    font-weight: 700;
    text-align: center;
    line-height: 1.25;
    color: #1e293b;
    word-break: normal;
  }

  @media (max-width: 991.98px) {
    .humas-quick-bar {
      display: flex !important;
      flex-wrap: nowrap !important;
      overflow-x: auto !important;
      justify-content: flex-start !important;
      padding: 14px 16px !important;
      gap: 12px !important;
      -webkit-overflow-scrolling: touch;
      scrollbar-width: none;
    }
    .humas-quick-bar::-webkit-scrollbar {
      display: none;
    }
    .humas-quick-item {
      flex: 0 0 100px !important;
      min-width: 100px !important;
    }
  }

  /* Floating Info Action Pills (Matching exact reference design) */
  .humas-pill-container {
    display: flex;
    justify-content: center;
    align-items: center;
    flex-wrap: wrap;
    gap: 16px;
    max-width: 1100px;
    margin: 0 auto;
  }
  .humas-info-pill {
    padding: 7px 8px 7px 22px;
    border-radius: 50px;
    font-size: 14px;
    font-weight: 700;
    display: inline-flex;
    align-items: center;
    gap: 14px;
    text-decoration: none;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.18);
    transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
  }
  .humas-info-pill:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.25);
  }
  
  /* Pill Variant 1: Lime-Yellow Style */
  .humas-info-pill.pill-lime {
    background: linear-gradient(90deg, #d8e51b 0%, #b2cb0c 100%);
    color: #1a1a1a;
    border: 1px solid rgba(0, 0, 0, 0.08);
  }
  .humas-info-pill.pill-lime .humas-pill-btn {
    background: #231815;
    color: #ffffff;
    font-weight: 700;
    font-size: 12.5px;
    padding: 6px 20px;
    border-radius: 50px;
    letter-spacing: 0.2px;
  }
  .humas-info-pill.pill-lime:hover {
    background: linear-gradient(90deg, #e0ee1e 0%, #bdd70e 100%);
    color: #000000;
  }

  /* Pill Variant 2 & 3: Deep Emerald Green Style */
  .humas-info-pill.pill-emerald {
    background: linear-gradient(90deg, #057d38 0%, #035a26 100%);
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.15);
  }
  .humas-info-pill.pill-emerald .humas-pill-btn {
    background: #fab005;
    color: #ffffff;
    font-weight: 700;
    font-size: 12.5px;
    padding: 6px 20px;
    border-radius: 50px;
    letter-spacing: 0.2px;
  }
  .humas-info-pill.pill-emerald:hover {
    background: linear-gradient(90deg, #069041 0%, #046b2e 100%);
    color: #ffffff;
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
    padding: 22px 18px 20px 18px;
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
    border-color: #FED802;
    box-shadow: 0 24px 44px rgba(254, 216, 2, 0.25), 0 16px 32px rgba(15, 23, 42, 0.12);
  }
  .humas-phone-speaker {
    width: 54px;
    height: 5px;
    background: #cbd5e1;
    border-radius: 10px;
    margin-bottom: 14px;
  }
  .humas-phone-logo {
    width: 52px;
    height: 52px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 26px;
    margin-bottom: 14px;
    color: #ffffff;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
  }
  .humas-phone-screen {
    position: relative;
    width: 100%;
    height: 340px;
    border-radius: 18px;
    overflow: hidden;
    margin-bottom: 14px;
    background: #000000;
    display: block;
    text-decoration: none;
    box-shadow: inset 0 0 0 1px rgba(255, 255, 255, 0.1), 0 8px 18px rgba(0, 0, 0, 0.12);
  }
  .humas-phone-screen iframe {
    width: 100% !important;
    height: 100% !important;
    border: none !important;
    display: block;
    border-radius: 18px;
  }
  .humas-phone-video-media {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease, filter 0.3s ease;
    display: block;
  }
  .humas-phone-screen:hover .humas-phone-video-media {
    transform: scale(1.06);
    filter: brightness(0.92);
  }
  .humas-phone-play-btn {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: #FED802;
    color: #111111;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    padding-left: 3px;
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.4);
    transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    z-index: 3;
  }
  .humas-phone-screen:hover .humas-phone-play-btn {
    transform: translate(-50%, -50%) scale(1.15);
    background: #ffe338;
    box-shadow: 0 0 25px rgba(254, 216, 2, 0.85);
  }
  .humas-phone-video-overlay {
    position: absolute;
    inset: 0;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    padding: 10px 12px;
    background: linear-gradient(180deg, rgba(15, 23, 42, 0.6) 0%, rgba(15, 23, 42, 0.05) 40%, rgba(15, 23, 42, 0.9) 100%);
    z-index: 2;
    text-align: left;
    pointer-events: none;
  }
  .humas-phone-video-title {
    color: #ffffff;
    font-size: 12.5px;
    font-weight: 700;
    line-height: 1.3;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.8);
    margin-bottom: 3px;
  }
  .humas-phone-video-meta {
    color: rgba(255, 255, 255, 0.9);
    font-size: 10.5px;
    font-weight: 600;
  }
  .humas-phone-handle {
    font-weight: 800;
    font-size: 15.5px;
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
    background: #FED802;
    color: #111;
    font-weight: 700;
    font-size: 13.5px;
    padding: 9px 0;
    border-radius: 50px;
    text-decoration: none;
    transition: all 0.2s ease;
    display: block;
    box-shadow: 0 4px 10px rgba(254, 216, 2, 0.35);
  }
  .humas-phone-btn:hover {
    background: #ffd600;
    color: #000;
    transform: scale(1.02);
    box-shadow: 0 6px 14px rgba(254, 216, 2, 0.5);
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
  $heroSubjudul = $heroHumas?->subjudul ?: 'di Biro Hubungan Masyarakat dan Protokoler Universitas Islam Riau';
  $heroBadge = $heroHumas?->badge_text ?: 'Layanan';
  $pillText1 = $heroHumas?->pill_text_1 ?: 'Twibbon & Logo PKKMB UIR 2026';
  $pillUrl1 = $heroHumas?->pill_url_1 ?: route('homepage.unduhan', ['kategori' => 'image']);
  $pillText2 = $heroHumas?->pill_text_2 ?: 'Panduan Penggunaan Logo & Merek';
  $pillUrl2 = $heroHumas?->pill_url_2 ?: route('homepage.unduhan', ['kategori' => 'template']);
  $pillText3 = $heroHumas?->pill_text_3 ?: 'Logo UIR';
  $pillUrl3 = $heroHumas?->pill_url_3 ?: route('homepage.unduhan', ['kategori' => 'image']);
@endphp

<!-- ══════════════════════════════════════════════════════
     1. HERO BANNER HUMAS UIR
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
      <a href="{{ route('homepage.unduhan') }}" class="humas-quick-item" title="Pusat Unduhan & Asset Media">
        <div class="humas-quick-icon-wrap"><i class="bi bi-cloud-arrow-down"></i></div>
        <span class="humas-quick-label">Unduhan</span>
      </a>
      <a href="{{ route('homepage.desain-grafis') }}" class="humas-quick-item" title="Pusat Layanan & Templat Desain Grafis">
        <div class="humas-quick-icon-wrap"><i class="bi bi-newspaper"></i></div>
        <span class="humas-quick-label">Desain Grafis</span>
      </a>
      <a href="{{ route('homepage.faq') }}" class="humas-quick-item" title="Layanan Informasi & PPID">
        <div class="humas-quick-icon-wrap"><i class="bi bi-file-earmark-text"></i></div>
        <span class="humas-quick-label">Template Dokumen</span>
      </a>
      <a href="{{ route('homepage.desain-grafis') }}" class="humas-quick-item" title="Panduan Desain & Video">
        <div class="humas-quick-icon-wrap"><i class="bi bi-camera-video"></i></div>
        <span class="humas-quick-label">Panduan Desain & Video</span>
      </a>
      <a href="{{ route('homepage.galeri.humas') }}" class="humas-quick-item" title="Galeri & Kegiatan Humas">
        <div class="humas-quick-icon-wrap"><i class="bi bi-images"></i></div>
        <span class="humas-quick-label">Galeri Kegiatan</span>
      </a>
      <a href="#emagazine-section" class="humas-quick-item" title="E-Magazine UIS">
        <div class="humas-quick-icon-wrap"><i class="bi bi-journal-richtext"></i></div>
        <span class="humas-quick-label">Permintaan Rilis</span>
      </a>
      <a href="{{ route('homepage.kontak') }}" class="humas-quick-item" title="Kemitraan & Liputan Media">
        <div class="humas-quick-icon-wrap"><i class="bi bi-people-fill"></i></div>
        <span class="humas-quick-label">Pendampingan Acara</span>
      </a>
      <a href="{{ route('homepage.kontak') }}" class="humas-quick-item" title="Layanan Pengaduan & Aspirasi">
        <div class="humas-quick-icon-wrap"><i class="bi bi-chat-left-dots"></i></div>
        <span class="humas-quick-label">Survey Layanan</span>
      </a>
    </div>

    <!-- Notification Info Action Pills (Matching exact reference design) -->
    <div class="humas-pill-container" data-aos="fade-up" data-aos-delay="150">
      @if(!empty($pillText1))
      <a href="{{ $pillUrl1 }}" class="humas-info-pill pill-lime">
        <span>{{ $pillText1 }}</span>
        <span class="humas-pill-btn">Unduh</span>
      </a>
      @endif

      @if(!empty($pillText2))
      <a href="{{ $pillUrl2 }}" class="humas-info-pill pill-emerald">
        <span>{{ $pillText2 }}</span>
        <span class="humas-pill-btn">Lihat</span>
      </a>
      @endif

      @if(!empty($pillText3))
      <a href="{{ $pillUrl3 }}" target="{{ str_starts_with($pillUrl3, 'http') ? '_blank' : '_self' }}" class="humas-info-pill pill-emerald">
        <span>{{ $pillText3 }}</span>
        <span class="humas-pill-btn">Unduh</span>
      </a>
      @endif
    </div>
  </div>
</section>

<!-- ══════════════════════════════════════════════════════
     2. GALERI & KEGIATAN HUMAS
══════════════════════════════════════════════════════ -->
<section class="section-bg-sand py-5" id="galeri-humas">
  <div class="container py-3">
    <div class="d-flex align-items-end justify-content-between mb-5 flex-wrap gap-3" data-aos="fade-up">
      <div>
        <div class="section-label mb-2">Dokumentasi Visual</div>
        <h2 class="section-title mb-0">Galeri & <em>Kegiatan Humas</em></h2>
      </div>
      <a href="{{ route('homepage.galeri.humas') }}" class="btn-outline-hero" style="color: var(--uis-green); border-color: var(--uis-green); font-size: 13.5px; padding: 10px 22px;">
        <i class="bi bi-images me-1"></i> Lihat Semua Galeri
      </a>
    </div>

    @if(isset($galleries) && $galleries->count() > 0)
      <div class="row g-4">
        @foreach($galleries->take(6) as $index => $gal)
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
            <a href="{{ route('homepage.galeri.detail', $gal->slug ?? $gal->id) }}" class="gallery-card-item d-block text-decoration-none">
              <div class="gallery-img-container">
                @if(!empty($gal->url))
                  <img src="{{ asset('storage/' . $gal->url) }}" alt="{{ $gal->judul }}" class="gallery-card-img" loading="lazy">
                @else
                  <div class="gallery-fallback-box">
                    <i class="bi bi-camera-fill fs-1 text-white-50"></i>
                  </div>
                @endif
                <div class="gallery-card-overlay">
                  <span class="gallery-tag"><i class="bi bi-tag-fill me-1"></i>Dokumentasi</span>
                  <h5 class="gallery-card-title">{{ $gal->judul }}</h5>
                  @if(!empty($gal->deskripsi))
                    <p class="gallery-card-desc mb-0">{!! Str::limit(strip_tags($gal->deskripsi), 90) !!}</p>
                  @endif
                </div>
              </div>
            </a>
          </div>
        @endforeach
      </div>
    @else
      <div class="text-center py-5 bg-white rounded-4 border">
        <i class="bi bi-images fs-1 text-muted d-block mb-2"></i>
        <p class="text-muted mb-0">Belum ada dokumentasi foto kegiatan Humas yang diunggah.</p>
      </div>
    @endif
  </div>
</section>

<!-- ══════════════════════════════════════════════════════
     3. EKSPLORASI DI SOSIAL MEDIA
══════════════════════════════════════════════════════ -->
<section class="humas-social-section" id="eksplorasi-medsos">
  <div class="container">
    <h2 class="humas-section-heading" data-aos="fade-up">Eksplorasi di Sosial Media</h2>

    @php
      // Ambil daftar sosial media aktif (kecuali peta lokasi)
      $activeSocials = isset($socialMedias) ? $socialMedias->filter(function($item) {
          $name = strtolower($item->nama);
          return !str_contains($name, 'peta') && !str_contains($name, 'map');
      }) : collect();
    @endphp

    @if($activeSocials->count() > 0)
      <div class="row g-4 justify-content-center">
        @foreach($activeSocials as $index => $sm)
          @php
            $lowerName = strtolower($sm->nama);
            
            // Default styling presets by platform
            if (str_contains($lowerName, 'instagram')) {
                $brandIcon    = 'bi-instagram';
                $logoBg       = 'radial-gradient(circle at 30% 107%, #fdf497 0%, #fdf497 5%, #fd5949 45%, #d6249f 60%, #285AEB 90%)';
                $previewBg    = 'linear-gradient(135deg, #fdf2f8 0%, #fce7f3 100%)';
                $previewIcon  = 'bi-camera-reels text-danger';
                $btnText      = 'Ikuti';
                $btnIcon      = 'bi-instagram';
                $defaultLabel = 'Instagram Resmi UIS';
                $defaultHandle= '@universitasibnusina';
            } elseif (str_contains($lowerName, 'tiktok')) {
                $brandIcon    = 'bi-tiktok';
                $logoBg       = '#000000';
                $previewBg    = 'linear-gradient(135deg, #e0f2fe 0%, #f0fdfa 100%)';
                $previewIcon  = 'bi-play-circle-fill text-dark';
                $btnText      = 'Ikuti';
                $btnIcon      = 'bi-tiktok';
                $defaultLabel = 'TikTok Resmi Kampus';
                $defaultHandle= '@humas_uis';
            } elseif (str_contains($lowerName, 'facebook')) {
                $brandIcon    = 'bi-facebook';
                $logoBg       = '#1877f2';
                $previewBg    = 'linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)';
                $previewIcon  = 'bi-people-fill text-primary';
                $btnText      = 'Kunjungi';
                $btnIcon      = 'bi-facebook';
                $defaultLabel = 'Facebook & YouTube Humas';
                $defaultHandle= 'Universitas Ibnu Sina';
            } elseif (str_contains($lowerName, 'youtube')) {
                $brandIcon    = 'bi-youtube';
                $logoBg       = '#ff0000';
                $previewBg    = 'linear-gradient(135deg, #fef2f2 0%, #fee2e2 100%)';
                $previewIcon  = 'bi-play-btn-fill text-danger';
                $btnText      = 'Kunjungi';
                $btnIcon      = 'bi-youtube';
                $defaultLabel = 'YouTube Resmi UIS';
                $defaultHandle= 'Universitas Ibnu Sina Channel';
            } elseif (str_contains($lowerName, 'whatsapp') || str_contains($lowerName, 'wa')) {
                $brandIcon    = 'bi-whatsapp';
                $logoBg       = '#25D366';
                $previewBg    = 'linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%)';
                $previewIcon  = 'bi-chat-dots-fill text-success';
                $btnText      = 'Chat WhatsApp';
                $btnIcon      = 'bi-whatsapp';
                $defaultLabel = 'Layanan WhatsApp Humas';
                $defaultHandle= 'Layanan Informasi Cepat';
            } elseif (str_contains($lowerName, 'linkedin')) {
                $brandIcon    = 'bi-linkedin';
                $logoBg       = '#0a66c2';
                $previewBg    = 'linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)';
                $previewIcon  = 'bi-briefcase-fill text-primary';
                $btnText      = 'Terhubung';
                $btnIcon      = 'bi-linkedin';
                $defaultLabel = 'Jejaring Profesional UIS';
                $defaultHandle= 'Universitas Ibnu Sina';
            } else {
                $brandIcon    = !empty($sm->icon) ? $sm->icon : 'bi-globe2';
                $logoBg       = '#046B26';
                $previewBg    = 'linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%)';
                $previewIcon  = $brandIcon . ' text-success';
                $btnText      = 'Kunjungi';
                $btnIcon      = 'bi-box-arrow-up-right';
                $defaultLabel = $sm->nama . ' Resmi UIS';
                $defaultHandle= $sm->nama;
            }

            // Extract or build clean handle display from URL
            $handleDisplay = $defaultHandle;
            if (!empty($sm->url)) {
                $parsedPath = trim(parse_url($sm->url, PHP_URL_PATH) ?? '', '/');
                if (!empty($parsedPath) && !str_contains($parsedPath, '?') && !str_contains($parsedPath, '=')) {
                    $handleDisplay = str_starts_with($parsedPath, '@') ? $parsedPath : '@' . $parsedPath;
                }
            }

            $displayHandle  = !empty($sm->handle) ? (str_starts_with($sm->handle, '@') ? $sm->handle : '@' . $sm->handle) : $handleDisplay;
            $hasMedia       = !empty($sm->thumbnail_video_url);
            $isVideoFile    = method_exists($sm, 'isVideoFile') ? $sm->isVideoFile() : false;
            $videoTargetUrl = !empty($sm->video_url) ? $sm->video_url : ($sm->url ?? '#');
            $videoJudul     = !empty($sm->video_judul) ? $sm->video_judul : ('Video & Momen Terbaru ' . $sm->nama . ' UIS');
          @endphp
          <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
            <div class="humas-phone-card">
              {{-- Speaker Notch --}}
              <div class="humas-phone-speaker"></div>

              {{-- Platform App Icon Badge --}}
              <div class="humas-phone-logo" style="background: {{ $logoBg }};">
                @if(!empty($sm->logo_url))
                  <img src="{{ $sm->logo_url }}" alt="{{ $sm->nama }}" style="max-width: 32px; max-height: 32px; object-fit: contain;">
                @else
                  <i class="bi {{ $brandIcon }}"></i>
                @endif
              </div>

              {{-- Video Screen Area --}}
              <div class="humas-phone-screen">
                @if(!empty($sm->video_embed_url))
                  @if(preg_match('/\.(mp4|webm|ogg)$/i', $sm->video_embed_url))
                    <video src="{{ $sm->video_embed_url }}" controls playsinline class="w-100 h-100" style="object-fit: cover; border-radius: 18px;"></video>
                  @else
                    <iframe src="{{ $sm->video_embed_url }}" 
                            class="w-100 h-100" 
                            style="border: none; border-radius: 18px;" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                            allowfullscreen>
                    </iframe>
                  @endif
                @elseif($hasMedia && $isVideoFile)
                  <video src="{{ $sm->thumbnail_video_url }}" class="humas-phone-video-media" autoplay muted loop playsinline></video>
                @else
                  <a href="{{ $videoTargetUrl }}" target="_blank" rel="noopener" class="d-block w-100 h-100 position-relative text-decoration-none" title="Tonton {{ $videoJudul }}">
                    @if($hasMedia)
                      <img src="{{ $sm->thumbnail_video_url }}" class="humas-phone-video-media" alt="{{ $videoJudul }}">
                    @else
                      {{-- Default Campus Documentation Video Preview --}}
                      <img src="{{ asset('frontend/img/gedung-uis.jpg') }}" class="humas-phone-video-media" alt="{{ $videoJudul }}" style="filter: brightness(0.8);">
                    @endif

                    {{-- Play Button Overlay --}}
                    <div class="humas-phone-play-btn">
                      <i class="bi bi-play-fill"></i>
                    </div>

                    {{-- Video Overlay Details --}}
                    <div class="humas-phone-video-overlay">
                      <div class="d-flex align-items-center justify-content-between w-100">
                        <span class="badge bg-dark bg-opacity-75 text-white border border-light border-opacity-25" style="font-size: 10px; font-weight: 600; padding: 4px 8px; border-radius: 20px;">
                          <i class="bi bi-broadcast text-danger me-1"></i> Video Terbaru
                        </span>
                        <span class="badge bg-black bg-opacity-60 text-white" style="font-size: 10px; padding: 4px 8px; border-radius: 20px;">
                          <i class="bi {{ $brandIcon }} me-1"></i> {{ $sm->nama }}
                        </span>
                      </div>

                      <div class="w-100">
                        <div class="humas-phone-video-title">{{ $videoJudul }}</div>
                        <div class="humas-phone-video-meta d-flex align-items-center justify-content-between">
                          <span><i class="bi bi-play-circle-fill me-1 text-warning"></i> Putar Video</span>
                          <span class="badge bg-danger bg-opacity-75 text-white px-2 py-0" style="font-size: 9.5px;">Terbaru</span>
                        </div>
                      </div>
                    </div>
                  </a>
                @endif
              </div>

              {{-- Handle & Label --}}
              <div class="humas-phone-handle text-truncate w-100 text-center">{{ $displayHandle }}</div>
              <div class="humas-phone-label text-truncate w-100 text-center">{{ $defaultLabel }}</div>

              {{-- Action Button --}}
              <a href="{{ $videoTargetUrl }}" target="_blank" rel="noopener" class="humas-phone-btn text-center">
                <i class="bi {{ !empty($sm->video_url) ? 'bi-play-btn-fill' : $btnIcon }} me-1"></i> {{ !empty($sm->video_url) ? 'Tonton Video' : $btnText }}
              </a>
            </div>
          </div>
        @endforeach
      </div>
    @endif
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
     8. E-MAGAZINE PROFIL UNIVERSITAS
══════════════════════════════════════════════════════ -->
<section class="humas-emagz-section" id="emagazine-section">
  <div class="container">
    <div class="humas-emagz-container" data-aos="fade-up">
      <h2 class="fw-bold mb-3" style="color: #0f172a; font-size: 28px;">E-Magazine Profil Universitas</h2>
      
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
                <span style="font-size: 11px; font-weight: 800; color: #fff; line-height: 1.2; display: block;">PROFIL 2026</span>
              </div>
            </div>
          </div>

          <h4 class="fw-bold mb-2 text-dark" id="emagzTitle">E-Magazine Edisi Eksklusif Profil Kampus</h4>
          <p class="text-muted small mx-auto mb-4" style="max-width: 500px;">
            Jelajahi informasi lengkap mengenai fasilitas laboratorium, profil fakultas, program beasiswa, dan prestasi mahasiswa.
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
      title.innerText = 'Buku Saku Panduan Mahasiswa & Akademik';
    }
  }
</script>

@endsection
