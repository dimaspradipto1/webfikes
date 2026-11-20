@extends('layouts.dashboard.template')

@section('content')
<div class="pagetitle">
    <h1>Pengaturan Halaman Login</h1>
    <nav>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item">Pengaturan & Administrator</li>
            <li class="breadcrumb-item active">Pengaturan Login</li>
        </ol>
    </nav>
</div>

<style>
    .login-cfg-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 6px 25px rgba(0, 0, 0, 0.05);
    }

    .color-picker-group {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #f8fafc;
        border: 1.5px solid #e2e8f0;
        border-radius: 12px;
        padding: 8px 12px;
        transition: all 0.2s ease;
    }

    .color-picker-group input[type="color"] {
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 8px;
        padding: 0;
        cursor: pointer;
        background: transparent;
        flex-shrink: 0;
    }

    .color-picker-group input[type="text"] {
        border: none;
        background: transparent;
        font-family: monospace;
        font-weight: 700;
        font-size: 0.9rem;
        color: #1e293b;
        width: 100%;
        outline: none;
        text-transform: uppercase;
    }

    /* Live Preview Browser Frame */
    .login-preview-browser {
        border-radius: 16px;
        overflow: hidden;
        border: 1px solid #cbd5e1;
        box-shadow: 0 14px 35px rgba(15, 23, 42, 0.12);
        background: #0f172a;
    }

    .login-preview-bar {
        background: #1e293b;
        padding: 10px 16px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .b-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        display: inline-block;
        margin-right: 5px;
    }

    .pv-login-shell {
        display: flex;
        min-height: 410px;
        background: #edf6f0;
    }

    .pv-login-left {
        flex: 1.1;
        position: relative;
        background-size: cover;
        background-position: center bottom;
        padding: 20px;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
    }

    .pv-login-brand-pill {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: rgba(2, 46, 18, 0.85);
        backdrop-filter: blur(10px);
        border: 1.5px solid rgba(254, 216, 2, 0.5);
        padding: 7px 15px;
        border-radius: 100px;
        align-self: flex-start;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.25);
    }

    .pv-login-right {
        flex: 0.95;
        padding: 18px 24px;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        transition: background 0.2s ease;
    }

    .pv-login-card {
        width: 100%;
        max-width: 340px;
        background: #ffffff;
        border-radius: 16px;
        padding: 18px 20px;
        border: 1.5px solid rgba(4, 107, 38, 0.16);
        border-top: 4px solid #046B26;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
    }

    @media (max-width: 767.98px) {
        .pv-login-left {
            display: none;
        }
    }
</style>

<section class="section">
    <!-- Live Preview Mockup Halaman Login -->
    <div class="login-preview-browser mb-4">
        <div class="login-preview-bar">
            <div class="d-flex align-items-center">
                <span class="b-dot" style="background: #ef4444;"></span>
                <span class="b-dot" style="background: #f59e0b;"></span>
                <span class="b-dot" style="background: #22c55e;"></span>
                <span class="text-white-50 small ms-2 font-monospace">{{ url('/login') }} — Pratinjau Langsung Halaman Login</span>
            </div>
            <a href="{{ route('login') }}" target="_blank" class="btn btn-sm btn-outline-light py-0 px-2" style="font-size: 11.5px;">
                <i class="bi bi-box-arrow-up-right me-1"></i> Buka Halaman Login
            </a>
        </div>

        <div class="pv-login-shell">
            <!-- Left Showcase Panel Preview -->
            <div class="pv-login-left" id="pvLeftBg" style="background-image: url('{{ $loginSetting->background_image_url }}');">
                <div class="pv-login-brand-pill" id="pvBrandPill" style="border-color: {{ $loginSetting->accent_color }}80;">
                    <img src="{{ $loginSetting->brand_logo_url }}" id="pvBrandLogo" alt="Logo" style="width: 32px; height: 32px; object-fit: contain;">
                    <div>
                        <div id="pvBrandTitle" style="color: #fff; font-weight: 800; font-size: 13px; line-height: 1.1;">{{ $loginSetting->brand_title }}</div>
                        <div id="pvBrandSubtitle" style="color: {{ $loginSetting->accent_color }}; font-size: 10px; font-weight: 600;">{{ $loginSetting->brand_subtitle }}</div>
                    </div>
                </div>
            </div>

            <!-- Right Auth Panel Preview -->
            <div class="pv-login-right" id="pvRightBg" style="background: {{ $loginSetting->right_panel_bg_color }};">
                <div class="d-flex justify-content-between align-items-center w-100" style="max-width: 340px;">
                    <span id="pvBackBtn" style="background: #fff; color: {{ $loginSetting->primary_color }}; border: 1px solid {{ $loginSetting->primary_color }}40; padding: 4px 10px; border-radius: 7px; font-size: 10.5px; font-weight: 600;">
                        ← <span id="pvBackBtnText">{{ $loginSetting->back_button_text }}</span>
                    </span>
                    <span id="pvStatusBadge" style="background: #fff; color: {{ $loginSetting->primary_color }}; border: 1px solid {{ $loginSetting->primary_color }}40; padding: 3px 10px; border-radius: 20px; font-size: 10px; font-weight: 700; {{ $loginSetting->show_status_badge ? '' : 'display:none;' }}">
                        <span style="display:inline-block; width:6px; height:6px; border-radius:50%; background:#22c55e; margin-right:3px;"></span>
                        <span id="pvStatusBadgeText">{{ $loginSetting->status_badge_text }}</span>
                    </span>
                </div>

                <div class="pv-login-card my-2" id="pvLoginCard" style="background: {{ $loginSetting->card_bg_color }}; border-top-color: {{ $loginSetting->primary_color }};">
                    <div class="mb-2">
                        <span id="pvCardBadge" style="background: {{ $loginSetting->right_panel_bg_color }}; color: {{ $loginSetting->primary_color }}; font-size: 9.5px; font-weight: 800; padding: 2px 7px; border-radius: 5px; display: inline-flex; align-items: center; gap: 4px;">
                            <i class="bi bi-shield-lock-fill"></i>
                            <span id="pvCardBadgeText">{{ $loginSetting->card_badge_text }}</span>
                        </span>
                        <h6 id="pvCardTitle" class="fw-bold text-dark mb-1 mt-1" style="font-size: 16px;">{{ $loginSetting->card_title }}</h6>
                        <p id="pvCardSubtitle" class="text-muted mb-2" style="font-size: 11px; line-height: 1.35;">{{ $loginSetting->card_subtitle }}</p>
                    </div>

                    <div class="mb-2">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span id="pvEmailLabel" class="fw-bold text-dark" style="font-size: 10.5px;">{{ $loginSetting->email_label }}</span>
                            <span id="pvEmailHint" class="text-muted" style="font-size: 9.5px;">{{ $loginSetting->email_hint }}</span>
                        </div>
                        <div class="border rounded-2 px-2 py-1 bg-white text-muted d-flex align-items-center gap-2" style="font-size: 11px;">
                            <i class="bi bi-envelope"></i>
                            <span id="pvEmailPlaceholder">{{ $loginSetting->email_placeholder }}</span>
                        </div>
                    </div>

                    <div class="mb-2">
                        <div class="mb-1">
                            <span id="pvPasswordLabel" class="fw-bold text-dark" style="font-size: 10.5px;">{{ $loginSetting->password_label }}</span>
                        </div>
                        <div class="border rounded-2 px-2 py-1 bg-white text-muted d-flex align-items-center justify-content-between" style="font-size: 11px;">
                            <span><i class="bi bi-lock-fill me-2"></i><span id="pvPasswordPlaceholder">{{ $loginSetting->password_placeholder }}</span></span>
                            <i class="bi bi-eye"></i>
                        </div>
                    </div>

                    <div class="mb-2 d-flex align-items-center gap-1" style="font-size: 10.5px;">
                        <input type="checkbox" disabled>
                        <span id="pvRememberText">{{ $loginSetting->remember_text }}</span>
                    </div>

                    <div id="pvSubmitBtn" class="text-white text-center fw-bold py-2 rounded-2 mb-2" style="background: {{ $loginSetting->primary_color }}; font-size: 11.5px;">
                        <span id="pvSubmitBtnText">{{ $loginSetting->submit_button_text }}</span> →
                    </div>

                    <div id="pvAlumniCard" class="p-2 rounded-2 border d-flex align-items-center gap-2" style="background: #f4faf6; {{ $loginSetting->show_alumni_card ? '' : 'display:none !important;' }}">
                        <span id="pvAlumniIcon" class="rounded-2 d-inline-flex align-items-center justify-content-center" style="width: 26px; height: 26px; background: {{ $loginSetting->right_panel_bg_color }}; color: {{ $loginSetting->primary_color }}; font-size: 12px;">
                            <i class="bi bi-mortarboard-fill"></i>
                        </span>
                        <div class="flex-grow-1" style="line-height: 1.2;">
                            <div id="pvAlumniTitle" class="fw-bold text-dark" style="font-size: 10.5px;">{{ $loginSetting->alumni_card_title }}</div>
                            <div id="pvAlumniSubtitle" class="text-muted" style="font-size: 9.5px;">{{ $loginSetting->alumni_card_subtitle }}</div>
                        </div>
                        <i class="bi bi-chevron-right text-muted" style="font-size: 10px;"></i>
                    </div>
                </div>

                <div class="text-center" style="font-size: 9.5px; color: #64748b;">
                    <div><i class="bi bi-shield-check me-1" id="pvSecurityIcon" style="color: {{ $loginSetting->primary_color }};"></i><span id="pvSecurityText">{{ $loginSetting->security_badge_text }}</span></div>
                    <div>&copy; {{ date('Y') }} <span id="pvCopyrightText">{{ $loginSetting->copyright_text }}</span></div>
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('login-setting.update') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="row g-4">
            <!-- 1. Gambar Background & Identitas Brand Panel Kiri -->
            <div class="col-lg-6">
                <div class="card login-cfg-card h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-image-fill text-success"></i> 1. Panel Kiri (Foto Gedung & Identitas Brand)
                        </h6>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Foto Latar Belakang (Gedung Kampus)</label>
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 border">
                                <img src="{{ $loginSetting->background_image_url }}" id="thumbBgImg" alt="Background" class="rounded-2 border bg-white" style="width: 90px; height: 62px; object-fit: cover;">
                                <div class="flex-grow-1">
                                    <input type="file" name="background_image" id="background_image" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp">
                                    <div class="form-text" style="font-size: 11px;">Format JPG, PNG, WEBP (Maks. 2 MB).</div>
                                    @if($loginSetting->hasCustomBackground())
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="remove_background_image" value="1" id="remove_background_image">
                                            <label class="form-check-label small text-danger fw-semibold" for="remove_background_image">
                                                Kembalikan ke Foto Gedung Default UIS
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold small">Logo Brand Pojok Kiri Atas</label>
                            <div class="d-flex align-items-center gap-3 p-3 bg-light rounded-3 border">
                                <img src="{{ $loginSetting->brand_logo_url }}" id="thumbLogoImg" alt="Logo" class="rounded-2 border bg-white p-1" style="width: 56px; height: 56px; object-fit: contain;">
                                <div class="flex-grow-1">
                                    <input type="file" name="brand_logo" id="brand_logo" class="form-control form-control-sm" accept="image/jpeg,image/png,image/webp,image/svg+xml">
                                    <div class="form-text" style="font-size: 11px;">Format PNG, SVG, WEBP, JPG (Maks. 2 MB).</div>
                                    @if($loginSetting->hasCustomLogo())
                                        <div class="form-check mt-1">
                                            <input class="form-check-input" type="checkbox" name="remove_brand_logo" value="1" id="remove_brand_logo">
                                            <label class="form-check-label small text-danger fw-semibold" for="remove_brand_logo">
                                                Kembalikan ke Logo Default UIS
                                            </label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Judul Brand (Baris Atas)</label>
                                <input type="text" name="brand_title" id="brand_title" class="form-control" value="{{ old('brand_title', $loginSetting->brand_title) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Subjudul Brand (Baris Bawah)</label>
                                <input type="text" name="brand_subtitle" id="brand_subtitle" class="form-control" value="{{ old('brand_subtitle', $loginSetting->brand_subtitle) }}">
                            </div>
                        </div>

                        <hr class="my-4">

                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-palette-fill text-success"></i> 2. Warna Halaman Login
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Warna Utama (Tombol & Aksen Card)</label>
                                <div class="color-picker-group">
                                    <input type="color" value="{{ $loginSetting->primary_color }}" data-sync="primary_color">
                                    <input type="text" name="primary_color" id="primary_color" value="{{ $loginSetting->primary_color }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Warna Aksen Brand Kiri (Kuning/Emas)</label>
                                <div class="color-picker-group">
                                    <input type="color" value="{{ $loginSetting->accent_color }}" data-sync="accent_color">
                                    <input type="text" name="accent_color" id="accent_color" value="{{ $loginSetting->accent_color }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Warna Latar Panel Kanan</label>
                                <div class="color-picker-group">
                                    <input type="color" value="{{ $loginSetting->right_panel_bg_color }}" data-sync="right_panel_bg_color">
                                    <input type="text" name="right_panel_bg_color" id="right_panel_bg_color" value="{{ $loginSetting->right_panel_bg_color }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Warna Kotak Card Form Login</label>
                                <div class="color-picker-group">
                                    <input type="color" value="{{ $loginSetting->card_bg_color }}" data-sync="card_bg_color">
                                    <input type="text" name="card_bg_color" id="card_bg_color" value="{{ $loginSetting->card_bg_color }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 2. Teks Form Login, Kartu Alumni & Footer -->
            <div class="col-lg-6">
                <div class="card login-cfg-card h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-bold text-dark mb-3 d-flex align-items-center gap-2">
                            <i class="bi bi-card-heading text-success"></i> 3. Teks Header, Label Input & Tombol Form Login
                        </h6>

                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-bold small">Teks Tombol Kembali</label>
                                <input type="text" name="back_button_text" id="back_button_text" class="form-control" value="{{ old('back_button_text', $loginSetting->back_button_text) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small">Teks Badge Status</label>
                                <input type="text" name="status_badge_text" id="status_badge_text" class="form-control" value="{{ old('status_badge_text', $loginSetting->status_badge_text) }}" required>
                            </div>
                            <div class="col-md-3 d-flex align-items-end">
                                <div class="form-check form-switch p-2 px-3 bg-light rounded-3 border w-100">
                                    <input class="form-check-input ms-0 me-2" type="checkbox" name="show_status_badge" id="show_status_badge" {{ $loginSetting->show_status_badge ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold small" for="show_status_badge">Tampil</label>
                                </div>
                            </div>

                            <div class="col-md-5">
                                <label class="form-label fw-bold small">Badge Atas Card</label>
                                <input type="text" name="card_badge_text" id="card_badge_text" class="form-control" value="{{ old('card_badge_text', $loginSetting->card_badge_text) }}" required>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label fw-bold small">Judul Utama Form Login</label>
                                <input type="text" name="card_title" id="card_title" class="form-control" value="{{ old('card_title', $loginSetting->card_title) }}" required>
                            </div>

                            <div class="col-12">
                                <label class="form-label fw-bold small">Subjudul / Deskripsi Form Login</label>
                                <input type="text" name="card_subtitle" id="card_subtitle" class="form-control" value="{{ old('card_subtitle', $loginSetting->card_subtitle) }}">
                            </div>

                            <div class="col-md-4">
                                <label class="form-label fw-bold small">Label Input Email</label>
                                <input type="text" name="email_label" id="email_label" class="form-control" value="{{ old('email_label', $loginSetting->email_label) }}" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small">Petunjuk Contoh Email</label>
                                <input type="text" name="email_hint" id="email_hint" class="form-control" value="{{ old('email_hint', $loginSetting->email_hint) }}">
                            </div>
                            <div class="col-md-4">
                                <label class="form-label fw-bold small">Placeholder Email</label>
                                <input type="text" name="email_placeholder" id="email_placeholder" class="form-control" value="{{ old('email_placeholder', $loginSetting->email_placeholder) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Label Input Kata Sandi</label>
                                <input type="text" name="password_label" id="password_label" class="form-control" value="{{ old('password_label', $loginSetting->password_label) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Placeholder Kata Sandi</label>
                                <input type="text" name="password_placeholder" id="password_placeholder" class="form-control" value="{{ old('password_placeholder', $loginSetting->password_placeholder) }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Teks Checkbox Ingat Saya</label>
                                <input type="text" name="remember_text" id="remember_text" class="form-control" value="{{ old('remember_text', $loginSetting->remember_text) }}" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Teks Tombol Submit Login</label>
                                <input type="text" name="submit_button_text" id="submit_button_text" class="form-control" value="{{ old('submit_button_text', $loginSetting->submit_button_text) }}" required>
                            </div>
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-dark mb-0 d-flex align-items-center gap-2">
                                <i class="bi bi-mortarboard-fill text-success"></i> 4. Kartu Alumni / Mitra & Footer Login
                            </h6>
                            <div class="form-check form-switch mb-0">
                                <input class="form-check-input" type="checkbox" name="show_alumni_card" id="show_alumni_card" {{ $loginSetting->show_alumni_card ? 'checked' : '' }}>
                                <label class="form-check-label fw-bold small" for="show_alumni_card">Tampilkan Kartu Alumni</label>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-md-5">
                                <label class="form-label fw-bold small">Judul Kartu Alumni/Mitra</label>
                                <input type="text" name="alumni_card_title" id="alumni_card_title" class="form-control" value="{{ old('alumni_card_title', $loginSetting->alumni_card_title) }}" required>
                            </div>
                            <div class="col-md-7">
                                <label class="form-label fw-bold small">Subjudul Kartu Alumni/Mitra</label>
                                <input type="text" name="alumni_card_subtitle" id="alumni_card_subtitle" class="form-control" value="{{ old('alumni_card_subtitle', $loginSetting->alumni_card_subtitle) }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Teks Badge Keamanan SSL</label>
                                <input type="text" name="security_badge_text" id="security_badge_text" class="form-control" value="{{ old('security_badge_text', $loginSetting->security_badge_text) }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Teks Hak Cipta (Copyright)</label>
                                <input type="text" name="copyright_text" id="copyright_text" class="form-control" value="{{ old('copyright_text', $loginSetting->copyright_text) }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card login-cfg-card mt-4">
            <div class="card-body py-3 px-4 d-flex flex-wrap justify-content-between align-items-center gap-2">
                <button type="button" class="btn btn-outline-danger rounded-pill px-4 fw-bold" onclick="if(confirm('Kembalikan tampilan halaman Login ke pengaturan standar awal?')) document.getElementById('resetLoginSettingForm').submit();">
                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset ke Standar Awal
                </button>
                <div class="d-flex gap-2">
                    <a href="{{ route('login') }}" target="_blank" class="btn btn-outline-secondary rounded-pill px-4 fw-bold">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Halaman Login
                    </a>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 fw-bold">
                        <i class="bi bi-check2-circle me-1"></i> Simpan Pengaturan Login
                    </button>
                </div>
            </div>
        </div>
    </form>

    <form action="{{ route('login-setting.reset') }}" method="POST" id="resetLoginSettingForm" class="d-none">
        @csrf
    </form>
</section>

<script>
    (function () {
        const textBindings = [
            ['brand_title', 'pvBrandTitle'],
            ['brand_subtitle', 'pvBrandSubtitle'],
            ['back_button_text', 'pvBackBtnText'],
            ['status_badge_text', 'pvStatusBadgeText'],
            ['card_badge_text', 'pvCardBadgeText'],
            ['card_title', 'pvCardTitle'],
            ['card_subtitle', 'pvCardSubtitle'],
            ['email_label', 'pvEmailLabel'],
            ['email_hint', 'pvEmailHint'],
            ['email_placeholder', 'pvEmailPlaceholder'],
            ['password_label', 'pvPasswordLabel'],
            ['password_placeholder', 'pvPasswordPlaceholder'],
            ['remember_text', 'pvRememberText'],
            ['submit_button_text', 'pvSubmitBtnText'],
            ['alumni_card_title', 'pvAlumniTitle'],
            ['alumni_card_subtitle', 'pvAlumniSubtitle'],
            ['security_badge_text', 'pvSecurityText'],
            ['copyright_text', 'pvCopyrightText'],
        ];

        textBindings.forEach(([inputId, targetId]) => {
            const input = document.getElementById(inputId);
            const target = document.getElementById(targetId);
            if (input && target) {
                input.addEventListener('input', () => {
                    target.textContent = input.value;
                });
            }
        });

        function updateLoginColors() {
            const primary = document.getElementById('primary_color').value;
            const accent = document.getElementById('accent_color').value;
            const rightBg = document.getElementById('right_panel_bg_color').value;
            const cardBg = document.getElementById('card_bg_color').value;

            document.getElementById('pvBrandPill').style.borderColor = accent + '80';
            document.getElementById('pvBrandSubtitle').style.color = accent;
            document.getElementById('pvRightBg').style.background = rightBg;

            const pvBack = document.getElementById('pvBackBtn');
            pvBack.style.color = primary;
            pvBack.style.borderColor = primary + '40';

            const pvStatus = document.getElementById('pvStatusBadge');
            pvStatus.style.color = primary;
            pvStatus.style.borderColor = primary + '40';

            const pvCard = document.getElementById('pvLoginCard');
            pvCard.style.background = cardBg;
            pvCard.style.borderTopColor = primary;

            const pvBadge = document.getElementById('pvCardBadge');
            pvBadge.style.background = rightBg;
            pvBadge.style.color = primary;

            document.getElementById('pvSubmitBtn').style.background = primary;

            const pvAlumniIcon = document.getElementById('pvAlumniIcon');
            pvAlumniIcon.style.background = rightBg;
            pvAlumniIcon.style.color = primary;

            document.getElementById('pvSecurityIcon').style.color = primary;
        }

        document.querySelectorAll('input[type="color"][data-sync]').forEach(picker => {
            picker.addEventListener('input', function () {
                const targetId = this.getAttribute('data-sync');
                document.getElementById(targetId).value = this.value;
                updateLoginColors();
            });
        });

        document.querySelectorAll('.color-picker-group input[type="text"]').forEach(txt => {
            txt.addEventListener('input', function () {
                const picker = document.querySelector(`input[type="color"][data-sync="${this.id}"]`);
                if (picker && /^#[0-9A-Fa-f]{6}$/.test(this.value.trim())) {
                    picker.value = this.value.trim();
                }
                updateLoginColors();
            });
        });

        const showStatusCb = document.getElementById('show_status_badge');
        if (showStatusCb) {
            showStatusCb.addEventListener('change', () => {
                document.getElementById('pvStatusBadge').style.display = showStatusCb.checked ? '' : 'none';
            });
        }

        const showAlumniCb = document.getElementById('show_alumni_card');
        if (showAlumniCb) {
            showAlumniCb.addEventListener('change', () => {
                document.getElementById('pvAlumniCard').style.setProperty('display', showAlumniCb.checked ? 'flex' : 'none', 'important');
            });
        }

        const bgInput = document.getElementById('background_image');
        if (bgInput) {
            bgInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const url = URL.createObjectURL(this.files[0]);
                    document.getElementById('pvLeftBg').style.backgroundImage = `url('${url}')`;
                    document.getElementById('thumbBgImg').src = url;
                }
            });
        }

        const logoInput = document.getElementById('brand_logo');
        if (logoInput) {
            logoInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const url = URL.createObjectURL(this.files[0]);
                    document.getElementById('pvBrandLogo').src = url;
                    document.getElementById('thumbLogoImg').src = url;
                }
            });
        }
    })();
</script>
@endsection
