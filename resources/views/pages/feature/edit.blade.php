@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Edit Keunggulan</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('feature.index') }}">Keunggulan</a></li>
            <li class="breadcrumb-item active">Edit</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8 col-md-10">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-pencil-square me-2 text-warning"></i>Edit Keunggulan Kami
                </h5>
            </div>
            <div class="card-body pt-4">

                {{-- Error Summary --}}
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

                <form action="{{ route('feature.update', $feature->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- Icon (wajib) --}}
                    <div class="mb-3">
                        <label for="icon" class="form-label fw-semibold">
                            Bootstrap Icon Class <span class="text-danger">*</span>
                        </label>
                        <div class="input-group">
                            <span class="input-group-text bg-light text-primary" id="icon-preview-box" style="font-size: 20px;">
                                <i class="bi bi-info-circle"></i>
                            </span>
                            <input type="text"
                                   id="icon"
                                   name="icon"
                                   class="form-control @error('icon') is-invalid @enderror"
                                   value="{{ old('icon', $feature->icon) }}"
                                   placeholder="Contoh: bi-award, bi-shield-check, bi-headset"
                                   oninput="updateIconPreview(this.value)">
                        </div>
                        <div class="form-text">
                            Ketik nama class icon Bootstrap. Lihat daftar ikon di <a href="https://icons.getbootstrap.com/" target="_blank">icons.getbootstrap.com</a>.
                        </div>
                        @error('icon')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Judul (wajib) --}}
                    <div class="mb-3">
                        <label for="judul" class="form-label fw-semibold">
                            Judul Keunggulan <span class="text-danger">*</span>
                        </label>
                        <input type="text"
                               id="judul"
                               name="judul"
                               class="form-control @error('judul') is-invalid @enderror"
                               value="{{ old('judul', $feature->judul) }}"
                               placeholder="Contoh: Motif Terlengkap">
                        @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Deskripsi (wajib) --}}
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label fw-semibold">
                            Deskripsi <span class="text-danger">*</span>
                        </label>
                        <textarea id="deskripsi"
                                  name="deskripsi"
                                  class="form-control @error('deskripsi') is-invalid @enderror"
                                  rows="4"
                                  placeholder="Tuliskan keterangan detail keunggulan kami...">{{ old('deskripsi', strip_tags(html_entity_decode($feature->deskripsi ?? ''))) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Urutan --}}
                    <div class="mb-4 col-sm-4">
                        <label for="urutan" class="form-label fw-semibold">
                            Urutan Tampil
                        </label>
                        <input type="number"
                               id="urutan"
                               name="urutan"
                               class="form-control @error('urutan') is-invalid @enderror"
                               value="{{ old('urutan', $feature->urutan) }}"
                               min="0">
                        <div class="form-text">Angka kecil akan tampil lebih dulu.</div>
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Tombol --}}
                    <div class="d-flex gap-2">
                        <a href="{{ route('feature.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-save me-1"></i> Simpan Perubahan
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
    function updateIconPreview(val) {
        const previewBox = document.getElementById('icon-preview-box');
        const cleanVal = val.trim();
        if (cleanVal) {
            previewBox.innerHTML = '<i class="bi ' + cleanVal + '"></i>';
        } else {
            previewBox.innerHTML = '<i class="bi bi-info-circle"></i>';
        }
    }

    // Run preview on load
    document.addEventListener('DOMContentLoaded', function() {
        updateIconPreview(document.getElementById('icon').value);
    });
</script>
@endpush
