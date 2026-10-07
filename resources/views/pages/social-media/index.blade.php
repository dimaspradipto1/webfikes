@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Link Media Sosial</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Konten Beranda</li>
            <li class="breadcrumb-item active">Link Media Sosial</li>
        </ol>
    </nav>
</div>

{{-- 1. Pengaturan Header Seksi Frontend (Judul, Garis Divider Share, & Teks Kutipan) --}}
<div class="card shadow-sm border-0 mb-4" id="section-setting-card" style="border-radius: 12px;">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between" style="border-top: 3px solid #046B26; border-radius: 12px 12px 0 0;">
        <h5 class="mb-0 fw-bold" style="color: #2b2f32; font-size: 16px;">
            <i class="bi bi-pencil-square me-2" style="color: #046B26;"></i>Pengaturan Judul & Teks Kutipan Seksi Media Sosial
        </h5>
        <span class="badge" style="background-color: #046B26; color: #ffffff; font-size: 11.5px; font-weight: 700; padding: 6px 12px; border-radius: 6px;">
            <i class="bi bi-globe2 me-1"></i>Tampil di Beranda
        </span>
    </div>
    <div class="card-body pt-3 pb-4">
        <form action="{{ route('social-media.update-setting') }}" method="POST">
            @csrf
            
            <div class="row g-3">
                <div class="col-lg-5 col-md-12">
                    <label for="judul_seksi" class="form-label fw-bold text-dark" style="font-size: 13.5px;">
                        Judul Seksi <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           id="judul_seksi"
                           name="judul_seksi"
                           class="form-control @error('judul_seksi') is-invalid @enderror"
                           value="{{ old('judul_seksi', $setting->judul_seksi ?? 'IKUTI UIS DI MEDIA SOSIAL') }}"
                           placeholder="Contoh: IKUTI UIS DI MEDIA SOSIAL"
                           required>
                    <div class="form-text text-muted" style="font-size: 12px;">Teks judul huruf kapital di atas garis divider icon share.</div>
                    @error('judul_seksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-lg-7 col-md-12">
                    <label for="subjudul_seksi" class="form-label fw-bold text-dark" style="font-size: 13.5px;">
                        Teks Kutipan / Subjudul <span class="text-danger">*</span>
                    </label>
                    <textarea id="subjudul_seksi"
                              name="subjudul_seksi"
                              class="form-control @error('subjudul_seksi') is-invalid @enderror"
                              rows="3"
                              placeholder="Ketik kalimat ajakan yang tampil di bawah ikon share..."
                              required>{{ old('subjudul_seksi', $setting->subjudul_seksi ?? '') }}</textarea>
                    <div class="form-text text-muted" style="font-size: 12px;">Kalimat ajakan yang tampil di bawah garis divider share sebelum baris ikon logo.</div>
                    @error('subjudul_seksi')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            {{-- Live Preview Tampilan Teks di Frontend --}}
            <div class="mt-4 p-3 p-md-4 rounded-3 border" style="background-color: #fbfdfc;">
                <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                    <span class="small fw-bold text-success text-uppercase" style="letter-spacing: 0.5px;">
                        <i class="bi bi-eye-fill me-1"></i> Live Preview Tampilan Teks di Beranda
                    </span>
                    <span class="badge bg-light text-muted border" style="font-size: 11px;">Otomatis berubah saat diketik</span>
                </div>

                <div class="text-center py-2 px-1">
                    {{-- Judul Preview --}}
                    <h3 id="preview-heading" class="fw-bold mb-2 text-uppercase" style="color: #2b7044; font-size: 20px; letter-spacing: 0.6px; font-family: 'Plus Jakarta Sans', sans-serif;">
                        {{ $setting->judul_seksi ?? 'IKUTI UIS DI MEDIA SOSIAL' }}
                    </h3>

                    {{-- Divider Preview --}}
                    <div class="d-flex align-items-center justify-content-center gap-3 my-2 mx-auto" style="max-width: 380px;">
                        <span style="flex: 1; height: 3px; background-color: #2b7044; border-radius: 2px;"></span>
                        <span style="color: #2b7044; font-size: 18px;"><i class="bi bi-share"></i></span>
                        <span style="flex: 1; height: 3px; background-color: #2b7044; border-radius: 2px;"></span>
                    </div>

                    {{-- Subjudul Kutipan Preview --}}
                    <p id="preview-quote" class="mt-3 mb-0 mx-auto text-dark" style="max-width: 780px; font-size: 14.5px; line-height: 1.6; font-style: normal;">
                        "{{ $setting->subjudul_seksi ?? 'Dapatkan update terbaru, berita inspiratif, dan berbagai informasi menarik lainnya langsung dari platform media sosial kami. Jangan lewatkan momen penting dari UIS klik ikon di bawah untuk terhubung sekarang juga!' }}"
                    </p>
                </div>
            </div>

            <div class="col-12 text-end pt-3">
                <button type="submit" class="btn fw-semibold shadow-sm px-4 py-2" style="background-color: #046B26; color: #ffffff; border: none; border-radius: 8px;">
                    <i class="bi bi-floppy-fill me-1"></i> Simpan Perubahan Teks Seksi
                </button>
            </div>
        </form>
    </div>
</div>

{{-- 2. Daftar Logo & Link Media Sosial --}}
<div class="card shadow-sm border-0" style="border-radius: 12px;">
    <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between flex-wrap gap-2" style="border-top: 3px solid #046B26; border-radius: 12px 12px 0 0;">
        <h5 class="mb-0 fw-bold" style="color: #2b2f32; font-size: 16px;">
            <i class="bi bi-share-fill me-2" style="color: #046B26;"></i>Daftar Link & Logo Media Sosial
        </h5>
        <div class="d-flex align-items-center gap-2">
            <a href="#section-setting-card" class="btn btn-outline-success btn-sm fw-semibold">
                <i class="bi bi-pencil me-1"></i> Edit Teks Judul & Deskripsi
            </a>
            <a href="{{ route('social-media.create') }}" class="btn fw-semibold shadow-sm btn-sm" style="background-color: #046B26; color: #ffffff; border: none; padding: 7px 18px; border-radius: 8px;">
                <i class="bi bi-plus-lg me-1"></i> Tambah Media Sosial
            </a>
        </div>
    </div>
    <div class="card-body pt-3">
        <div class="alert alert-info alert-dismissible fade show d-flex align-items-center mb-4" role="alert" style="background-color: #e8f4fd; border-color: #b8e0fe; color: #0c5460; border-radius: 8px;">
            <i class="bi bi-info-circle-fill fs-5 me-2 text-info"></i>
            <div>
                <strong>Info:</strong> Logo media sosial di bawah ini akan tampil secara horizontal di bawah teks kutipan di atas seksi <strong>Berita</strong> pada beranda website. Klik tombol Tambah untuk mengunggah logo PNG baru atau klik ikon Pensil untuk mengeditnya.
            </div>
            <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

        <div class="table-responsive">
            {{ $dataTable->table([
                'class' => 'table table-hover table-bordered align-middle',
                'style' => 'width:100%',
            ]) }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    @if(app()->environment('production'))
        {!! str_replace('http:', 'https:', $dataTable->scripts()) !!}
    @else
        {!! $dataTable->scripts() !!}
    @endif

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const judulInput = document.getElementById('judul_seksi');
            const subjudulInput = document.getElementById('subjudul_seksi');
            const previewHeading = document.getElementById('preview-heading');
            const previewQuote = document.getElementById('preview-quote');

            if (judulInput && previewHeading) {
                judulInput.addEventListener('input', function () {
                    previewHeading.textContent = this.value.trim() ? this.value : 'IKUTI UIS DI MEDIA SOSIAL';
                });
            }

            if (subjudulInput && previewQuote) {
                subjudulInput.addEventListener('input', function () {
                    const val = this.value.trim();
                    previewQuote.textContent = val ? '"' + val + '"' : '';
                });
            }
        });
    </script>
@endpush
