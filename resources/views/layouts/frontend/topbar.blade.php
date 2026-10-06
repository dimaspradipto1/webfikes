<!-- ═══════════════════════════════════════════════
     TOPBAR BILAH ATAS — UNIVERSITAS IBNU SINA (UIS)
═══════════════════════════════════════════════ -->
@php
  $topbar = $topbarSetting;
  $badgeText = $topbar?->badge_text ?? 'UNIVERSITAS IBNU SINA';
  if ($badgeText === 'Universitas Ibnu Sina' || $badgeText === 'UIS') {
      $badgeText = 'UNIVERSITAS IBNU SINA';
  }
  $badgeIcon = $topbar?->badge_icon ?: 'bi-award-fill';
  $alamatText = $topbar?->alamat ?? $contact?->alamat ?? 'Jl. Teuku Umar, Lubuk Baja Kota, Kec. Lubuk Baja, Kota Batam, Kepulauan Riau 29444';
  $jamOperasional = $topbar?->jam_operasional ?? 'Senin - Sabtu: 08.00 - 17.00 WIB';
  $telpWa = $topbar?->telepon ?? $contact?->no_wa ?? '08123456789';
  $emailText = $topbar?->email ?? $contact?->email ?? 'humas@uis.ac.id';
  $socialMediaList = is_array($topbar?->social_media) && count($topbar->social_media) > 0
    ? $topbar->social_media
    : [
        ['platform' => 'Instagram', 'icon' => 'bi-instagram', 'url' => 'https://instagram.com'],
        ['platform' => 'YouTube', 'icon' => 'bi-youtube', 'url' => 'https://youtube.com'],
      ];
@endphp

@if(!isset($topbar) || $topbar->is_active)
<div class="topbar-main d-none d-lg-block">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <div class="d-flex align-items-center gap-4">
        <span class="topbar-badge"><i class="bi {{ $badgeIcon }}"></i> {{ $badgeText }}</span>
        @if(!empty($alamatText))
          <span><i class="bi bi-geo-alt me-1" style="color:var(--uis-yellow);"></i> {{ $alamatText }}</span>
        @endif
        @if(!empty($jamOperasional))
          <span><i class="bi bi-clock me-1" style="color:var(--uis-yellow);"></i> {{ $jamOperasional }}</span>
        @endif
      </div>
      <div class="d-flex align-items-center gap-3">
        <!-- Dynamic Social Media -->
        @foreach($socialMediaList as $sosmed)
          @if(!empty($sosmed['url']))
            <a href="{{ $sosmed['url'] }}" target="_blank" title="{{ $sosmed['platform'] ?? 'Media Sosial' }}" class="text-white-50">
              <i class="bi {{ !empty($sosmed['icon']) ? $sosmed['icon'] : 'bi-globe' }}"></i>
            </a>
          @endif
        @endforeach

        @if(!empty($telpWa) || !empty($emailText))
          <span style="opacity:0.25; color:white;">|</span>
        @endif

        @if(!empty($telpWa))
          <a href="https://wa.me/{{ $cleanWa }}" target="_blank"><i class="bi bi-whatsapp me-1 text-success"></i> {{ $telpWa }}</a>
        @endif
        @if(!empty($emailText))
          <a href="mailto:{{ $emailText }}"><i class="bi bi-envelope me-1" style="color:var(--uis-yellow);"></i> {{ $emailText }}</a>
        @endif
      </div>
    </div>
  </div>
</div>
@endif
