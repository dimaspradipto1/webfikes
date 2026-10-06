<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login — UIS (Universitas Ibnu Sina)</title>
  <meta name="description" content="Portal Login Resmi UIS - Universitas Ibnu Sina">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logouis.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('assets/img/logouis.png') }}">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    :root {
      --uis-purple:       #046B26;
      --uis-purple-dark:  #03521d;
      --uis-purple-deep:  #023814;
      --uis-purple-light: #eaf6ee;
      --uis-purple-subtle:#d4edd9;
      
      --uis-orange:       #FED802;
      --uis-orange-hover: #e5c302;
      --uis-orange-dark:  #cfae00;
      --uis-orange-light: #fefde8;
      --uis-orange-subtle:#fef9c3;
      
      --obsidian-dark:      #032e12;
      --obsidian-card:      #053d18;
      
      --white:              #ffffff;
      --page-bg:            #f8fcf9;
      --surface-light:      #edf6f0;
      --text-main:          #032e12;
      --text-muted:         #655672;
      --text-light:         #9586a2;
      --border-light:       #d8e8dc;
      
      --shadow-sm:          0 4px 12px rgba(4, 107, 38, 0.08);
      --shadow-md:          0 8px 24px rgba(4, 107, 38, 0.12);
      --shadow-lg:          0 16px 36px rgba(4, 107, 38, 0.15);
      --shadow-purple:      0 8px 24px rgba(4, 107, 38, 0.28);
    }

    html, body { height: 100%; }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background: var(--surface-light);
      color: var(--text-main);
      overflow: hidden;
    }

    .login-wrapper {
      display: flex;
      height: 100vh;
      width: 100vw;
    }

    /* ── LEFT PANEL ──────── */
    .panel-left {
      flex: 1.15;
      position: relative;
      background: var(--obsidian-dark);
      overflow: hidden;
    }

    .panel-left-content {
      position: relative;
      z-index: 3;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 52px 56px;
    }

    .brand-top {
      display: flex;
      align-items: center;
      gap: 14px;
    }

    .brand-title .name {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 22px;
      font-weight: 800;
      color: var(--white);
      letter-spacing: -0.5px;
      line-height: 1.1;
    }
    .brand-title .sub {
      font-size: 11.5px;
      color: rgba(255, 255, 255, 0.65);
      letter-spacing: 0.4px;
      margin-top: 2px;
    }

    .brand-middle { max-width: 480px; }

    .badge-kategori {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: rgba(4, 107, 38, 0.3);
      border: 1px solid rgba(254, 216, 2, 0.4);
      border-radius: 50px;
      padding: 6px 16px;
      margin-bottom: 24px;
    }
    .badge-kategori span {
      font-size: 11.5px;
      font-weight: 700;
      letter-spacing: 1px;
      text-transform: uppercase;
      color: var(--uis-orange);
      font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .brand-middle h1 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 42px;
      font-weight: 800;
      color: var(--white);
      line-height: 1.15;
      letter-spacing: -1.2px;
      margin-bottom: 18px;
    }
    .brand-middle h1 em {
      font-style: normal;
      color: var(--uis-orange);
    }

    .brand-middle p {
      font-size: 15px;
      color: rgba(255, 255, 255, 0.7);
      line-height: 1.75;
      margin-bottom: 32px;
    }

    .faculty-chips {
      display: flex;
      flex-wrap: wrap;
      gap: 10px;
      margin-bottom: 36px;
    }
    .f-chip {
      display: flex;
      align-items: center;
      gap: 7px;
      background: rgba(255, 255, 255, 0.08);
      border: 1px solid rgba(255, 255, 255, 0.15);
      border-radius: 50px;
      padding: 7px 16px;
      color: rgba(255, 255, 255, 0.9);
      font-size: 12.5px;
      font-weight: 500;
    }
    .f-chip i { color: var(--uis-orange); }

    .stats-row {
      display: flex;
      align-items: center;
      gap: 32px;
    }
    .stat { text-align: left; }
    .stat-num {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 26px;
      font-weight: 800;
      color: var(--white);
      line-height: 1;
    }
    .stat-num sup { font-size: 14px; color: var(--uis-orange); vertical-align: super; }
    .stat-txt {
      font-size: 11.5px;
      color: rgba(255, 255, 255, 0.5);
      margin-top: 4px;
    }
    .stat-sep {
      width: 1px;
      height: 36px;
      background: rgba(255, 255, 255, 0.15);
    }

    /* ── RIGHT PANEL ──────────────── */
    .panel-right {
      flex: 0.85;
      background: var(--page-bg);
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 48px 44px;
      overflow-y: auto;
      position: relative;
    }

    .form-container {
      width: 100%;
      max-width: 420px;
    }

    .form-card {
      background: var(--white);
      border-radius: 24px;
      padding: 42px 38px;
      border: 1px solid var(--border-light);
      box-shadow: var(--shadow-lg);
    }

    .form-logo-sm {
      display: flex;
      align-items: center;
      gap: 12px;
      margin-bottom: 26px;
    }
    .form-logo-sm .txt {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 17px;
      font-weight: 800;
      color: var(--uis-purple);
    }

    .form-heading { margin-bottom: 28px; }
    .form-heading h2 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 24px;
      font-weight: 800;
      color: var(--text-main);
      letter-spacing: -0.5px;
      margin-bottom: 6px;
    }
    .form-heading p {
      font-size: 13.5px;
      color: var(--text-muted);
      line-height: 1.5;
    }

    .alert-box {
      border-radius: 12px;
      padding: 12px 15px;
      font-size: 13px;
      font-weight: 500;
      display: flex;
      align-items: flex-start;
      gap: 10px;
      margin-bottom: 20px;
    }
    .alert-err {
      background: #fff5f5;
      border: 1px solid #fed7d7;
      color: #c53030;
    }
    .alert-ok {
      background: #f0fff4;
      border: 1px solid #c6f6d5;
      color: #276749;
    }

    .field { margin-bottom: 18px; }
    .field-label {
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 13.5px;
      font-weight: 600;
      color: var(--text-main);
      margin-bottom: 8px;
    }

    .input-wrap { position: relative; }

    .input-icon {
      position: absolute;
      left: 15px;
      top: 50%;
      transform: translateY(-50%);
      color: var(--text-light);
      font-size: 16px;
      pointer-events: none;
    }

    .form-input {
      width: 100%;
      background: var(--surface-light);
      border: 1.5px solid var(--border-light);
      border-radius: 12px;
      padding: 13px 44px 13px 44px;
      font-size: 14px;
      color: var(--text-main);
      font-family: 'Inter', sans-serif;
      outline: none;
      transition: all 0.25s ease;
    }

    .form-input:focus {
      border-color: var(--uis-purple);
      background: var(--white);
      box-shadow: 0 0 0 3px rgba(4, 107, 38, 0.12);
    }

    .field-err-msg {
      font-size: 12px;
      color: #c53030;
      margin-top: 6px;
      display: flex;
      align-items: center;
      gap: 5px;
    }

    .btn-show-pw {
      position: absolute;
      right: 12px;
      top: 50%;
      transform: translateY(-50%);
      background: none;
      border: none;
      cursor: pointer;
      color: var(--text-light);
      font-size: 16px;
      padding: 4px 6px;
    }

    .remember-row {
      display: flex;
      align-items: center;
      gap: 9px;
      margin-bottom: 24px;
    }
    .remember-row input[type=checkbox] {
      width: 16px;
      height: 16px;
      accent-color: var(--uis-purple);
      cursor: pointer;
    }
    .remember-row label {
      font-size: 13px;
      color: var(--text-muted);
      cursor: pointer;
    }

    .btn-masuk {
      width: 100%;
      padding: 14px;
      background: var(--uis-purple);
      border: none;
      border-radius: 12px;
      color: var(--white);
      font-size: 15px;
      font-weight: 700;
      font-family: 'Plus Jakarta Sans', sans-serif;
      cursor: pointer;
      transition: all 0.25s ease;
      box-shadow: var(--shadow-purple);
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
    }
    .btn-masuk:hover {
      background: var(--uis-purple-dark);
      transform: translateY(-2px);
    }

    .form-footer {
      text-align: center;
      padding-top: 18px;
    }
    .form-footer a {
      color: var(--uis-purple);
      font-weight: 600;
    }
    .back-to-home-link {
      color: var(--text-muted) !important;
      font-weight: 500 !important;
      display: inline-flex;
      align-items: center;
      gap: 6px;
      margin-top: 8px;
    }

    .copyright {
      text-align: center;
      margin-top: 22px;
      font-size: 11.5px;
      color: var(--text-light);
    }

    @media (max-width: 900px) {
      .panel-left { display: none; }
      .panel-right { flex: 1; }
    }
  </style>
</head>

<body>

<div class="login-wrapper">

  <!-- LEFT PANEL -->
  <div class="panel-left">
    <div class="panel-left-content">
      <div class="brand-top">
        <img src="{{ asset('frontend/img/logouis.png') }}" alt="Logo Universitas Ibnu Sina" style="height: 52px; width: auto; object-fit: contain;">
      </div>

      <div class="brand-middle">
        <div class="badge-kategori">
          <span>Portal Resmi Akademik</span>
        </div>

        <h1>Universitas Ibnu Sina<br><em>Unggul & Berintegritas</em></h1>

        <p>
          Sistem informasi terpadu pengelolaan akademik, publikasi berita, dokumentasi fasilitas, dan data informasi UIS.
        </p>

        <div class="faculty-chips">
          <div class="f-chip"><i class="bi bi-hospital"></i> <span>Laboratorium Modern</span></div>
          <div class="f-chip"><i class="bi bi-patch-check-fill"></i> <span>Akreditasi Unggul</span></div>
          <div class="f-chip"><i class="bi bi-mortarboard-fill"></i> <span>Dosen Profesional</span></div>
          <div class="f-chip"><i class="bi bi-shield-check"></i> <span>Standar Nasional</span></div>
        </div>
      </div>
    </div>
  </div>

  <!-- RIGHT PANEL -->
  <div class="panel-right">
    <div class="form-container">
      <div class="form-card">
        <div class="form-logo-sm">
          <img src="{{ asset('frontend/img/logouis.png') }}" alt="Logo UIS" style="height: 38px; width: auto; object-fit: contain;">
          <div class="txt">Portal UIS</div>
        </div>

        <div class="form-heading">
          <h2>Masuk ke Akun Anda</h2>
          <p>Silakan masukkan kredensial untuk mengakses dashboard</p>
        </div>

        @if (session('success'))
          <div class="alert-box alert-ok">
            <i class="bi bi-check-circle-fill"></i>
            <span>{{ session('success') }}</span>
          </div>
        @endif

        @if ($errors->has('email') && str_contains($errors->first('email'), 'salah'))
          <div class="alert-box alert-err">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <span>{{ $errors->first('email') }}</span>
          </div>
        @endif

        <form id="formLogin" action="{{ route('loginproses') }}" method="POST" novalidate>
          @csrf

          <div class="field">
            <label class="field-label" for="email"><span>Email</span></label>
            <div class="input-wrap">
              <input type="email" id="email" name="email" class="form-input {{ $errors->has('email') && !str_contains($errors->first('email'), 'salah') ? 'is-invalid' : '' }}" placeholder="admin@uis.ac.id" value="{{ old('email') }}" required>
              <i class="bi bi-envelope input-icon"></i>
            </div>
            @error('email')
              @if (!str_contains($message, 'salah'))
                <div class="field-err-msg"><i class="bi bi-x-circle-fill"></i> {{ $message }}</div>
              @endif
            @enderror
          </div>

          <div class="field">
            <label class="field-label" for="password"><span>Password</span></label>
            <div class="input-wrap">
              <input type="password" id="password" name="password" class="form-input {{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Masukkan password Anda" required>
              <i class="bi bi-lock input-icon"></i>
              <button type="button" id="togglePw" class="btn-show-pw"><i class="bi bi-eye" id="eyeIcon"></i></button>
            </div>
            @error('password')
              <div class="field-err-msg"><i class="bi bi-x-circle-fill"></i> {{ $message }}</div>
            @enderror
          </div>

          <button type="submit" class="btn-masuk" id="btnMasuk">
            <i class="bi bi-box-arrow-in-right"></i>
            Masuk Portal
          </button>
        </form>

        <!-- Link Akses Formulir Testimoni Alumni (Tanpa Login) -->
        <div style="margin-top: 24px; padding-top: 18px; border-top: 1px solid rgba(4, 107, 38, 0.12); text-align: center;">
          <div style="background: rgba(4, 107, 38, 0.05); border: 1.5px dashed rgba(4, 107, 38, 0.25); border-radius: 14px; padding: 14px 16px; transition: all 0.25s ease;">
            <p style="font-size: 12.5px; color: #555555; margin-bottom: 6px; font-weight: 500;">
              🎓 <strong>Alumni atau Mitra Universitas Ibnu Sina?</strong>
            </p>
            <a href="{{ route('homepage.alumni.create') }}" style="display: inline-flex; align-items: center; justify-content: center; gap: 6px; font-size: 13px; font-weight: 700; color: #046B26; text-decoration: none; padding: 6px 12px; border-radius: 8px; background: rgba(4, 107, 38, 0.08);">
              <i class="bi bi-chat-quote-fill"></i>
              <span>Isi Ulasan & Testimoni Alumni di Sini</span>
              <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>

        <div class="form-footer" style="margin-top: 18px;">
          <p><a href="{{ route('homepage') }}" class="back-to-home-link"><i class="bi bi-arrow-left"></i> Kembali ke Beranda</a></p>
        </div>
      </div>

      <div class="copyright">
        &copy; {{ date('Y') }} UIS — Universitas Ibnu Sina. All rights reserved.
      </div>
    </div>
  </div>

</div>

<script>
  document.getElementById('togglePw').addEventListener('click', function () {
    const inp  = document.getElementById('password');
    const icon = document.getElementById('eyeIcon');
    const show = inp.type === 'password';
    inp.type = show ? 'text' : 'password';
    icon.className = show ? 'bi bi-eye-slash' : 'bi bi-eye';
  });
</script>

</body>
</html>
