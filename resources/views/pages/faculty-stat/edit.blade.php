@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Edit Statistik Fakultas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('faculty-stat.index') }}">Statistik Fakultas</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-9">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-pencil-fill me-2 text-warning"></i>Edit Data Statistik Fakultas
                </h5>
            </div>
            <div class="card-body pt-4">

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
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

                <form action="{{ route('faculty-stat.update', $facultyStat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- Judul Section --}}
                    <div class="mb-4">
                        <label for="title" class="form-label fw-semibold">
                            Judul Section <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="title"
                               name="title"
                               class="form-control @error('title') is-invalid @enderror"
                               value="{{ old('title', $facultyStat->title) }}"
                               placeholder="Contoh: UIS Dalam Angka">
                        <div class="form-text">Teks judul yang tampil di atas angka statistik.</div>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Angka Statistik --}}
                    <div class="mb-4">
                        <label class="form-label fw-semibold d-block mb-3">
                            <i class="bi bi-hash me-1 text-primary"></i>Angka Statistik <span class="text-danger">*</span>
                        </label>
                        <div class="row g-3">
                            {{-- Jumlah Prodi --}}
                            <div class="col-md-4">
                                <div class="card border-0 bg-primary bg-opacity-10 h-100">
                                    <div class="card-body text-center py-3">
                                        <i class="bi bi-mortarboard fs-3 text-primary mb-2 d-block"></i>
                                        <label for="jumlah_prodi" class="form-label fw-semibold small">Program Studi</label>
                                        <input type="number"
                                               id="jumlah_prodi"
                                               name="jumlah_prodi"
                                               class="form-control text-center fw-bold fs-5 @error('jumlah_prodi') is-invalid @enderror"
                                               value="{{ old('jumlah_prodi', $facultyStat->jumlah_prodi) }}"
                                               min="0">
                                        @error('jumlah_prodi')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Total Mahasiswa --}}
                            <div class="col-md-4">
                                <div class="card border-0 bg-success bg-opacity-10 h-100">
                                    <div class="card-body text-center py-3">
                                        <i class="bi bi-people fs-3 text-success mb-2 d-block"></i>
                                        <label for="total_mahasiswa" class="form-label fw-semibold small">Total Mahasiswa Aktif</label>
                                        <input type="number"
                                               id="total_mahasiswa"
                                               name="total_mahasiswa"
                                               class="form-control text-center fw-bold fs-5 @error('total_mahasiswa') is-invalid @enderror"
                                               value="{{ old('total_mahasiswa', $facultyStat->total_mahasiswa) }}"
                                               min="0">
                                        @error('total_mahasiswa')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            {{-- Total Alumni --}}
                            <div class="col-md-4">
                                <div class="card border-0 bg-info bg-opacity-10 h-100">
                                    <div class="card-body text-center py-3">
                                        <i class="bi bi-award fs-3 text-info mb-2 d-block"></i>
                                        <label for="total_alumni" class="form-label fw-semibold small">Total Alumni</label>
                                        <input type="number"
                                               id="total_alumni"
                                               name="total_alumni"
                                               class="form-control text-center fw-bold fs-5 @error('total_alumni') is-invalid @enderror"
                                               value="{{ old('total_alumni', $facultyStat->total_alumni) }}"
                                               min="0">
                                        @error('total_alumni')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="total_dosen" value="{{ old('total_dosen', $facultyStat->total_dosen ?? 0) }}">
                        </div>
                    </div>

                    {{-- Gambar Opsional --}}
                    <div class="mb-4">
                        <label for="image" class="form-label fw-semibold">
                            Gambar Pendukung
                            <span class="badge bg-secondary fw-normal ms-1" style="font-size:10px">Opsional</span>
                        </label>

                        @if ($facultyStat->image)
                            <div class="mb-3" id="existingImageWrap">
                                <p class="small text-muted mb-1">Gambar saat ini:</p>
                                <img src="{{ asset('storage/' . $facultyStat->image) }}"
                                     alt="Gambar Statistik"
                                     id="existingImg"
                                     style="max-width:280px;height:160px;object-fit:cover;border-radius:10px;border:1px solid #dee2e6">
                                <div class="mt-2">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="remove_image" name="remove_image" value="1"
                                               onchange="toggleRemoveImage(this)">
                                        <label class="form-check-label text-danger small" for="remove_image">
                                            <i class="bi bi-trash me-1"></i>Hapus gambar ini (tanpa mengganti)
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <input type="file"
                               id="image"
                               name="image"
                               class="form-control @error('image') is-invalid @enderror"
                               accept="image/jpg,image/jpeg,image/png,image/webp"
                               onchange="previewImage(this)">
                        <div class="form-text">
                            <i class="bi bi-info-circle me-1"></i>
                            Upload gambar baru untuk mengganti gambar lama. Format: JPG, PNG, WebP. Maks 2MB.
                        </div>
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        {{-- Preview gambar baru --}}
                        <div id="previewWrap" class="mt-3 d-none">
                            <p class="small text-muted mb-1">Preview gambar baru:</p>
                            <img id="previewImg" src="" alt="Preview"
                                 style="max-width:100%;max-height:200px;object-fit:cover;border-radius:10px;border:1px solid #dee2e6">
                        </div>
                    </div>

                    {{-- Status Aktif --}}
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1"
                                   {{ old('is_active', $facultyStat->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="is_active">
                                Aktifkan (tampil di halaman beranda)
                            </label>
                        </div>
                        <div class="form-text">Hanya satu data yang sebaiknya aktif pada satu waktu.</div>
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2 pt-2 border-top mt-2">
                        <a href="{{ route('faculty-stat.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-save me-1"></i> Perbarui Data
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
    function previewImage(input) {
        const wrap = document.getElementById('previewWrap');
        const img  = document.getElementById('previewImg');
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                img.src = e.target.result;
                wrap.classList.remove('d-none');
            };
            reader.readAsDataURL(input.files[0]);
        } else {
            wrap.classList.add('d-none');
        }
    }

    function toggleRemoveImage(cb) {
        const existingImg = document.getElementById('existingImg');
        if (existingImg) {
            existingImg.style.opacity = cb.checked ? '0.3' : '1';
        }
    }
</script>
@endpush
