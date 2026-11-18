<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>

@if (\Request::is('rtl'))
<html dir="rtl" lang="ar">
@else
<html lang="en">
@endif

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  @if (env('IS_DEMO'))
  <x-demo-metas></x-demo-metas>
  @endif

  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Soft UI Dashboard by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&family=Open+Sans:300,400,600,700&display=swap" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons (Official CDN & Reliable Fallbacks) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css?v=1.0.3') }}" rel="stylesheet" />

  <!-- TAMBAHKAN BARIS INI UNTUK TEMA GELAP -->
  <link href="{{ asset('css/custom-dark.css') }}" rel="stylesheet" />

  {{-- Inisialisasi Tema Dinamis Agrovia (Head execution, zero-flash) --}}
  <style id="agrovia-theme-override"></style>
  <script>
    window.agroviaThemes = {
      purple: {
        name: 'Ungu Neon',
        primary: '#b844f7',
        light: '#d580ff',
        dark: '#8b2fd4',
        glow: 'rgba(184, 68, 247, 0.55)',
        glowSoft: 'rgba(184, 68, 247, 0.22)',
        border: 'rgba(184, 68, 247, 0.35)'
      },
      green: {
        name: 'Hijau Sawit',
        primary: '#22c55e',
        light: '#86efac',
        dark: '#15803d',
        glow: 'rgba(34, 197, 94, 0.55)',
        glowSoft: 'rgba(34, 197, 94, 0.22)',
        border: 'rgba(34, 197, 94, 0.35)'
      },
      cyan: {
        name: 'Cyan Cyber',
        primary: '#06b6d4',
        light: '#67e8f9',
        dark: '#0e7490',
        glow: 'rgba(6, 182, 212, 0.55)',
        glowSoft: 'rgba(6, 182, 212, 0.22)',
        border: 'rgba(6, 182, 212, 0.35)'
      },
      gold: {
        name: 'Emas Panen',
        primary: '#f59e0b',
        light: '#fde68a',
        dark: '#b45309',
        glow: 'rgba(245, 158, 11, 0.55)',
        glowSoft: 'rgba(245, 158, 11, 0.22)',
        border: 'rgba(245, 158, 11, 0.35)'
      },
      rose: {
        name: 'Ruby Merah',
        primary: '#f43f5e',
        light: '#fda4af',
        dark: '#be123c',
        glow: 'rgba(244, 63, 94, 0.55)',
        glowSoft: 'rgba(244, 63, 94, 0.22)',
        border: 'rgba(244, 63, 94, 0.35)'
      },
      pink: {
        name: 'Neon Pink',
        primary: '#ec4899',
        light: '#f472b6',
        dark: '#be185d',
        glow: 'rgba(236, 72, 153, 0.55)',
        glowSoft: 'rgba(236, 72, 153, 0.22)',
        border: 'rgba(236, 72, 153, 0.35)'
      }
    };

    window.setAgroviaTheme = function(themeKey, btnEl) {
      const p = window.agroviaThemes[themeKey] || window.agroviaThemes.purple;
      
      // 1. Set CSS Variables pada :root & body
      const root = document.documentElement;
      root.style.setProperty('--neon-purple', p.primary);
      root.style.setProperty('--neon-purple-light', p.light);
      root.style.setProperty('--neon-purple-dark', p.dark);
      root.style.setProperty('--neon-glow', p.glow);
      root.style.setProperty('--neon-glow-soft', p.glowSoft);
      root.style.setProperty('--border-subtle', p.border);

      // 2. Inject high-impact CSS override langsung
      let styleTag = document.getElementById('agrovia-theme-override');
      if (!styleTag) {
        styleTag = document.createElement('style');
        styleTag.id = 'agrovia-theme-override';
        document.head.appendChild(styleTag);
      }
      styleTag.textContent = `
        /* Sidebar Active & Indicators */
        .nav-button-block.active {
          background: linear-gradient(135deg, ${p.glowSoft}, rgba(255, 255, 255, 0.05)) !important;
          border-color: ${p.primary} !important;
          box-shadow: 0 4px 20px ${p.glowSoft}, inset 0 0 14px ${p.glowSoft} !important;
        }
        .nav-active-pill {
          background: linear-gradient(180deg, ${p.primary}, ${p.light}) !important;
          box-shadow: 0 0 10px ${p.primary}, 0 0 20px ${p.glow} !important;
        }
        .nav-button-block.active .nav-icon-square {
          background: linear-gradient(135deg, ${p.dark}, ${p.primary}) !important;
          box-shadow: 0 0 14px ${p.glow} !important;
          border-color: ${p.primary} !important;
        }
        .brand-logo-container {
          box-shadow: 0 0 16px ${p.glowSoft} !important;
          border-color: ${p.border} !important;
        }
        .user-avatar-pill, .navbar-avatar-circle {
          background: linear-gradient(135deg, ${p.dark}, ${p.primary}) !important;
          box-shadow: 0 0 12px ${p.glow} !important;
        }
        /* Video Background Ambient Light */
        .video-bg-overlay {
          background: 
            radial-gradient(ellipse 65% 50% at 15% 10%, ${p.glow} 0%, transparent 60%),
            radial-gradient(ellipse 55% 40% at 85% 90%, ${p.glowSoft} 0%, transparent 55%),
            linear-gradient(180deg, rgba(11, 12, 22, 0.55) 0%, rgba(11, 12, 22, 0.78) 100%) !important;
        }
        /* Cards & Accents */
        .card, .glass-card {
          border-color: ${p.border} !important;
        }
        .card:hover, .glass-card:hover {
          box-shadow: 0 8px 32px rgba(0,0,0,0.45), 0 0 18px ${p.glowSoft} !important;
          border-color: ${p.primary} !important;
        }
        .card-header h6::after {
          background: linear-gradient(90deg, ${p.primary}, ${p.light}) !important;
          box-shadow: 0 0 10px ${p.glow} !important;
        }
        /* Tables */
        .table thead th {
          color: ${p.light} !important;
          border-bottom-color: ${p.border} !important;
        }
        .table tbody tr:hover td {
          background: ${p.glowSoft} !important;
        }
        /* Navbar & Focus */
        .navbar-search-box:focus-within, .navbar-search-wrap:focus-within {
          border-color: ${p.primary} !important;
          box-shadow: 0 0 14px ${p.glowSoft} !important;
        }
        .form-control:focus, .form-select:focus {
          border-color: ${p.primary} !important;
          box-shadow: 0 0 0 3px ${p.glowSoft}, 0 0 14px ${p.glowSoft} !important;
        }
        /* Dashboard Stat Cards Accent */
        .stat-purple, .stat-card:first-child {
          border-color: ${p.primary} !important;
        }
        .glow-purple, .stat-card:first-child .stat-card-glow {
          background: ${p.primary} !important;
        }
        .bg-purple, .stat-card:first-child .stat-icon {
          background: linear-gradient(135deg, ${p.dark}, ${p.primary}) !important;
          box-shadow: 0 4px 14px ${p.glow} !important;
        }
        .text-purple {
          color: ${p.light} !important;
        }
        .badge-pill {
          background: ${p.glowSoft} !important;
          color: ${p.light} !important;
          border-color: ${p.border} !important;
        }
        .legend-dot.bg-purple {
          background: ${p.primary} !important;
        }
        .fc-purple:hover {
          box-shadow: 0 10px 40px ${p.glowSoft} !important;
          border-color: ${p.primary} !important;
        }
        .fc-purple .fc-glow {
          background: ${p.primary} !important;
        }
        .fc-purple .fc-icon {
          background: linear-gradient(135deg, ${p.dark}, ${p.primary}) !important;
          box-shadow: 0 4px 14px ${p.glow} !important;
        }
        .ql-purple:hover {
          border-color: ${p.primary} !important;
          background: ${p.glowSoft} !important;
        }
        .ql-purple .ql-icon {
          background: ${p.glowSoft} !important;
          color: ${p.light} !important;
        }
        /* Configurator Highlights */
        .fixed-plugin .fixed-plugin-button {
          border-color: ${p.primary} !important;
          box-shadow: 0 0 16px ${p.glow} !important;
        }
        .theme-color-btn.active {
          border-color: ${p.primary} !important;
          box-shadow: 0 0 16px ${p.glow} !important;
        }
        .btn-dim.active {
          background: ${p.primary} !important;
          box-shadow: 0 0 10px ${p.glowSoft} !important;
        }
        ::-webkit-scrollbar-thumb {
          background: ${p.glow} !important;
        }
        ::-webkit-scrollbar-thumb:hover {
          background: ${p.primary} !important;
        }
      `;

      // 3. Simpan ke LocalStorage
      localStorage.setItem('agrovia_accent_theme', themeKey);

      // 4. Update UI Tombol di Fixed Plugin Drawer
      document.querySelectorAll('.theme-color-btn').forEach(b => b.classList.remove('active'));
      const activeBtn = btnEl || document.querySelector(`.theme-color-btn[data-theme="${themeKey}"]`);
      if (activeBtn) activeBtn.classList.add('active');

      // 5. Broadcast Event agar Grafik ChartJS ikut berganti
      window.dispatchEvent(new CustomEvent('agrovia-theme-change', {
        detail: { themeKey: themeKey, preset: p }
      }));
    };

    window.setBgDim = function(dimValue, btnEl) {
      const media = document.querySelector('.video-bg-media');
      if (media) {
        media.style.filter = `brightness(${dimValue}) contrast(1.15) saturate(1.2)`;
      }
      localStorage.setItem('agrovia_bg_dim', dimValue);
      document.querySelectorAll('.btn-dim').forEach(b => b.classList.remove('active'));
      const activeBtn = btnEl || document.querySelector(`.btn-dim[data-dim="${dimValue}"]`);
      if (activeBtn) activeBtn.classList.add('active');
    };

    window.resetAgroviaTheme = function() {
      localStorage.removeItem('agrovia_accent_theme');
      localStorage.removeItem('agrovia_bg_dim');
      window.setAgroviaTheme('purple');
      window.setBgDim('0.65');
    };

    // Eksekusi segera sebelum render agar tidak kedip (instant)
    (function() {
      const savedTheme = localStorage.getItem('agrovia_accent_theme') || 'purple';
      window.setAgroviaTheme(savedTheme);
    })();
  </script>

  @stack('css')
</head>


<body class="g-sidenav-show bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
  {{-- Video Background Animasi --}}
  <div class="video-bg-container">
    <video autoplay muted loop playsinline class="video-bg-media">
      <source src="{{ asset('assets/video/bg-animation.mp4') }}" type="video/mp4">
    </video>
    <div class="video-bg-overlay"></div>
  </div>

  @auth
  @yield('auth')
  @endauth
  @guest
  @yield('guest')
  @endguest

  @if(session()->has('success'))
  <div x-data="{ show: true}"
    x-init="setTimeout(() => show = false, 4000)"
    x-show="show"
    class="position-fixed bg-success rounded right-3 text-sm py-2 px-4">
    <p class="m-0">{{ session('success')}}</p>
  </div>
  @endif
  <!--   Core JS Files   -->
  <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/fullcalendar.min.js') }}"></script>
  <script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
  @stack('rtl')
  @stack('dashboard')
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('assets/js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
</body>

</html>