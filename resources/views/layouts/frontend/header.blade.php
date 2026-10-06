<!-- ═══════════════════════════════════════════════
     NAVBAR HEADER UTAMA — UNIVERSITAS IBNU SINA (UIS)
═══════════════════════════════════════════════ -->
<nav class="navbar navbar-expand-xl navbar-main">
  <div class="container-fluid px-lg-4 px-xl-5">
    <!-- Logo UIS -->
    <a class="navbar-brand navbar-brand-custom me-2 me-xl-4" href="{{ route('homepage') }}">
      <img src="{{ asset('assets/img/logouis.png') }}" alt="Logo Universitas Ibnu Sina" class="brand-logo-img">
    </a>

    <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMain" aria-controls="navMain" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navMain">
      <ul class="navbar-nav mx-auto gap-1 align-items-center">
        <!-- Beranda -->
        <li class="nav-item">
          <a href="{{ route('homepage') }}" class="nav-link nav-link-custom {{ request()->routeIs('homepage') ? 'active' : '' }}">Beranda</a>
        </li>

        <!-- Profil Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.tentang') || request()->routeIs('homepage.sambutan*') || request()->routeIs('homepage.visi-misi') || request()->routeIs('homepage.struktur-organisasi') || request()->routeIs('homepage.sejarah') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Profil <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.tentang') ? 'active' : '' }}" href="{{ route('homepage.tentang') }}"><i class="bi bi-building"></i> Tentang Universitas</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.visi-misi') ? 'active' : '' }}" href="{{ route('homepage.visi-misi') }}"><i class="bi bi-bullseye"></i> Visi & Misi</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.sambutan*') ? 'active' : '' }}" href="{{ route('homepage.sambutan-rektor') }}"><i class="bi bi-person-badge"></i> Sambutan Rektor</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.struktur-organisasi') ? 'active' : '' }}" href="{{ route('homepage.struktur-organisasi') }}"><i class="bi bi-diagram-3"></i> Struktur Organisasi</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.sejarah') ? 'active' : '' }}" href="{{ route('homepage.sejarah') }}"><i class="bi bi-hourglass-split"></i> Sejarah Universitas</a></li>
          </ul>
        </li>

        <!-- Akademik Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.kurikulum*') || request()->routeIs('homepage.kalender-akademik') || request()->routeIs('homepage.pedoman-akademik') || request()->routeIs('homepage.sistem-akademik') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Akademik <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            <!-- Kurikulum UIS with Submenu -->
            <li class="dropdown-submenu">
              <a class="dropdown-item dropdown-item-custom d-flex justify-content-between align-items-center {{ request()->routeIs('homepage.kurikulum*') ? 'active' : '' }}" href="{{ route('homepage.kurikulum') }}">
                <span><i class="bi bi-journal-text me-1"></i> Kurikulum Akademik</span>
                <i class="bi bi-chevron-right ms-2 d-none d-xl-inline" style="font-size: 10px;"></i>
              </a>
              <ul class="dropdown-menu dropdown-menu-custom" style="min-width: 270px;">
                @if(isset($navProdis) && $navProdis->count() > 0)
                  @foreach($navProdis as $np)
                    <li>
                      <a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.kurikulum', ['prodi' => $np->id]) }}">
                        <i class="bi bi-mortarboard-fill text-warning"></i> {{ $np->judul }}
                      </a>
                    </li>
                  @endforeach
                @else
                  <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.kurikulum') }}"><i class="bi bi-mortarboard"></i> Semua Kurikulum Prodi</a></li>
                @endif
              </ul>
            </li>

            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.kalender-akademik') ? 'active' : '' }}" href="{{ route('homepage.kalender-akademik') }}"><i class="bi bi-calendar-check"></i> Kalender Akademik</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.pedoman-akademik') ? 'active' : '' }}" href="{{ route('homepage.pedoman-akademik') }}"><i class="bi bi-book"></i> Pedoman Akademik</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.sistem-akademik') ? 'active' : '' }}" href="{{ route('homepage.sistem-akademik') }}"><i class="bi bi-laptop"></i> Sistem Akademik</a></li>
          </ul>
        </li>

        <!-- Program Studi Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.layanan*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Program Studi <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
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
                  $prodiHref = $hasLink ? $rawLink : route('homepage.layanan.detail', $navProdi->id);
                  $isExternal = $hasLink && (str_starts_with($rawLink, 'http://') || str_starts_with($rawLink, 'https://'));
                @endphp
                <li>
                  <a class="dropdown-item dropdown-item-custom"
                     href="{{ $prodiHref }}"
                     @if($isExternal) target="_blank" rel="noopener noreferrer" @endif>
                    <i class="bi {{ $navProdi->icon ?: 'bi-mortarboard-fill' }}"></i>
                    <span>{{ $navProdi->judul }}</span>
                    @if($isExternal)
                      <i class="bi bi-box-arrow-up-right ms-auto text-muted" style="font-size: 10px;" title="Buka website prodi"></i>
                    @endif
                  </a>
                </li>
              @endforeach

              <li><hr class="dropdown-divider my-1"></li>
              <li>
                <a class="dropdown-item dropdown-item-custom fw-semibold" href="{{ route('homepage.layanan') }}" style="color: var(--uis-green);">
                  <i class="bi bi-grid-fill" style="color: var(--uis-green);"></i>
                  <span>Semua Program & Fasilitas</span>
                  <i class="bi bi-arrow-right ms-auto" style="font-size: 11px;"></i>
                </a>
              </li>
            @else
              <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.layanan') }}"><i class="bi bi-mortarboard-fill"></i> Fakultas & Program Studi</a></li>
            @endif
          </ul>
        </li>

        <!-- Kemahasiswaan Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.prestasi*') || request()->routeIs('homepage.organisasi*') || request()->routeIs('homepage.galeri*') || request()->routeIs('homepage.testimoni*') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Kemahasiswaan <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.prestasi*') ? 'active' : '' }}" href="{{ route('homepage.prestasi') }}"><i class="bi bi-trophy-fill text-warning"></i> Prestasi Mahasiswa</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.organisasi*') ? 'active' : '' }}" href="{{ route('homepage.organisasi') }}"><i class="bi bi-people-fill text-success"></i> Organisasi & Ormawa</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.galeri*') ? 'active' : '' }}" href="{{ route('homepage.galeri') }}"><i class="bi bi-camera"></i> Galeri Dokumentasi</a></li>
            <li><a class="dropdown-item dropdown-item-custom {{ request()->routeIs('homepage.testimoni*') ? 'active' : '' }}" href="{{ route('homepage.testimoni') }}"><i class="bi bi-mortarboard"></i> Alumni & Testimoni</a></li>
          </ul>
        </li>

        <!-- Penelitian & Pengabdian Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Penelitian & Pengabdian <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news') }}"><i class="bi bi-file-earmark-medical"></i> Penelitian Dosen</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news') }}"><i class="bi bi-journal-richtext"></i> Publikasi Ilmiah</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.galeri') }}"><i class="bi bi-heart-pulse"></i> Pengabdian Masyarakat</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.layanan') }}"><i class="bi bi-briefcase"></i> Kerja Sama Riset</a></li>
          </ul>
        </li>

        <!-- Informasi Dropdown -->
        <li class="nav-item dropdown">
          <a class="nav-link nav-link-custom dropdown-toggle {{ request()->routeIs('homepage.news*') || request()->routeIs('homepage.faq') ? 'active' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Informasi <i class="bi bi-chevron-down ms-1" style="font-size: 10px;"></i>
          </a>
          <ul class="dropdown-menu dropdown-menu-custom">
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news', ['category' => 'Berita Universitas']) }}"><i class="bi bi-newspaper"></i> Berita Kampus</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news', ['category' => 'Pengumuman & Agenda']) }}"><i class="bi bi-megaphone"></i> Pengumuman</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news', ['category' => 'Pengumuman & Agenda']) }}"><i class="bi bi-calendar-event"></i> Agenda</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.news') }}"><i class="bi bi-card-text"></i> Artikel</a></li>
            <li><a class="dropdown-item dropdown-item-custom" href="{{ route('homepage.faq') }}"><i class="bi bi-question-circle"></i> FAQ Informasi</a></li>
          </ul>
        </li>

        <!-- Kontak -->
        <li class="nav-item">
          <a href="{{ route('homepage.kontak') }}" class="nav-link nav-link-custom {{ request()->routeIs('homepage.kontak') ? 'active' : '' }}">Kontak</a>
        </li>
      </ul>

      <!-- CTA Buttons -->
      <div class="d-flex align-items-center gap-2 mt-3 mt-xl-0">
        @php
          $pmbNavUrl = $pmbSetting->tombol_link_1 ?? route('homepage.kontak');
          if (!str_starts_with($pmbNavUrl, 'http') && !str_starts_with($pmbNavUrl, '/')) {
              $pmbNavUrl = '/' . $pmbNavUrl;
          }
          $pmbNavTarget = str_starts_with($pmbNavUrl, 'http') ? '_blank' : '_self';
        @endphp
        <a href="{{ $pmbNavUrl }}" target="{{ $pmbNavTarget }}" class="btn-pmb-nav" title="Penerimaan Mahasiswa Baru">
          <i class="bi bi-pencil-square"></i>
          <span>PMB</span>
        </a>
        <a href="{{ route('login') }}" class="btn-portal-nav" title="Login">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </div>
    </div>
  </div>
</nav>
