@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Kategori Berita</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Informasi & Berita</a></li>
            <li class="breadcrumb-item active">Kategori Berita</li>
        </ol>
    </nav>
</div>

<div class="card shadow-sm border-0" style="border-radius: 14px;">
    <div class="card-header bg-white py-3 border-bottom d-flex flex-wrap align-items-center justify-content-between gap-3">
        <div>
            <h5 class="mb-1 fw-bold text-dark d-flex align-items-center gap-2">
                <i class="bi bi-tags-fill text-primary"></i> Daftar Kategori Berita & Pengumuman
            </h5>
            <small class="text-muted">Kategori yang aktif di sini otomatis tersinkronisasi ke pilihan <strong>Kategori Berita</strong> pada form Tambah & Edit Berita.</small>
        </div>

        <div class="d-flex flex-wrap align-items-center gap-2">
            <form action="{{ route('news-category.index') }}" method="GET" class="d-flex gap-1">
                <div class="input-group input-group-sm" style="width: 230px;">
                    <input type="text" name="search" class="form-control" placeholder="Cari kategori..." value="{{ $search ?? '' }}">
                    <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
                    @if(!empty($search))
                        <a href="{{ route('news-category.index') }}" class="btn btn-outline-danger"><i class="bi bi-x"></i></a>
                    @endif
                </div>
            </form>

            <a href="{{ route('news.create') }}" class="btn btn-outline-primary btn-sm fw-semibold">
                <i class="bi bi-pencil-square me-1"></i> Tulis Berita
            </a>

            <button type="button" class="btn btn-primary btn-sm fw-semibold" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
            </button>
        </div>
    </div>

    <div class="card-body pt-3">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 60px;">Urutan</th>
                        <th>Nama Kategori Berita</th>
                        <th>Slug URL</th>
                        <th class="text-center" style="width: 130px;">Jumlah Berita</th>
                        <th class="text-center" style="width: 115px;">Status</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $cat)
                        <tr>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border fw-bold px-2 py-1">{{ $cat->urutan }}</span>
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <span class="rounded-3 d-inline-flex align-items-center justify-content-center flex-shrink-0"
                                          style="width: 34px; height: 34px; background: {{ ($cat->color ?: '#046B26') }}18; color: {{ $cat->color ?: '#046B26' }}; font-size: 15px;">
                                        <i class="bi {{ $cat->icon ?: 'bi-tag-fill' }}"></i>
                                    </span>
                                    <div>
                                        <div class="fw-bold text-dark">{{ $cat->name }}</div>
                                        @if(!empty($cat->description))
                                            <div class="text-muted small">{{ $cat->description }}</div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                <code class="text-muted small">{{ $cat->slug }}</code>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-light text-dark border px-2 py-1">
                                    {{ $cat->news_count }} Berita
                                </span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('news-category.toggle', $cat->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm p-0 border-0 bg-transparent" title="Klik untuk ubah status Aktif/Nonaktif">
                                        @if($cat->is_active)
                                            <span class="badge bg-success-subtle text-success border border-success-subtle px-2 py-1">
                                                <i class="bi bi-check-circle-fill me-1"></i> Aktif
                                            </span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle px-2 py-1">
                                                <i class="bi bi-slash-circle me-1"></i> Nonaktif
                                            </span>
                                        @endif
                                    </button>
                                </form>
                            </td>
                            <td class="text-center">
                                <div class="d-inline-flex align-items-center gap-1">
                                    <button type="button"
                                            class="btn btn-sm btn-warning text-white btn-edit-cat"
                                            style="width: 31px; height: 31px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                                            data-id="{{ $cat->id }}"
                                            data-name="{{ $cat->name }}"
                                            data-description="{{ $cat->description }}"
                                            data-icon="{{ $cat->icon }}"
                                            data-color="{{ $cat->color ?: '#046B26' }}"
                                            data-urutan="{{ $cat->urutan }}"
                                            data-active="{{ $cat->is_active ? '1' : '0' }}"
                                            title="Edit Kategori">
                                        <i class="bi bi-pencil-fill" style="font-size: 12px;"></i>
                                    </button>

                                    <form action="{{ route('news-category.destroy', $cat->id) }}" method="POST" class="d-inline m-0" onsubmit="return confirm('Hapus kategori berita \'{{ addslashes($cat->name) }}\'?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="btn btn-sm btn-danger"
                                                style="width: 31px; height: 31px; padding: 0; display: inline-flex; align-items: center; justify-content: center;"
                                                title="Hapus Kategori">
                                            <i class="bi bi-trash-fill" style="font-size: 12px;"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-4 text-muted">
                                <i class="bi bi-tags fs-2 d-block mb-2"></i>
                                Belum ada kategori berita yang ditemukan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- Modal Tambah Kategori --}}
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form action="{{ route('news-category.store') }}" method="POST">
                @csrf
                <div class="modal-header text-white" style="background: var(--uis-purple, #046B26);">
                    <h5 class="modal-title fw-bold" id="addCategoryModalLabel">
                        <i class="bi bi-plus-circle me-2"></i>Tambah Kategori Berita
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Nama Kategori Berita <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Contoh: Kesehatan Lingkungan" required maxlength="120">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Deskripsi Singkat (Opsional)</label>
                        <input type="text" name="description" class="form-control" placeholder="Keterangan singkat kategori" maxlength="255">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label class="form-label fw-bold small">Ikon Bootstrap</label>
                            <input type="text" name="icon" class="form-control" value="bi-tag-fill" placeholder="bi-tag-fill">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Warna Badge</label>
                            <input type="color" name="color" class="form-control form-control-color w-100" value="#046B26">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small">Urutan</label>
                            <input type="number" name="urutan" class="form-control" value="{{ $categories->count() + 1 }}" min="1">
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="add_is_active" checked>
                        <label class="form-check-label fw-semibold small" for="add_is_active">Aktifkan (Tampilkan di Form Tambah Berita)</label>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4">
                        <i class="bi bi-check2-circle me-1"></i> Simpan Kategori
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Modal Edit Kategori --}}
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg rounded-4">
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header text-white" style="background: var(--uis-purple, #046B26);">
                    <h5 class="modal-title fw-bold" id="editCategoryModalLabel">
                        <i class="bi bi-pencil-square me-2"></i>Edit Kategori Berita
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Nama Kategori Berita <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_name" class="form-control" required maxlength="120">
                        <div class="form-text small text-muted">Jika nama diubah, seluruh berita yang menggunakan kategori ini akan otomatis ikut diperbarui.</div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold small">Deskripsi Singkat (Opsional)</label>
                        <input type="text" name="description" id="edit_description" class="form-control" maxlength="255">
                    </div>
                    <div class="row g-3 mb-3">
                        <div class="col-md-5">
                            <label class="form-label fw-bold small">Ikon Bootstrap</label>
                            <input type="text" name="icon" id="edit_icon" class="form-control">
                        </div>
                        <div class="col-md-4">
                            <label class="form-label fw-bold small">Warna Badge</label>
                            <input type="color" name="color" id="edit_color" class="form-control form-control-color w-100">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label fw-bold small">Urutan</label>
                            <input type="number" name="urutan" id="edit_urutan" class="form-control" min="1">
                        </div>
                    </div>
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" id="edit_is_active">
                        <label class="form-check-label fw-semibold small" for="edit_is_active">Aktifkan (Tampilkan di Form Tambah Berita)</label>
                    </div>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4">
                        <i class="bi bi-check2-circle me-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.btn-edit-cat').forEach(btn => {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const form = document.getElementById('editCategoryForm');
            form.action = `{{ url('admin-news-category') }}/${id}`;

            document.getElementById('edit_name').value = this.dataset.name || '';
            document.getElementById('edit_description').value = this.dataset.description || '';
            document.getElementById('edit_icon').value = this.dataset.icon || 'bi-tag-fill';
            document.getElementById('edit_color').value = this.dataset.color || '#046B26';
            document.getElementById('edit_urutan').value = this.dataset.urutan || 1;
            document.getElementById('edit_is_active').checked = this.dataset.active === '1';

            const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
            modal.show();
        });
    });
</script>
@endpush
