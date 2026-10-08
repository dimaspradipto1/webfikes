@extends('layouts.frontend.template')

@section('title', 'Hubungi Kami — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Hubungi Universitas Ibnu Sina (UIS) untuk informasi program studi, layanan akademik, praktikum laboratorium, dan penerimaan mahasiswa baru.')
@section('meta_keywords', 'kontak uis, alamat universitas ibnu sina, nomor wa uis, lokasi kampus uis')

@push('styles')
<style>
  .contact-hero {
    position: relative;
    background: var(--obsidian-dark);
    padding: 70px 0 50px;
    border-bottom: 2px solid var(--uis-purple);
  }
  .contact-hero-title {
    font-size: 38px;
    font-weight: 800;
    color: var(--white);
    margin-bottom: 8px;
  }
  .contact-hero-title em {
    font-style: normal;
    color: var(--uis-orange);
  }
  .contact-card-box {
    background: var(--white);
    border: 1px solid var(--border-light);
    border-radius: 20px;
    padding: 28px 22px;
    text-align: center;
    box-shadow: var(--shadow-sm);
    transition: all 0.3s ease;
    height: 100%;
  }
  .contact-card-box:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-md);
    border-color: var(--border-purple);
  }
  .contact-card-icon {
    width: 56px;
    height: 56px;
    background: var(--uis-purple-light);
    color: var(--uis-purple);
    border-radius: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 24px;
    margin: 0 auto 16px;
  }
  .contact-card-title {
    font-size: 17px;
    font-weight: 700;
    margin-bottom: 8px;
  }
  .contact-card-text {
    font-size: 13.5px;
    color: var(--text-muted);
    line-height: 1.6;
    margin: 0;
  }
  .map-responsive-container {
    position: relative;
    width: 100%;
    height: 460px;
    min-height: 460px;
    background: #f8fafc;
    overflow: hidden;
  }
  .map-responsive-container iframe {
    width: 100% !important;
    height: 100% !important;
    min-height: 460px !important;
    border: 0 !important;
    display: block !important;
  }
</style>
@endpush

@section('content')
@php
  $cleanWa = $cleanWa ?? '';
  if (empty($cleanWa) && !empty($contact->no_wa)) {
      $cleanWa = preg_replace('/[^0-9]/', '', $contact->no_wa);
      if (strpos($cleanWa, '08') === 0) {
          $cleanWa = '628' . substr($cleanWa, 2);
      }
  }
@endphp

<!-- ═══════════════════════════════════════════════
     HERO BANNER
═══════════════════════════════════════════════ -->
<div class="contact-hero">
  <div class="container">
    <div class="contact-hero-content" data-aos="fade-up" data-aos-duration="800">
      <h1 class="contact-hero-title">
        Hubungi <em>UIS</em>
      </h1>
      <div class="breadcrumb-custom">
        <a href="{{ route('homepage') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
        <span>/</span>
        <span class="active">Hubungi Kami</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     CONTACT INFO CARDS & MAP
═══════════════════════════════════════════════ -->
<section class="section-bg-white">
  <div class="container">
    
    <div class="row g-4 mb-5">
      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="100">
        <div class="contact-card-box">
          <div class="contact-card-icon"><i class="bi bi-geo-alt-fill"></i></div>
          <h4 class="contact-card-title">Alamat Kampus</h4>
          <p class="contact-card-text">
            {{ $contact->alamat ?? 'Gedung Universitas Ibnu Sina (UIS), Kampus Terpadu' }}
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="200">
        <div class="contact-card-box">
          <div class="contact-card-icon"><i class="bi bi-envelope-open-fill"></i></div>
          <h4 class="contact-card-title">Email Resmi</h4>
          <p class="contact-card-text">
            <a href="mailto:{{ $contact->email ?? 'humas@uis.ac.id' }}" class="text-decoration-none fw-bold" style="color: var(--uis-purple);">
              {{ $contact->email ?? 'humas@uis.ac.id' }}
            </a>
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="300">
        <div class="contact-card-box">
          <div class="contact-card-icon"><i class="bi bi-whatsapp"></i></div>
          <h4 class="contact-card-title">Layanan WhatsApp</h4>
          <p class="contact-card-text">
            @if(!empty($cleanWa))
              <a href="https://wa.me/{{ $cleanWa }}" target="_blank" class="text-decoration-none fw-bold text-success">
                <i class="bi bi-whatsapp me-1"></i> {{ $contact->no_wa ?? '0812-3456-7890' }}
              </a>
            @else
              <span>{{ $contact->no_wa ?? '0812-3456-7890' }}</span>
            @endif
          </p>
        </div>
      </div>

      <div class="col-md-6 col-lg-3" data-aos="fade-up" data-aos-delay="400">
        <div class="contact-card-box">
          <div class="contact-card-icon"><i class="bi bi-clock-fill"></i></div>
          <h4 class="contact-card-title">Jam Layanan</h4>
          <p class="contact-card-text">
            Senin - Jumat: 08.00 - 16.00 WIB<br>
            Sabtu: 08.00 - 13.00 WIB
          </p>
        </div>
      </div>
    </div>

    <!-- PETA LOKASI -->
    @if(isset($contact) && !empty($contact->map))
      <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 24px; border: 1px solid var(--border-light) !important;" data-aos="fade-up">
        <div class="p-3 bg-light border-bottom fw-bold text-dark d-flex align-items-center justify-content-between">
          <div class="d-flex align-items-center">
            <i class="bi bi-pin-map-fill text-danger me-2 fs-5"></i>
            <span>Lokasi Kampus UIS di Google Maps</span>
          </div>
          @if(!empty($contact->latitude) && !empty($contact->longitude))
            <a href="https://www.google.com/maps/search/?api=1&query={{ $contact->latitude }},{{ $contact->longitude }}" target="_blank" class="btn btn-sm btn-outline-primary rounded-pill px-3 fw-semibold" style="font-size: 12.5px;">
              <i class="bi bi-box-arrow-up-right me-1"></i> Buka Peta Penuh
            </a>
          @endif
        </div>
        <div class="map-responsive-container">
          {!! $contact->map !!}
        </div>
      </div>
    @endif

  </div>
</section>

@endsection
