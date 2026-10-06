@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Tambah Poin Visi/Misi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('visimisi.index') }}">Visi & Misi</a></li>
            <li class="breadcrumb-item active">Tambah</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-plus-circle-fill me-2 text-primary"></i>Form Tambah Poin
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

                <form action="{{ route('visimisi.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="tipe" class="form-label fw-semibold">Tipe <span class="text-danger">*</span></label>
                        <select id="tipe" name="tipe" class="form-select @error('tipe') is-invalid @enderror" required>
                            <option value="" disabled selected>Pilih Tipe</option>
                            <option value="visi" {{ old('tipe') == 'visi' ? 'selected' : '' }}>Visi</option>
                            <option value="misi" {{ old('tipe') == 'misi' ? 'selected' : '' }}>Misi</option>
                        </select>
                        @error('tipe')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="isi" class="form-label fw-semibold">Isi <span class="text-danger">*</span></label>
                        <textarea id="isi" name="isi" rows="4"
                                  class="form-control @error('isi') is-invalid @enderror"
                                  placeholder="Contoh: Menjadi Universitas Unggul, Bermartabat, Bereputasi Nasional dan Internasional serta berjiwa Entrepreneur berbasis Imtaq tahun 2029.">{{ old('isi') }}</textarea>
                        <div class="form-text">Untuk Misi, isi satu poin saja per baris data (tambahkan poin lain sebagai data baru).</div>
                        @error('isi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="urutan" class="form-label fw-semibold">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan"
                               class="form-control @error('urutan') is-invalid @enderror"
                               value="{{ old('urutan', 0) }}" min="0">
                        <div class="form-text">Angka kecil tampil lebih dulu (khusus untuk poin bertipe sama).</div>
                        @error('urutan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <a href="{{ route('visimisi.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left me-1"></i> Batal
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-1"></i> Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
