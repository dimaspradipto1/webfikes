@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Kelola Organisasi & Kegiatan Mahasiswa</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item">Kemahasiswaan</li>
            <li class="breadcrumb-item active">Organisasi & Kegiatan</li>
        </ol>
    </nav>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="bi bi-check-circle me-1"></i>
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="bi bi-exclamation-triangle me-1"></i>
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm mb-4">
    <div class="card-header d-flex flex-wrap align-items-center justify-content-between gap-2 py-3">
        <h5 class="mb-0 fw-semibold text-dark">
            <i class="bi bi-people-fill me-2 text-primary"></i>Daftar Lembaga & Organisasi Mahasiswa UIS
        </h5>
        <a href="{{ route('organisasi-mahasiswa.create') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-circle me-1"></i> Tambah Organisasi
        </a>
    </div>
    <div class="card-body pt-3">
        <div class="alert alert-info alert-dismissible fade show mb-3" role="alert">
            <i class="bi bi-info-circle-fill me-2"></i>
            Kelola data organisasi kemahasiswaan (BEM, Himpunan Mahasiswa Program Studi, UKM, Komunitas) lengkap dengan profil, logo, visi-misi, susunan pengurus, dan link pendaftaran anggota baru.
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
