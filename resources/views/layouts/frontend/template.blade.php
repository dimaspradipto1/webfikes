<!DOCTYPE html>
<html lang="id">
@php
  if (!isset($cleanWa) || empty($cleanWa)) {
      $cleanWa = '';
      if (!empty($contact->no_wa)) {
          $cleanWa = preg_replace('/[^0-9]/', '', $contact->no_wa);
          if (strpos($cleanWa, '08') === 0) {
              $cleanWa = '628' . substr($cleanWa, 2);
          } elseif (strpos($cleanWa, '8') === 0) {
              $cleanWa = '628' . substr($cleanWa, 1);
          }
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

  <!-- Master Unified Frontend CSS -->
  <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}?v={{ file_exists(public_path('frontend/css/style.css')) ? filemtime(public_path('frontend/css/style.css')) : time() }}">

  @if(isset($themeSetting))
  <style id="dynamic-frontend-theme">
    :root {
      --uis-green: {{ $themeSetting->primary_color ?? '#046B26' }} !important;
      --uis-green-dark: {{ $themeSetting->primary_dark_color ?? '#03521d' }} !important;
      --uis-yellow: {{ $themeSetting->secondary_color ?? '#FED802' }} !important;
      --uis-yellow-hover: {{ $themeSetting->secondary_dark_color ?? '#e5c302' }} !important;
      --uis-purple: {{ $themeSetting->primary_color ?? '#046B26' }} !important;
      --uis-purple-dark: {{ $themeSetting->primary_dark_color ?? '#03521d' }} !important;
      --uis-orange: {{ $themeSetting->secondary_color ?? '#FED802' }} !important;
      --uis-orange-hover: {{ $themeSetting->secondary_dark_color ?? '#e5c302' }} !important;
      --obsidian-dark: {{ $themeSetting->primary_dark_color ?? '#03521d' }} !important;
      --obsidian-card: {{ $themeSetting->primary_color ?? '#046B26' }} !important;
    }

    /* Navbar Header Dynamic Overrides */
    .navbar-main {
      background: {{ $themeSetting->header_bg_color ?? '#046B26' }} !important;
      border-bottom: 3px solid {{ $themeSetting->header_border_color ?? '#FED802' }} !important;
      min-height: {{ $themeSetting->header_height ?? 90 }}px !important;
      padding-top: 16px !important;
      padding-bottom: 16px !important;
    }

    .navbar-main .brand-logo-img {
      height: 54px !important;
      max-height: 54px !important;
    }

    .navbar-main .brand-title-main,
    .navbar-main .nav-link-custom {
      color: {{ $themeSetting->header_text_color ?? '#ffffff' }} !important;
    }

    .navbar-main .nav-link-custom:hover,
    .navbar-main .nav-link-custom:focus,
    .navbar-main .nav-link-custom.active,
    .navbar-main .nav-link-custom.show,
    .navbar-main .show > .nav-link-custom,
    .navbar-main .nav-item.dropdown:hover > .nav-link-custom {
      background: {{ $themeSetting->header_active_bg_color ?? '#FED802' }} !important;
      color: {{ $themeSetting->header_active_text_color ?? '#046B26' }} !important;
    }

    .navbar-main .btn-pmb-nav {
      background: {{ $themeSetting->header_pmb_bg_color ?? '#FED802' }} !important;
      color: {{ $themeSetting->header_pmb_text_color ?? '#046B26' }} !important;
    }

    .navbar-main .btn-portal-nav {
      background: {{ $themeSetting->header_login_bg_color ?? '#ffffff' }} !important;
      color: {{ $themeSetting->header_login_text_color ?? '#046B26' }} !important;
    }

    .navbar-main .uis-lang-toggle {
      background: {{ $themeSetting->header_lang_bg_color ?? '#03521d' }} !important;
      color: {{ $themeSetting->header_lang_text_color ?? '#ffffff' }} !important;
    }

    /* Subpage Hero Banner Dynamic Overrides */
    .prestasi-hero, .dosen-hero, .news-hero, .article-hero, .about-hero,
    .sejarah-hero, .visimisi-hero, .rektor-hero, .detail-hero, .ormawa-hero,
    .layanan-hero, .galeri-hero, .fasilitas-hero, .kontak-hero, .faq-hero,
    .kerjasama-hero, .tracer-hero, .download-hero, .kurikulum-hero, .hero-subpage,
    .page-hero-banner, .akademik-hero, .sambutan-hero, .struktur-hero,
    .testimoni-hero, .humas-hero, .organisasi-hero {
      background: {{ $themeSetting->hero_bg_color ?? '#046B26' }} !important;
      border-bottom-color: {{ $themeSetting->hero_border_color ?? '#FED802' }} !important;
    }

    /* Footer Dynamic Overrides */
    .footer-main {
      background: {{ $themeSetting->footer_bg_color ?? '#03521d' }} !important;
      color: {{ $themeSetting->footer_text_color ?? '#ffffff' }} !important;
      border-top: 4px solid {{ $themeSetting->footer_border_top_color ?? '#FED802' }} !important;
    }

    .footer-main .footer-heading,
    .footer-main .footer-logo-text strong {
      color: {{ $themeSetting->footer_heading_color ?? '#FED802' }} !important;
    }

    .footer-main .footer-desc,
    .footer-main .footer-contact-item,
    .footer-main .footer-contact-item span,
    .footer-main .footer-bottom {
      color: {{ $themeSetting->footer_text_color ?? '#ffffff' }} !important;
    }

    .footer-main .footer-links a {
      color: {{ $themeSetting->footer_link_color ?? '#ffffff' }} !important;
    }

    .footer-main .footer-links a:hover {
      color: {{ $themeSetting->footer_link_hover_color ?? '#FED802' }} !important;
    }

    .footer-main .footer-social a {
      background: {{ $themeSetting->footer_social_bg_color ?? '#FED802' }} !important;
      color: {{ $themeSetting->footer_social_text_color ?? '#046B26' }} !important;
    }
  </style>
  @endif

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
<div id="frontend-live-content">
@yield('content')
</div>

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

<!-- ═══════════════════════════════════════════════
     LIVE AUTO-SYNC ENGINE (UPDATE OTOMATIS DARI ADMIN TANPA RELOAD)
═══════════════════════════════════════════════ -->
<script>
(function() {
  var currentThemeHash = null;
  var currentContentHash = null;
  var isRefreshingDom = false;

  window.applyLiveFrontendTheme = function(t) {
    if (!t) return;
    var styleEl = document.getElementById('dynamic-frontend-theme');
    if (!styleEl) {
      styleEl = document.createElement('style');
      styleEl.id = 'dynamic-frontend-theme';
      document.head.appendChild(styleEl);
    }

    var hHeight = parseInt(t.header_height || 90, 10);
    styleEl.textContent = `
      :root {
        --uis-green: ${t.primary_color || '#046B26'} !important;
        --uis-green-dark: ${t.primary_dark_color || '#03521d'} !important;
        --uis-yellow: ${t.secondary_color || '#FED802'} !important;
        --uis-yellow-hover: ${t.secondary_dark_color || '#e5c302'} !important;
        --uis-purple: ${t.primary_color || '#046B26'} !important;
        --uis-purple-dark: ${t.primary_dark_color || '#03521d'} !important;
        --uis-orange: ${t.secondary_color || '#FED802'} !important;
        --uis-orange-hover: ${t.secondary_dark_color || '#e5c302'} !important;
        --obsidian-dark: ${t.primary_dark_color || '#03521d'} !important;
        --obsidian-card: ${t.primary_color || '#046B26'} !important;
      }
      .navbar-main {
        background: ${t.header_bg_color || '#046B26'} !important;
        border-bottom: 3px solid ${t.header_border_color || '#FED802'} !important;
        min-height: ${hHeight}px !important;
        padding-top: 16px !important;
        padding-bottom: 16px !important;
      }
      .navbar-main .brand-logo-img {
        height: 54px !important;
        max-height: 54px !important;
      }
      .navbar-main .brand-title-main,
      .navbar-main .nav-link-custom {
        color: ${t.header_text_color || '#ffffff'} !important;
      }
      .navbar-main .nav-link-custom:hover,
      .navbar-main .nav-link-custom:focus,
      .navbar-main .nav-link-custom.active,
      .navbar-main .nav-link-custom.show,
      .navbar-main .show > .nav-link-custom,
      .navbar-main .nav-item.dropdown:hover > .nav-link-custom {
        background: ${t.header_active_bg_color || '#FED802'} !important;
        color: ${t.header_active_text_color || '#046B26'} !important;
      }
      .navbar-main .btn-pmb-nav {
        background: ${t.header_pmb_bg_color || '#FED802'} !important;
        color: ${t.header_pmb_text_color || '#046B26'} !important;
      }
      .navbar-main .btn-portal-nav {
        background: ${t.header_login_bg_color || '#ffffff'} !important;
        color: ${t.header_login_text_color || '#046B26'} !important;
      }
      .navbar-main .uis-lang-toggle {
        background: ${t.header_lang_bg_color || '#03521d'} !important;
        color: ${t.header_lang_text_color || '#ffffff'} !important;
      }
      .prestasi-hero, .dosen-hero, .news-hero, .article-hero, .about-hero,
      .sejarah-hero, .visimisi-hero, .rektor-hero, .detail-hero, .ormawa-hero,
      .layanan-hero, .galeri-hero, .fasilitas-hero, .kontak-hero, .faq-hero,
      .kerjasama-hero, .tracer-hero, .download-hero, .kurikulum-hero, .hero-subpage,
      .page-hero-banner, .akademik-hero, .sambutan-hero, .struktur-hero,
      .testimoni-hero, .humas-hero, .organisasi-hero {
        background: ${t.hero_bg_color || '#046B26'} !important;
        border-bottom-color: ${t.hero_border_color || '#FED802'} !important;
      }
      .footer-main {
        background: ${t.footer_bg_color || '#03521d'} !important;
        color: ${t.footer_text_color || '#ffffff'} !important;
        border-top: 4px solid ${t.footer_border_top_color || '#FED802'} !important;
      }
      .footer-main .footer-heading,
      .footer-main .footer-logo-text strong {
        color: ${t.footer_heading_color || '#FED802'} !important;
      }
      .footer-main .footer-desc,
      .footer-main .footer-contact-item,
      .footer-main .footer-contact-item span,
      .footer-main .footer-bottom {
        color: ${t.footer_text_color || '#ffffff'} !important;
      }
      .footer-main .footer-links a {
        color: ${t.footer_link_color || '#ffffff'} !important;
      }
      .footer-main .footer-links a:hover {
        color: ${t.footer_link_hover_color || '#FED802'} !important;
      }
      .footer-main .footer-social a {
        background: ${t.footer_social_bg_color || '#FED802'} !important;
        color: ${t.footer_social_text_color || '#046B26'} !important;
      }
    `;

    var navEl = document.querySelector('.navbar-main');
    if (navEl) {
      var sticky = (t.header_is_sticky === undefined || t.header_is_sticky === null) ? true : Boolean(t.header_is_sticky);
      navEl.classList.toggle('sticky-top', sticky);
    }

    if (t.layout && typeof t.layout === 'object') {
      var layoutStyle = document.getElementById('uis-home-layout-style');
      if (layoutStyle) {
        var cssLines = [
          '#uisHomeLayout { display: flex; flex-direction: column; }',
          '#uisHomeLayout > section { width: 100%; }'
        ];
        Object.keys(t.layout).forEach(function(key) {
          var row = t.layout[key];
          var ord = parseInt(row.order || 1, 10);
          var vis = Boolean(row.visible);
          cssLines.push('#uisHomeLayout > section#' + key + ' { order: ' + ord + ';' + (!vis ? ' display: none !important;' : '') + ' }');
        });
        layoutStyle.textContent = cssLines.join('\n');
      }
    }
  };

  window.hotSwapFrontendContent = function() {
    if (isRefreshingDom) return;
    isRefreshingDom = true;

    fetch(window.location.href, {
      headers: { 'X-Requested-With': 'LiveSync', 'Cache-Control': 'no-cache' },
      cache: 'no-store'
    })
    .then(function(res) { return res.text(); })
    .then(function(html) {
      var parser = new DOMParser();
      var doc = parser.parseFromString(html, 'text/html');

      var newNav = doc.querySelector('.navbar-main');
      var curNav = document.querySelector('.navbar-main');
      if (newNav && curNav) {
        curNav.innerHTML = newNav.innerHTML;
      }

      var newContent = doc.getElementById('frontend-live-content');
      var curContent = document.getElementById('frontend-live-content');
      if (newContent && curContent) {
        curContent.innerHTML = newContent.innerHTML;
      }

      var newFooter = doc.querySelector('.footer-main');
      var curFooter = document.querySelector('.footer-main');
      if (newFooter && curFooter) {
        curFooter.innerHTML = newFooter.innerHTML;
      }

      if (window.AOS && typeof window.AOS.refreshHard === 'function') {
        window.AOS.refreshHard();
      }
    })
    .catch(function() {})
    .finally(function() {
      isRefreshingDom = false;
    });
  };

  // 1. Instant Cross-Tab Sync via BroadcastChannel & localStorage
  if ('BroadcastChannel' in window) {
    var bc = new BroadcastChannel('webfikes_live_sync');
    bc.onmessage = function(ev) {
      if (!ev.data) return;
      if (ev.data.type === 'theme_update' && ev.data.theme) {
        window.applyLiveFrontendTheme(ev.data.theme);
      } else if (ev.data.type === 'content_update') {
        if (ev.data.theme) window.applyLiveFrontendTheme(ev.data.theme);
        window.hotSwapFrontendContent();
      }
    };
  }

  window.addEventListener('storage', function(ev) {
    if (ev.key === 'webfikes_live_theme' && ev.newValue) {
      try {
        var payload = JSON.parse(ev.newValue);
        if (payload && payload.theme) {
          window.applyLiveFrontendTheme(payload.theme);
        }
      } catch (e) {}
    } else if (ev.key === 'webfikes_live_content_ping' && ev.newValue) {
      window.hotSwapFrontendContent();
    }
  });

  // 2. Background Polling (/api/live-state) Every 2.5 Seconds
  function checkLiveState() {
    if (document.hidden) return;
    fetch('{{ route("api.live-state") }}?t=' + Date.now(), { cache: 'no-store' })
      .then(function(r) { return r.json(); })
      .then(function(data) {
        if (!data) return;
        if (currentThemeHash === null) {
          currentThemeHash = data.theme_hash;
          currentContentHash = data.content_hash;
          return;
        }
        if (data.theme_hash && data.theme_hash !== currentThemeHash) {
          currentThemeHash = data.theme_hash;
          window.applyLiveFrontendTheme(data.theme);
        }
        if (data.content_hash && data.content_hash !== currentContentHash) {
          currentContentHash = data.content_hash;
          window.hotSwapFrontendContent();
        }
      })
      .catch(function() {});
  }

  setInterval(checkLiveState, 2500);
  document.addEventListener('visibilitychange', function() {
    if (!document.hidden) checkLiveState();
  });
  checkLiveState();
})();
</script>

</body>
</html>
