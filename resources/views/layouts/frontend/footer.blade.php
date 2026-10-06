<!-- ═══════════════════════════════════════════════
     FOOTER — UNIVERSITAS IBNU SINA (UIS)
═══════════════════════════════════════════════ -->
<footer class="footer-main">
  <div class="container">
    <div class="row g-5">
      <!-- Brand -->
      <div class="col-lg-4">
        <a href="{{ route('homepage') }}" class="footer-logo mb-3 d-inline-block">
          <img src="{{ asset('assets/img/logouis.png') }}" alt="Logo Universitas Ibnu Sina" style="height: 52px; width: auto; object-fit: contain;">
        </a>
        <p class="footer-desc">
          Universitas Ibnu Sina (UIS) Batam — Kampusnya Profesional Muda. Berkomitmen menyelenggarakan pendidikan tinggi unggul, bermartabat, bereputasi nasional dan internasional serta berjiwa entrepreneur berbasis Imtaq.
        </p>
        <div class="footer-social">
          <a href="https://www.instagram.com/universitasibnusina/" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>
          <a href="https://www.facebook.com/universitasibnusina/" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
          <a href="https://wa.me/6281234567890" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i></a>
          <a href="https://www.youtube.com/@universitasibnusinabatam" target="_blank" rel="noopener"><i class="bi bi-youtube"></i></a>
        </div>
      </div>

      <!-- Links -->
      <div class="col-6 col-lg-2">
        <div class="footer-heading">Navigasi</div>
        <ul class="footer-links">
          <li><a href="{{ route('homepage') }}"><i class="bi bi-chevron-right"></i> Beranda</a></li>
          <li><a href="{{ route('homepage.layanan') }}"><i class="bi bi-chevron-right"></i> Program Studi</a></li>
          <li><a href="{{ route('homepage.galeri') }}"><i class="bi bi-chevron-right"></i> Galeri Kegiatan</a></li>
          <li><a href="{{ route('homepage.news') }}"><i class="bi bi-chevron-right"></i> Berita Kampus</a></li>
          <li><a href="{{ route('homepage.tentang') }}"><i class="bi bi-chevron-right"></i> Tentang UIS</a></li>
          <li><a href="{{ route('homepage.kontak') }}"><i class="bi bi-chevron-right"></i> Hubungi Kami</a></li>
        </ul>
      </div>

      <!-- Akademik Info -->
      <div class="col-6 col-lg-2">
        <div class="footer-heading">Akademik</div>
        <ul class="footer-links">
          <li><a href="{{ route('homepage.visi-misi') }}"><i class="bi bi-chevron-right"></i> Visi & Misi</a></li>
          <li><a href="{{ route('homepage.sambutan-dekan') }}"><i class="bi bi-chevron-right"></i> Sambutan Rektor</a></li>
          <li><a href="{{ route('homepage.struktur-organisasi') }}"><i class="bi bi-chevron-right"></i> Struktur Organisasi</a></li>
          <li><a href="{{ route('homepage.testimoni') }}"><i class="bi bi-chevron-right"></i> Alumni & Testimoni</a></li>
          <li><a href="{{ route('homepage.faq') }}"><i class="bi bi-chevron-right"></i> Tanya Jawab (FAQ)</a></li>
        </ul>
      </div>

      <!-- Contact -->
      <div class="col-lg-4">
        <div class="footer-heading">Kontak Kampus</div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-geo-alt"></i></div>
          <div class="footer-contact-text">
            <strong>Alamat Kampus</strong>
            {{ $contact->alamat ?? 'Jalan Teuku Umar, Lubuk Baja Kota, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29432' }}
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-telephone"></i></div>
          <div class="footer-contact-text">
            <strong>Telepon / WhatsApp</strong>
            {{ $contact->no_wa ?? '(0778) 408 3113' }}
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-envelope"></i></div>
          <div class="footer-contact-text">
            <strong>Email Resmi</strong>
            {{ $contact->email ?? 'info@uis.ac.id' }}
          </div>
        </div>
        <div class="footer-contact-item">
          <div class="footer-contact-icon"><i class="bi bi-clock"></i></div>
          <div class="footer-contact-text">
            <strong>Jam Operasional</strong>
            Senin – Sabtu: 08.00 – 17.00 WIB
          </div>
        </div>
      </div>
    </div>

    <div class="footer-divider"></div>

    <div class="d-flex flex-column flex-md-row align-items-center justify-content-between gap-3 footer-bottom">
      <span>© {{ date('Y') }} Universitas Ibnu Sina (UIS). All rights reserved.</span>
      <div class="d-flex gap-3">
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Syarat & Ketentuan</a>
        <a href="{{ route('login') }}" style="color:var(--uis-yellow);">Portal Admin</a>
      </div>
    </div>
  </div>
</footer>
