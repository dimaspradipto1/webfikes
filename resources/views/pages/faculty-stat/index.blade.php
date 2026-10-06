@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Statistik Fakultas</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Statistik Fakultas</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm">
    <div class="card-header d-flex align-items-center justify-content-between py-3">
        <h5 class="mb-0 fw-semibold">
            <i class="bi bi-bar-chart-fill me-2 text-primary"></i>Data Statistik "UIS Dalam Angka"
        </h5>
        <a href="{{ route('faculty-stat.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Tambah Data
        </a>
    </div>
    <div class="card-body pt-3">
        <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            <strong>Info:</strong> Section ini menampilkan angka statistik UIS (Jumlah Prodi, Mahasiswa, Dosen, Alumni)
            di atas section <strong>Program Studi</strong> pada halaman beranda. Hanya satu data dengan status
            <span class="badge bg-success">Aktif</span> yang akan tampil di frontend.
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <div class="table-responsive">
            {{ $dataTable->table([
                'class' => 'table table-striped table-bordered align-middle',
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
@endpush
