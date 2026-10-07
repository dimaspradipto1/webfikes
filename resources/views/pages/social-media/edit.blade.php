@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Edit Media Sosial</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('social-media.index') }}">Media Sosial</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow-sm border-0" style="border-radius: 12px;">
            <div class="card-header bg-white py-3" style="border-top: 3px solid #046B26; border-radius: 12px 12px 0 0;">
                <h5 class="mb-0 fw-bold" style="color: #2b2f32; font-size: 16px;">
                    <i class="bi bi-pencil-square me-2" style="color: #046B26;"></i>Edit Data Media Sosial
                </h5>
            </div>
            <div class="card-body pt-4">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Periksa kembali data yang diinput:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('social-media.update', $socialMedia->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Nama Platform --}}
                    <div class="mb-3">
                        <label for="nama" class="form-label fw-bold text-dark">
                            Nama Media Sosial / Platform <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="nama"
                               name="nama"
                               class="form-control @error('nama') is-invalid @enderror"
                               value="{{ old('nama', $socialMedia->nama) }}"
                               placeholder="Contoh: TikTok / Facebook / Instagram / WhatsApp / YouTube"
                               required>
                        <div class="form-text">Nama media sosial yang akan tampil saat di-hover / tooltip.</div>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Upload / Ganti Logo PNG & Live Preview --}}
                    <div class="mb-4">
                        <label for="logo" class="form-label fw-bold text-dark">
                            Upload / Ganti Logo (Format PNG)
                        </label>
                        
                        <input type="file"
                               id="logo"
                               name="logo"
                               class="form-control @error('logo') is-invalid @enderror"
                               accept="image/png,image/webp,image/svg+xml">
                        <div class="form-text mt-1">
                            Format file yang didukung: <strong>PNG (disarankan transparan)</strong>, WebP, SVG. Maks 2MB.
                        </div>
                        @error('logo')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        {{-- Area Preview Logo --}}
                        <div class="mt-3 p-3 bg-light rounded-3 border">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="small fw-bold text-muted text-uppercase" style="letter-spacing: 0.5px;">
                                    <i class="bi bi-eye me-1 text-success"></i> Preview Logo
                                </span>
                                <span id="preview-badge" class="badge {{ $socialMedia->logo_url ? 'bg-success' : 'bg-secondary' }}" style="font-size: 11px;">
                                    {{ $socialMedia->logo_url ? 'Logo Saat Ini' : 'Belum Ada Logo' }}
                                </span>
                            </div>
                            
                            <div class="d-flex align-items-center gap-3">
                                {{-- Box Preview Logo Langsung (Tanpa Background Hijau) --}}
                                <div id="preview-container" class="d-flex align-items-center justify-content-center rounded-3 border bg-white p-1"
                                     style="width: 58px; height: 58px; flex-shrink: 0; box-shadow: 0 1px 4px rgba(0,0,0,0.06);">
                                    @if($socialMedia->logo_url)
                                        <img id="preview-img" src="{{ $socialMedia->logo_url }}" alt="{{ $socialMedia->nama }}"
                                             style="max-width: 48px; max-height: 48px; object-fit: contain; border-radius: 6px;">
                                        <div id="preview-placeholder" class="d-none text-muted text-center" style="font-size: 11px; line-height: 1.2;">
                                            <i class="bi bi-image d-block fs-5 mb-1 text-secondary"></i>Preview
                                        </div>
                                    @else
                                        <img id="preview-img" src="" alt="Preview Logo" class="d-none"
                                             style="max-width: 48px; max-height: 48px; object-fit: contain; border-radius: 6px;">
                                        <div id="preview-placeholder" class="text-muted text-center" style="font-size: 11px; line-height: 1.2;">
                                            <i class="bi bi-image d-block fs-5 mb-1 text-secondary"></i>Preview
                                        </div>
                                    @endif
                                </div>

                                {{-- Keterangan Preview --}}
                                <div class="small text-muted flex-grow-1" id="preview-note">
                                    @if($socialMedia->logo_url)
                                        Menampilkan logo PNG yang tersimpan saat ini. Bila Anda memilih file baru, tampilan di kotak ini akan berganti secara otomatis.
                                    @else
                                        Belum ada logo PNG yang diunggah. Silakan pilih file gambar PNG di atas untuk menampilkan logo di website.
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- URL Tujuan --}}
                    <div class="mb-3">
                        <label for="url" class="form-label fw-bold text-dark">
                            Link / URL Akun Media Sosial <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-muted"><i class="bi bi-link-45deg fs-5"></i></span>
                            <input type="text"
                                   id="url"
                                   name="url"
                                   class="form-control @error('url') is-invalid @enderror"
                                   value="{{ old('url', $socialMedia->url) }}"
                                   placeholder="Contoh: https://tiktok.com/@universitasibnusina atau https://instagram.com/uis_official"
                                   required>
                        </div>
                        <div class="form-text">Tautan langsung ke akun media sosial (akan membuka di tab baru).</div>
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Urutan Tampil --}}
                    <div class="mb-3">
                        <label for="urutan" class="form-label fw-bold text-dark">
                            Urutan Tampil (Posisi Kiri ke Kanan)
                        </label>
                        <input type="number"
                               id="urutan"
                               name="urutan"
                               class="form-control @error('urutan') is-invalid @enderror"
                               value="{{ old('urutan', $socialMedia->urutan) }}"
                               min="0"
                               style="max-width: 140px;">
                        <div class="form-text">Urutan posisi ikon dari kiri ke kanan (angka terkecil tampil lebih awal).</div>
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Status Aktif --}}
                    <div class="mb-4">
                        <div class="form-check form-switch fs-5">
                            <input class="form-check-input"
                                   type="checkbox"
                                   role="switch"
                                   id="is_active"
                                   name="is_active"
                                   value="1"
                                   {{ old('is_active', $socialMedia->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fs-6 fw-bold text-dark ms-2" for="is_active">
                                Aktifkan Media Sosial (Tampil di Frontend)
                            </label>
                        </div>
                        <div class="form-text ms-1">Jika dinonaktifkan, logo tidak akan muncul di beranda.</div>
                    </div>

                    {{-- Tombol Aksi --}}
                    <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                        <a href="{{ route('social-media.index') }}" class="btn btn-outline-secondary px-4">
                            <i class="bi bi-arrow-left me-1"></i> Kembali
                        </a>
                        <button type="submit" class="btn fw-semibold shadow-sm px-4" style="background-color: #046B26; color: #ffffff; border: none;">
                            <i class="bi bi-save me-1"></i> Perbarui Media Sosial
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const logoInput = document.getElementById('logo');
        const previewImg = document.getElementById('preview-img');
        const placeholder = document.getElementById('preview-placeholder');
        const previewBadge = document.getElementById('preview-badge');
        const previewNote = document.getElementById('preview-note');

        if (logoInput) {
            logoInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewImg.src = e.target.result;
                        previewImg.classList.remove('d-none');
                        if (placeholder) placeholder.classList.add('d-none');
                        if (previewBadge) {
                            previewBadge.className = 'badge bg-warning text-dark';
                            previewBadge.textContent = 'Preview File Baru';
                        }
                        if (previewNote) {
                            previewNote.innerHTML = '<span class="text-success fw-bold"><i class="bi bi-check-circle-fill me-1"></i>File terpilih: ' + file.name + '</span> (' + (file.size / 1024).toFixed(1) + ' KB)';
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
</script>
@endpush
