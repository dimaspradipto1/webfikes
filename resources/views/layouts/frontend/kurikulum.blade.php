@extends('layouts.frontend.template')

@section('title', ($pageTitle ?? 'Kurikulum Program Studi') . ' — Universitas Ibnu Sina')
@section('meta_description', 'Struktur kurikulum lengkap per semester dan unduhan silabus RPS program studi Universitas Ibnu Sina (UIS) Universitas Ibnu Sina.')

@push('styles')
<style>
  .kurikulum-hero {
    background: var(--obsidian-dark);
    padding: 65px 0 45px;
    border-bottom: 2px solid var(--uis-purple);
  }
  .prodi-header-pill {
    background: #ffc107;
    background: #FED802;
    color: #032e12;
    font-size: 24px;
    font-weight: 800;
    padding: 18px 30px;
    border-radius: 50px;
    display: block;
    width: 100%;
    text-align: center;
    box-shadow: 0 8px 25px rgba(229, 168, 35, 0.35);
    letter-spacing: 0.5px;
    margin-bottom: 25px;
  }
  @media (max-width: 768px) {
    .prodi-header-pill {
      font-size: 17px;
      padding: 14px 20px;
      border-radius: 35px;
    }
  }

  .prodi-tab-nav {
    display: flex;
    flex-wrap: wrap;
    gap: 10px;
    justify-content: center;
    margin-bottom: 35px;
  }
  .prodi-tab-btn {
    padding: 10px 22px;
    border-radius: 50px;
    font-size: 13.5px;
    font-weight: 700;
    text-decoration: none !important;
    background: #ffffff;
    border: 1.5px solid var(--border-light);
    color: #475569 !important;
    transition: all 0.25s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.03);
  }
  .prodi-tab-btn:hover, .prodi-tab-btn.active {
    background: var(--uis-purple, #046B26) !important;
    color: #ffffff !important;
    border-color: var(--uis-purple, #046B26);
    box-shadow: 0 6px 18px rgba(4, 107, 38, 0.3);
  }

  /* Table Style Matching Screenshot */
  .kurikulum-table-card {
    background: #ffffff;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    border: 1px solid var(--border-light);
  }
  .table-kurikulum {
    margin-bottom: 0;
    border-collapse: collapse;
    width: 100%;
  }
  .table-kurikulum thead th {
    background: #501224; /* Maroon header like screenshot */
    background: #032e12;
    color: #ffffff;
    font-weight: 700;
    font-size: 13.5px;
    padding: 14px 16px;
    text-align: center;
    vertical-align: middle;
    border: 1px solid rgba(255,255,255,0.1);
  }
  .table-kurikulum tbody td {
    padding: 12px 16px;
    font-size: 13.5px;
    vertical-align: middle;
    border: 1px solid #e2e8f0;
    color: #1e293b;
  }
  .table-kurikulum tr.semester-heading-row td {
    background: #f8fafc;
    color: #0f172a;
    font-weight: 800;
    font-size: 14px;
    letter-spacing: 0.5px;
    border-top: 2px solid #cbd5e1;
    border-bottom: 2px solid #cbd5e1;
    padding: 10px 16px;
  }
  .table-kurikulum tbody tr:hover td {
    background-color: #fbf8fd;
  }
  .btn-rps-download {
    background: #501224;
    background: #032e12;
    color: #ffffff !important;
    border: none;
    font-size: 11.5px;
    font-weight: 700;
    padding: 6px 14px;
    border-radius: 50px;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    text-decoration: none !important;
    transition: all 0.2s ease;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
  }
  .btn-rps-download:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(96, 35, 124, 0.4);
    color: #ffffff !important;
  }
</style>
@endpush

@section('content')
<!-- Header Hero -->
<div class="kurikulum-hero text-white">
  <div class="container text-center">
    <nav aria-label="breadcrumb" class="mb-3">
      <ol class="breadcrumb justify-content-center mb-0">
        <li class="breadcrumb-item"><a href="{{ route('homepage') }}" class="text-white-50 text-decoration-none">Beranda</a></li>
        <li class="breadcrumb-item"><a href="#" class="text-white-50 text-decoration-none">Akademik</a></li>
        <li class="breadcrumb-item active text-white" aria-current="page">Kurikulum</li>
      </ol>
    </nav>
    <div class="badge px-3 py-2 rounded-pill mb-2" style="background: rgba(229, 168, 35, 0.2); color: #FED802; border: 1px solid rgba(229, 168, 35, 0.4);">
      <i class="bi bi-mortarboard-fill me-1"></i> Layanan Akademik Universitas Ibnu Sina
    </div>
    <h1 class="fw-bold mb-2" style="font-size: 34px;">Kurikulum & Capaian Pembelajaran</h1>
    <p class="text-white-50 mx-auto mb-0" style="max-width: 620px; font-size: 14.5px;">
      Struktur kurikulum berbasis kompetensi dan Kerangka Kualifikasi Nasional Indonesia (KKNI) untuk setiap program studi di Universitas Ibnu Sina.
    </p>
  </div>
</div>

<section class="section-bg-sand py-5">
  <div class="container py-3">

    <!-- Prodi Selector Tabs -->
    @if(isset($prodis) && $prodis->count() > 0)
      <div class="prodi-tab-nav" data-aos="fade-up">
        @foreach($prodis as $p)
          <a href="{{ route('homepage.kurikulum', ['prodi' => $p->id]) }}" class="prodi-tab-btn {{ ($currentProdi->id ?? 0) === $p->id ? 'active' : '' }}">
            <i class="bi bi-mortarboard me-1"></i> {{ $p->judul }}
          </a>
        @endforeach
      </div>
    @endif

    <!-- Header Banner Kuning / Gold Sesuai Permintaan -->
    <div class="text-center" data-aos="fade-up">
      <div class="prodi-header-pill">
        Kurikulum {{ $currentProdi->judul ?? 'Program Studi Universitas Ibnu Sina' }}
      </div>
    </div>

    <!-- Summary & Info -->
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4 bg-white p-3 rounded-4 shadow-sm border" data-aos="fade-up">
      <div class="d-flex align-items-center gap-3">
        <div class="rounded-circle p-2 d-flex align-items-center justify-content-center text-white" style="width: 44px; height: 44px; background: #046B26;">
          <i class="bi bi-book-half fs-5"></i>
        </div>
        <div>
          <h5 class="fw-bold text-dark mb-0">{{ $currentProdi->judul ?? 'Program Studi' }}</h5>
          <small class="text-muted">Total Beban Studi: <strong>{{ $totalSks }} SKS</strong> &bull; Total Matakuliah: <strong>{{ $totalMatakuliah }} MK</strong></small>
        </div>
      </div>
      <div class="mt-2 mt-md-0">
        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill fw-bold" style="font-size: 12.5px;">
          <i class="bi bi-check-circle-fill me-1"></i> Kurikulum Berlaku 2026/2027
        </span>
      </div>
    </div>

    <!-- Tabel Kurikulum Berkelompok Per Semester -->
    <div class="kurikulum-table-card" data-aos="fade-up">
      <div class="table-responsive">
        <table class="table table-kurikulum">
          <thead>
            <tr>
              <th style="width: 6%;">No</th>
              <th style="width: 16%;">Kode_MK</th>
              <th>Nama Matakuliah</th>
              <th style="width: 10%;">Semester</th>
              <th style="width: 12%;">Jumlah SKS</th>
              <th style="width: 14%;">RPS</th>
            </tr>
          </thead>
          <tbody>
            @if(isset($coursesBySemester) && $coursesBySemester->count() > 0)
              @php
                $romawi = [1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V', 6 => 'VI', 7 => 'VII', 8 => 'VIII'];
              @endphp
              @foreach($coursesBySemester as $sem => $courseList)
                <!-- Heading Semester -->
                <tr class="semester-heading-row">
                  <td colspan="6">
                    <div class="d-flex align-items-center justify-content-between">
                      <span><i class="bi bi-calendar3 me-2 text-primary"></i>SEMESTER {{ $romawi[$sem] ?? $sem }}</span>
                      <span class="badge bg-secondary font-monospace fw-normal" style="font-size: 11px;">
                        Subtotal: {{ $courseList->sum('sks') }} SKS
                      </span>
                    </div>
                  </td>
                </tr>

                @foreach($courseList as $idx => $course)
                  <tr>
                    <td class="text-center fw-semibold text-muted">{{ $idx + 1 }}</td>
                    <td class="text-center font-monospace fw-bold text-dark">{{ $course->kode_mk }}</td>
                    <td>
                      <span class="fw-bold text-dark">{{ $course->nama_mk }}</span>
                      @if($course->kategori && $course->kategori !== 'Wajib')
                        <span class="badge bg-light text-secondary border ms-1" style="font-size: 10px;">{{ $course->kategori }}</span>
                      @endif
                      @if(!empty($course->deskripsi))
                        <small class="text-muted d-block mt-1" style="font-size: 11.5px;">{{ $course->deskripsi }}</small>
                      @endif
                    </td>
                    <td class="text-center fw-bold">{{ $course->semester_romawi }}</td>
                    <td class="text-center">
                      <span class="badge bg-warning text-dark px-2 py-1 fw-bold" style="font-size: 12px;">{{ $course->sks }}</span>
                    </td>
                    <td class="text-center">
                      @if(!empty($course->rps_url))
                        <a href="{{ $course->rps_url }}" target="_blank" class="btn-rps-download">
                          <i class="bi bi-download"></i> Download
                        </a>
                      @else
                        <button class="btn btn-sm btn-light border text-muted rounded-pill px-3 py-1" style="font-size: 11px;" disabled>
                          <i class="bi bi-file-earmark-text me-1"></i> RPS
                        </button>
                      @endif
                    </td>
                  </tr>
                @endforeach
              @endforeach
            @else
              <tr>
                <td colspan="6" class="text-center py-5">
                  <i class="bi bi-journal-x fs-1 text-muted d-block mb-2"></i>
                  <h6 class="fw-bold text-dark">Data Matakuliah Belum Tersedia</h6>
                  <p class="text-muted small mb-0">Daftar kurikulum untuk program studi ini akan segera diperbarui oleh pimpinan.</p>
                </td>
              </tr>
            @endif
          </tbody>
        </table>
      </div>
    </div>

    <!-- Info Bantuan Box -->
    <div class="mt-5 p-4 rounded-4 text-white d-flex flex-wrap align-items-center justify-content-between gap-3 shadow-sm" style="background: #032e12; border: 1px solid rgba(255,255,255,0.2);" data-aos="fade-up">
      <div>
        <h5 class="fw-bold text-white mb-1"><i class="bi bi-question-circle-fill me-2 text-warning"></i>Butuh Informasi Kurikulum & Konversi SKS?</h5>
        <p class="text-white-50 small mb-0">Hubungi Bagian Akademik & Tata Usaha Universitas Ibnu Sina untuk panduan registrasi mata kuliah dan bimbingan akademik.</p>
      </div>
      <a href="{{ route('homepage.kontak') }}" class="btn btn-warning rounded-pill px-4 fw-bold" style="color: #032e12;">
        <i class="bi bi-telephone-fill me-1"></i> Hubungi Kami
      </a>
    </div>

  </div>
</section>
@endsection
