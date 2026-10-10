@extends('layouts.frontend.template')

@section('title', ($setting->judul_hero ?? 'Pendampingan Acara') . ' — Universitas Ibnu Sina (UIS)')
@section('meta_description', 'Layanan pendampingan acara, protokoler resmi, dan konsultasi kegiatan kampus Universitas Ibnu Sina (UIS) Batam. Panduan SOP, perizinan, dan suksesi event.')
@section('meta_keywords', 'pendampingan acara uis, protokoler uis, sop acara uis batam, humas uis event, konsultasi protokol uis')

@section('content')
<style>
  /* ═══════════════════════════════════════════════
     STYLING PENDAMPINGAN ACARA (State-of-the-Art)
  ═══════════════════════════════════════════════ */
  .pendampingan-page {
    background-color: #f8fafc;
    color: #334155;
    font-family: 'Plus Jakarta Sans', sans-serif;
  }

  .divider-line-gold {
    width: 60px;
    height: 4px;
    background: #fab005;
    border-radius: 4px;
    margin: 14px auto 26px auto;
  }

  /* ── 1. Showcase Hero Box ── */
  .event-main-card {
    background: #ffffff;
    border-radius: 20px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
    padding: 44px;
    position: relative;
    overflow: hidden;
  }
  .event-main-card::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 100%;
    background: linear-gradient(180deg, #046B26 0%, #fab005 100%);
  }

  .event-salutation-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: #e8f5e9;
    color: #046B26;
    border: 1px solid #c8e6c9;
    font-size: 13px;
    font-weight: 700;
    padding: 6px 16px;
    border-radius: 50px;
    margin-bottom: 20px;
  }

  .event-salutation-title {
    color: #0f172a;
    font-size: 30px;
    font-weight: 800;
    line-height: 1.35;
    letter-spacing: -0.6px;
    margin-bottom: 20px;
  }
  .event-salutation-title span {
    color: #046B26;
  }

  .event-desc-lead {
    color: #475569;
    font-size: 15.5px;
    line-height: 1.85;
    margin-bottom: 28px;
  }

  /* ── TinyMCE Rich Content Rendered Styling ── */
  .event-rendered-content {
    color: #475569;
    font-size: 15.5px;
    line-height: 1.85;
  }
  .event-rendered-content p {
    margin-bottom: 1.15rem;
    color: #475569;
    line-height: 1.85;
  }
  .event-rendered-content strong,
  .event-rendered-content b {
    color: #0f172a;
    font-weight: 700;
  }
  .event-rendered-content ul {
    list-style: none !important;
    padding-left: 0 !important;
    margin: 1.5rem 0 1.75rem 0 !important;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 14px;
  }
  .event-rendered-content ul li {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 14px 18px 14px 48px;
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
    position: relative;
    line-height: 1.5;
    transition: all 0.25s ease;
    display: flex;
    align-items: center;
  }
  .event-rendered-content ul li::before {
    content: "\F26E";
    font-family: "bootstrap-icons";
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #046B26;
    font-size: 20px;
    font-weight: bold;
  }
  .event-rendered-content ul li:hover {
    background: #ffffff;
    border-color: #046B26;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(4, 107, 38, 0.08);
  }
  .event-rendered-content ol {
    padding-left: 1.25rem;
    margin-bottom: 1.25rem;
  }
  .event-rendered-content ol li {
    margin-bottom: 0.5rem;
    color: #334155;
    font-weight: 500;
  }

  /* ── 2. Feature Assistance Grid ── */
  .assistance-item {
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 16px 18px;
    display: flex;
    align-items: flex-start;
    gap: 14px;
    transition: all 0.25s ease;
    height: 100%;
  }
  .assistance-item:hover {
    background: #ffffff;
    border-color: #046B26;
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(4, 107, 38, 0.08);
  }
  .assistance-icon-wrap {
    width: 38px;
    height: 38px;
    border-radius: 10px;
    background: #046B26;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
  }
  .assistance-text {
    font-size: 14px;
    font-weight: 600;
    color: #1e293b;
    line-height: 1.45;
    margin-top: 2px;
  }

  /* ── 3. High-Impact CTA Box (Right Column) ── */
  .cta-showcase-box {
    background: linear-gradient(145deg, #064e3b 0%, #046B26 60%, #03521d 100%);
    border-radius: 20px;
    padding: 34px 28px;
    color: #ffffff;
    box-shadow: 0 16px 36px rgba(4, 107, 38, 0.25);
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  .cta-showcase-box::after {
    content: "";
    position: absolute;
    top: -50px;
    right: -50px;
    width: 140px;
    height: 140px;
    background: radial-gradient(circle, rgba(254, 216, 2, 0.2) 0%, transparent 70%);
    border-radius: 50%;
    pointer-events: none;
  }

  .cta-badge-tag {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(255, 255, 255, 0.15);
    border: 1px solid rgba(255, 255, 255, 0.25);
    backdrop-filter: blur(8px);
    color: #fed802;
    font-size: 11.5px;
    font-weight: 800;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    padding: 5px 12px;
    border-radius: 50px;
    margin-bottom: 16px;
  }

  .cta-heading {
    font-size: 23px;
    font-weight: 800;
    color: #ffffff;
    line-height: 1.35;
    margin-bottom: 10px;
  }
  .cta-desc {
    color: #e2e8f0;
    font-size: 13.5px;
    line-height: 1.6;
    margin-bottom: 22px;
    opacity: 0.95;
  }

  /* Action Buttons Group */
  .cta-btn-group {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-bottom: 20px;
  }

  /* Main Action Button (Ajukan Permohonan) */
  .btn-ajukan-utama {
    background: #fed802;
    color: #046B26;
    font-weight: 800;
    font-size: 14.5px;
    padding: 13px 20px;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    border: 2px solid #fed802;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
  }
  .btn-ajukan-utama:hover {
    background: #ffffff;
    color: #046B26;
    border-color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
  }

  /* WhatsApp Consultation Button */
  .btn-wa-hotline {
    background: #25d366;
    border: 2px solid #25d366;
    color: #ffffff;
    font-weight: 700;
    font-size: 14.5px;
    padding: 13px 20px;
    border-radius: 12px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    transition: all 0.25s ease;
    box-shadow: 0 4px 14px rgba(37, 211, 102, 0.25);
  }
  .btn-wa-hotline:hover {
    background: #1ebc59;
    border-color: #1ebc59;
    color: #ffffff;
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(37, 211, 102, 0.35);
  }

  .cta-check-list {
    margin-top: auto;
    padding: 18px 20px;
    background: rgba(0, 0, 0, 0.14);
    border: 1px solid rgba(255, 255, 255, 0.12);
    border-radius: 14px;
  }
  .cta-check-item {
    font-size: 13px;
    color: #f1f5f9;
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 8px;
    font-weight: 500;
  }
  .cta-check-item:last-child {
    margin-bottom: 0;
  }
  .cta-check-item i {
    color: #fed802;
    font-size: 16px;
  }

  /* ── 4. Workflow Steps (Alur Layanan) ── */
  .step-flow-box {
    background: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    padding: 26px 20px;
    text-align: center;
    position: relative;
    height: 100%;
    transition: all 0.3s ease;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.02);
  }
  .step-flow-box:hover {
    transform: translateY(-5px);
    border-color: #046B26;
    box-shadow: 0 14px 28px rgba(4, 107, 38, 0.08);
  }
  .step-num-badge {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #046B26 0%, #03521d 100%);
    color: #ffffff;
    font-weight: 800;
    font-size: 17px;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 16px auto;
    box-shadow: 0 6px 14px rgba(4, 107, 38, 0.25);
  }
  .step-title {
    font-size: 16px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 8px;
  }
  .step-desc {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 0;
  }

  /* ── 5. Category Event Cards ── */
  .category-event-card {
    background: #ffffff;
    border-radius: 16px;
    border: 1px solid #e2e8f0;
    padding: 24px;
    transition: all 0.25s ease;
    height: 100%;
  }
  .category-event-card:hover {
    border-color: #046B26;
    transform: translateY(-4px);
    box-shadow: 0 10px 24px rgba(4, 107, 38, 0.06);
  }
  .category-icon-wrap {
    width: 48px;
    height: 48px;
    border-radius: 12px;
    background: #edf6f0;
    color: #046B26;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    margin-bottom: 16px;
  }
  .category-title {
    font-size: 16.5px;
    font-weight: 800;
    color: #0f172a;
    margin-bottom: 8px;
  }
  .category-desc {
    font-size: 13.5px;
    color: #64748b;
    line-height: 1.6;
    margin-bottom: 0;
  }

  /* ── 6. Info Protocol Notice ── */
  .protocol-notice-box {
    background: #f8fafc;
    border-left: 5px solid #046B26;
    border-radius: 0 14px 14px 0;
  /* ── 7. Button Lokasi Kantor Humas ── */
  .btn-lokasi-humas {
    background: transparent;
    color: #046B26;
    border: 2px solid #046B26;
    font-weight: 700;
    font-size: 14.5px;
    padding: 10px 24px;
    border-radius: 10px;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    transition: all 0.25s ease;
  }
  .btn-lokasi-humas i {
    color: #046B26;
    transition: color 0.25s ease;
  }
  .btn-lokasi-humas:hover {
    background: #fed802 !important;
    border-color: #fed802 !important;
    color: #046B26 !important;
    box-shadow: 0 6px 18px rgba(254, 216, 2, 0.35);
    transform: translateY(-2px);
  }
  .btn-lokasi-humas:hover i {
    color: #046B26 !important;
  }
</style>

<!-- ═══════════════════════════════════════════════
     HERO BANNER
═══════════════════════════════════════════════ -->
<div class="faq-hero">
  <div class="container">
    <div class="faq-hero-content" data-aos="fade-up" data-aos-duration="800">
      <h1 class="faq-hero-title">
        {{ $setting->judul_hero ?? 'Pendampingan Acara' }} <em>(Humas)</em>
      </h1>
      <div class="breadcrumb-custom">
        <a href="{{ route('homepage') }}"><i class="bi bi-house-door-fill me-1"></i>Beranda</a>
        <span>/</span>
        <a href="{{ route('homepage.humas') }}">Humas</a>
        <span>/</span>
        <span class="active">{{ $setting->judul_hero ?? 'Pendampingan Acara' }}</span>
      </div>
    </div>
  </div>
</div>

<!-- ═══════════════════════════════════════════════
     KONTEN UTAMA PENDAMPINGAN ACARA
═══════════════════════════════════════════════ -->
<div class="pendampingan-page py-5">
  <div class="container py-3">

    {{-- Header Judul Seksi Utama --}}
    <div class="text-center mb-5" data-aos="fade-up">
      <div class="section-label mx-auto mb-3">
        PROTOKOLER & SUKSESI KEGIATAN KAMPUS
      </div>
      
      <h2 class="fw-bold mb-0" style="color: #0f172a; font-size: 34px; letter-spacing: -0.6px;">
        {{ $setting->judul_seksi ?? 'Pendampingan Acara' }}
      </h2>
      
      <div class="divider-line-gold"></div>

      <p class="text-muted mx-auto mb-0" style="max-width: 820px; font-size: 15px; line-height: 1.8;">
        Layanan konsultasi protokoler, perancangan tata letak acara, penyusunan rundown, serta pendampingan langsung oleh Tim Humas & Protokoler Universitas Ibnu Sina (UIS).
      </p>
    </div>

    {{-- SECTION 1: MAIN SHOWCASE (Row 2 Kolom) --}}
    <div class="row g-4 align-items-stretch mb-5">
      
      {{-- Kolom Kiri: Informasi Layanan & Lingkup Bantuan --}}
      <div class="col-lg-8 col-12" data-aos="fade-up" data-aos-delay="100">
        <div class="event-main-card h-100">
          
          <div class="event-salutation-badge">
            <i class="bi bi-stars text-warning"></i>
            <span>Layanan Resmi Biro Humas UIS</span>
          </div>

          <h3 class="event-salutation-title">
            {{ $setting->sapaan ?? 'Halo, Civitas Akademika Universitas Ibnu Sina dan Mitra Eksternal!' }}
          </h3>

          @if(!empty($setting->konten))
            <div class="event-rendered-content">
              {!! $setting->konten !!}
            </div>
          @else
            <p class="event-desc-lead">
              {!! nl2br(e($setting->paragraf_1 ?? 'Kami hadir untuk mendukung kesuksesan acara dan kegiatan Anda melalui layanan konsultasi yang profesional, terstruktur, dan sesuai dengan Standar Operasional Prosedur (SOP) Universitas Ibnu Sina.')) !!}
            </p>

            <p class="fw-bold text-dark mb-3" style="font-size: 15px;">
              {!! nl2br(e($setting->paragraf_2 ?? 'Apakah Anda sedang merencanakan seminar, workshop, kegiatan sosial, atau event lainnya? Tim kami siap membantu dalam hal:')) !!}
            </p>

            {{-- Grid Poin Lingkup Bantuan (Visual Cards) --}}
            @php
              $rawPoints = $setting->poin_bantuan ?? "Perencanaan dan konsep acara,\nStrategi promosi dan publikasi,\nPengelolaan logistik,\nPengurusan SOP dan perizinan, serta\nPendampingan selama pelaksanaan acara.";
              $pointsArray = array_filter(array_map('trim', explode("\n", $rawPoints)));
              
              // Icon visual default untuk tiap poin
              $pointIcons = [
                'bi-lightbulb-fill',
                'bi-megaphone-fill',
                'bi-box-seam-fill',
                'bi-shield-check',
                'bi-person-check-fill',
                'bi-camera-video-fill',
              ];
            @endphp

            <div class="row g-3 mb-4">
              @foreach($pointsArray as $idx => $point)
                <div class="col-md-6 col-12">
                  <div class="assistance-item">
                    <div class="assistance-icon-wrap">
                      <i class="bi {{ $pointIcons[$idx % count($pointIcons)] }}"></i>
                    </div>
                    <div class="assistance-text">
                      {{ ltrim($point, '-• ') }}
                    </div>
                  </div>
                </div>
              @endforeach
            </div>

            <p class="text-muted small mb-0 pt-2" style="line-height: 1.7;">
              {!! $setting->paragraf_3 ?? 'Untuk memulai, silakan isi formulir konsultasi melalui tombol <strong>“Ajukan Permohonan”</strong> di panel samping.' !!}
            </p>
          @endif

        </div>
      </div>

      {{-- Kolom Kanan: High-Impact Action Showcase Card --}}
      <div class="col-lg-4 col-12" data-aos="fade-up" data-aos-delay="200">
        <div class="cta-showcase-box">
          
          <div>
            <div class="cta-badge-tag">
              <i class="bi bi-shield-fill-check"></i> Layanan Terintegrasi
            </div>

            <h4 class="cta-heading">
              Siap Menggelar Acara Berkualitas?
            </h4>

            <p class="cta-desc">
              Kirimkan draf permohonan Anda. Tim Protokoler & Humas UIS siap mendampingi mulai dari pra-acara hingga evaluasi kegiatan.
            </p>

            @php
              $targetForm = !empty($setting->link_form) ? $setting->link_form : ($item->url ?? 'https://forms.gle/');
              
              // Ambil nomor WA secara presisi dari setting pendampingan acara admin
              $rawAcaraWa = !empty($setting->no_wa) ? $setting->no_wa : '081234567890';
              $cleanAcaraWa = preg_replace('/[^0-9]/', '', $rawAcaraWa);
              if (str_starts_with($cleanAcaraWa, '08')) {
                  $cleanAcaraWa = '628' . substr($cleanAcaraWa, 2);
              } elseif (str_starts_with($cleanAcaraWa, '8')) {
                  $cleanAcaraWa = '628' . substr($cleanAcaraWa, 1);
              }
              $waText = rawurlencode('Halo Tim Humas UIS, saya ingin berkonsultasi mengenai pendampingan protokol dan dokumentasi acara.');
            @endphp
            
            <div class="cta-btn-group">
              <a href="{{ $targetForm }}" 
                 target="_blank" 
                 rel="noopener noreferrer" 
                 class="btn-ajukan-utama">
                <span>{{ $setting->tombol_teks ?? 'Ajukan Permohonan' }}</span>
                <i class="bi bi-arrow-right-circle-fill fs-5"></i>
              </a>

              <a href="https://wa.me/{{ $cleanAcaraWa }}?text={{ $waText }}" 
                 target="_blank" 
                 rel="noopener noreferrer" 
                 class="btn-wa-hotline">
                <i class="bi bi-whatsapp fs-5"></i>
                <span>Konsultasi via WhatsApp</span>
              </a>
            </div>

            @if(!empty($setting->file_sop) || ($item && $item->file_path))
              @php
                $filePath = $setting->file_sop ?: $item->file_path;
              @endphp
              <div class="mt-2 text-center">
                <a href="{{ asset('storage/' . $filePath) }}" target="_blank" class="small text-white-50 text-decoration-underline d-inline-flex align-items-center gap-1">
                  <i class="bi bi-file-earmark-pdf text-warning"></i> Unduh SOP Pendampingan Acara
                </a>
              </div>
            @endif
          </div>

          <div class="cta-check-list">
            <div class="cta-check-item">
              <i class="bi bi-check-circle-fill"></i>
              <span>Respon cepat 1x24 jam kerja</span>
            </div>
            <div class="cta-check-item">
              <i class="bi bi-check-circle-fill"></i>
              <span>Standar Protokol Resmi Institusi</span>
            </div>
            <div class="cta-check-item">
              <i class="bi bi-check-circle-fill"></i>
              <span>Dukungan Media & Publikasi Humas</span>
            </div>
          </div>

        </div>
      </div>

    </div>

    {{-- SECTION 2: ALUR PROSEDUR PENDAMPINGAN (4 Langkah Mudah) --}}
    <div class="mb-5 pb-2" data-aos="fade-up">
      <div class="d-flex align-items-center gap-3 mb-4">
        <div class="p-2 rounded-3 text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: #046B26;">
          <i class="bi bi-diagram-3-fill fs-5"></i>
        </div>
        <div>
          <h4 class="fw-bold text-dark mb-1">Alur & Prosedur Pendampingan Acara</h4>
          <p class="text-muted small mb-0">Tahapan terstruktur untuk menjamin kelancaran jalannya setiap agenda kampus.</p>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-lg-3 col-md-6 col-12">
          <div class="step-flow-box">
            <div class="step-num-badge">1</div>
            <div class="step-title">Pengajuan Daring</div>
            <p class="step-desc">
              Isi formulir permohonan minimal <strong>H-7</strong> sebelum acara dan lampirkan rancangan konsep rundown.
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="step-flow-box">
            <div class="step-num-badge">2</div>
            <div class="step-title">Rapat Koordinasi</div>
            <p class="step-desc">
              Tim Protokol Humas bertemu dengan panitia untuk menyelaraskan tata tempat, tamu undangan, dan teknis acara.
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="step-flow-box">
            <div class="step-num-badge">3</div>
            <div class="step-title">Gladi & Simulasi</div>
            <p class="step-desc">
              Pelaksanaan gladi bersih (H-1) untuk memastikan kesiapan sound, display LED/LCD, MC, dan barisan prosesi.
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="step-flow-box">
            <div class="step-num-badge">4</div>
            <div class="step-title">Pendampingan Hari-H</div>
            <p class="step-desc">
              Pendampingan langsung oleh Liaison Officer (LO), staf protokol, dan dokumentasi foto/video hingga selesai.
            </p>
          </div>
        </div>
      </div>
    </div>

    {{-- SECTION 3: KATEGORI ACARA YANG DAPAT DIDAMPINGI --}}
    <div class="mb-5 pb-2" data-aos="fade-up">
      <div class="d-flex align-items-center gap-3 mb-4">
        <div class="p-2 rounded-3 text-white d-flex align-items-center justify-content-center" style="width: 44px; height: 44px; background-color: #046B26;">
          <i class="bi bi-grid-3x3-gap-fill fs-5"></i>
        </div>
        <div>
          <h4 class="fw-bold text-dark mb-1">Cakupan Kategori Kegiatan</h4>
          <p class="text-muted small mb-0">Berbagai skala acara yang siap didukung oleh Biro Humas Universitas Ibnu Sina.</p>
        </div>
      </div>

      <div class="row g-3">
        <div class="col-lg-3 col-md-6 col-12">
          <div class="category-event-card">
            <div class="category-icon-wrap">
              <i class="bi bi-mortarboard-fill"></i>
            </div>
            <div class="category-title">Acara Akademik Resmi</div>
            <p class="category-desc">
              Wisuda sarjana & pascasarjana, Dies Natalis, Sidang Senat Terbuka, serta Kuliah Perdana Mahasiswa Baru.
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="category-event-card">
            <div class="category-icon-wrap">
              <i class="bi bi-building-check"></i>
            </div>
            <div class="category-title">Kunjungan VVIP & Mitra</div>
            <p class="category-desc">
              Kunjungan menteri, pimpinan LLDIKTI, kedutaan besar, investor industri, dan penandatanganan MoU kerjasama.
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="category-event-card">
            <div class="category-icon-wrap">
              <i class="bi bi-journal-bookmark-fill"></i>
            </div>
            <div class="category-title">Seminar & Konferensi</div>
            <p class="category-desc">
              Seminar internasional, simposium ilmiah, workshop fakultas, talkshow kemahasiswaan, dan stadium general.
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 col-12">
          <div class="category-event-card">
            <div class="category-icon-wrap">
              <i class="bi bi-trophy-fill"></i>
            </div>
            <div class="category-title">Seremoni & Festival</div>
            <p class="category-desc">
              Pelantikan pimpinan struktural, peresmian fasilitas gedung baru, expo kampus, dan festival budaya/olahraga.
            </p>
          </div>
        </div>
      </div>
    </div>

    {{-- SECTION 4: PROTOCOL TIME NOTICE --}}
    <div class="protocol-notice-box mb-5" data-aos="fade-up">
      <div class="d-flex align-items-start gap-3">
        <i class="bi bi-clock-history fs-3 text-success"></i>
        <div>
          <h6 class="fw-bold text-dark mb-1">Pedoman Batas Waktu Pengajuan:</h6>
          <p class="mb-0 text-muted small" style="line-height: 1.75;">
            Untuk memastikan persiapan berjalan optimal, pengajuan pendampingan disarankan dilakukan selambat-lambatnya <strong>7 hari kerja (H-7)</strong> sebelum acara tingkat fakultas/unit, dan <strong>14 hari kerja (H-14)</strong> untuk acara tingkat universitas atau yang menghadirkan pejabat VVIP/mitra internasional.
          </p>
        </div>
      </div>
    </div>

    {{-- SECTION 5: KOTAK BANTUAN & KONTAK LANGSUNG --}}
    <div class="p-4 bg-white rounded-4 border shadow-sm" data-aos="fade-up">
      <div class="row align-items-center g-3">
        <div class="col-lg-8 col-12">
          <h6 class="fw-bold text-dark mb-1">Punya agenda khusus atau butuh briefing awal?</h6>
          <p class="text-muted small mb-0">
            Tim Biro Humas & Protokoler siap berdiskusi di Gedung Rektorat Lt. 1 UIS atau melalui:
            <a href="https://wa.me/{{ $cleanAcaraWa }}?text={{ $waText }}" target="_blank" rel="noopener noreferrer" class="text-decoration-none fw-bold text-success ms-1">
              <i class="bi bi-whatsapp text-success me-1"></i>{{ $setting->no_wa ?? '081234567890' }}
            </a>
            <span class="mx-2">•</span>
            <a href="mailto:info@uis.ac.id" class="text-decoration-none fw-bold text-dark">
              <i class="bi bi-envelope text-primary me-1"></i>info@uis.ac.id
            </a>
          </p>
        </div>
        <div class="col-lg-4 col-12 text-lg-end">
          <a href="{{ route('homepage.kontak') }}" class="btn-lokasi-humas">
            <i class="bi bi-geo-alt-fill"></i>
            <span>Lokasi Kantor Humas</span>
          </a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection
