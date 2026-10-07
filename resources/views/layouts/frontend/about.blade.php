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
     PROFIL UNIVERSITAS (FULL WIDTH & VIDEO)
═══════════════════════════════════════════════ -->
<section class="section-bg-white py-5">
  <div class="container">
    <div class="row">
      <div class="col-12" data-aos="fade-up" data-aos-duration="800">
        <!-- Header Profil -->
        <div class="text-center mb-4">
          <div class="section-label mx-auto">Profil Universitas</div>
          <h2 class="section-title">{!! $about->judul_profil ?? 'Kampusnya Profesional Muda — <em>Universitas Ibnu Sina</em>' !!}</h2>
          <div class="divider-line centered"></div>
        </div>

        {{-- 1. VIDEO PROFIL DI ATAS (FULL WIDTH) --}}
        @if($about?->hasVideo())
          <div class="w-100 mb-5" data-aos="fade-up" data-aos-delay="100">
            <div class="position-relative rounded-4 overflow-hidden shadow-lg border w-100" style="border-color: #e2e8f0; background: #000;">
              @if($about->video_file)
                <video controls class="w-100 d-block" style="max-height: 560px; object-fit: contain;">
                  <source src="{{ asset('storage/' . $about->video_file) }}">
                  Browser Anda tidak mendukung tag video.
                </video>
              @elseif($about->youtube_embed_url)
                <div class="ratio ratio-16x9">
                  <iframe 
                    src="{{ $about->youtube_embed_url }}" 
                    title="Video Profil Universitas Ibnu Sina" 
                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                    referrerpolicy="strict-origin-when-cross-origin" 
                    allowfullscreen>
                  </iframe>
                </div>
              @endif
            </div>
            @if($about->youtube_watch_url)
              <div class="d-flex justify-content-end align-items-center gap-2 mt-2 px-1">
                <span class="text-muted small">Video bermasalah saat diputar?</span>
                <a href="{{ $about->youtube_watch_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm text-white fw-semibold d-inline-flex align-items-center gap-1" style="background-color: #046B26; font-size: 12.5px; border-radius: 6px; padding: 4px 12px;">
                  <i class="bi bi-youtube text-warning"></i> Buka Langsung di YouTube <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 10px;"></i>
                </a>
              </div>
            @endif
          </div>
        @endif

        {{-- 2. DESKRIPSI PARAGRAF DI BAWAH (FULL WIDTH 100%) --}}
        <div class="w-100 p-4 p-md-5 rounded-4 shadow-sm mb-4" style="width: 100% !important; max-width: 100% !important; text-align: justify; font-size: 17px; line-height: 2.0; color: #2d3748; background: #f8faf9; border-left: 6px solid var(--uis-green, #046B26); border-top: 1px solid #edf2f7; border-right: 1px solid #edf2f7; border-bottom: 1px solid #edf2f7;" data-aos="fade-up" data-aos-delay="200">
          {!! $about->deskripsi_profil_1 ?? 'Universitas Ibnu Sina (UIS) Batam merupakan perguruan tinggi swasta terkemuka di Provinsi Kepulauan Riau yang lahir dari perpaduan keunggulan akademik Sekolah Tinggi Teknik (STT), Sekolah Tinggi Ilmu Ekonomi (STIE), dan Sekolah Tinggi Ilmu Kesehatan (STIKES) di bawah naungan Yayasan Pendidikan Ibnu Sina Batam (YAPISNA). Berlokasi strategis di kawasan industri dan perdagangan internasional Kota Batam, UIS mengelola tiga fakultas unggulan: Fakultas Teknik (Sains & Teknologi), Fakultas Ekonomi dan Bisnis (FEB), serta Fakultas Ilmu Kesehatan (FIKES), beserta Program Pascasarjana (Magister). UIS bertekad mencetak lulusan profesional muda yang inovatif, berdaya saing global, berjiwa entrepreneur, dan berakhlak mulia berlandaskan Iman dan Taqwa (Imtaq).' !!}
        </div>
      </div>
    </div>
  </div>
</section>

@endsection
