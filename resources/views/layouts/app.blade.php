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
        detail: {
          themeKey: themeKey,
          preset: p
        }
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

  <style>
    /* ── ANIMASI TRANSISI PER HALAMAN & EFEK KLIK AGROVIA ── */
    #agr-page-progress {
      position: fixed;
      top: 0;
      left: 0;
      height: 3px;
      width: 0%;
      z-index: 99999;
      background: linear-gradient(90deg, var(--neon-purple, #b844f7), #22c55e, #06b6d4);
      box-shadow: 0 0 12px var(--neon-glow, rgba(184, 68, 247, 0.7));
      opacity: 0;
      pointer-events: none;
      transition: width 0.28s cubic-bezier(0.22, 1, 0.36, 1), opacity 0.2s ease;
    }
    #agr-page-progress.active {
      opacity: 1;
      width: 82%;
    }

    @keyframes agrPageEnter {
      0% {
        opacity: 0;
        transform: translateY(14px) scale(0.992);
      }
      100% {
        opacity: 1;
        transform: none;
      }
    }

    @keyframes agrCardPop {
      0% {
        opacity: 0;
        transform: translateY(16px) scale(0.985);
      }
      100% {
        opacity: 1;
        transform: none;
      }
    }

    .main-content-inner {
      animation: agrPageEnter 0.38s cubic-bezier(0.22, 1, 0.36, 1) forwards;
      transition: opacity 0.2s ease, transform 0.2s ease, filter 0.2s ease;
    }

    .main-content-inner.agr-page-leaving {
      opacity: 0 !important;
      transform: translateY(-8px) scale(0.992) !important;
      filter: blur(2px);
      pointer-events: none;
    }

    .main-content-inner .dash-header,
    .main-content-inner .agr-table-card,
    .main-content-inner .card {
      animation: agrCardPop 0.42s cubic-bezier(0.22, 1, 0.36, 1) both;
    }

    .main-content-inner .stat-card:nth-child(1) { animation: agrCardPop 0.35s cubic-bezier(0.22, 1, 0.36, 1) 0.04s both; }
    .main-content-inner .stat-card:nth-child(2) { animation: agrCardPop 0.35s cubic-bezier(0.22, 1, 0.36, 1) 0.09s both; }
    .main-content-inner .stat-card:nth-child(3) { animation: agrCardPop 0.35s cubic-bezier(0.22, 1, 0.36, 1) 0.14s both; }
    .main-content-inner .stat-card:nth-child(4) { animation: agrCardPop 0.35s cubic-bezier(0.22, 1, 0.36, 1) 0.19s both; }

    /* Efek tekan & ripple saat menu / tombol dipencet */
    .nav-button-block,
    .agr-mail-tab,
    .btn-agrovia-add,
    .btn-dash-primary,
    .navbar-mail-btn {
      position: relative;
      overflow: hidden;
    }

    .nav-button-block:active,
    .agr-mail-tab:active,
    .btn-agrovia-add:active,
    .btn-dash-primary:active {
      transform: scale(0.97) !important;
    }

    .agr-click-ripple {
      position: absolute;
      border-radius: 50%;
      transform: scale(0);
      background: radial-gradient(circle, rgba(255, 255, 255, 0.45) 0%, var(--neon-glow-soft, rgba(184, 68, 247, 0.35)) 60%, transparent 100%);
      animation: agrRippleAnim 0.55s ease-out forwards;
      pointer-events: none;
      z-index: 5;
    }

    @keyframes agrRippleAnim {
      to {
        transform: scale(3.2);
        opacity: 0;
      }
    }
  </style>

  @stack('css')
</head>


<body class="g-sidenav-show bg-gray-100 {{ (\Request::is('rtl') ? 'rtl' : (Request::is('virtual-reality') ? 'virtual-reality' : '')) }} ">
  <div id="agr-page-progress"></div>
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

  <!-- SweetAlert2 + Agrovia Dark Neon Theme -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <style>
    /* Styling SweetAlert2 Dark Neon Glassmorphism */
    div.swal2-container {
      z-index: 9999999 !important;
    }
    .agr-swal-popup {
      background: rgba(18, 19, 35, 0.96) !important;
      backdrop-filter: blur(25px) !important;
      -webkit-backdrop-filter: blur(25px) !important;
      border: 1px solid var(--neon-purple, #b844f7) !important;
      border-radius: 20px !important;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.8), 0 0 25px var(--neon-glow, rgba(184, 68, 247, 0.5)) !important;
      color: #ffffff !important;
      font-family: "Poppins", sans-serif !important;
      padding: 1.8rem !important;
    }
    .agr-swal-title {
      color: #ffffff !important;
      font-weight: 700 !important;
      font-size: 1.25rem !important;
    }
    .agr-swal-html {
      color: rgba(255, 255, 255, 0.75) !important;
      font-size: 0.9rem !important;
    }
    .agr-swal-confirm-btn {
      background: linear-gradient(135deg, #16a34a, #22c55e) !important;
      border: none !important;
      border-radius: 10px !important;
      color: #ffffff !important;
      font-weight: 600 !important;
      font-size: 0.85rem !important;
      padding: 0.65rem 1.4rem !important;
      box-shadow: 0 4px 15px rgba(34, 197, 94, 0.4) !important;
      cursor: pointer !important;
      margin: 0.3rem !important;
      transition: all 0.25s ease !important;
    }
    .agr-swal-confirm-btn:hover {
      box-shadow: 0 0 20px rgba(34, 197, 94, 0.7) !important;
      transform: translateY(-2px) !important;
    }
    .agr-swal-danger-btn {
      background: linear-gradient(135deg, #be123c, #ef4444) !important;
      border: none !important;
      border-radius: 10px !important;
      color: #ffffff !important;
      font-weight: 600 !important;
      font-size: 0.85rem !important;
      padding: 0.65rem 1.4rem !important;
      box-shadow: 0 4px 15px rgba(239, 68, 68, 0.4) !important;
      cursor: pointer !important;
      margin: 0.3rem !important;
      transition: all 0.25s ease !important;
    }
    .agr-swal-danger-btn:hover {
      box-shadow: 0 0 20px rgba(239, 68, 68, 0.7) !important;
      transform: translateY(-2px) !important;
    }
    .agr-swal-cancel-btn {
      background: rgba(255, 255, 255, 0.08) !important;
      border: 1px solid rgba(255, 255, 255, 0.15) !important;
      border-radius: 10px !important;
      color: rgba(255, 255, 255, 0.75) !important;
      font-weight: 600 !important;
      font-size: 0.85rem !important;
      padding: 0.65rem 1.3rem !important;
      cursor: pointer !important;
      margin: 0.3rem !important;
      transition: all 0.25s ease !important;
    }
    .agr-swal-cancel-btn:hover {
      background: rgba(255, 255, 255, 0.16) !important;
      color: #ffffff !important;
    }
  </style>

  <script>
    /* ═════════════════════════════════════════════════════════════
       AGROVIA SYNTHESIZED SOUND ENGINE (Web Audio API)
       Suara renyah, futuristik, tanpa dependensi file mp3 eksternal
       ═════════════════════════════════════════════════════════════ */
    window.AgroviaSound = (function() {
      let ctx = null;
      let isSoundEnabled = localStorage.getItem('agrovia_sound_enabled') !== 'false';
      let lastHoverTime = 0;
      let userHasInteracted = false;

      function getAudioContext() {
        try {
          if (!ctx) {
            const AudioCtx = window.AudioContext || window.webkitAudioContext;
            if (AudioCtx) {
              ctx = new AudioCtx();
            }
          }
          if (ctx && ctx.state === 'suspended' && userHasInteracted) {
            ctx.resume().catch(function() {});
          }
        } catch (err) {}
        return ctx;
      }

      // Tandai interaksi pertama user untuk mematuhi kebijakan autoplay browser
      ['pointerdown', 'keydown', 'touchstart'].forEach(function(evt) {
        document.addEventListener(evt, function() {
          userHasInteracted = true;
          try {
            if (ctx && ctx.state === 'suspended') {
              ctx.resume().catch(function() {});
            }
          } catch (e) {}
        }, { once: true, passive: true });
      });

      return {
        isEnabled: function() {
          return isSoundEnabled;
        },
        setEnabled: function(val) {
          isSoundEnabled = !!val;
          localStorage.setItem('agrovia_sound_enabled', isSoundEnabled ? 'true' : 'false');
          window.dispatchEvent(new CustomEvent('agrovia-sound-toggled', { detail: { enabled: isSoundEnabled } }));
        },

        // Suara Hover Kursor: blip lembut & futuristik
        hover: function() {
          if (!isSoundEnabled || !userHasInteracted) return;
          const now = Date.now();
          if (now - lastHoverTime < 75) return;
          lastHoverTime = now;

          try {
            const audio = getAudioContext();
            if (!audio || audio.state !== 'running') return;
            const osc = audio.createOscillator();
            const gain = audio.createGain();

            osc.type = 'sine';
            osc.frequency.setValueAtTime(880, audio.currentTime);
            osc.frequency.exponentialRampToValueAtTime(680, audio.currentTime + 0.035);

            gain.gain.setValueAtTime(0.015, audio.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.0001, audio.currentTime + 0.035);

            osc.connect(gain);
            gain.connect(audio.destination);

            osc.start(audio.currentTime);
            osc.stop(audio.currentTime + 0.036);
          } catch (e) {}
        },

        // Suara Klik Tombol: snap taktil mekanik
        click: function() {
          if (!isSoundEnabled) return;
          userHasInteracted = true;
          try {
            const audio = getAudioContext();
            if (!audio) return;
            if (audio.state === 'suspended') {
              audio.resume().catch(function() {});
            }
            const osc = audio.createOscillator();
            const gain = audio.createGain();

            osc.type = 'triangle';
            osc.frequency.setValueAtTime(460, audio.currentTime);
            osc.frequency.exponentialRampToValueAtTime(180, audio.currentTime + 0.045);

            gain.gain.setValueAtTime(0.045, audio.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.0001, audio.currentTime + 0.045);

            osc.connect(gain);
            gain.connect(audio.destination);

            osc.start(audio.currentTime);
            osc.stop(audio.currentTime + 0.046);
          } catch (e) {}
        },

        // Suara Sukses CRUD: Double Chime Akor Mayor (C6 -> G6)
        success: function() {
          if (!isSoundEnabled) return;
          try {
            const audio = getAudioContext();
            if (!audio) return;
            if (audio.state === 'suspended') {
              audio.resume().catch(function() {});
            }
            const notes = [1046.5, 1318.5, 1567.98];
            notes.forEach(function(freq, idx) {
              const osc = audio.createOscillator();
              const gain = audio.createGain();
              const start = audio.currentTime + (idx * 0.08);

              osc.type = 'sine';
              osc.frequency.setValueAtTime(freq, start);

              gain.gain.setValueAtTime(0.035, start);
              gain.gain.exponentialRampToValueAtTime(0.0001, start + 0.28);

              osc.connect(gain);
              gain.connect(audio.destination);

              osc.start(start);
              osc.stop(start + 0.29);
            });
          } catch (e) {}
        },

        // Suara Peringatan / Dialog Konfirmasi Hapus
        warning: function() {
          if (!isSoundEnabled) return;
          try {
            const audio = getAudioContext();
            if (!audio) return;
            if (audio.state === 'suspended') {
              audio.resume().catch(function() {});
            }
            const osc = audio.createOscillator();
            const gain = audio.createGain();

            osc.type = 'sine';
            osc.frequency.setValueAtTime(420, audio.currentTime);
            osc.frequency.exponentialRampToValueAtTime(300, audio.currentTime + 0.12);

            gain.gain.setValueAtTime(0.05, audio.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.0001, audio.currentTime + 0.13);

            osc.connect(gain);
            gain.connect(audio.destination);

            osc.start(audio.currentTime);
            osc.stop(audio.currentTime + 0.14);
          } catch (e) {}
        },

        // Suara Data Dihapus: Digital downward swoosh
        delete: function() {
          if (!isSoundEnabled) return;
          try {
            const audio = getAudioContext();
            if (!audio) return;
            if (audio.state === 'suspended') {
              audio.resume().catch(function() {});
            }
            const osc = audio.createOscillator();
            const gain = audio.createGain();

            osc.type = 'sawtooth';
            osc.frequency.setValueAtTime(360, audio.currentTime);
            osc.frequency.exponentialRampToValueAtTime(80, audio.currentTime + 0.15);

            gain.gain.setValueAtTime(0.035, audio.currentTime);
            gain.gain.exponentialRampToValueAtTime(0.0001, audio.currentTime + 0.15);

            osc.connect(gain);
            gain.connect(audio.destination);

            osc.start(audio.currentTime);
            osc.stop(audio.currentTime + 0.16);
          } catch (e) {}
        }
      };
    })();

    // ── EVENT LISTENER GLOBAL UNTUK HOVER, KLIK, & CRUD POP-UP ──
    document.addEventListener('DOMContentLoaded', function() {
      // 1. Suara saat kursor bergerak menyentuh elemen yang bisa dipencet (hover)
      document.addEventListener('mouseover', function(e) {
        if (!e.target || typeof e.target.closest !== 'function') return;
        const target = e.target.closest('a, button, input[type="submit"], input[type="button"], input[type="checkbox"], .nav-button-block, .stat-card, .quick-link-item, .feature-card, .agr-btn-edit, .agr-btn-delete, .theme-color-btn, .btn-dim, .navbar-search-wrap, .btn, .fixed-plugin-button');
        if (target && window.AgroviaSound) {
          window.AgroviaSound.hover();
        }
      }, true);

      // 2. Suara saat tombol dipencet (click)
      document.addEventListener('click', function(e) {
        if (!e.target || typeof e.target.closest !== 'function') return;

        // A. Pop-up Konfirmasi saat tombol Edit di tabel diklik
        const editBtn = e.target.closest('.agr-btn-edit');
        if (editBtn && !editBtn.dataset.confirmed && editBtn.getAttribute('href')) {
          e.preventDefault();
          e.stopPropagation();

          if (window.AgroviaSound) window.AgroviaSound.click();

          const targetUrl = editBtn.getAttribute('href');
          Swal.fire({
            title: 'Edit Data Ini?',
            text: 'Anda akan dialihkan ke halaman formulir pengubahan data.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-edit me-1"></i> Lanjutkan Edit',
            cancelButtonText: '<i class="fas fa-times me-1"></i> Batal',
            reverseButtons: true,
            customClass: {
              popup: 'agr-swal-popup',
              title: 'agr-swal-title',
              htmlContainer: 'agr-swal-html',
              confirmButton: 'agr-swal-confirm-btn',
              cancelButton: 'agr-swal-cancel-btn'
            },
            buttonsStyling: false
          }).then(function(result) {
            if (result.isConfirmed) {
              if (window.AgroviaSound) window.AgroviaSound.click();
              window.location.href = targetUrl;
            }
          });
          return;
        }

        // B. Suara klik reguler + Efek Ripple & Transisi Halaman
        const target = e.target.closest('a, button, input[type="submit"], input[type="button"], .nav-button-block, .stat-card, .quick-link-item, .agr-btn-edit, .agr-btn-delete, .theme-color-btn, .btn-dim, .btn');
        if (target && window.AgroviaSound) {
          window.AgroviaSound.click();
        }

        // B1. Efek Ripple Neon pada tombol/menu yang dipencet
        const rippleHost = e.target.closest('.nav-button-block, .agr-mail-tab, .btn-agrovia-add, .btn-dash-primary, .navbar-mail-btn');
        if (rippleHost) {
          const rect = rippleHost.getBoundingClientRect();
          const size = Math.max(rect.width, rect.height);
          const ripple = document.createElement('span');
          ripple.className = 'agr-click-ripple';
          ripple.style.width = size + 'px';
          ripple.style.height = size + 'px';
          ripple.style.left = (e.clientX - rect.left - size / 2) + 'px';
          ripple.style.top = (e.clientY - rect.top - size / 2) + 'px';
          rippleHost.appendChild(ripple);
          setTimeout(function() { ripple.remove(); }, 600);
        }

        // B2. Animasi keluar halus saat pindah halaman (per halaman)
        const navLink = e.target.closest('a[href]');
        if (
          navLink &&
          !e.defaultPrevented &&
          !e.ctrlKey && !e.metaKey && !e.shiftKey && !e.altKey &&
          e.button === 0 &&
          !navLink.hasAttribute('download') &&
          !navLink.hasAttribute('data-bs-toggle') &&
          !navLink.classList.contains('agr-btn-edit') &&
          !navLink.classList.contains('user-logout-btn') &&
          !navLink.classList.contains('navbar-logout-btn')
        ) {
          const href = navLink.getAttribute('href');
          const targetAttr = navLink.getAttribute('target');
          if (
            href &&
            href !== '#' &&
            !href.startsWith('#') &&
            !href.startsWith('javascript:') &&
            targetAttr !== '_blank' &&
            navLink.origin === window.location.origin
          ) {
            e.preventDefault();
            const contentInner = document.querySelector('.main-content-inner');
            const progressBar = document.getElementById('agr-page-progress');
            if (progressBar) progressBar.classList.add('active');
            if (contentInner) {
              contentInner.classList.add('agr-page-leaving');
              setTimeout(function() {
                window.location.href = href;
              }, 190);
            } else {
              window.location.href = href;
            }
          }
        }
      }, true);

      // Reset animasi jika user menekan tombol Back/Forward browser (bfcache)
      window.addEventListener('pageshow', function() {
        const contentInner = document.querySelector('.main-content-inner');
        const progressBar = document.getElementById('agr-page-progress');
        if (contentInner) contentInner.classList.remove('agr-page-leaving');
        if (progressBar) progressBar.classList.remove('active');
      });

      // 3. POPUP SUKSES & GAGAL DARI SESSION LARAVEL (CRUD)
      const successMessage = @json(session('success'));
      const errorMessage = @json(session('error'));
      const validationErrors = @json(isset($errors) && $errors->any() ? $errors->all() : null);

      if (successMessage) {
        setTimeout(function() {
          if (window.AgroviaSound) window.AgroviaSound.success();
        }, 200);

        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: successMessage,
          customClass: {
            popup: 'agr-swal-popup',
            title: 'agr-swal-title',
            htmlContainer: 'agr-swal-html',
            confirmButton: 'agr-swal-confirm-btn'
          },
          buttonsStyling: false,
          timer: 3500,
          timerProgressBar: true
        });
      }

      if (errorMessage) {
        if (window.AgroviaSound) window.AgroviaSound.warning();

        Swal.fire({
          icon: 'error',
          title: 'Gagal!',
          text: errorMessage,
          customClass: {
            popup: 'agr-swal-popup',
            title: 'agr-swal-title',
            htmlContainer: 'agr-swal-html',
            confirmButton: 'agr-swal-danger-btn'
          },
          buttonsStyling: false
        });
      }

      if (validationErrors && validationErrors.length > 0) {
        if (window.AgroviaSound) window.AgroviaSound.warning();

        Swal.fire({
          icon: 'warning',
          title: 'Periksa Input Anda!',
          html: '<ul style="text-align:left; margin:0; padding-left:1.2rem;">' + 
                validationErrors.map(function(err) { return '<li>' + err + '</li>'; }).join('') + 
                '</ul>',
          customClass: {
            popup: 'agr-swal-popup',
            title: 'agr-swal-title',
            htmlContainer: 'agr-swal-html',
            confirmButton: 'agr-swal-danger-btn'
          },
          buttonsStyling: false
        });
      }

      // 4. INTERSEPSI POP-UP KONFIRMASI HAPUS & SIMPAN EDIT (CRUD)
      document.addEventListener('submit', function(e) {
        const form = e.target;
        if (!form || typeof form.querySelector !== 'function') return;

        // Cek jika form adalah delete
        const isDelete = form.querySelector('input[name="_method"][value="DELETE"]') || 
                         (form.getAttribute('action') && form.getAttribute('action').includes('destroy')) ||
                         form.classList.contains('form-delete');

        if (isDelete && !form.dataset.confirmed) {
          e.preventDefault();
          e.stopPropagation();

          if (window.AgroviaSound) window.AgroviaSound.warning();

          Swal.fire({
            title: 'Hapus Data Ini?',
            text: 'Data yang dihapus tidak dapat dipulihkan kembali!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-trash me-1"></i> Ya, Hapus!',
            cancelButtonText: '<i class="fas fa-times me-1"></i> Batal',
            reverseButtons: true,
            customClass: {
              popup: 'agr-swal-popup',
              title: 'agr-swal-title',
              htmlContainer: 'agr-swal-html',
              confirmButton: 'agr-swal-danger-btn',
              cancelButton: 'agr-swal-cancel-btn'
            },
            buttonsStyling: false
          }).then(function(result) {
            if (result.isConfirmed) {
              if (window.AgroviaSound) window.AgroviaSound.delete();
              form.dataset.confirmed = 'true';
              HTMLFormElement.prototype.submit.call(form);
            }
          });
          return false;
        }

        // Cek jika form adalah form edit/update (PUT/PATCH)
        const isUpdate = form.querySelector('input[name="_method"][value="PUT"]') ||
                         form.querySelector('input[name="_method"][value="PATCH"]') ||
                         form.classList.contains('form-edit-update');

        if (isUpdate && !form.dataset.confirmed) {
          if (typeof form.checkValidity === 'function' && !form.checkValidity()) {
            return;
          }

          e.preventDefault();
          e.stopPropagation();

          if (window.AgroviaSound) window.AgroviaSound.click();

          Swal.fire({
            title: 'Simpan Perubahan?',
            text: 'Pastikan seluruh perubahan data sudah benar sebelum disimpan.',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: '<i class="fas fa-save me-1"></i> Ya, Simpan!',
            cancelButtonText: '<i class="fas fa-times me-1"></i> Periksa Lagi',
            reverseButtons: true,
            customClass: {
              popup: 'agr-swal-popup',
              title: 'agr-swal-title',
              htmlContainer: 'agr-swal-html',
              confirmButton: 'agr-swal-confirm-btn',
              cancelButton: 'agr-swal-cancel-btn'
            },
            buttonsStyling: false
          }).then(function(result) {
            if (result.isConfirmed) {
              if (window.AgroviaSound) window.AgroviaSound.click();
              form.dataset.confirmed = 'true';
              HTMLFormElement.prototype.submit.call(form);
            }
          });
          return false;
        }
      }, true);
    });
  </script>
</body>

</html>