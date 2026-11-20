@php
  $ns = $navbarSetting ?? \App\Models\NavbarSetting::current();
@endphp
<!-- ═══════════════════════════════════════════════
     NAVBAR HEADER UTAMA
═══════════════════════════════════════════════ -->
<nav class="navbar navbar-expand-xl navbar-main {{ ($themeSetting->header_is_sticky ?? true) ? 'sticky-top' : '' }}">
  <div class="container-fluid px-lg-4 px-xl-5">
    <!-- Logo & Brand -->
    <a class="navbar-brand navbar-brand-custom me-2 me-xl-3" href="{{ route('homepage') }}">
      <img src="{{ $ns->frontend_logo_url }}" alt="{{ $ns->frontend_title }}" class="brand-logo-img">
      <div class="ms-2 d-flex flex-column justify-content-center" style="line-height: 1.15;">
        <span class="brand-title-main">{{ $ns->frontend_title }}</span>
        @if(!empty($ns->frontend_subtitle))
          <span class="brand-subtitle" style="font-size: 11px; font-weight: 600; opacity: 0.88; color: {{ $themeSetting->header_text_color ?? '#ffffff' }};">{{ $ns->frontend_subtitle }}</span>
        @endif
      </div>
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav mx-auto gap-1 align-items-center">
        <!-- Beranda -->
        @if($ns->show_beranda)
        <li class="nav-item">
          <a href="{{ route('homepage') }}" class="nav-link nav-link-custom {{ request()->routeIs('homepage') ? 'active' : '' }}">{{ $ns->menu_beranda_label }}</a>
        </li>
        @endif

        <!-- Profil Dropdown -->
        @if($ns->show_profil)
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.tentang') || request()->routeIs('homepage.sambutan*') || request()->routeIs('homepage.visi-misi') || request()->routeIs('homepage.struktur-organisasi') || request()->routeIs('homepage.sejarah') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $ns->menu_profil_label }} <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.tentang') ? 'active' : '' }}" href="{{ route('homepage.tentang') }}"><i class="bi bi-building"></i> Tentang Universitas</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.visi-misi') ? 'active' : '' }}" href="{{ route('homepage.visi-misi') }}"><i class="bi bi-bullseye"></i> Visi & Misi</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.sambutan*') ? 'active' : '' }}" href="{{ route('homepage.sambutan-rektor') }}"><i class="bi bi-person-badge"></i> Sambutan Dekan</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.struktur-organisasi') ? 'active' : '' }}" href="{{ route('homepage.struktur-organisasi') }}"><i class="bi bi-diagram-3"></i> Struktur Organisasi</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.sejarah') ? 'active' : '' }}" href="{{ route('homepage.sejarah') }}"><i class="bi bi-hourglass-split"></i> Sejarah FIKES</a></li>
          </ul>
        </li>
        @endif

        <!-- Akademik Dropdown (Di Samping Profil) -->
        @if($ns->show_akademik)
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.kurikulum*') || request()->routeIs('homepage.kalender-akademik') || request()->routeIs('homepage.pedoman-akademik') || request()->routeIs('homepage.sistem-akademik') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $ns->menu_akademik_label }} <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-item-custom justify-content-between {{ request()->routeIs('homepage.kurikulum*') ? 'active' : '' }}" href="{{ route('homepage.kurikulum') }}">
                <span class="d-flex align-items-center gap-2">
                  <i class="bi bi-card-list" style="color: var(--uis-orange, #FED802);"></i>
                  <span>Kurikulum FIKES</span>
                </span>
                <i class="bi bi-chevron-right ms-2" style="font-size: 10px; color: var(--uis-orange, #FED802);"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-custom">
                @if(isset($navProdis) && $navProdis->count() > 0)
                  @foreach($navProdis as $navProdi)
                    <li>
                      <a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.kurikulum*') && request('prodi') == $navProdi->id ? 'active' : '' }}"
                         href="{{ route('homepage.kurikulum', ['prodi' => $navProdi->id]) }}">
                        <i class="bi bi-mortarboard-fill" style="color: var(--uis-orange, #FED802);"></i>
                        <span>{{ strtoupper($navProdi->judul) }}</span>
                      </a>
                    </li>
                  @endforeach
                @else
                  <li>
                    <a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.kurikulum') }}">
                      <i class="bi bi-mortarboard-fill" style="color: var(--uis-orange, #FED802);"></i>
                      <span>Semua Program Studi</span>
                    </a>
                  </li>
                @endif
              </ul>
            </li>
            <li>
              <a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.kalender-akademik') ? 'active' : '' }}" href="{{ route('homepage.kalender-akademik') }}">
                <i class="bi bi-calendar2-check" style="color: var(--uis-orange, #FED802);"></i> Kalender Akademik
              </a>
            </li>
            <li>
              <a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.pedoman-akademik') ? 'active' : '' }}" href="{{ route('homepage.pedoman-akademik') }}">
                <i class="bi bi-book" style="color: var(--uis-orange, #FED802);"></i> Pedoman Akademik
              </a>
            </li>
            <li>
              <a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.sistem-akademik') ? 'active' : '' }}" href="{{ route('homepage.sistem-akademik') }}">
                <i class="bi bi-laptop" style="color: var(--uis-orange, #FED802);"></i> Sistem Akademik
              </a>
            </li>
          </ul>
        </li>
        @endif

        <!-- Program Studi / Fakultas Dropdown -->
        @if($ns->show_fakultas)
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.layanan*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $ns->menu_fakultas_label }} <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            @if(isset($navProdis) && $navProdis->count() > 0)
              @foreach($navProdis as $navProdi)
                @php
                  $rawLink = trim($navProdi->link ?? '');
                  if (!empty($rawLink) && !str_starts_with($rawLink, 'http://') && !str_starts_with($rawLink, 'https://') && !str_starts_with($rawLink, '/') && !str_starts_with($rawLink, '#')) {
                      $rawLink = 'https://' . $rawLink;
                  }
                  $hasLink = !empty($rawLink);
                  $prodiHref = $hasLink ? $rawLink : '#';
                  $isExternal = $hasLink && (str_starts_with($rawLink, 'http://') || str_starts_with($rawLink, 'https://'));
                @endphp
                <li>
                  <a class="dropdown-item dropdown-item-custom"
                     href="{{ $prodiHref }}"
                     @if($isExternal) target="_blank" rel="noopener noreferrer" @endif>
                    <i class="bi {{ $navProdi->icon ?: 'bi-mortarboard-fill' }}" style="color: var(--uis-green);"></i>
                    <span>{{ $navProdi->judul }}</span>
                    @if($isExternal)
                      <i class="bi bi-box-arrow-up-right ms-auto text-muted" style="font-size: 10px;" title="Buka website prodi"></i>
                    @endif
                  </a>
                </li>
              @endforeach
            @else
              <li><a class="dropdown-item dropdown-item-custom" href="#"><i class="bi bi-mortarboard-fill"></i> Fakultas & Program Studi</a></li>
            @endif
          </ul>
        </li>
        @endif

        <!-- Kemahasiswaan Dropdown -->
        @if($ns->show_kemahasiswaan)
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.prestasi*') || request()->routeIs('homepage.organisasi*') || request()->routeIs('homepage.galeri*') || request()->routeIs('homepage.testimoni*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $ns->menu_kemahasiswaan_label }} <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.prestasi*') ? 'active' : '' }}" href="{{ route('homepage.prestasi') }}"><i class="bi bi-trophy-fill text-warning"></i> Prestasi Mahasiswa</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.organisasi*') ? 'active' : '' }}" href="{{ route('homepage.organisasi') }}"><i class="bi bi-people-fill text-success"></i> Organisasi & Ormawa</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.galeri*') ? 'active' : '' }}" href="{{ route('homepage.galeri') }}"><i class="bi bi-camera"></i> Galeri Dokumentasi</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.testimoni*') ? 'active' : '' }}" href="{{ route('homepage.testimoni') }}"><i class="bi bi-mortarboard"></i> Alumni & Testimoni</a></li>
          </ul>
        </li>
        @endif

        <!-- Publikasi Dropdown -->
        @if($ns->show_publikasi)
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $ns->menu_publikasi_label }} <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            @if(isset($navPublikasis) && $navPublikasis->count() > 0)
              @foreach($navPublikasis as $navPub)
                @php
                  $rawLink = trim($navPub->link ?? '');
                  if (!empty($rawLink) && !str_starts_with($rawLink, 'http://') && !str_starts_with($rawLink, 'https://') && !str_starts_with($rawLink, '/') && !str_starts_with($rawLink, '#')) {
                      $rawLink = 'https://' . $rawLink;
                  }
                  $hasLink = !empty($rawLink);
                  $pubHref = $hasLink ? $rawLink : '#';
                  $isExternal = $hasLink && (str_starts_with($rawLink, 'http://') || str_starts_with($rawLink, 'https://'));
                @endphp
                <li>
                  <a class="dropdown-item dropdown-item-custom"
                     href="{{ $pubHref }}"
                     @if($isExternal) target="_blank" rel="noopener noreferrer" @endif
                     title="{{ $navPub->deskripsi ?: $navPub->judul }}">
                    <i class="bi {{ $navPub->icon ?: 'bi-journal-richtext' }}" style="color: var(--uis-green);"></i>
                    <span>{{ $navPub->judul }}</span>
                    @if($isExternal)
                      <i class="bi bi-box-arrow-up-right ms-auto text-muted" style="font-size: 10px;" title="Buka website"></i>
                    @endif
                  </a>
                </li>
              @endforeach
            @else
              <li><a class="dropdown-item dropdown-item-custom" href="https://journal.uis.ac.id/" target="_blank"><i class="bi bi-journal-richtext" style="color: var(--uis-green);"></i> <span>E-Journal UIS</span></a></li>
            @endif
          </ul>
        </li>
        @endif

        <!-- Informasi Dropdown -->
        @if($ns->show_informasi)
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.news*') || request()->routeIs('homepage.faq') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ $ns->menu_informasi_label }} <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news.category', 'berita-universitas') }}"><i class="bi bi-newspaper"></i> Berita Kampus</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news.category', 'pengumuman-agenda') }}"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news.category', 'agenda') }}"><i class="bi bi-calendar-event"></i> Agenda</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news') }}"><i class="bi bi-card-text"></i> Artikel</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.faq') }}"><i class="bi bi-question-circle"></i> FAQ Informasi</a></li>
          </ul>
        </li>
        @endif

        <!-- Kontak -->
        @if($ns->show_kontak)
        <li class="nav-item">
          <a href="{{ route('homepage.kontak') }}" class="nav-link nav-link-custom {{ request()->routeIs('homepage.kontak') ? 'active' : '' }}">{{ $ns->menu_kontak_label }}</a>
        </li>
        @endif

        <!-- Pilih Bahasa Dropdown -->
        @if($ns->show_lang_btn && isset($bahasaList) && $bahasaList->count() > 0)
        <li class="nav-item dropdown uis-lang-nav-item">
          <a class="nav-link nav-link-custom dropdown-toggle uis-lang-toggle" 
             href="#" 
             role="button" 
             data-bs-toggle="dropdown" 
             aria-expanded="false" 
             id="dropdownLangSelect" 
             title="Pilih Bahasa / Select Language">
            <img src="{{ $defaultBahasa?->flag_url ?? asset('assets/img/flags/id.png') }}" 
                 id="uisCurrentFlagImg" 
                 alt="Bendera" 
                 class="uis-flag-img-main" 
                 width="22" 
                 height="15"
                 onerror="this.onerror=null; this.src='{{ asset('assets/img/flags/id.png') }}';">
            <span class="uis-lang-name d-none d-xxl-inline" id="uisCurrentName">{{ $defaultBahasa->nama ?? 'Bahasa Indonesia' }}</span>
            <span class="uis-lang-name d-inline d-xxl-none" id="uisCurrentShort">{{ $defaultBahasa ? (str_contains($defaultBahasa->nama, ' ') ? explode(' ', $defaultBahasa->nama)[1] ?? $defaultBahasa->nama : $defaultBahasa->nama) : 'Indonesia' }}</span>
            <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom dropdown-menu-end uis-lang-menu shadow-lg" aria-labelledby="dropdownLangSelect">
            <li class="px-3 py-1 dropdown-header text-muted text-uppercase fw-bold" style="font-size: 10px; letter-spacing: 0.5px;">
              <i class="bi bi-translate me-1"></i> Select Language
            </li>
            @foreach($bahasaList as $lang)
              <li>
                <a class="dropdown-item dropdown-item-custom uis-lang-item justify-content-between" 
                   href="javascript:void(0)" 
                   onclick="uisChangeLanguage('{{ $lang->kode }}', '{{ addslashes($lang->nama) }}', '{{ $lang->flag_url }}')"
                   data-code="{{ $lang->kode }}"
                   data-name="{{ $lang->nama }}"
                   data-flag="{{ $lang->flag_url }}">
                  <span class="d-flex align-items-center gap-2">
                    <img src="{{ $lang->flag_url }}" 
                         alt="{{ $lang->nama }}" 
                         class="uis-flag-img" 
                         width="22" 
                         height="15"
                         onerror="this.onerror=null; this.src='{{ asset('assets/img/flags/id.png') }}';">
                    <span class="uis-lang-text">{{ $lang->nama }}</span>
                  </span>
                  <i class="bi bi-check2 text-success fw-bold uis-check-icon {{ ($lang->is_default) ? '' : 'd-none' }}" id="check-lang-{{ $lang->kode }}"></i>
                </a>
              </li>
            @endforeach
          </ul>
        </li>
        @endif
      </ul>

      <!-- CTA Buttons -->
      @if($ns->show_pmb_btn || $ns->show_login_btn)
      <div class="d-flex align-items-center gap-2 mt-3 mt-xl-0">
        @if($ns->show_pmb_btn)
          @php
            $pmbNavUrl = !empty($ns->pmb_btn_url)
                ? trim($ns->pmb_btn_url)
                : ($pmbSetting->tombol_link_1 ?? route('homepage.kontak'));
            if (!str_starts_with($pmbNavUrl, 'http') && !str_starts_with($pmbNavUrl, '/')) {
                $pmbNavUrl = '/' . $pmbNavUrl;
            }
            $pmbNavTarget = str_starts_with($pmbNavUrl, 'http') ? '_blank' : '_self';
          @endphp
          <a href="{{ $pmbNavUrl }}" target="{{ $pmbNavTarget }}" class="btn-pmb-nav" title="Penerimaan Mahasiswa Baru">
            <i class="bi bi-pencil-square"></i>
            <span>{{ $ns->pmb_btn_label }}</span>
          </a>
        @endif
        @if($ns->show_login_btn)
          <a href="{{ route('login') }}" class="btn-portal-nav" title="Login">
            <i class="bi bi-box-arrow-in-right"></i>
            <span>{{ $ns->login_btn_label }}</span>
          </a>
        @endif
      </div>
      @endif
    </div>
  </div>
</nav>
