  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

      <ul class="sidebar-nav" id="sidebar-nav">

          <!-- 1. Beranda / Dashboard -->
          <li class="nav-item">
              <a class="nav-link {{ Route::is('dashboard') ? '' : 'collapsed' }}" href="{{ route('dashboard') }}">
                  <i class="bi bi-grid"></i>
                  <span>Dashboard</span>
              </a>
          </li><!-- End Dashboard Nav -->

          @php
              $currentUser = Auth::user();
              $isAdmin = $currentUser?->isAdmin();
              $isPenulis = $currentUser?->hasExactRole('penulis');
              $isOrganisasi = $currentUser?->hasExactRole('organisasi');
          @endphp

          @if($isAdmin)
          <!-- 2. Konten Beranda / Landing Page -->
          <li class="nav-item">
              <a class="nav-link {{ Route::is('banner.*') || Route::is('layanan-terkait.*') || Route::is('feature.*') || Route::is('sarana.*') || Route::is('tridharma.*') || Route::is('pmb-setting.*') || Route::is('faculty-stat.*') ? '' : 'collapsed' }}" data-bs-target="#beranda-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-layout-text-window-reverse"></i><span>Konten Beranda</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="beranda-nav" class="nav-content collapse {{ Route::is('banner.*') || Route::is('layanan-terkait.*') || Route::is('feature.*') || Route::is('sarana.*') || Route::is('tridharma.*') || Route::is('pmb-setting.*') || Route::is('faculty-stat.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('banner.index') }}" class="{{ Route::is('banner.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>Banner Hero</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('layanan-terkait.index') }}" class="{{ Route::is('layanan-terkait.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>Layanan Terkait</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('faculty-stat.index') }}" class="{{ Route::is('faculty-stat.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>Statistik Universitas</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('feature.index') }}" class="{{ Route::is('feature.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>Keunggulan Universitas</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('sarana.index') }}" class="{{ Route::is('sarana.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>Sarana Kampus</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('tridharma.index') }}" class="{{ Route::is('tridharma.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>Tri Dharma</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('pmb-setting.index') }}" class="{{ Route::is('pmb-setting.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>Banner PMB & Pendaftaran</span>
                      </a>
                  </li>
              </ul>
          </li>
          @endif

          @if($isAdmin)
          <!-- 3. Profil (Sesuai Urutan & Dropdown Header) -->
          <li class="nav-item">
            <a class="nav-link {{ Route::is('about.*') || Route::is('visimisi.*') || Route::is('sambutan-dekan.*') || Route::is('sambutan-rektor.*') || Route::is('struktur-organisasi.*') || Route::is('milestone.*') ? '' : 'collapsed' }}" data-bs-target="#profil-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-building"></i><span>Profil</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="profil-nav" class="nav-content collapse {{ Route::is('about.*') || Route::is('visimisi.*') || Route::is('sambutan-dekan.*') || Route::is('sambutan-rektor.*') || Route::is('struktur-organisasi.*') || Route::is('milestone.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
              <li>
                <a href="{{ route('about.index') }}" class="{{ Route::is('about.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Tentang UIS</span>
                </a>
              </li>
              <li>
                <a href="{{ route('visimisi.index') }}" class="{{ Route::is('visimisi.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Visi & Misi</span>
                </a>
              </li>
              <li>
                <a href="{{ route('sambutan-rektor.index') }}" class="{{ Route::is('sambutan-dekan.*') || Route::is('sambutan-rektor.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Sambutan Rektor</span>
                </a>
              </li>
              <li>
                <a href="{{ route('struktur-organisasi.index') }}" class="{{ Route::is('struktur-organisasi.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Struktur Organisasi</span>
                </a>
              </li>
              <li>
                <a href="{{ route('milestone.index') }}" class="{{ Route::is('milestone.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Sejarah Universitas</span>
                </a>
              </li>
            </ul>
          </li>

          <!-- 3. Akademik (Sesuai Urutan Header) -->
          <li class="nav-item">
            <a class="nav-link {{ Route::is('kurikulum.*') || Route::is('akademik.*') ? '' : 'collapsed' }}" data-bs-target="#akademik-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-book-half"></i><span>Akademik</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="akademik-nav" class="nav-content collapse {{ Route::is('kurikulum.*') || Route::is('akademik.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
              <li>
                <a href="{{ route('kurikulum.index') }}" class="{{ Route::is('kurikulum.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Kurikulum Program Studi</span>
                </a>
              </li>
              <li>
                <a href="{{ route('akademik.kalender') }}" class="{{ Route::is('akademik.kalender') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Kalender Akademik</span>
                </a>
              </li>
              <li>
                <a href="{{ route('akademik.pedoman') }}" class="{{ Route::is('akademik.pedoman') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Pedoman Akademik</span>
                </a>
              </li>
              <li>
                <a href="{{ route('akademik.sistem') }}" class="{{ Route::is('akademik.sistem') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Sistem Akademik</span>
                </a>
              </li>
            </ul>
          </li>

          <!-- 4. Program Studi (Sesuai Urutan Header) -->
          <li class="nav-item">
            <a class="nav-link {{ Route::is('layanan.*') ? '' : 'collapsed' }}" href="{{ route('layanan.index') }}">
              <i class="bi bi-mortarboard"></i><span>Program Studi</span>
            </a>
          </li>

          <!-- 5. Kemahasiswaan (Sesuai Urutan Header) -->
          <li class="nav-item">
            <a class="nav-link {{ Route::is('prestasi.*') || Route::is('organisasi-mahasiswa.*') || Route::is('gallery.*') || Route::is('testimonial.*') ? '' : 'collapsed' }}" data-bs-target="#kemahasiswaan-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-people"></i><span>Kemahasiswaan</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="kemahasiswaan-nav" class="nav-content collapse {{ Route::is('prestasi.*') || Route::is('organisasi-mahasiswa.*') || Route::is('gallery.*') || Route::is('testimonial.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
              <li>
                <a href="{{ route('prestasi.index') }}" class="{{ Route::is('prestasi.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Prestasi Mahasiswa</span>
                </a>
              </li>
              <li>
                <a href="{{ route('organisasi-mahasiswa.index') }}" class="{{ Route::is('organisasi-mahasiswa.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Organisasi Mahasiswa</span>
                </a>
              </li>
              <li>
                <a href="{{ route('gallery.index') }}" class="{{ Route::is('gallery.index') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Galeri Dokumentasi</span>
                </a>
              </li>
              <li>
                <a href="{{ route('gallery.create') }}" class="{{ Route::is('gallery.create') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Upload Dokumentasi</span>
                </a>
              </li>
              <li>
                <a href="{{ route('testimonial.index') }}" class="{{ Route::is('testimonial.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Alumni & Testimoni</span>
                </a>
              </li>
            </ul>
          </li>

          <!-- 6. Penelitian & Pengabdian (Sesuai Urutan Header) -->
          <li class="nav-item">
            <a class="nav-link {{ Route::is('partner.*') ? '' : 'collapsed' }}" data-bs-target="#penelitian-nav" data-bs-toggle="collapse" href="#">
              <i class="bi bi-file-earmark-medical"></i><span>Penelitian & Pengabdian</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="penelitian-nav" class="nav-content collapse {{ Route::is('partner.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
              <li>
                <a href="{{ route('partner.index') }}" class="{{ Route::is('partner.*') ? 'active' : '' }}">
                  <i class="bi bi-circle"></i><span>Mitra Kerjasama Riset</span>
                </a>
              </li>
            </ul>
          </li>
          @elseif($isOrganisasi)
          <!-- Menu Khusus Role Organisasi Mahasiswa -->
          <li class="nav-item">
            <a class="nav-link {{ Route::is('organisasi-mahasiswa.*') ? '' : 'collapsed' }}" href="{{ route('organisasi-mahasiswa.index') }}">
              <i class="bi bi-people-fill"></i><span>Organisasi Mahasiswa</span>
            </a>
          </li>
          @endif

          @if($isAdmin || $isPenulis)
          <!-- 7. Informasi (Berita & Pengumuman) -->
          <li class="nav-item">
              <a class="nav-link {{ Route::is('news.*') || Route::is('faq.*') ? '' : 'collapsed' }}" data-bs-target="#informasi-nav" data-bs-toggle="collapse" href="#">
                  <i class="bi bi-newspaper"></i><span>Informasi</span><i class="bi bi-chevron-down ms-auto"></i>
              </a>
              <ul id="informasi-nav" class="nav-content collapse {{ Route::is('news.*') || Route::is('faq.*') ? 'show' : '' }}" data-bs-parent="#sidebar-nav">
                  <li>
                      <a href="{{ route('news.index') }}" class="{{ Route::is('news.index') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>Semua Berita & Pengumuman</span>
                      </a>
                  </li>
                  <li>
                      <a href="{{ route('news.create') }}" class="{{ Route::is('news.create') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>Tulis Berita / Pengumuman</span>
                      </a>
                  </li>
                  @if($isAdmin)
                  <li>
                      <a href="{{ route('faq.index') }}" class="{{ Route::is('faq.*') ? 'active' : '' }}">
                          <i class="bi bi-circle"></i><span>FAQ Informasi</span>
                      </a>
                  </li>
                  @endif
              </ul>
          </li>
          @endif

          @if($isAdmin)
          <!-- 8. Kontak (Sesuai Urutan Header) -->
          <li class="nav-item">
              <a class="nav-link {{ Route::is('contact.*') ? '' : 'collapsed' }}" href="{{ route('contact.index') }}">
                  <i class="bi bi-telephone"></i>
                  <span>Kontak</span>
              </a>
          </li>
          @endif


          <li class="nav-heading">Pengaturan & Administrator</li>

          @if($isAdmin)
          <li class="nav-item">
              <a class="nav-link {{ Route::is('topbar.*') ? '' : 'collapsed' }}" href="{{ route('topbar.index') }}">
                  <i class="bi bi-layout-text-window-reverse"></i>
                  <span>Pengaturan Topbar</span>
              </a>
          </li>
          @endif

          <li class="nav-item">
              <a class="nav-link {{ Route::is('user.my-profile') || Route::is('profil.*') ? '' : 'collapsed' }}" href="{{ route('user.my-profile') }}">
                  <i class="bi bi-person"></i>
                  <span>Profil Akun</span>
              </a>
          </li>

          @if($isAdmin)
          <li class="nav-item">
              <a class="nav-link {{ Route::is('user.*') ? '' : 'collapsed' }}" href="{{ route('user.index') }}">
                  <i class="bi bi-people"></i>
                  <span>Manajemen Pengguna</span>
              </a>
          </li>
          @endif

      </ul>

  </aside>
