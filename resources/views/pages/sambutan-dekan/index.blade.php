@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Sambutan & Foto Dekan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Profil & Konten FIKES</li>
            <li class="breadcrumb-item active">Sambutan Dekan</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-10">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-header bg-white py-3 border-bottom d-flex align-items-center justify-content-between">
                <h5 class="mb-0 fw-bold" style="color: var(--fikes-purple, #823ca2);">
                    <i class="bi bi-person-badge-fill me-2"></i>Kelola Sambutan & Foto Dekan
                </h5>
                <span class="badge bg-light text-dark border">Halaman Khusus Sambutan Dekan</span>
            </div>
            <div class="card-body pt-4">

                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger alert-dismissible fade show rounded-3" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Periksa kembali data Anda:</strong>
                        <ul class="mb-0 mt-1 ps-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                <form action="{{ route('sambutan-dekan.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-4 mb-4">
                        {{-- Nama Dekan --}}
                        <div class="col-md-7">
                            <label for="nama_dekan" class="form-label fw-semibold text-dark">
                                Nama Lengkap & Gelar Dekan <span class="text-danger">*</span>
                            </label>
                            <input type="text" id="nama_dekan" name="nama_dekan" class="form-control @error('nama_dekan') is-invalid @enderror" value="{{ old('nama_dekan', $sambutanDekan->nama_dekan) }}" placeholder="Contoh: Dr. Apt. H. Nama Dekan, M.Kes" required>
                            <div class="form-text small text-muted">Akan ditampilkan di bawah foto dan di kartu sambutan homepage.</div>
                            @error('nama_dekan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Jabatan Dekan --}}
                        <div class="col-md-5">
                            <label for="jabatan_dekan" class="form-label fw-semibold text-dark">
                                Jabatan Resmi
                            </label>
                            <input type="text" id="jabatan_dekan" name="jabatan_dekan" class="form-control @error('jabatan_dekan') is-invalid @enderror" value="{{ old('jabatan_dekan', $sambutanDekan->jabatan_dekan ?? 'Dekan Fakultas Ilmu Kesehatan UIS') }}" placeholder="Dekan Fakultas Ilmu Kesehatan UIS">
                            @error('jabatan_dekan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Upload Foto Dekan --}}
                    <div class="mb-4 p-3 rounded-3" style="background: #faf7fc; border: 1px dashed #cbb0d9;">
                        <label for="foto_dekan" class="form-label fw-bold text-dark d-block">
                            <i class="bi bi-camera-fill me-1 text-primary"></i> Foto Resmi Dekan
                        </label>
                        
                        @if($sambutanDekan->foto_dekan)
                            <div class="d-flex align-items-center gap-3 mb-3 p-2 bg-white rounded-3 border shadow-sm" style="max-width: 420px;">
                                <img src="{{ asset('storage/' . $sambutanDekan->foto_dekan) }}" alt="Foto Dekan" class="rounded-3" style="width: 80px; height: 100px; object-fit: cover; border: 2px solid #823ca2;">
                                <div>
                                    <div class="fw-bold small text-dark">Foto Saat Ini Aktif</div>
                                    <div class="text-muted" style="font-size: 12px;">Pilih file baru di bawah jika ingin mengganti. Foto lama akan otomatis terhapus dari server.</div>
                                </div>
                            </div>
                        @endif

                        <input type="file" id="foto_dekan" name="foto_dekan" class="form-control @error('foto_dekan') is-invalid @enderror" accept="image/jpeg,image/png,image/jpg,image/webp">
                        <div class="form-text small text-muted mt-1">
                            <i class="bi bi-info-circle me-1"></i> Format: <strong>JPG, PNG, WEBP</strong>. Maksimal 2MB. Disarankan orientasi Potret (3:4) dengan latar belakang rapi.
                        </div>
                        @error('foto_dekan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Kutipan Singkat Sambutan (Homepage) --}}
                    <div class="mb-4">
                        <label for="kutipan_singkat" class="form-label fw-semibold text-dark">
                            Kutipan Singkat Sambutan <span class="badge bg-warning text-dark ms-1">Tampil di Halaman Depan (Homepage)</span>
                        </label>
                        <textarea id="kutipan_singkat" name="kutipan_singkat" rows="3" class="form-control @error('kutipan_singkat') is-invalid @enderror" placeholder="Contoh: Selamat datang di Fakultas Ilmu Kesehatan UIS. Kami bertekad membentuk generasi tenaga kesehatan yang tidak hanya unggul secara akademis...">{{ old('kutipan_singkat', $sambutanDekan->kutipan_singkat) }}</textarea>
                        <div class="form-text small text-muted">Kutipan ringkas yang menarik perhatian pengunjung di section 3 halaman depan.</div>
                        @error('kutipan_singkat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Naskah Lengkap Sambutan Dekan --}}
                    <div class="mb-4">
                        <label for="sambutan_dekan" class="form-label fw-semibold text-dark">
                            Naskah Lengkap Sambutan Dekan <span class="badge bg-primary ms-1">Tampil di Halaman /sambutan-dekan</span>
                        </label>
                        <textarea id="sambutan_dekan" name="sambutan_dekan" rows="8" class="form-control tinymce-editor @error('sambutan_dekan') is-invalid @enderror" placeholder="Tuliskan amanat, visi pimpinan, dan sambutan lengkap Dekan kepada mahasiswa dan masyarakat...">{{ old('sambutan_dekan', $sambutanDekan->sambutan_dekan) }}</textarea>
                        <div class="form-text small text-muted">Mendukung format teks tebal, miring, list, tabel, dan gambar.</div>
                        @error('sambutan_dekan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center gap-2 pt-3 border-top">
                        <button type="submit" class="btn text-white px-4 py-2 fw-semibold" style="background-color: #823ca2;">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan Sambutan Dekan
                        </button>
                        <a href="{{ route('homepage.sambutan-dekan') }}" target="_blank" class="btn btn-outline-secondary px-3 py-2">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Halaman Publik
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection
