@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Pengaturan Navbar Frontend & Admin</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Pengaturan & Administrator</li>
            <li class="breadcrumb-item active">Pengaturan Navbar</li>
        </ol>
    </nav>
</div>

<style>
    .nav-cfg-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.05);
    }

    .nav-preview-frame {
        border-radius: 14px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.1);
        background: #0f172a;
    }

    .nav-preview-bar {
        background: #1e293b;
        padding: 9px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .nav-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .pv-fe-nav {
        background: {{ $themeSetting->header_bg_color ?? '#046B26' }};
        border-bottom: 3px solid {{ $themeSetting->header_border_color ?? '#FED802' }};
        padding: 14px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }

    .pv-ad-nav {
        background: {{ $themeSetting->admin_header_bg_color ?? '#046B26' }};
        border-bottom: 3px solid {{ $themeSetting->admin_header_border_color ?? '#FED802' }};
        padding: 12px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }
</style>

<section class="section">
    <!-- Live Preview Navbar Frontend -->
    <div class="nav-preview-frame mb-3">
        <div class="nav-preview-bar">
            <div class="d-flex align-items-center">
                <span class="nav-dot" style="background: #ef4444;"></span>
                <span class="nav-dot" style="background: #f59e0b;"></span>
                <span class="nav-dot" style="background: #22c55e;"></span>
                <span class="text-white-50 small ms-2 font-monospace">Pratinjau Langsung: Navbar Header Frontend</span>
            </div>
            <a href="{{ url('/') }}" target="_blank" class="btn btn-sm btn-outline-light py-0 px-2" style="font-size: 11px;">
                <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Website
            </a>
        </div>
        <div class="pv-fe-nav">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ $navbarSetting->frontend_logo_url }}" id="pvFeLogo" alt="Logo" style="height: 40px; width: auto; object-fit: contain;">
                <div style="line-height: 1.15;">
                    <div id="pvFeTitle" style="font-weight: 800; font-size: 0.9rem; color: {{ $themeSetting->header_text_color ?? '#ffffff' }}; text-transform: uppercase;">{{ $navbarSetting->frontend_title }}</div>
                    <div id="pvFeSubtitle" style="font-size: 0.72rem; opacity: 0.85; color: {{ $themeSetting->header_text_color ?? '#ffffff' }}; {{ empty($navbarSetting->frontend_subtitle) ? 'display:none;' : '' }}">{{ $navbarSetting->frontend_subtitle }}</div>
                </div>
            </div>
            <div class="d-flex align-items-center gap-2 flex-wrap" style="font-size: 0.78rem; font-weight: 700; color: {{ $themeSetting->header_text_color ?? '#ffffff' }};">
                <span id="pvMenuBeranda" style="{{ $navbarSetting->show_beranda ? '' : 'display:none;' }}">{{ $navbarSetting->menu_beranda_label }}</span>
                <span id="pvMenuProfil" style="{{ $navbarSetting->show_profil ? '' : 'display:none;' }}">{{ $navbarSetting->menu_profil_label }} ▾</span>
                <span id="pvMenuAkademik" style="background: {{ $themeSetting->header_active_bg_color ?? '#FED802' }}; color: {{ $themeSetting->header_active_text_color ?? '#046B26' }}; padding: 4px 10px; border-radius: 7px; {{ $navbarSetting->show_akademik ? '' : 'display:none;' }}">{{ $navbarSetting->menu_akademik_label }} ▾</span>
                <span id="pvMenuFakultas" style="{{ $navbarSetting->show_fakultas ? '' : 'display:none;' }}">{{ $navbarSetting->menu_fakultas_label }} ▾</span>
                <span id="pvMenuKemahasiswaan" style="{{ $navbarSetting->show_kemahasiswaan ? '' : 'display:none;' }}">{{ $navbarSetting->menu_kemahasiswaan_label }} ▾</span>
                <span id="pvMenuPublikasi" style="{{ $navbarSetting->show_publikasi ? '' : 'display:none;' }}">{{ $navbarSetting->menu_publikasi_label }} ▾</span>
                <span id="pvMenuInformasi" style="{{ $navbarSetting->show_informasi ? '' : 'display:none;' }}">{{ $navbarSetting->menu_informasi_label }} ▾</span>
                <span id="pvMenuKontak" style="{{ $navbarSetting->show_kontak ? '' : 'display:none;' }}">{{ $navbarSetting->menu_kontak_label }}</span>
                <span id="pvBtnLang" style="background: {{ $themeSetting->header_lang_bg_color ?? '#03521d' }}; color: {{ $themeSetting->header_lang_text_color ?? '#ffffff' }}; padding: 4px 10px; border-radius: 50px; font-size: 0.72rem; {{ $navbarSetting->show_lang_btn ? '' : 'display:none;' }}">🇮🇩 Bahasa Indonesia ▾</span>
            </div>
            <div class="d-flex align-items-center gap-2">
                <span id="pvBtnPmb" style="background: {{ $themeSetting->header_pmb_bg_color ?? '#FED802' }}; color: {{ $themeSetting->header_pmb_text_color ?? '#046B26' }}; padding: 5px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 800; {{ $navbarSetting->show_pmb_btn ? '' : 'display:none;' }}">
                    <i class="bi bi-pencil-square me-1"></i><span id="pvBtnPmbText">{{ $navbarSetting->pmb_btn_label }}</span>
                </span>
                <span id="pvBtnLogin" style="background: {{ $themeSetting->header_login_bg_color ?? '#ffffff' }}; color: {{ $themeSetting->header_login_text_color ?? '#046B26' }}; padding: 5px 12px; border-radius: 8px; font-size: 0.75rem; font-weight: 800; {{ $navbarSetting->show_login_btn ? '' : 'display:none;' }}">
                    <i class="bi bi-box-arrow-in-right me-1"></i><span id="pvBtnLoginText">{{ $navbarSetting->login_btn_label }}</span>
                </span>
            </div>
        </div>
    </div>

    <!-- Live Preview Navbar Admin -->
    <div class="nav-preview-frame mb-4">
        <div class="nav-preview-bar">
            <div class="d-flex align-items-center">
                <span class="nav-dot" style="background: #ef4444;"></span>
                <span class="nav-dot" style="background: #f59e0b;"></span>
                <span class="nav-dot" style="background: #22c55e;"></span>
                <span class="text-white-50 small ms-2 font-monospace">Pratinjau Langsung: Navbar Topbar Panel Admin</span>
            </div>
        </div>
        <div class="pv-ad-nav">
            <div class="d-flex align-items-center gap-2">
                <img src="{{ $navbarSetting->admin_logo_url }}" id="pvAdLogo" alt="Admin Logo" style="height: 36px; width: auto; object-fit: contain;">
                <span id="pvAdTitle" style="color: {{ $themeSetting->admin_header_brand_color ?? '#FED802' }}; font-weight: 800; font-size: 0.95rem;">{{ $navbarSetting->admin_title }}</span>
                <i class="bi bi-list ms-2" style="color: {{ $themeSetting->admin_header_text_color ?? '#ffffff' }}; font-size: 1.3rem;"></i>
            </div>
            <div class="d-flex align-items-center gap-3">
                <span id="pvAdWebBtn" style="background: {{ $themeSetting->admin_accent_color ?? '#FED802' }}; color: {{ $themeSetting->admin_primary_color ?? '#046B26' }}; padding: 4px 12px; border-radius: 50px; font-size: 0.75rem; font-weight: 800; {{ $navbarSetting->show_admin_website_btn ? '' : 'display:none;' }}">
                    <i class="bi bi-globe2 me-1"></i><span id="pvAdWebBtnText">{{ $navbarSetting->admin_website_btn_text }}</span>
                </span>
                <span style="color: {{ $themeSetting->admin_header_text_color ?? '#ffffff' }}; font-size: 0.78rem; font-weight: 700;">
                    <i class="bi bi-person-circle me-1"></i> {{ Auth::user()->name ?? 'Admin' }}
                </span>
            </div>
        </div>
    </div>

    <form action="{{ route('navbar-setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <!-- Kolom Kiri: Brand Frontend & Brand Admin -->
            <div class="col-lg-5">
                <!-- Brand Frontend -->
                <div class="card nav-cfg-card mb-4">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-window-dock text-success"></i> 1. Identitas Navbar Frontend
                        </h6>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Logo Navbar Frontend</label>
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 border">
                                <img src="{{ $navbarSetting->frontend_logo_url }}" id="thumbFeLogo" alt="Logo Frontend" class="rounded-2 border bg-white p-1" style="width: 56px; height: 56px; object-fit: contain;">
                                <div class="flex-grow-1">
                                    <input type="file" name="frontend_logo" id="frontend_logo" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp,image/svg+xml">
                                    <div class="form-text" style="font-size: 11px;">PNG, SVG, WEBP, JPG (Maks. 20 MB).</div>
                                    @if($navbarSetting->hasCustomFrontendLogo())
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="remove_frontend_logo" value="1" id="remove_frontend_logo">
                                            <label class="form-check-label small text-danger fw-semibold" for="remove_frontend_logo">Kembalikan ke Logo Default</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Judul Brand Navbar Frontend <span class="text-danger">*</span></label>
                            <input type="text" name="frontend_title" id="frontend_title" class="form-control fw-bold" value="{{ old('frontend_title', $navbarSetting->frontend_title) }}" required>
                            <div class="form-text small">Contoh: <strong>FAKULTAS ILMU KESEHATAN</strong> atau <strong>FIKES</strong>.</div>
                        </div>

                        <div class="mb-0">
                            <label class="form-label fw-bold small">Subjudul Brand Frontend (Opsional)</label>
                            <input type="text" name="frontend_subtitle" id="frontend_subtitle" class="form-control" value="{{ old('frontend_subtitle', $navbarSetting->frontend_subtitle) }}" placeholder="Kosongkan jika hanya 1 baris judul">
                        </div>
                    </div>
                </div>

                <!-- Brand Admin -->
                <div class="card nav-cfg-card">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-speedometer2 text-success"></i> 2. Identitas Navbar Panel Admin
                        </h6>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Logo Navbar Admin</label>
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 border">
                                <img src="{{ $navbarSetting->admin_logo_url }}" id="thumbAdLogo" alt="Logo Admin" class="rounded-2 border bg-white p-1" style="width: 56px; height: 56px; object-fit: contain;">
                                <div class="flex-grow-1">
                                    <input type="file" name="admin_logo" id="admin_logo" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp,image/svg+xml">
                                    <div class="form-text" style="font-size: 11px;">PNG, SVG, WEBP, JPG (Maks. 20 MB).</div>
                                    @if($navbarSetting->hasCustomAdminLogo())
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="remove_admin_logo" value="1" id="remove_admin_logo">
                                            <label class="form-check-label small text-danger fw-semibold" for="remove_admin_logo">Kembalikan ke Logo Default</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Judul Brand Topbar Admin <span class="text-danger">*</span></label>
                            <input type="text" name="admin_title" id="admin_title" class="form-control fw-bold" value="{{ old('admin_title', $navbarSetting->admin_title) }}" required>
                        </div>

                        <div class="row g-2 align-items-end">
                            <div class="col-8">
                                <label class="form-label fw-bold small">Teks Tombol Website Utama</label>
                                <input type="text" name="admin_website_btn_text" id="admin_website_btn_text" class="form-control" value="{{ old('admin_website_btn_text', $navbarSetting->admin_website_btn_text) }}" required>
                            </div>
                            <div class="col-4">
                                <div class="form-check form-switch p-2 px-3 bg-light rounded-3 border">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" name="show_admin_website_btn" id="show_admin_website_btn" {{ $navbarSetting->show_admin_website_btn ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold small" for="show_admin_website_btn">Tampil</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kolom Kanan: Menu Navigasi Frontend & Tombol Aksi -->
            <div class="col-lg-7">
                <div class="card nav-cfg-card h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-1 d-flex align-items-center gap-2">
                            <i class="bi bi-list-ul text-success"></i> 3. Label & Visibilitas Menu Navbar Frontend
                        </h6>
                        <p class="text-muted small mb-3">Ubah nama menu atau matikan sakelar untuk menyembunyikan menu tertentu di navbar website utama.</p>

                        @php
                            $menuItems = [
                                ['key' => 'beranda',       'pv' => 'pvMenuBeranda',       'suffix' => '',   'hint' => 'Halaman utama beranda'],
                                ['key' => 'profil',        'pv' => 'pvMenuProfil',        'suffix' => ' ▾', 'hint' => 'Dropdown Tentang, Visi Misi, Sambutan, Struktur, Sejarah'],
                                ['key' => 'akademik',      'pv' => 'pvMenuAkademik',      'suffix' => ' ▾', 'hint' => 'Dropdown Kurikulum, Kalender, Pedoman, Sistem Akademik'],
                                ['key' => 'fakultas',      'pv' => 'pvMenuFakultas',      'suffix' => ' ▾', 'hint' => 'Dropdown Daftar Program Studi / Fakultas'],
                                ['key' => 'kemahasiswaan', 'pv' => 'pvMenuKemahasiswaan', 'suffix' => ' ▾', 'hint' => 'Dropdown Prestasi, Ormawa, Galeri, Testimoni'],
                                ['key' => 'publikasi',     'pv' => 'pvMenuPublikasi',     'suffix' => ' ▾', 'hint' => 'Dropdown Jurnal & Publikasi Ilmiah'],
                                ['key' => 'informasi',     'pv' => 'pvMenuInformasi',     'suffix' => ' ▾', 'hint' => 'Dropdown Berita, Pengumuman, Agenda, FAQ'],
                                ['key' => 'kontak',        'pv' => 'pvMenuKontak',        'suffix' => '',   'hint' => 'Halaman kontak & peta lokasi'],
                            ];
                        @endphp

                        <div class="row g-2 mb-4">
                            @foreach($menuItems as $m)
                                @php
                                    $labelField = 'menu_' . $m['key'] . '_label';
                                    $showField  = 'show_' . $m['key'];
                                @endphp
                                <div class="col-md-6">
                                    <div class="p-2 px-3 bg-light rounded-3 border">
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <span class="small fw-bold text-dark text-uppercase" style="font-size: 11px;">Menu {{ ucfirst($m['key']) }}</span>
                                            <div class="form-check form-switch mb-0">
                                                <input class="form-check-input nav-menu-toggle" type="checkbox" name="{{ $showField }}" id="{{ $showField }}" data-pv="{{ $m['pv'] }}" {{ $navbarSetting->$showField ? 'checked' : '' }}>
                                            </div>
                                        </div>
                                        <input type="text"
                                               name="{{ $labelField }}"
                                               id="{{ $labelField }}"
                                               class="form-control form-control-sm fw-semibold nav-menu-label"
                                               data-pv="{{ $m['pv'] }}"
                                               data-suffix="{{ $m['suffix'] }}"
                                               value="{{ old($labelField, $navbarSetting->$labelField) }}"
                                               required>
                                        <div class="text-muted mt-1" style="font-size: 10.5px;">{{ $m['hint'] }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <hr class="my-3">

                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-ui-checks-grid text-success"></i> 4. Tombol Bahasa, PMB & Login (Kanan Navbar)
                        </h6>

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="p-2 px-3 bg-light rounded-3 border d-flex justify-content-between align-items-center">
                                    <div>
                                        <div class="fw-bold small text-dark"><i class="bi bi-translate me-1 text-success"></i> Tombol Pemilih Bahasa</div>
                                        <div class="text-muted" style="font-size: 11px;">Tampilkan dropdown pilihan bahasa di navbar sebelah menu Kontak.</div>
                                    </div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input nav-menu-toggle" type="checkbox" name="show_lang_btn" id="show_lang_btn" data-pv="pvBtnLang" {{ $navbarSetting->show_lang_btn ? 'checked' : '' }}>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold small text-dark"><i class="bi bi-pencil-square me-1 text-warning"></i> Tombol PMB</span>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input nav-menu-toggle" type="checkbox" name="show_pmb_btn" id="show_pmb_btn" data-pv="pvBtnPmb" {{ $navbarSetting->show_pmb_btn ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <label class="form-label small fw-semibold mb-1">Teks Tombol</label>
                                    <input type="text" name="pmb_btn_label" id="pmb_btn_label" class="form-control form-control-sm mb-2 fw-bold" value="{{ old('pmb_btn_label', $navbarSetting->pmb_btn_label) }}" required>
                                    <label class="form-label small fw-semibold mb-1">Link URL Khusus (Opsional)</label>
                                    <input type="text" name="pmb_btn_url" id="pmb_btn_url" class="form-control form-control-sm" value="{{ old('pmb_btn_url', $navbarSetting->pmb_btn_url) }}" placeholder="Kosongkan untuk pakai link PMB default">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="p-3 bg-light rounded-3 border h-100">
                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                        <span class="fw-bold small text-dark"><i class="bi bi-box-arrow-in-right me-1 text-primary"></i> Tombol Login</span>
                                        <div class="form-check form-switch mb-0">
                                            <input class="form-check-input nav-menu-toggle" type="checkbox" name="show_login_btn" id="show_login_btn" data-pv="pvBtnLogin" {{ $navbarSetting->show_login_btn ? 'checked' : '' }}>
                                        </div>
                                    </div>
                                    <label class="form-label small fw-semibold mb-1">Teks Tombol</label>
                                    <input type="text" name="login_btn_label" id="login_btn_label" class="form-control form-control-sm fw-bold" value="{{ old('login_btn_label', $navbarSetting->login_btn_label) }}" required>
                                    <div class="text-muted mt-2" style="font-size: 11px;">Mengarah langsung ke halaman <code>/login</code>.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card nav-cfg-card mt-4">
            <div class="card-body py-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <button type="button" class="btn btn-outline-danger rounded-pill px-4 fw-bold" onclick="if(confirm('Kembalikan pengaturan Navbar Frontend & Admin ke standar awal?')) document.getElementById('resetNavbarSettingForm').submit();">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset ke Standar Awal
                </button>
                <div class="d-flex gap-2">
                    <a href="{{ url('/') }}" target="_blank" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Frontend
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
                        <i class="bi bi-check2-circle me-1"></i> Simpan Pengaturan Navbar
                    </button>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('navbar-setting.reset') }}" method="POST" id="resetNavbarSettingForm" class="d-none">
        @csrf
    </form>
</section>

<script>
    (function () {
        const bindText = (inputId, targetId, hideIfEmpty = false) => {
            const inp = document.getElementById(inputId);
            const tgt = document.getElementById(targetId);
            if (!inp || !tgt) return;
            inp.addEventListener('input', () => {
                tgt.textContent = inp.value;
                if (hideIfEmpty) tgt.style.display = inp.value.trim() ? '' : 'none';
            });
        };

        bindText('frontend_title', 'pvFeTitle');
        bindText('frontend_subtitle', 'pvFeSubtitle', true);
        bindText('admin_title', 'pvAdTitle');
        bindText('admin_website_btn_text', 'pvAdWebBtnText');
        bindText('pmb_btn_label', 'pvBtnPmbText');
        bindText('login_btn_label', 'pvBtnLoginText');

        document.querySelectorAll('.nav-menu-label').forEach(inp => {
            inp.addEventListener('input', () => {
                const pv = document.getElementById(inp.dataset.pv);
                if (pv) pv.textContent = inp.value + (inp.dataset.suffix || '');
            });
        });

        document.querySelectorAll('.nav-menu-toggle').forEach(cb => {
            cb.addEventListener('change', () => {
                const pv = document.getElementById(cb.dataset.pv);
                if (pv) pv.style.display = cb.checked ? '' : 'none';
            });
        });

        const showAdWeb = document.getElementById('show_admin_website_btn');
        if (showAdWeb) {
            showAdWeb.addEventListener('change', () => {
                document.getElementById('pvAdWebBtn').style.display = showAdWeb.checked ? '' : 'none';
            });
        }

        const feLogo = document.getElementById('frontend_logo');
        if (feLogo) {
            feLogo.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const url = URL.createObjectURL(this.files[0]);
                    document.getElementById('pvFeLogo').src = url;
                    document.getElementById('thumbFeLogo').src = url;
                }
            });
        }

        const adLogo = document.getElementById('admin_logo');
        if (adLogo) {
            adLogo.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const url = URL.createObjectURL(this.files[0]);
                    document.getElementById('pvAdLogo').src = url;
                    document.getElementById('thumbAdLogo').src = url;
                }
            });
        }
    })();
</script>
@endsection
