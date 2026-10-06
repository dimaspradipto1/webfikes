@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Pengaturan Program Studi</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item active">Program Studi</li>
        </ol>
    </nav>
</div>

<div class="row">
    <div class="col-12 col-xl-11">

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

        <div class="alert alert-info d-flex align-items-start gap-3 shadow-sm rounded-3 mb-4" role="alert">
            <i class="bi bi-info-circle-fill fs-4 text-primary mt-1"></i>
            <div>
                <h6 class="fw-bold mb-1">Pengaturan Program Studi (Header Website & Kartu Beranda)</h6>
                <p class="mb-0 small text-muted">
                    Halaman ini digunakan untuk mengelola menu <strong>Program Studi</strong> di header/navbar frontend dan bagian <strong>Program Studi Unggulan</strong> di Beranda. Gunakan editor <strong>TinyMCE</strong> pada kolom Deskripsi & Keunggulan untuk mempercantik format teks.
                </p>
            </div>
        </div>

        <form action="{{ route('layanan.update-all') }}" method="POST" id="form-prodi-settings">
            @csrf

            <div class="card shadow-sm border-0 mb-4">
                <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                    <h5 class="mb-0 fw-semibold text-dark">
                        <i class="bi bi-mortarboard-fill text-primary me-2"></i>Daftar Program Studi
                    </h5>
                    <div class="d-flex gap-2">
                        <a href="{{ route('homepage') }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-box-arrow-up-right me-1"></i> Lihat di Website
                        </a>
                        <button type="button" class="btn btn-sm btn-primary" id="btn-add-prodi" style="background: #046B26; border-color: #046B26;">
                            <i class="bi bi-plus-circle-fill me-1"></i> Tambah Menu Prodi
                        </button>
                    </div>
                </div>

                <div class="card-body pt-3">
                    <div id="prodi-list-container" class="d-flex flex-column gap-4">
                        @foreach($prodis as $index => $prodi)
                            <div class="card border prodi-item shadow-none rounded-3" style="background: #fafafa;" data-item-index="{{ $index }}">
                                <div class="card-header bg-white d-flex align-items-center justify-content-between py-2 border-bottom">
                                    <div class="d-flex align-items-center gap-2">
                                        <span class="badge bg-primary rounded-pill prodi-index-badge px-2 py-1" style="background: #046B26 !important;">
                                            Menu #{{ $loop->iteration }}
                                        </span>
                                        <span class="fw-semibold text-dark prodi-title-preview">
                                            {{ $prodi->judul }}
                                        </span>
                                    </div>
                                    <button type="button" class="btn btn-link text-danger p-0 btn-remove-prodi" title="Hapus menu prodi ini">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>

                                <div class="card-body pt-3 pb-3">
                                    <input type="hidden" name="prodis[{{ $index }}][id]" value="{{ $prodi->id }}">

                                    <div class="row g-3">
                                        <!-- Nama Program Studi -->
                                        <div class="col-md-7">
                                            <label class="form-label fw-semibold small text-dark">
                                                Nama Program Studi <span class="text-danger">*</span>
                                            </label>
                                            <input type="text"
                                                   name="prodis[{{ $index }}][judul]"
                                                   class="form-control form-control-sm prodi-judul-input"
                                                   value="{{ old("prodis.{$index}.judul", $prodi->judul) }}"
                                                   placeholder="Contoh: S1 Teknik Informatika / S1 Manajemen / S1 K3"
                                                   required>
                                        </div>

                                        <!-- Icon -->
                                        <div class="col-md-5">
                                            <label class="form-label fw-semibold small text-dark">
                                                Icon Bootstrap <span class="text-danger">*</span>
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-white border-end-0 text-primary">
                                                    <i class="bi {{ $prodi->icon ?: 'bi-mortarboard-fill' }} prodi-icon-preview"></i>
                                                </span>
                                                <input type="text"
                                                       name="prodis[{{ $index }}][icon]"
                                                       class="form-control form-control-sm border-start-0 prodi-icon-input"
                                                       value="{{ old("prodis.{$index}.icon", $prodi->icon ?: 'bi-mortarboard-fill') }}"
                                                       placeholder="bi-mortarboard-fill"
                                                       required>
                                            </div>
                                        </div>

                                        <!-- Link Website Program Studi -->
                                        <div class="col-md-12">
                                            <label class="form-label fw-semibold small text-dark d-flex align-items-center justify-content-between">
                                                <span>
                                                    <i class="bi bi-link-45deg text-primary me-1"></i>Link / URL Website Program Studi
                                                </span>
                                                @if(!empty($prodi->link))
                                                    <a href="{{ $prodi->link }}" target="_blank" class="badge bg-light text-primary text-decoration-none border" style="font-size: 11px;">
                                                        <i class="bi bi-box-arrow-up-right me-1"></i>Test Link
                                                    </a>
                                                @endif
                                            </label>
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text bg-light text-muted border-end-0">
                                                    <i class="bi bi-globe"></i>
                                                </span>
                                                <input type="url"
                                                       name="prodis[{{ $index }}][link]"
                                                       class="form-control form-control-sm border-start-0 font-monospace"
                                                       value="{{ old("prodis.{$index}.link", $prodi->link) }}"
                                                       placeholder="https://kesmas.uis.ac.id atau https://...">
                                            </div>
                                            <div class="form-text" style="font-size: 11.5px;">
                                                Menu di header dropdown akan langsung membuka tautan ini. Jika dikosongkan, akan diarahkan ke halaman detail prodi di portal UIS.
                                            </div>
                                        </div>

                                        <!-- Deskripsi Singkat (TinyMCE) -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small text-dark d-flex align-items-center justify-content-between">
                                                <span><i class="bi bi-card-text text-primary me-1"></i>Deskripsi Singkat (Kartu Beranda)</span>
                                                <span class="badge bg-light text-muted border" style="font-size: 10px;">TinyMCE</span>
                                            </label>
                                            <textarea id="deskripsi_{{ $index }}"
                                                      name="prodis[{{ $index }}][deskripsi]"
                                                      class="form-control prodi-tinymce-deskripsi"
                                                      rows="4"
                                                      placeholder="Ringkasan singkat tentang program studi...">{{ old("prodis.{$index}.deskripsi", $prodi->deskripsi) }}</textarea>
                                        </div>

                                        <!-- Poin Keunggulan (TinyMCE) -->
                                        <div class="col-md-6">
                                            <label class="form-label fw-semibold small text-dark d-flex align-items-center justify-content-between">
                                                <span><i class="bi bi-award text-primary me-1"></i>Kompetensi / Poin Keunggulan</span>
                                                <span class="badge bg-light text-muted border" style="font-size: 10px;">TinyMCE</span>
                                            </label>
                                            <textarea id="rincian_{{ $index }}"
                                                      name="prodis[{{ $index }}][rincian]"
                                                      class="form-control prodi-tinymce-rincian"
                                                      rows="4"
                                                      placeholder="Poin-poin keunggulan atau kurikulum unggulan...">{{ old("prodis.{$index}.rincian", $prodi->rincian) }}</textarea>
                                        </div>

                                        <!-- SK / Akreditasi & Status -->
                                        <div class="col-md-7">
                                            <label class="form-label fw-semibold small text-dark">
                                                Keterangan / Akreditasi <span class="badge bg-secondary fw-normal ms-1" style="font-size:9px">Opsional</span>
                                            </label>
                                            <input type="text"
                                                   name="prodis[{{ $index }}][dasar_hukum]"
                                                   class="form-control form-control-sm"
                                                   value="{{ old("prodis.{$index}.dasar_hukum", $prodi->dasar_hukum) }}"
                                                   placeholder="Contoh: SK LAM-PTKes & Kemendikbudristek">
                                        </div>

                                        <div class="col-md-5 d-flex align-items-center" style="padding-top: 24px;">
                                            <div class="form-check form-switch">
                                                <input class="form-check-input"
                                                       type="checkbox"
                                                       id="aktif_{{ $index }}"
                                                       name="prodis[{{ $index }}][aktif]"
                                                       value="1"
                                                       {{ old("prodis.{$index}.aktif", $prodi->aktif) ? 'checked' : '' }}>
                                                <label class="form-check-label fw-semibold small text-dark" for="aktif_{{ $index }}">
                                                    Tampilkan di Dropdown & Beranda
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-footer bg-light py-3 d-flex justify-content-between align-items-center">
                    <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary px-4 rounded-3">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Dashboard
                    </a>
                    <button type="submit" class="btn btn-primary px-4 rounded-3 fw-bold shadow-sm" style="background: #046B26; border-color: #046B26;">
                        <i class="bi bi-check2-circle me-1"></i> Simpan Pengaturan Program Studi
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const container = document.getElementById('prodi-list-container');
    const btnAdd = document.getElementById('btn-add-prodi');
    const prodiForm = document.getElementById('form-prodi-settings');

    const tinyConfig = {
        height: 220,
        menubar: false,
        plugins: 'advlist autolink lists link charmap preview searchreplace visualblocks code wordcount',
        toolbar: 'undo redo | bold italic underline | forecolor backcolor | bullist numlist | link removeformat code',
        content_style: 'body { font-family: Plus Jakarta Sans, Arial, sans-serif; font-size: 13.5px; line-height: 1.6; }',
    };

    function initTinyMCEOn(textareaId) {
        if (typeof tinymce === 'undefined') return;
        if (tinymce.get(textareaId)) {
            tinymce.get(textareaId).remove();
        }
        tinymce.init({
            ...tinyConfig,
            selector: '#' + textareaId,
            setup: function (editor) {
                editor.on('change keyup', function () {
                    editor.save();
                });
            }
        });
    }

    // Inisialisasi TinyMCE untuk setiap textarea yang ada
    document.querySelectorAll('.prodi-tinymce-deskripsi, .prodi-tinymce-rincian').forEach(function (el) {
        if (el.id) {
            initTinyMCEOn(el.id);
        }
    });

    function updateIndexes() {
        const items = container.querySelectorAll('.prodi-item');
        items.forEach((item, idx) => {
            const badge = item.querySelector('.prodi-index-badge');
            if (badge) badge.textContent = `Menu #${idx + 1}`;
            item.setAttribute('data-item-index', idx);

            // Update basic inputs (kecuali textarea yang terhubung tinymce)
            item.querySelectorAll('input').forEach(input => {
                const name = input.getAttribute('name');
                if (name) {
                    input.setAttribute('name', name.replace(/prodis\[\d+\]/, `prodis[${idx}]`));
                }
                const id = input.getAttribute('id');
                if (id && id.startsWith('aktif_')) {
                    input.setAttribute('id', `aktif_${idx}`);
                }
            });

            item.querySelectorAll('label[for^="aktif_"]').forEach(label => {
                label.setAttribute('for', `aktif_${idx}`);
            });
        });
    }

    // Live update title preview and icon preview
    container.addEventListener('input', function (e) {
        if (e.target.classList.contains('prodi-judul-input')) {
            const card = e.target.closest('.prodi-item');
            const preview = card.querySelector('.prodi-title-preview');
            if (preview) {
                preview.textContent = e.target.value || 'Program Studi Baru';
            }
        }
        if (e.target.classList.contains('prodi-icon-input')) {
            const card = e.target.closest('.prodi-item');
            const iconPreview = card.querySelector('.prodi-icon-preview');
            if (iconPreview) {
                iconPreview.className = `bi ${e.target.value.trim()} prodi-icon-preview`;
            }
        }
    });

    if (btnAdd) {
        btnAdd.addEventListener('click', function () {
            const newIndex = Date.now(); // unique timestamp index
            const card = document.createElement('div');
            card.className = 'card border prodi-item shadow-none rounded-3';
            card.style.background = '#fafafa';
            card.innerHTML = `
                <div class="card-header bg-white d-flex align-items-center justify-content-between py-2 border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-primary rounded-pill prodi-index-badge px-2 py-1" style="background: #046B26 !important;">
                            Menu Baru
                        </span>
                        <span class="fw-semibold text-dark prodi-title-preview">
                            Program Studi Baru
                        </span>
                    </div>
                    <button type="button" class="btn btn-link text-danger p-0 btn-remove-prodi" title="Hapus menu prodi ini">
                        <i class="bi bi-trash-fill"></i> Hapus
                    </button>
                </div>

                <div class="card-body pt-3 pb-3">
                    <div class="row g-3">
                        <div class="col-md-7">
                            <label class="form-label fw-semibold small text-dark">
                                Nama Program Studi <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="prodis[${newIndex}][judul]"
                                   class="form-control form-control-sm prodi-judul-input"
                                   placeholder="Contoh: Program Sarjana (S1) Farmasi"
                                   required>
                        </div>

                        <div class="col-md-5">
                            <label class="form-label fw-semibold small text-dark">
                                Icon Bootstrap <span class="text-danger">*</span>
                            </label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-white border-end-0 text-primary">
                                    <i class="bi bi-mortarboard-fill prodi-icon-preview"></i>
                                </span>
                                <input type="text"
                                       name="prodis[${newIndex}][icon]"
                                       class="form-control form-control-sm border-start-0 prodi-icon-input"
                                       value="bi-mortarboard-fill"
                                       placeholder="bi-mortarboard-fill"
                                       required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label fw-semibold small text-dark">
                                <i class="bi bi-link-45deg text-primary me-1"></i>Link / URL Website Program Studi
                            </label>
                            <div class="input-group input-group-sm">
                                <span class="input-group-text bg-light text-muted border-end-0">
                                    <i class="bi bi-globe"></i>
                                </span>
                                <input type="url"
                                       name="prodis[${newIndex}][link]"
                                       class="form-control form-control-sm border-start-0 font-monospace"
                                       placeholder="https://farmasi.uis.ac.id atau https://...">
                            </div>
                            <div class="form-text" style="font-size: 11.5px;">
                                Menu di header dropdown akan langsung membuka tautan ini. Jika dikosongkan, akan diarahkan ke halaman detail prodi di portal UIS.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark d-flex align-items-center justify-content-between">
                                <span><i class="bi bi-card-text text-primary me-1"></i>Deskripsi Singkat (Kartu Beranda)</span>
                                <span class="badge bg-light text-muted border" style="font-size: 10px;">TinyMCE</span>
                            </label>
                            <textarea id="deskripsi_${newIndex}"
                                      name="prodis[${newIndex}][deskripsi]"
                                      class="form-control prodi-tinymce-deskripsi"
                                      rows="4"
                                      placeholder="Ringkasan singkat tentang program studi..."></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label fw-semibold small text-dark d-flex align-items-center justify-content-between">
                                <span><i class="bi bi-award text-primary me-1"></i>Kompetensi / Poin Keunggulan</span>
                                <span class="badge bg-light text-muted border" style="font-size: 10px;">TinyMCE</span>
                            </label>
                            <textarea id="rincian_${newIndex}"
                                      name="prodis[${newIndex}][rincian]"
                                      class="form-control prodi-tinymce-rincian"
                                      rows="4"
                                      placeholder="Poin-poin keunggulan atau kurikulum unggulan..."></textarea>
                        </div>

                        <div class="col-md-7">
                            <label class="form-label fw-semibold small text-dark">
                                Keterangan / Akreditasi <span class="badge bg-secondary fw-normal ms-1" style="font-size:9px">Opsional</span>
                            </label>
                            <input type="text"
                                   name="prodis[${newIndex}][dasar_hukum]"
                                   class="form-control form-control-sm"
                                   placeholder="Contoh: SK LAM-PTKes & Kemendikbudristek">
                        </div>

                        <div class="col-md-5 d-flex align-items-center" style="padding-top: 24px;">
                            <div class="form-check form-switch">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="aktif_${newIndex}"
                                       name="prodis[${newIndex}][aktif]"
                                       value="1"
                                       checked>
                                <label class="form-check-label fw-semibold small text-dark" for="aktif_${newIndex}">
                                    Tampilkan di Dropdown & Beranda
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            `;
            container.appendChild(card);
            updateIndexes();

            // Initialize TinyMCE for new item
            initTinyMCEOn(`deskripsi_${newIndex}`);
            initTinyMCEOn(`rincian_${newIndex}`);

            card.querySelector('.prodi-judul-input').focus();
        });
    }

    container.addEventListener('click', function (e) {
        const removeBtn = e.target.closest('.btn-remove-prodi');
        if (removeBtn) {
            if (container.querySelectorAll('.prodi-item').length <= 1) {
                alert('Setidaknya harus ada 1 menu Program Studi.');
                return;
            }
            if (confirm('Yakin ingin menghapus program studi ini?')) {
                const card = removeBtn.closest('.prodi-item');
                // Remove tinymce instances if any
                card.querySelectorAll('textarea').forEach(ta => {
                    if (ta.id && typeof tinymce !== 'undefined' && tinymce.get(ta.id)) {
                        tinymce.get(ta.id).remove();
                    }
                });
                card.remove();
                updateIndexes();
            }
        }
    });

    if (prodiForm) {
        prodiForm.addEventListener('submit', function () {
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
            }
        });
    }
});
</script>
@endpush
