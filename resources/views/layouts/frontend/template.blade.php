<!DOCTYPE html>
<html lang="id">
@php
  $cleanWa = '';
  if (!empty($contact->no_wa)) {
      $cleanWa = preg_replace('/[^0-9]/', '', $contact->no_wa);
      if (strpos($cleanWa, '08') === 0) {
          $cleanWa = '628' . substr($cleanWa, 2);
      }
  }
  $isHome = request()->routeIs('homepage') || request()->routeIs('homepage.galeri');
@endphp
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="referrer" content="strict-origin-when-cross-origin">
  <title>@yield('title', 'Universitas Ibnu Sina (UIS) | Unggul, Profesional & Berintegritas')</title>
  <meta name="description" content="@yield('meta_description', 'Portal Resmi Universitas Ibnu Sina (UIS) — Menyelenggarakan Pendidikan Tinggi Berkualitas, Riset Terapan, dan Pengabdian Masyarakat Berdaya Saing Global.')">
  <meta name="keywords" content="@yield('meta_keywords', 'universitas ibnu sina, uis, pmb uis, pendaftaran uis, kampus batam, perguruan tinggi batam, pendidikan tinggi, riset terpadu')">
  <meta name="author" content="@yield('meta_author', 'Universitas Ibnu Sina')">

  <!-- Open Graph / Facebook / WhatsApp / Telegram Preview -->
  <meta property="og:type" content="@yield('og_type', 'website')">
  <meta property="og:url" content="{{ url()->current() }}">
  <meta property="og:title" content="@yield('og_title', View::yieldContent('title', 'Universitas Ibnu Sina (UIS) | Unggul, Profesional & Berintegritas'))">
  <meta property="og:description" content="@yield('og_description', View::yieldContent('meta_description', 'Portal Resmi Universitas Ibnu Sina (UIS) — Menyelenggarakan Pendidikan Tinggi Berkualitas, Riset Terapan, dan Pengabdian Masyarakat Berdaya Saing Global.'))">
  <meta property="og:image" content="@yield('og_image', asset('assets/img/logouis.png'))">
  <meta property="og:image:secure_url" content="@yield('og_image', asset('assets/img/logouis.png'))">
  <meta property="og:image:width" content="@yield('og_image_width', '1200')">
  <meta property="og:image:height" content="@yield('og_image_height', '630')">
  <meta property="og:image:type" content="@yield('og_image_type', 'image/jpeg')">
  <meta property="og:site_name" content="Universitas Ibnu Sina">

  <!-- Twitter / X Cards -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:url" content="{{ url()->current() }}">
  <meta name="twitter:title" content="@yield('og_title', View::yieldContent('title', 'Universitas Ibnu Sina (UIS) | Unggul, Profesional & Berintegritas'))">
  <meta name="twitter:description" content="@yield('og_description', View::yieldContent('meta_description', 'Portal Resmi Universitas Ibnu Sina (UIS) — Menyelenggarakan Pendidikan Tinggi Berkualitas, Riset Terapan, dan Pengabdian Masyarakat Berdaya Saing Global.'))">
  <meta name="twitter:image" content="@yield('og_image', asset('assets/img/logouis.png'))">

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="{{ asset('assets/img/logouis.png') }}">
  <link rel="apple-touch-icon" href="{{ asset('assets/img/logouis.png') }}">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- AOS Animation CSS -->
  <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">

  <!-- Swiper Slider CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">

  <style>
    /* ═══════════════════════════════════════════════
       DESIGN TOKENS — UNIVERSITAS IBNU SINA (UIS)
       SOLID PALETTE — ZERO GRADIENTS
       Hijau UIS: #046B26 | Kuning UIS: #FED802
    ═══════════════════════════════════════════════ */
    :root {
      --uis-green:          #046B26;
      --uis-green-dark:     #03521d;
      --uis-green-deep:     #023814;
      --uis-green-light:    #eaf6ee;
      --uis-green-subtle:   #d4edd9;
      
      --uis-yellow:         #FED802;
      --uis-yellow-hover:   #e5c302;
      --uis-yellow-dark:    #cfae00;
      --uis-yellow-light:   #fefde8;
      --uis-yellow-subtle:  #fef9c3;
      
      /* Cheerful & Professional Secondary Accents (Solid Warm & Emerald, No Blue) */
      --uis-coral:          #ea580c;  /* Warm Coral / Tangerine */
      --uis-coral-light:    #ffedd5;
      
      --uis-amber:          #d97706;  /* Warm Amber Gold */
      --uis-amber-light:    #fef3c7;
      
      --uis-teal:           #0d9488;  /* Mint / Teal */
      --uis-teal-light:     #ccfbf1;
      
      /* Backward compatibility alias */
      --uis-purple:       var(--uis-green);
      --uis-purple-dark:  var(--uis-green-dark);
      --uis-purple-deep:  var(--uis-green-deep);
      --uis-purple-light: var(--uis-green-light);
      --uis-purple-subtle:var(--uis-green-subtle);
      
      --uis-orange:       var(--uis-yellow);
      --uis-orange-hover: var(--uis-yellow-hover);
      --uis-orange-dark:  var(--uis-yellow-dark);
      --uis-orange-light: var(--uis-yellow-light);
      --uis-orange-subtle:var(--uis-yellow-subtle);
      
      --obsidian-dark:      #03521d;
      --obsidian-card:      #046B26;
      
      --white:              #ffffff;
      --page-bg:            #f8fafc;  /* Clean Slate-50 */
      --surface-light:      #f1f5f9;  /* Crisp Slate-100 */
      --surface-muted:      #e2e8f0;  /* Slate-200 */
      
      --text-main:          #0f172a;  /* Slate-900 (ultra-crisp readability) */
      --text-muted:         #475569;  /* Slate-600 */
      --text-light:         #94a3b8;  /* Slate-400 */
      
      --border-light:       #e2e8f0;  /* Slate-200 */
      --border-purple:      #046B26;
      --border-orange:      #FED802;
      
      --shadow-sm:          0 2px 10px rgba(15, 23, 42, 0.05);
      --shadow-md:          0 8px 24px rgba(15, 23, 42, 0.08);
      --shadow-lg:          0 16px 36px rgba(15, 23, 42, 0.12);
      --shadow-orange:      0 6px 18px rgba(254, 216, 2, 0.28);
      --shadow-purple:      0 6px 18px rgba(4, 107, 38, 0.2);
    }

    .text-terracotta, .text-uis-purple, .text-uis-green { color: var(--uis-green) !important; }
    .text-uis-orange, .text-uis-yellow { color: var(--uis-yellow) !important; }
    .bg-uis-green, .bg-uis-purple { background-color: var(--uis-green) !important; }
    .bg-uis-yellow, .bg-uis-orange { background-color: var(--uis-yellow) !important; }

    /* Cheerful Soft Badges (Solid Tones, No Blue) */
    .badge-soft-teal { background: #ccfbf1; color: #0d9488; border: 1px solid #99f6e4; font-weight: 700; }
    .badge-soft-coral { background: #ffedd5; color: #ea580c; border: 1px solid #fed7aa; font-weight: 700; }
    .badge-soft-amber { background: #fef3c7; color: #d97706; border: 1px solid #fde68a; font-weight: 700; }
    .badge-soft-green { background: #eaf6ee; color: #046B26; border: 1px solid #d4edd9; font-weight: 700; }

    /* ═══════════════════════════════════════════════
       MOBILE SMOOTH PERFORMANCE & INSTANT CONTENT RENDER
    ═══════════════════════════════════════════════ */
    @media (max-width: 768px) {
      [data-aos] {
        opacity: 1 !important;
        transform: none !important;
        transition: none !important;
        visibility: visible !important;
      }
      .btn-mobile-full {
        width: 100% !important;
        display: flex !important;
        justify-content: center !important;
        text-align: center !important;
      }
    }
    .bg-uis-purple { background-color: var(--uis-purple) !important; }
    .bg-uis-orange { background-color: var(--uis-orange) !important; }

    html { 
      scroll-behavior: smooth;
      overflow-x: clip;
      max-width: 100vw;
    }

    body {
      font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
      background-color: var(--page-bg);
      color: var(--text-main);
      overflow-x: clip;
      max-width: 100vw;
      line-height: 1.65;
    }

    /* Swiper Navigation Controls */
    .swiper-button-prev,
    .swiper-button-next {
      width: 44px !important;
      height: 44px !important;
      background: #ffffff !important;
      border-radius: 50% !important;
      box-shadow: 0 4px 16px rgba(0, 0, 0, 0.12) !important;
      border: 1px solid var(--border-light) !important;
      color: var(--uis-purple) !important;
      transition: all 0.25s ease !important;
    }
    .swiper-button-prev::after,
    .swiper-button-next::after {
      font-size: 15px !important;
      font-weight: 800 !important;
    }
    .swiper-button-prev:hover,
    .swiper-button-next:hover {
      background: var(--uis-purple) !important;
      color: #ffffff !important;
      transform: scale(1.08);
    }
    @media (max-width: 768px) {
      .swiper-button-prev,
      .swiper-button-next {
        display: none !important;
      }
    }

    h1, h2, h3, h4, h5, h6 {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      color: var(--text-main);
    }

    /* ═══════════════════════════════════════════════
       UNIVERSAL SUBPAGE HERO BANNER CONTRAST & TYPOGRAPHY
       Guarantees crisp white headings & legible subtitles across all hero sections
    ═══════════════════════════════════════════════ */
    .prestasi-hero, .dosen-hero, .news-hero, .article-hero, .about-hero, .sejarah-hero,
    .visimisi-hero, .rektor-hero, .detail-hero, .ormawa-hero, .layanan-hero, .galeri-hero,
    .fasilitas-hero, .kontak-hero, .faq-hero, .kerjasama-hero, .tracer-hero, .download-hero,
    .kurikulum-hero, .hero-subpage, .page-hero-banner {
      background: #046B26 !important;
      border-bottom: 3px solid #FED802 !important;
      position: relative;
      overflow: hidden;
    }

    .prestasi-hero h1, .prestasi-hero h2, .prestasi-hero h3,
    .dosen-hero h1, .dosen-hero h2, .dosen-hero h3,
    .news-hero h1, .news-hero h2, .news-hero h3,
    .article-hero h1, .article-hero h2, .article-hero h3,
    .about-hero h1, .about-hero h2, .about-hero h3,
    .sejarah-hero h1, .sejarah-hero h2, .sejarah-hero h3,
    .visimisi-hero h1, .visimisi-hero h2, .visimisi-hero h3,
    .rektor-hero h1, .rektor-hero h2, .rektor-hero h3,
    .detail-hero h1, .detail-hero h2, .detail-hero h3,
    .ormawa-hero h1, .ormawa-hero h2, .ormawa-hero h3,
    .layanan-hero h1, .layanan-hero h2, .layanan-hero h3,
    .galeri-hero h1, .galeri-hero h2, .galeri-hero h3,
    .fasilitas-hero h1, .fasilitas-hero h2, .fasilitas-hero h3,
    .kontak-hero h1, .kontak-hero h2, .kontak-hero h3,
    .faq-hero h1, .faq-hero h2, .faq-hero h3,
    .kurikulum-hero h1, .hero-subpage h1, .page-hero-banner h1,
    .text-white h1, .text-white h2, .text-white h3, .text-white h4 {
      color: #ffffff !important;
      font-weight: 800 !important;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.35);
    }

    .prestasi-hero p, .dosen-hero p, .news-hero p, .article-hero p,
    .about-hero p, .sejarah-hero p, .visimisi-hero p, .rektor-hero p,
    .detail-hero p, .ormawa-hero p, .layanan-hero p, .galeri-hero p,
    .fasilitas-hero p, .kontak-hero p, .faq-hero p, .kurikulum-hero p,
    .hero-subpage p, .page-hero-banner p {
      color: rgba(255, 255, 255, 0.92) !important;
    }

    .prestasi-hero .text-white-50, .dosen-hero .text-white-50, .news-hero .text-white-50,
    .sejarah-hero .text-white-50, .detail-hero .text-white-50, .about-hero .text-white-50 {
      color: rgba(255, 255, 255, 0.88) !important;
    }

    /* ═══════════════════════════════════════════════
       UNIVERSAL BREADCRUMB CUSTOM — KONSISTEN SEMUA MENU
       Kecil, Ramping & Proporsional (Sesuai arahan: jangan besar, kecilkan)
    ═══════════════════════════════════════════════ */
    .breadcrumb-custom {
      display: inline-flex !important;
      align-items: center !important;
      flex-wrap: wrap !important;
      gap: 5px !important;
      font-size: 11px !important;
      line-height: 1.3 !important;
      color: rgba(255, 255, 255, 0.6) !important;
      margin-top: 8px !important;
      margin-bottom: 0 !important;
      letter-spacing: 0.25px !important;
    }
    .breadcrumb-custom a {
      color: rgba(255, 255, 255, 0.8) !important;
      text-decoration: none !important;
      font-size: 11px !important;
      font-weight: 500 !important;
      transition: color 0.2s ease !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 3.5px !important;
    }
    .breadcrumb-custom a:hover {
      color: #FED802 !important;
    }
    .breadcrumb-custom a i,
    .breadcrumb-custom i {
      font-size: 10.5px !important;
      line-height: 1 !important;
      opacity: 0.85 !important;
    }
    .breadcrumb-custom span {
      color: rgba(255, 255, 255, 0.4) !important;
      font-size: 9.5px !important;
      line-height: 1 !important;
      user-select: none !important;
    }
    .breadcrumb-custom .active,
    .breadcrumb-custom span.active {
      color: #FED802 !important;
      font-size: 11px !important;
      font-weight: 600 !important;
      line-height: 1.3 !important;
    }

    a { text-decoration: none; transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1); }

    /* ═══════════════════════════════════════════════
       TOPBAR — Solid UIS Dark Green Theme
    ═══════════════════════════════════════════════ */
    .topbar-main {
      background: var(--obsidian-dark);
      padding: 9px 0;
      border-bottom: 1px solid rgba(4, 107, 38, 0.4);
      font-size: 13px;
      color: rgba(255, 255, 255, 0.85);
    }

    .topbar-main a {
      color: rgba(255, 255, 255, 0.9);
    }
    .topbar-main a:hover {
      color: var(--uis-yellow);
    }

    .topbar-badge {
      display: inline-flex;
      align-items: center;
      gap: 6px;
      background: var(--uis-green);
      color: var(--white);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.5px;
      padding: 3px 10px;
      border-radius: 50px;
      text-transform: uppercase;
      border: 1px solid rgba(254, 216, 2, 0.3);
    }

    /* ═══════════════════════════════════════════════
       NAVBAR — Solid UIS Green (#046B26) with Yellow (#FED802) Accents & Dropdowns
    ═══════════════════════════════════════════════ */
    .navbar-main {
      background: var(--uis-green, #046B26);
      padding: 10px 0;
      position: -webkit-sticky;
      position: sticky;
      top: 0;
      left: 0;
      right: 0;
      width: 100%;
      z-index: 1050;
      border-bottom: 3px solid var(--uis-yellow, #FED802);
      box-shadow: 0 4px 18px rgba(0, 0, 0, 0.12);
    }

    .navbar-brand-custom {
      display: flex;
      align-items: center;
      text-decoration: none;
      transition: transform 0.2s ease, opacity 0.2s ease;
    }

    .navbar-brand-custom:hover {
      opacity: 0.95;
    }

    .brand-logo-img {
      height: 46px;
      max-height: 46px;
      width: auto;
      object-fit: contain;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.15));
    }

    .brand-title-main {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 15px;
      font-weight: 800;
      color: #ffffff;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      white-space: nowrap;
      text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
      line-height: 1;
    }

    @media (max-width: 576px) {
      .brand-logo-img {
        height: 38px;
        max-height: 38px;
      }
      .brand-title-main {
        font-size: 12.5px;
        letter-spacing: 0.3px;
      }
    }

    .nav-link-custom {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13px;
      font-weight: 700;
      color: #ffffff !important;
      padding: 7px 10px !important;
      border-radius: 8px;
      transition: all 0.2s ease;
      white-space: nowrap;
      display: inline-flex;
      align-items: center;
      gap: 4px;
    }

    .nav-link-custom:hover,
    .nav-link-custom.active,
    .show > .nav-link-custom {
      color: var(--uis-yellow, #FED802) !important;
      background: rgba(254, 216, 2, 0.18);
    }

    /* Hide bootstrap default dropdown caret (prevent double arrow) */
    .navbar-main .dropdown-toggle::after {
      display: none !important;
    }

    /* Modern Dropdown Menus */
    .dropdown-menu-custom {
      background: var(--white);
      border: 1px solid var(--border-light);
      border-top: 3px solid var(--uis-green);
      border-radius: 14px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.14);
      padding: 10px 8px;
      min-width: 220px;
      animation: fadeInDown 0.2s ease forwards;
    }

    @keyframes fadeInDown {
      from { opacity: 0; transform: translateY(-8px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Submenu Dropdown Support */
    .dropdown-submenu {
      position: relative;
    }
    .dropdown-submenu > .dropdown-menu-custom {
      top: 0;
      left: 100%;
      margin-top: -6px;
      margin-left: 2px;
      display: none;
    }
    .dropdown-submenu:hover > .dropdown-menu-custom {
      display: block;
    }
    @media (max-width: 1199.98px) {
      .dropdown-submenu > .dropdown-menu-custom {
        position: static;
        display: block;
        margin-left: 12px;
        background: rgba(255, 255, 255, 0.05);
        border: none;
        box-shadow: none;
        padding: 4px;
      }
    }

    .dropdown-item-custom {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 13px;
      font-weight: 600;
      color: var(--text-main);
      padding: 8px 14px;
      border-radius: 8px;
      transition: all 0.2s ease;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .dropdown-item-custom:hover {
      background: var(--uis-green-light);
      color: var(--uis-green);
      padding-left: 18px;
    }

    .dropdown-item-custom i {
      font-size: 14px;
      color: var(--uis-green);
    }

    .navbar-toggler {
      border: 1.5px solid var(--uis-yellow, #FED802) !important;
      padding: 6px 10px;
      border-radius: 8px;
      outline: none !important;
    }
    .navbar-toggler-icon {
      filter: invert(1);
    }

    /* ═══════════════════════════════════════════════
       LANGUAGE SELECTOR DROPDOWN (SAMPING KONTAK)
    ═══════════════════════════════════════════════ */
    .uis-lang-nav-item {
      position: relative;
    }
    .uis-lang-toggle {
      background: rgba(255, 255, 255, 0.12) !important;
      border: 1px solid rgba(254, 216, 2, 0.35) !important;
      border-radius: 20px !important;
      padding: 6px 14px !important;
      font-weight: 700 !important;
      font-size: 13px !important;
      color: #ffffff !important;
      display: inline-flex !important;
      align-items: center !important;
      gap: 6px !important;
      transition: all 0.25s ease !important;
    }
    .uis-lang-toggle:hover,
    .uis-lang-toggle:focus,
    .show > .uis-lang-toggle {
      background: var(--uis-yellow, #FED802) !important;
      border-color: var(--uis-yellow, #FED802) !important;
      color: var(--uis-green-deep, #023814) !important;
      transform: translateY(-1px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    }
    .uis-lang-toggle:hover i,
    .show > .uis-lang-toggle i {
      color: var(--uis-green-deep, #023814) !important;
    }
    .uis-flag-img-main {
      width: 22px !important;
      height: 15px !important;
      object-fit: cover !important;
      border-radius: 3px !important;
      border: 1px solid rgba(255, 255, 255, 0.6) !important;
      box-shadow: 0 1px 3px rgba(0, 0, 0, 0.25) !important;
      display: inline-block !important;
      vertical-align: middle !important;
      flex-shrink: 0 !important;
    }
    .uis-flag-img {
      width: 22px !important;
      height: 15px !important;
      object-fit: cover !important;
      border-radius: 3px !important;
      border: 1px solid rgba(0, 0, 0, 0.12) !important;
      box-shadow: 0 1px 2px rgba(0, 0, 0, 0.15) !important;
      display: inline-block !important;
      vertical-align: middle !important;
      flex-shrink: 0 !important;
    }
    .uis-lang-flag {
      font-size: 16px;
      line-height: 1;
    }
    .uis-lang-menu {
      min-width: 220px;
      max-height: 380px;
      overflow-y: auto;
      border-top: 3px solid var(--uis-yellow, #FED802) !important;
      border-radius: 14px !important;
      padding: 6px !important;
      box-shadow: 0 14px 35px rgba(0, 0, 0, 0.2) !important;
    }
    .uis-lang-menu::-webkit-scrollbar {
      width: 5px;
    }
    .uis-lang-menu::-webkit-scrollbar-thumb {
      background: rgba(4, 107, 38, 0.25);
      border-radius: 4px;
    }
    .uis-lang-item {
      font-size: 13px !important;
      font-weight: 600 !important;
      padding: 7px 12px !important;
      border-radius: 8px !important;
      color: var(--text-main) !important;
      transition: all 0.2s ease !important;
    }
    .uis-lang-item:hover {
      background: #eaf6ee !important;
      color: var(--uis-green) !important;
      padding-left: 14px !important;
    }
    .uis-lang-item.active-lang {
      background: #eaf6ee !important;
      color: var(--uis-green) !important;
      font-weight: 700 !important;
    }
    @media (max-width: 1199.98px) {
      .uis-lang-toggle {
        width: 100%;
        justify-content: space-between;
        margin-top: 4px;
      }
    }

    /* ═══════════════════════════════════════════════
       GOOGLE TRANSLATE SEAMLESS ENGINE OVERRIDES
    ═══════════════════════════════════════════════ */
    body {
      top: 0px !important;
      position: static !important;
    }
    .goog-te-banner-frame,
    .goog-te-banner-frame.skiptranslate,
    iframe.goog-te-banner-frame,
    .goog-te-balloon-frame {
      display: none !important;
      visibility: hidden !important;
      height: 0 !important;
    }
    #goog-gt-tt,
    .goog-tooltip,
    .goog-tooltip:hover {
      display: none !important;
    }
    .goog-text-highlight {
      background-color: transparent !important;
      box-shadow: none !important;
    }
    body > .skiptranslate {
      display: none !important;
    }

    /* ═══════════════════════════════════════════════
       MOBILE NAVBAR DRAWER & STYLING (< 1200px)
    ═══════════════════════════════════════════════ */
    @media (max-width: 1199.98px) {
      .navbar-collapse {
        background: #032e12 !important;
        border: 1px solid rgba(254, 216, 2, 0.25) !important;
        border-radius: 20px !important;
        padding: 20px 16px !important;
        margin-top: 14px !important;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.45) !important;
      }
      .navbar-nav {
        align-items: stretch !important;
        text-align: left !important;
        gap: 5px !important;
        width: 100% !important;
      }
      .nav-item {
        width: 100% !important;
      }
      .nav-link-custom {
        display: flex !important;
        align-items: center !important;
        justify-content: space-between !important;
        padding: 11px 16px !important;
        font-size: 14px !important;
        font-weight: 700 !important;
        color: rgba(255, 255, 255, 0.95) !important;
        background: rgba(255, 255, 255, 0.05) !important;
        border-radius: 12px !important;
        margin-bottom: 2px !important;
        transition: all 0.2s ease !important;
        width: 100% !important;
      }
      .nav-link-custom:hover,
      .nav-link-custom.active,
      .show > .nav-link-custom {
        background: var(--uis-green, #046B26) !important;
        color: var(--uis-yellow, #FED802) !important;
      }
      .dropdown-menu-custom {
        background: rgba(0, 0, 0, 0.3) !important;
        border: 1px solid rgba(255, 255, 255, 0.08) !important;
        border-left: 3px solid var(--uis-yellow) !important;
        border-radius: 12px !important;
        margin: 6px 0 10px 10px !important;
        padding: 8px !important;
        box-shadow: none !important;
        animation: none !important;
      }
      .dropdown-item-custom {
        color: rgba(255, 255, 255, 0.9) !important;
        padding: 9px 14px !important;
        font-size: 13px !important;
        border-radius: 8px !important;
      }
      .dropdown-item-custom:hover,
      .dropdown-item-custom.active {
        background: rgba(254, 216, 2, 0.2) !important;
        color: var(--uis-yellow, #FED802) !important;
      }
      .navbar-main .d-flex.align-items-center.gap-2.mt-3.mt-xl-0 {
        display: grid !important;
        grid-template-columns: 1fr 1fr;
        gap: 10px !important;
        margin-top: 18px !important;
        padding-top: 14px !important;
        border-top: 1px solid rgba(255, 255, 255, 0.12) !important;
      }
      .btn-pmb-nav,
      .btn-portal-nav {
        width: 100% !important;
        justify-content: center !important;
        padding: 11px 14px !important;
        font-size: 13px !important;
        border-radius: 10px !important;
        text-align: center !important;
      }
    }

    /* CTA Buttons */
    .btn-pmb-nav {
      background: #ffffff !important;
      color: #76C457 !important;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 800;
      font-size: 12.5px;
      padding: 8px 15px;
      border-radius: 8px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
      display: inline-flex;
      align-items: center;
      gap: 6px;
      border: 1px solid #ffffff !important;
      transition: all 0.25s ease;
      white-space: nowrap;
    }
    .btn-pmb-nav i {
      color: #76C457 !important;
      transition: color 0.25s ease;
    }
    .btn-pmb-nav:hover {
      background: var(--uis-yellow, #FED802) !important;
      border-color: var(--uis-yellow, #FED802) !important;
      color: #76C457 !important;
      transform: translateY(-2px);
      box-shadow: 0 4px 14px rgba(254, 216, 2, 0.4);
    }
    .btn-pmb-nav:hover i {
      color: #76C457 !important;
    }

    .btn-portal-nav {
      background: rgba(255, 255, 255, 0.14);
      color: #ffffff !important;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 12.5px;
      padding: 8px 14px;
      border-radius: 8px;
      border: 1px solid rgba(255, 255, 255, 0.35);
      display: inline-flex;
      align-items: center;
      gap: 6px;
      transition: all 0.25s ease;
      white-space: nowrap;
    }
    .btn-portal-nav:hover {
      background: rgba(255, 255, 255, 0.25);
      border-color: var(--uis-yellow);
      color: var(--uis-yellow) !important;
      transform: translateY(-2px);
    }

    .btn-primary-hero {
      background: var(--uis-yellow);
      color: #046B26;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 800;
      font-size: 15px;
      padding: 14px 28px;
      border-radius: 12px;
      border: none;
      box-shadow: var(--shadow-orange);
      display: inline-flex;
      align-items: center;
      gap: 9px;
    }
    .btn-primary-hero:hover {
      background: var(--uis-yellow-hover);
      color: #023814;
      transform: translateY(-2px);
    }

    .btn-outline-hero {
      background: rgba(255, 255, 255, 0.12);
      color: var(--white);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 15px;
      padding: 14px 28px;
      border-radius: 12px;
      border: 1.5px solid rgba(255, 255, 255, 0.4);
      display: inline-flex;
      align-items: center;
      gap: 9px;
    }
    .btn-outline-hero:hover {
      background: var(--white);
      color: var(--uis-green);
      border-color: var(--white);
      transform: translateY(-2px);
    }

    /* ═══════════════════════════════════════════════
       SECTION GENERAL STYLING
    ═══════════════════════════════════════════════ */
    section { padding: 80px 0; position: relative; }
    .section-bg-white { background: var(--white); }
    .section-bg-sand { background: var(--page-bg); }
    .section-bg-cream { background: var(--surface-light); }

    .section-label {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background: var(--uis-green-light);
      color: var(--uis-green);
      border: 1px solid var(--border-purple);
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 12px;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 1.2px;
      padding: 6px 16px;
      border-radius: 50px;
      margin-bottom: 16px;
    }

    .section-title {
      font-size: 36px;
      font-weight: 800;
      letter-spacing: -0.8px;
      line-height: 1.25;
      margin-bottom: 16px;
    }
    .section-title em {
      font-style: normal;
      color: var(--uis-green);
    }

    .section-desc {
      font-size: 16px;
      color: var(--text-muted);
      max-width: 680px;
      line-height: 1.7;
    }

    .divider-line {
      width: 60px;
      height: 4px;
      background: #FED802;
      border-radius: 4px;
      margin-bottom: 24px;
    }
    .divider-line.centered { margin-left: auto; margin-right: auto; }

    /* ═══════════════════════════════════════════════
       CARDS & INTERACTIVE ELEMENTS
    ═══════════════════════════════════════════════ */
    .feature-card, .value-card, .service-card {
      background: var(--white);
      border: 1px solid var(--border-light);
      border-radius: 20px;
      padding: 36px 30px;
      box-shadow: var(--shadow-sm);
      transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
      height: 100%;
    }
    .feature-card:hover, .value-card:hover, .service-card:hover {
      transform: translateY(-6px);
      border-color: var(--border-purple);
      box-shadow: var(--shadow-lg);
    }

    .feature-icon-wrap, .value-icon-wrap {
      width: 64px;
      height: 64px;
      background: var(--uis-green-light);
      border-radius: 16px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--uis-green);
      font-size: 28px;
      margin-bottom: 24px;
      border: 1px solid var(--uis-green-subtle);
    }

    .feature-title, .value-title {
      font-size: 20px;
      font-weight: 700;
      margin-bottom: 12px;
    }

    .feature-desc, .value-desc {
      font-size: 14.5px;
      color: var(--text-muted);
      line-height: 1.65;
    }

    /* Counter Section — Solid Dark Emerald */
    .counter-section {
      background: #023814;
      padding: 60px 0;
      color: var(--white);
      border-top: 1px solid rgba(254, 216, 2, 0.2);
      border-bottom: 1px solid rgba(254, 216, 2, 0.2);
    }
    .counter-item { text-align: center; }
    .counter-icon { font-size: 32px; color: var(--uis-yellow); margin-bottom: 10px; }
    .counter-num {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 42px;
      font-weight: 800;
      color: var(--white);
      line-height: 1;
      margin-bottom: 6px;
    }
    .counter-num sup { font-size: 22px; color: var(--uis-yellow); }
    .counter-label { font-size: 14px; color: rgba(255, 255, 255, 0.75); font-weight: 500; }

    /* Testimonials */
    .testi-card {
      background: var(--white);
      border: 1px solid var(--border-light);
      border-radius: 20px;
      padding: 32px;
      box-shadow: var(--shadow-sm);
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: all 0.3s ease;
    }
    .testi-card:hover {
      transform: translateY(-6px);
      box-shadow: var(--shadow-lg);
      border-color: var(--border-purple);
    }
    .testi-stars { color: #e5c302; font-size: 16px; margin-bottom: 14px; }
    .testi-text { font-size: 14.5px; color: var(--text-main); line-height: 1.7; margin-bottom: 24px; font-style: italic; }
    .testi-author { display: flex; align-items: center; gap: 14px; }
    .testi-avatar {
      width: 46px; height: 46px;
      background: var(--uis-green);
      color: var(--white);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-weight: 700; font-size: 16px;
    }
    .testi-name { font-weight: 700; font-size: 15px; }
    .testi-role { font-size: 12.5px; color: var(--text-muted); }

    /* FAQ */
    .faq-item {
      background: var(--white);
      border: 1px solid var(--border-light);
      border-radius: 16px;
      margin-bottom: 14px;
      overflow: hidden;
      transition: all 0.25s ease;
    }
    .faq-header {
      padding: 20px 24px;
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-weight: 700;
      font-size: 16px;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: space-between;
      color: var(--text-main);
      user-select: none;
    }
    .faq-header:hover { color: var(--uis-green); }
    .faq-icon {
      width: 28px; height: 28px;
      background: var(--uis-green-light);
      color: var(--uis-green);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 13px;
      transition: transform 0.25s ease;
    }
    .faq-body {
      padding: 0 24px 22px;
      font-size: 14.5px;
      color: var(--text-muted);
      line-height: 1.75;
      display: none;
    }
    .faq-item.open .faq-body { display: block; }
    .faq-item.open .faq-icon { transform: rotate(180deg); background: var(--uis-green); color: var(--white); }

    /* ═══════════════════════════════════════════════
       FOOTER — Solid Deep UIS Green (#023814) with Yellow (#FED802) Accent
    ═══════════════════════════════════════════════ */
    .footer-main {
      background: #023814;
      color: rgba(255, 255, 255, 0.9);
      padding: 70px 0 28px;
      border-top: 4px solid var(--uis-yellow, #FED802);
    }
    .footer-logo {
      display: flex;
      align-items: center;
      gap: 12px;
      text-decoration: none;
      margin-bottom: 18px;
    }
    .footer-brand-name {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 22px;
      font-weight: 800;
      color: var(--white);
    }
    .footer-brand-sub {
      font-size: 12px;
      color: rgba(255, 255, 255, 0.75);
    }
    .footer-desc {
      font-size: 14px;
      line-height: 1.75;
      margin-bottom: 24px;
      color: rgba(255, 255, 255, 0.88);
    }
    .footer-social { display: flex; gap: 10px; }
    .footer-social a {
      width: 38px; height: 38px;
      background: rgba(255, 255, 255, 0.12);
      border-radius: 10px;
      display: flex; align-items: center; justify-content: center;
      color: var(--white);
      font-size: 16px;
      border: 1px solid rgba(255, 255, 255, 0.22);
      transition: all 0.25s ease;
    }
    .footer-social a:hover {
      background: var(--uis-yellow, #FED802);
      border-color: var(--uis-yellow, #FED802);
      color: #046B26;
      transform: translateY(-2px);
    }
    .footer-heading {
      font-family: 'Plus Jakarta Sans', sans-serif;
      font-size: 16px;
      font-weight: 800;
      color: var(--white);
      margin-bottom: 20px;
      letter-spacing: 0.3px;
    }
    .footer-links { list-style: none; padding: 0; margin: 0; }
    .footer-links li { margin-bottom: 10px; }
    .footer-links a {
      color: rgba(255, 255, 255, 0.85);
      font-size: 13.5px;
      display: flex;
      align-items: center;
      gap: 6px;
      transition: all 0.2s ease;
    }
    .footer-links a:hover { color: #FED802; transform: translateX(3px); }
    .footer-contact-item {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin-bottom: 14px;
      font-size: 13.5px;
    }
    .footer-contact-icon {
      color: #FED802;
      font-size: 18px;
      flex-shrink: 0;
      margin-top: 2px;
    }
    .footer-contact-text strong { display: block; color: var(--white); margin-bottom: 2px; }
    .footer-divider {
      height: 1px;
      background: rgba(255, 255, 255, 0.18);
      margin: 48px 0 24px;
    }
    .footer-bottom { font-size: 13px; color: rgba(255, 255, 255, 0.82); }
    .footer-bottom a { color: rgba(255, 255, 255, 0.85); }
    .footer-bottom a:hover { color: #FED802; }

    /* Back to Top */
    .back-to-top {
      position: fixed;
      bottom: 24px;
      right: 24px;
      width: 44px;
      height: 44px;
      background: var(--uis-green);
      color: var(--white);
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 18px;
      z-index: 999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.3s ease;
      box-shadow: var(--shadow-purple);
      border: 1px solid var(--uis-yellow);
    }
    .back-to-top.show { opacity: 1; visibility: visible; }
    .back-to-top:hover {
      background: var(--uis-green-dark);
      transform: translateY(-3px);
      color: var(--uis-yellow);
    }

    /* Check list */
    .check-list { list-style: none; padding: 0; margin: 0; }
    .check-list li {
      display: flex;
      align-items: flex-start;
      gap: 12px;
      margin-bottom: 12px;
      font-size: 15px;
    }
    .check-icon {
      width: 22px; height: 22px;
      background: var(--uis-green-light);
      color: var(--uis-green);
      border-radius: 50%;
      display: flex; align-items: center; justify-content: center;
      font-size: 12px;
      flex-shrink: 0;
      margin-top: 3px;
    }

    /* Responsive Map Embed */
    .map-responsive-container iframe,
    .map-wrapper iframe,
    .contact-map-card iframe {
      width: 100% !important;
      height: 100% !important;
      min-height: 440px !important;
      border: 0 !important;
      display: block !important;
    }
  </style>

  @stack('styles')
</head>

<body>


<!-- ═══════════════════════════════════════════════
     NAVBAR HEADER UTAMA
═══════════════════════════════════════════════ -->
@include('layouts.frontend.header')

<!-- ═══════════════════════════════════════════════
     MAIN CONTENT
═══════════════════════════════════════════════ -->
@yield('content')

<!-- ═══════════════════════════════════════════════
     FOOTER
═══════════════════════════════════════════════ -->
@include('layouts.frontend.footer')

<!-- Back to Top -->
<a href="#" class="back-to-top" id="backToTop">
  <i class="bi bi-chevron-up"></i>
</a>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<!-- AOS JS -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<!-- Swiper Slider JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<script>
  AOS.init({
    once: true,
    duration: 400,
    offset: 20,
    delay: 0,
    disable: function() {
      return window.innerWidth < 768;
    }
  });

  const btn = document.getElementById('backToTop');
  window.addEventListener('scroll', () => {
    btn.classList.toggle('show', window.scrollY > 400);
  });
  btn.addEventListener('click', (e) => {
    e.preventDefault();
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });

  function toggleFaq(id) {
    const item = document.getElementById(id);
    const isOpen = item.classList.contains('open');
    document.querySelectorAll('.faq-item').forEach(f => f.classList.remove('open'));
    if (!isOpen) item.classList.add('open');
  }
</script>

<!-- ═══════════════════════════════════════════════
     GOOGLE TRANSLATE MULTI-LANGUAGE SYSTEM
═══════════════════════════════════════════════ -->
<div id="google_translate_element" style="display:none; position:absolute; left:-9999px; top:-9999px;"></div>

@php
  $includedCodes = (isset($bahasaList) && $bahasaList->count() > 0)
      ? $bahasaList->pluck('kode')->implode(',')
      : 'id,en,ar,zh-CN,nl,tl,fr,de,hi,it,ko,ja';
@endphp

<script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({
      pageLanguage: 'id',
      includedLanguages: '{{ $includedCodes }}',
      autoDisplay: false
    }, 'google_translate_element');
  }

  function getCookie(name) {
    var match = document.cookie.match(new RegExp('(^|;\\s*)(' + name + ')=([^;]*)'));
    return match ? decodeURIComponent(match[3]) : null;
  }

  function clearGoogTransCookie() {
    var hostname = window.location.hostname;
    document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
    document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=" + hostname;
    var domainParts = hostname.split('.');
    while (domainParts.length > 1) {
      document.cookie = "googtrans=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/; domain=." + domainParts.join('.');
      domainParts.shift();
    }
  }

  function setGoogTransCookie(langCode) {
    var val = '/id/' + langCode;
    var hostname = window.location.hostname;
    document.cookie = "googtrans=" + val + "; path=/;";
    document.cookie = "googtrans=" + val + "; path=/; domain=" + hostname;
    var domainParts = hostname.split('.');
    if (domainParts.length > 1) {
      document.cookie = "googtrans=" + val + "; path=/; domain=." + domainParts.slice(-2).join('.');
    }
  }

  function updateActiveLangUI(langCode, langName, flagUrl) {
    var nameEl = document.getElementById('uisCurrentName');
    var shortEl = document.getElementById('uisCurrentShort');
    var flagImgEl = document.getElementById('uisCurrentFlagImg');

    if (nameEl) nameEl.textContent = langName;
    if (shortEl) {
      var shortName = langName.indexOf(' ') !== -1 ? langName.split(' ')[1] : langName;
      shortEl.textContent = shortName;
    }
    if (flagImgEl && flagUrl) {
      flagImgEl.src = flagUrl;
    }

    document.querySelectorAll('.uis-lang-item').forEach(function(item) {
      item.classList.remove('active-lang');
    });
    document.querySelectorAll('.uis-check-icon').forEach(function(icon) {
      icon.classList.add('d-none');
    });

    var activeItem = document.querySelector('.uis-lang-item[data-code="' + langCode + '"]');
    if (activeItem) {
      activeItem.classList.add('active-lang');
      var checkIcon = document.getElementById('check-lang-' + langCode);
      if (checkIcon) checkIcon.classList.remove('d-none');
    }
  }

  function uisChangeLanguage(langCode, langName, flagUrl) {
    if (langCode === 'id') {
      clearGoogTransCookie();
      localStorage.setItem('uis_selected_lang', 'id');
      localStorage.setItem('uis_selected_lang_name', 'Bahasa Indonesia');
      localStorage.setItem('uis_selected_lang_flag', flagUrl || '{{ asset('assets/img/flags/id.png') }}');
      
      var combo = document.querySelector('.goog-te-combo');
      if (combo) {
        combo.value = 'id';
        combo.dispatchEvent(new Event('change'));
      }
      setTimeout(function() {
        window.location.reload();
      }, 150);
      return;
    }

    setGoogTransCookie(langCode);
    localStorage.setItem('uis_selected_lang', langCode);
    localStorage.setItem('uis_selected_lang_name', langName);
    localStorage.setItem('uis_selected_lang_flag', flagUrl);

    var combo = document.querySelector('.goog-te-combo');
    if (combo) {
      combo.value = langCode;
      combo.dispatchEvent(new Event('change'));
      updateActiveLangUI(langCode, langName, flagUrl);
    } else {
      window.location.reload();
    }
  }

  // Restore active language selection UI on load
  document.addEventListener('DOMContentLoaded', function() {
    var savedCode = localStorage.getItem('uis_selected_lang');
    var savedName = localStorage.getItem('uis_selected_lang_name');
    var savedFlag = localStorage.getItem('uis_selected_lang_flag');

    var googCookie = getCookie('googtrans');
    if (googCookie) {
      var parts = googCookie.split('/');
      var currentCookieLang = parts[parts.length - 1];
      if (currentCookieLang && currentCookieLang !== 'id') {
        savedCode = currentCookieLang;
      } else if (currentCookieLang === 'id') {
        savedCode = 'id';
      }
    }

    if (savedCode) {
      var item = document.querySelector('.uis-lang-item[data-code="' + savedCode + '"]');
      if (item) {
        var flag = item.getAttribute('data-flag') || savedFlag;
        var name = item.getAttribute('data-name') || savedName || savedCode;
        updateActiveLangUI(savedCode, name, flag);
      }
    }
  });
</script>
<script type="text/javascript" src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit" defer></script>

@stack('scripts')

</body>
</html>
