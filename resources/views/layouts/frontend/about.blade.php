@extends('layouts.frontend.template')

@section('title', 'Tentang Kami — Fakultas Ilmu Kesehatan')
@section('meta_description', 'Kenali lebih dekat Fakultas Ilmu Kesehatan — profil, visi misi, nilai karakter akademik, dan fasilitas unggulan kami.')
@section('meta_keywords', 'tentang uis, profil fakultas ilmu kesehatan ibnu sina, visi misi uis, struktur organisasi uis, pendidikan kesehatan')

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
        <a href="{{ route('homepage') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
        <span>/</span>
        <span class="active">Tentang Fakultas Ilmu Kesehatan</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     PROFIL FAKULTAS ILMU KESEHATAN (FULL WIDTH & VIDEO)
═══════════════════════════════════════════════ -->
<section class="section-bg-white py-5">
  <div class="container">
    <div class="row">
      <div class="col-12" data-aos="fade-up" data-aos-duration="800">
        <!-- Header Profil -->
        <div class="text-center mb-4">
          <div class="section-label mx-auto">Profil FIKES</div>
          <h2 class="section-title">{!! $about->judul_profil ?? 'Kampusnya Profesional Muda — <em>Fakultas Ilmu Kesehatan</em>' !!}</h2>
          <div class="divider-line centered"></div>
        </div>

        {{-- VIDEO KIRI & CONTENT KANAN (SIDE-BY-SIDE) --}}
        @if($about?->hasVideo())
          <div class="row g-4 align-items-center mb-4" data-aos="fade-up" data-aos-delay="120">
            {{-- Kolom Kiri: Video YouTube / File --}}
            <div class="col-lg-6">
              <div class="position-relative rounded-4 overflow-hidden shadow-lg border w-100" style="border-color: #e2e8f0; background: #000;">
                @if($about->video_file)
                  <video controls class="w-100 d-block" style="max-height: 440px; object-fit: contain;">
                    <source src="{{ asset('storage/' . $about->video_file) }}">
                    Browser Anda tidak mendukung tag video.
                  </video>
                @elseif($about->youtube_embed_url)
                  <div class="ratio ratio-16x9">
                    <iframe 
                      src="{{ $about->youtube_embed_url }}" 
                      title="Video Profil FIKES Fakultas Ilmu Kesehatan" 
                      allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                      referrerpolicy="strict-origin-when-cross-origin" 
                      allowfullscreen>
                    </iframe>
                  </div>
                @endif
              </div>
              @if($about->youtube_watch_url)
                <div class="d-flex justify-content-between align-items-center gap-2 mt-2 px-1">
                  <span class="text-muted small" style="font-size: 12px;">Video bermasalah saat diputar?</span>
                  <a href="{{ $about->youtube_watch_url }}" target="_blank" rel="noopener noreferrer" class="btn btn-sm text-white fw-semibold d-inline-flex align-items-center gap-1" style="background-color: var(--uis-green, #046B26); font-size: 12px; border-radius: 6px; padding: 4px 12px;">
                    <i class="bi bi-youtube text-warning"></i> Buka Langsung di YouTube <i class="bi bi-box-arrow-up-right ms-1" style="font-size: 10px;"></i>
                  </a>
                </div>
              @endif
            </div>

            {{-- Kolom Kanan: Konten Deskripsi --}}
            <div class="col-lg-6">
              <div class="h-100 p-4 p-md-4 rounded-4 shadow-sm" style="text-align: justify; font-size: 15.5px; line-height: 1.85; color: #2d3748; background: #f8faf9; border-left: 5px solid var(--uis-green, #046B26); border-top: 1px solid #edf2f7; border-right: 1px solid #edf2f7; border-bottom: 1px solid #edf2f7;">
                <div class="about-desc-content">
                  {!! $about->deskripsi_profil_1 ?? 'Fakultas Ilmu Kesehatan (FIKES) berdedikasi menyelenggarakan pendidikan tinggi berkualitas di bidang kesehatan dengan kurikulum modern yang berorientasi pada capaian kompetensi, riset inovatif, dan pelayanan masyarakat.' !!}
                </div>
              </div>
            </div>
          </div>
        @else
          {{-- Fallback jika belum ada video --}}
          <div class="w-100 p-4 p-md-5 rounded-4 shadow-sm mb-4" style="text-align: justify; font-size: 16.5px; line-height: 1.9; color: #2d3748; background: #f8faf9; border-left: 6px solid var(--uis-green, #046B26); border-top: 1px solid #edf2f7; border-right: 1px solid #edf2f7; border-bottom: 1px solid #edf2f7;" data-aos="fade-up" data-aos-delay="150">
            <div class="about-desc-content">
              {!! $about->deskripsi_profil_1 ?? 'Fakultas Ilmu Kesehatan (FIKES) berdedikasi menyelenggarakan pendidikan tinggi berkualitas di bidang kesehatan dengan kurikulum modern yang berorientasi pada capaian kompetensi, riset inovatif, dan pelayanan masyarakat.' !!}
            </div>
          </div>
        @endif
      </div>
    </div>
  </div>
</section>

@endsection
