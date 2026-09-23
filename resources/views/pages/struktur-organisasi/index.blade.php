@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Struktur Organisasi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Struktur Organisasi</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold text-primary">
                    <i class="bi bi-diagram-3 me-2"></i>Unggah Struktur Organisasi (PNG)
                </h5>
            </div>
            <div class="card-body pt-4">
                <form action="{{ route('struktur-organisasi.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="url_struktur" class="form-label fw-bold">Pilih Gambar Struktur Organisasi</label>
                        <input class="form-control @error('url_struktur') is-invalid @enderror" type="file" id="url_struktur" name="url_struktur" accept="image/png">
                        <div class="form-text text-muted">Format yang didukung: <strong>PNG</strong>. Ukuran maksimal: <strong>2 MB</strong>.</div>
                        @error('url_struktur')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-cloud-upload me-1"></i> Simpan Gambar
                        </button>

                        @if(isset($struktur) && $struktur->url_struktur)
                            <button type="button" class="btn btn-danger" onclick="Swal.fire({title: 'Hapus Struktur Organisasi?', text: 'Gambar struktur organisasi akan dihapus permanen!', icon: 'warning', showCancelButton: true, confirmButtonColor: '#dc3545', cancelButtonColor: '#6c757d', confirmButtonText: '<i class=\'bi bi-trash me-1\'></i> Ya, Hapus', cancelButtonText: 'Batal', reverseButtons: true, customClass: { popup: 'rounded-4 shadow-lg border-0', confirmButton: 'px-4 py-2 rounded-3 fw-semibold', cancelButton: 'px-4 py-2 rounded-3 fw-semibold' }}).then((result) => { if(result.isConfirmed) { document.getElementById('delete-form').submit(); } })">
                                <i class="bi bi-trash me-1"></i> Hapus Gambar
                            </button>
                        @endif
                    </div>
                </form>

                @if(isset($struktur) && $struktur->url_struktur)
                    <form id="delete-form" action="{{ route('struktur-organisasi.destroy', $struktur->id) }}" method="POST" class="d-none">
                        @csrf
                        @method('DELETE')
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-lg-6">
        <div class="card shadow-sm">
            <div class="card-header py-3">
                <h5 class="mb-0 fw-semibold">
                    <i class="bi bi-eye me-2"></i>Pratinjau Struktur Organisasi
                </h5>
            </div>
            <div class="card-body pt-4 text-center">
                @if(isset($struktur) && $struktur->url_struktur)
                    <div class="bg-light p-3 rounded border text-center d-inline-block w-100">
                        <img src="{{ asset($struktur->url_struktur) }}" alt="Struktur Organisasi" class="img-fluid rounded border shadow-sm" style="max-height: 450px;">
                    </div>
                    <div class="mt-2 text-muted small">Path: <code>{{ $struktur->url_struktur }}</code></div>
                @else
                    <div class="py-5 text-center text-muted">
                        <i class="bi bi-image fs-1 d-block mb-3 text-secondary"></i>
                        <span>Belum ada gambar struktur organisasi yang diunggah. Tampilan di halaman utama/Tentang Kami akan tetap kosong.</span>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
