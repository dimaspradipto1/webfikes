@extends('layouts.frontend.template')

@section('title', 'Tanya Jawab (FAQ) — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Temukan jawaban cepat atas pertanyaan seputar fakultas, program studi, PMB, fasilitas kampus, dan akreditasi UIS Batam.')
@section('meta_keywords', 'faq uis, tanya jawab universitas ibnu sina, pmb uis batam, pendaftaran mahasiswa baru, akreditasi uis batam')

@push('styles')
<style>
  .faq-hero {
    position: relative;
    background: var(--obsidian-dark);
    padding: 70px 0 50px;
    border-bottom: 2px solid var(--uis-purple);
  }
  .faq-hero-title {
    font-size: 38px;
    font-weight: 800;
    color: var(--white);
    margin-bottom: 8px;
  }
  .faq-hero-title em {
    font-style: normal;
    color: var(--uis-orange);
  }
  .accordion-item {
    border: 1px solid var(--border-light) !important;
    border-radius: 16px !important;
    margin-bottom: 12px;
    overflow: hidden;
    background: var(--white);
  }
  .accordion-button {
    font-family: 'Plus Jakarta Sans', sans-serif;
    font-weight: 700;
    font-size: 15.5px;
    color: var(--text-main);
    padding: 18px 24px;
    background: var(--white);
  }
  .accordion-button:not(.collapsed) {
    background: var(--uis-purple-light);
    color: var(--uis-purple);
    box-shadow: none;
  }
  .accordion-body {
    font-size: 14.5px;
    color: var(--text-muted);
    line-height: 1.75;
    padding: 20px 24px;
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
<div class="faq-hero">
  <div class="container">
    <div class="faq-hero-content" data-aos="fade-up" data-aos-duration="800">
      <h1 class="faq-hero-title">
        Tanya Jawab <em>(FAQ)</em>
      </h1>
      <div class="breadcrumb-custom">
        <a href="{{ route('homepage') }}" class="text-white-50"><i class="bi bi-house-fill me-1"></i>Beranda</a>
        <span class="mx-2 text-white-50">/</span>
        <span style="color: var(--uis-orange); font-weight: 600;">FAQ</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     FAQ SECTION
═══════════════════════════════════════════════ -->
<section class="section-bg-sand">
  <div class="container">
    
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="section-label mx-auto">Pusat Bantuan & Informasi</div>
      <h2 class="section-title">Pertanyaan yang Sering <em>Diajukan</em></h2>
      <div class="divider-line centered"></div>
      <p class="section-desc mx-auto">
        Kumpulan jawaban informatif seputar proses akademik, persyaratan seleksi masuk, fasilitas, dan kemitraan di UIS.
      </p>
    </div>

    <div class="row justify-content-center">
      <div class="col-lg-9" data-aos="fade-up">
        <div class="accordion" id="faqAccordion">
          @if(isset($faqs) && $faqs->count() > 0)
            @foreach($faqs as $index => $faq)
              <div class="accordion-item shadow-sm">
                <h2 class="accordion-header" id="heading{{ $faq->id ?? $index }}">
                  <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $faq->id ?? $index }}" aria-expanded="{{ $index === 0 ? 'true' : 'false' }}">
                    <i class="bi bi-question-circle-fill me-2" style="color: var(--uis-purple);"></i>
                    {{ $faq->question ?? $faq->pertanyaan }}
                  </button>
                </h2>
                <div id="collapse{{ $faq->id ?? $index }}" class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}" data-bs-parent="#faqAccordion">
                  <div class="accordion-body">
                    {{ $faq->answer ?? $faq->jawaban }}
                  </div>
                </div>
              </div>
            @endforeach
          @else
            <div class="text-center py-4 text-muted">Belum ada data FAQ tersedia.</div>
          @endif
        </div>

        <div class="card border-0 shadow-sm p-4 text-center mt-5" style="border-radius: 20px; background: var(--obsidian-dark); color: white;">
          <h4 class="fw-bold mb-2">Masih Memiliki Pertanyaan Lain?</h4>
          <p class="text-white-50 small mb-3">Tim layanan informasi akademik kami siap membantu menjawab segala pertanyaan Anda.</p>
          <div class="d-flex justify-content-center gap-3">
            @if(!empty($cleanWa))
              <a href="https://wa.me/{{ $cleanWa }}" target="_blank" class="btn-primary-hero">
                <i class="bi bi-whatsapp"></i> Chat WhatsApp
              </a>
            @endif
            <a href="{{ route('homepage.kontak') }}" class="btn-outline-hero">
              <i class="bi bi-envelope"></i> Kontak Kami
            </a>
          </div>
        </div>
      </div>
    </div>

  </div>
</section>

@endsection
