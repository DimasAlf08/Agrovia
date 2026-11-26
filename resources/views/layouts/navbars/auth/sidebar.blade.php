<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">

  {{-- ── 1. HEADER SIDEBAR (LOGO RESMI AGROVIA) ── --}}
  <div class="sidebar-header-box d-flex align-items-center justify-content-between">
    <a href="{{ route('dashboard') }}" class="d-flex align-items-center text-decoration-none min-width-0 flex-grow-1">
      <div class="brand-logo-container">
        <img src="{{ asset('assets/img/logo-agrovia.png') }}" alt="Agrovia Logo" class="brand-logo-image">
      </div>
      <div class="brand-text-container ms-2">
        <span class="brand-name">AGROVIA</span>
        <span class="brand-tagline">Palm Oil & Agriculture</span>
      </div>
    </a>
    <button type="button" class="sidebar-close-btn d-xl-none" id="closeSidenavBtn" aria-label="Tutup Menu">
      <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <line x1="18" y1="6" x2="6" y2="18"></line>
        <line x1="6" y1="6" x2="18" y2="18"></line>
      </svg>
    </button>
  </div>

  <div class="sidebar-separator"></div>

  {{-- ── 2. MENU NAVIGASI (TERSUSUN LURUS KE BAWAH) ── --}}
  <div class="sidebar-scrollable-body" id="sidenav-scrollbar">
    <nav class="sidebar-vertical-nav">

      {{-- MENU DASHBOARD --}}
      <a class="nav-button-block {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
        <div class="nav-icon-square icon-purple">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="7" height="9" rx="1.5"/>
            <rect x="14" y="3" width="7" height="5" rx="1.5"/>
            <rect x="14" y="12" width="7" height="9" rx="1.5"/>
            <rect x="3" y="16" width="7" height="5" rx="1.5"/>
          </svg>
        </div>
        <div class="nav-label-box">
          <span class="nav-title">Dashboard</span>
          <span class="nav-caption">Ringkasan Statistik</span>
        </div>
        @if(request()->routeIs('dashboard'))
        <div class="nav-active-pill"></div>
        @endif
      </a>

      {{-- SECTION OPERASIONAL --}}
      <div class="nav-section-title">
        <span>MENU OPERASIONAL</span>
      </div>

      {{-- MENU DATA LAHAN (KHUSUS ADMIN) --}}
      @if(auth()->user()->role === 'admin')
      <a class="nav-button-block {{ request()->routeIs('lahan.*') ? 'active' : '' }}" href="{{ route('lahan.index') }}">
        <div class="nav-icon-square icon-green">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 21s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 7.2c0 7.3 8 11.8 8 11.8z"/>
            <circle cx="12" cy="10" r="3"/>
          </svg>
        </div>
        <div class="nav-label-box">
          <span class="nav-title">Data Lahan</span>
          <span class="nav-caption">Kelola Blok Perkebunan</span>
        </div>
        @if(request()->routeIs('lahan.*'))
        <div class="nav-active-pill"></div>
        @endif
      </a>

      {{-- MENU DATA PEKERJA (KHUSUS ADMIN) --}}
      <a class="nav-button-block {{ request()->routeIs('pekerja.*') ? 'active' : '' }}" href="{{ route('pekerja.index') }}">
        <div class="nav-icon-square icon-cyan">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
        <div class="nav-label-box">
          <span class="nav-title">Data Pekerja</span>
          <span class="nav-caption">Mandor & Karyawan</span>
        </div>
        @if(request()->routeIs('pekerja.*'))
        <div class="nav-active-pill"></div>
        @endif
      </a>
      @endif

      {{-- MENU HASIL PANEN (SEMUA ROLE) --}}
      <a class="nav-button-block {{ request()->routeIs('panen.*') ? 'active' : '' }}" href="{{ route('panen.index') }}">
        <div class="nav-icon-square icon-gold">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 3a9 9 0 0 1 9 9M12 3a9 9 0 0 0-9 9"/>
            <circle cx="12" cy="12" r="3" fill="currentColor"/>
          </svg>
        </div>
        <div class="nav-label-box">
          <span class="nav-title">Hasil Panen</span>
          <span class="nav-caption">Produksi TBS Sawit</span>
        </div>
        @if(request()->routeIs('panen.*'))
        <div class="nav-active-pill"></div>
        @endif
      </a>

      {{-- MENU KEGIATAN (KHUSUS ADMIN) --}}
      @if(auth()->user()->role === 'admin')
      <a class="nav-button-block {{ request()->routeIs('kegiatan.*') ? 'active' : '' }}" href="{{ route('kegiatan.index') }}">
        <div class="nav-icon-square icon-orange">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
            <path d="m9 16 2 2 4-4"/>
          </svg>
        </div>
        <div class="nav-label-box">
          <span class="nav-title">Kegiatan Kebun</span>
          <span class="nav-caption">Pemupukan & Perawatan</span>
        </div>
        @if(request()->routeIs('kegiatan.*'))
        <div class="nav-active-pill"></div>
        @endif
      </a>
      @endif

      {{-- SECTION LAPORAN --}}
      <div class="nav-section-title">
        <span>REKAP & LAPORAN</span>
      </div>

      {{-- MENU LAPORAN --}}
      <a class="nav-button-block {{ request()->routeIs('laporan.*') ? 'active' : '' }}" href="{{ route('laporan.index') }}">
        <div class="nav-icon-square icon-blue">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="20" x2="18" y2="10"/>
            <line x1="12" y1="20" x2="12" y2="4"/>
            <line x1="6" y1="20" x2="6" y2="14"/>
            <path d="M3 20h18"/>
          </svg>
        </div>
        <div class="nav-label-box">
          <span class="nav-title">Laporan</span>
          <span class="nav-caption">Grafik & Ekspor Excel</span>
        </div>
        @if(request()->routeIs('laporan.*'))
        <div class="nav-active-pill"></div>
        @endif
      </a>

      {{-- SECTION KOMUNIKASI --}}
      <div class="nav-section-title">
        <span>KOMUNIKASI</span>
      </div>

      @php
        $sidebarUnreadPesan = 0;
        try {
          if (auth()->check() && \Illuminate\Support\Facades\Schema::hasTable('pesan_emails')) {
            $sidebarUnreadPesan = \App\Models\PesanEmail::where('penerima_id', auth()->id())
              ->whereNull('dibaca_pada')
              ->count();
          }
        } catch (\Throwable $e) {
          $sidebarUnreadPesan = 0;
        }
      @endphp

      {{-- MENU PESAN EMAIL (ADMIN & PENGAWAS) --}}
      <a class="nav-button-block {{ request()->routeIs('pesan.*') ? 'active' : '' }}" href="{{ route('pesan.index') }}">
        <div class="nav-icon-square icon-purple">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="2" y="4" width="20" height="16" rx="2"/>
            <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
          </svg>
        </div>
        <div class="nav-label-box">
          <span class="nav-title d-flex align-items-center gap-2">
            Pesan Email
            @if($sidebarUnreadPesan > 0)
              <span class="badge rounded-pill bg-danger" style="font-size: 0.62rem; padding: 0.2em 0.5em;">{{ $sidebarUnreadPesan }}</span>
            @endif
          </span>
          <span class="nav-caption">Admin & Pengawas</span>
        </div>
        @if(request()->routeIs('pesan.*'))
        <div class="nav-active-pill"></div>
        @endif
      </a>

    </nav>
  </div>

  {{-- ── 3. USER PROFILE PANEL (BAGIAN PALING BAWAH) ── --}}
  <div class="sidebar-user-bottom">
    <div class="sidebar-user-inner">
      <a href="{{ route('profil.edit') }}" class="d-flex align-items-center gap-2 text-decoration-none min-width-0 flex-grow-1" title="Pengaturan Profil">
        <div class="user-badge-avatar" style="overflow:hidden;">
          @if(auth()->user()->foto_profil)
            <img src="{{ asset(auth()->user()->foto_profil) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;">
          @else
            {{ strtoupper(substr(auth()->user()->nama ?? 'A', 0, 1)) }}
          @endif
        </div>
        <div class="user-info-text">
          <span class="user-name-text">{{ auth()->user()->nama ?? 'Admin Kebun' }}</span>
          <span class="user-role-text">{{ strtoupper(auth()->user()->role ?? 'ADMIN') }}</span>
        </div>
      </a>
      <a href="{{ route('logout') }}" class="user-logout-btn" title="Logout">
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
          <polyline points="16 17 21 12 16 7"/>
          <line x1="21" y1="12" x2="9" y2="12"/>
        </svg>
      </a>
    </div>
  </div>

</aside>

<style>
/* ============================================================
   AGROVIA SIDEBAR - 100% VERTIKAL RAPI KE BAWAH DENGAN LOGO ASLI
   ============================================================ */

#sidenav-main {
  width: 260px !important;
  max-width: 260px !important;
  background: rgba(13, 14, 26, 0.96) !important;
  backdrop-filter: blur(25px) !important;
  -webkit-backdrop-filter: blur(25px) !important;
  border: 1px solid var(--border-subtle) !important;
  border-radius: 20px !important;
  box-shadow: 0 12px 40px rgba(0, 0, 0, 0.75), 0 0 20px var(--neon-glow-soft) !important;
  display: flex !important;
  flex-direction: column !important;
  overflow: hidden !important;
  z-index: 1040 !important;
  padding: 0 !important;
  transition: border-color 0.3s ease, box-shadow 0.3s ease !important;
}

/* ── 1. HEADER & LOGO RESMI ── */
.sidebar-header-box {
  padding: 1.1rem 1rem 0.8rem !important;
  display: flex !important;
  align-items: center !important;
  width: 100% !important;
}

.brand-logo-container {
  width: 44px;
  height: 44px;
  border-radius: 12px;
  background: #ffffff;
  padding: 2px;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 14px rgba(34, 197, 94, 0.4), 0 0 20px var(--neon-glow-soft);
  border: 1.5px solid rgba(34, 197, 94, 0.6);
  flex-shrink: 0;
}

.brand-logo-image {
  width: 100%;
  height: 100%;
  object-fit: contain;
  border-radius: 10px;
}

.brand-text-container {
  display: flex;
  flex-direction: column;
  min-width: 0;
}

.brand-name {
  font-size: 1.15rem;
  font-weight: 800;
  letter-spacing: 0.06em;
  color: #ffffff !important;
  line-height: 1.1;
  font-family: 'Poppins', sans-serif;
}

.brand-tagline {
  font-size: 0.62rem;
  font-weight: 600;
  color: #22c55e !important;
  letter-spacing: 0.02em;
  line-height: 1.2;
}

.sidebar-separator {
  height: 1px;
  background: linear-gradient(90deg, transparent, var(--border-subtle), transparent);
  margin: 0.2rem 1rem 0.6rem;
}

/* ── 2. SCROLLABLE BODY & VERTIKAL MENU ── */
.sidebar-scrollable-body {
  flex: 1 1 auto;
  overflow-y: auto;
  overflow-x: hidden;
  padding: 0 0.85rem;
  display: block !important;
  width: 100% !important;
}

.sidebar-vertical-nav {
  display: flex !important;
  flex-direction: column !important;
  gap: 0.4rem;
  width: 100% !important;
  padding-bottom: 1rem;
}

/* SECTION TITLES */
.nav-section-title {
  padding: 0.75rem 0.5rem 0.25rem !important;
  width: 100% !important;
}

.nav-section-title span {
  font-size: 0.62rem;
  font-weight: 800;
  letter-spacing: 0.12em;
  color: var(--neon-purple-light) !important;
  text-transform: uppercase;
  display: block;
}

/* NAV BUTTON BLOCK */
.nav-button-block {
  display: flex !important;
  align-items: center !important;
  gap: 0.75rem !important;
  padding: 0.6rem 0.85rem !important;
  border-radius: 14px !important;
  text-decoration: none !important;
  background: rgba(255, 255, 255, 0.03) !important;
  border: 1px solid rgba(255, 255, 255, 0.05) !important;
  transition: all 0.22s ease !important;
  position: relative !important;
  width: 100% !important;
  box-sizing: border-box !important;
}

.nav-button-block:hover {
  background: rgba(255, 255, 255, 0.08) !important;
  border-color: var(--border-subtle) !important;
  transform: translateX(3px) !important;
}

.nav-button-block.active {
  background: linear-gradient(135deg, var(--neon-glow-soft), rgba(255, 255, 255, 0.05)) !important;
  border-color: var(--neon-purple) !important;
  box-shadow: 0 4px 20px var(--neon-glow-soft), inset 0 0 14px var(--neon-glow-soft) !important;
}

.nav-active-pill {
  position: absolute;
  right: -1px;
  top: 50%;
  transform: translateY(-50%);
  width: 4px;
  height: 24px;
  background: linear-gradient(180deg, var(--neon-purple), var(--neon-purple-light));
  border-radius: 4px 0 0 4px;
  box-shadow: 0 0 10px var(--neon-purple), 0 0 20px var(--neon-glow);
}

/* ICON SQUARE */
.nav-icon-square {
  width: 38px;
  height: 38px;
  border-radius: 11px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
  transition: all 0.22s ease;
}

.nav-button-block:hover .nav-icon-square {
  transform: scale(1.08);
}

.icon-purple {
  background: linear-gradient(135deg, var(--neon-purple-dark), var(--neon-purple));
  color: #ffffff;
  border: 1px solid var(--neon-purple);
  box-shadow: 0 0 14px var(--neon-glow);
}
.icon-green {
  background: linear-gradient(135deg, rgba(22, 163, 74, 0.35), rgba(34, 197, 94, 0.5));
  color: #bbf7d0;
  border: 1px solid rgba(34, 197, 94, 0.5);
  box-shadow: 0 0 14px rgba(34, 197, 94, 0.4);
}
.icon-cyan {
  background: linear-gradient(135deg, rgba(14, 165, 233, 0.35), rgba(34, 211, 238, 0.5));
  color: #cffafe;
  border: 1px solid rgba(34, 211, 238, 0.5);
  box-shadow: 0 0 14px rgba(34, 211, 238, 0.4);
}
.icon-gold {
  background: linear-gradient(135deg, rgba(217, 119, 6, 0.35), rgba(251, 191, 36, 0.5));
  color: #fef08a;
  border: 1px solid rgba(251, 191, 36, 0.5);
  box-shadow: 0 0 14px rgba(251, 191, 36, 0.4);
}
.icon-orange {
  background: linear-gradient(135deg, rgba(234, 88, 12, 0.35), rgba(249, 115, 22, 0.5));
  color: #ffedd5;
  border: 1px solid rgba(249, 115, 22, 0.5);
  box-shadow: 0 0 14px rgba(249, 115, 22, 0.4);
}
.icon-blue {
  background: linear-gradient(135deg, rgba(79, 70, 229, 0.35), rgba(99, 102, 241, 0.5));
  color: #e0e7ff;
  border: 1px solid rgba(99, 102, 241, 0.5);
  box-shadow: 0 0 14px rgba(99, 102, 241, 0.4);
}

/* LABELS */
.nav-label-box {
  display: flex;
  flex-direction: column;
  overflow: hidden;
  text-align: left;
}

.nav-title {
  font-size: 0.86rem;
  font-weight: 700;
  color: #ffffff !important;
  line-height: 1.2;
}

.nav-caption {
  font-size: 0.65rem;
  color: rgba(255, 255, 255, 0.5) !important;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.nav-button-block.active .nav-caption {
  color: var(--neon-purple-light) !important;
}

/* ── 3. USER PROFILE FOOTER ── */
.sidebar-user-bottom {
  padding: 0.75rem 0.85rem !important;
  background: rgba(10, 11, 20, 0.8);
  border-top: 1px solid var(--border-subtle);
  width: 100% !important;
}

.sidebar-user-inner {
  display: flex;
  align-items: center;
  gap: 0.65rem;
  background: rgba(255, 255, 255, 0.05);
  border: 1px solid var(--border-subtle);
  border-radius: 14px;
  padding: 0.55rem 0.75rem;
}

.user-badge-avatar {
  width: 34px;
  height: 34px;
  border-radius: 10px;
  background: linear-gradient(135deg, var(--neon-purple-dark), var(--neon-purple));
  color: #ffffff;
  font-weight: 800;
  font-size: 0.85rem;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 12px var(--neon-glow);
  flex-shrink: 0;
}

.user-info-text {
  display: flex;
  flex-direction: column;
  flex: 1;
  min-width: 0;
  text-align: left;
}

.user-name-text {
  font-size: 0.8rem;
  font-weight: 700;
  color: #ffffff !important;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}

.user-role-text {
  font-size: 0.6rem;
  font-weight: 800;
  color: #4ade80 !important;
  letter-spacing: 0.06em;
}

.user-logout-btn {
  width: 30px;
  height: 30px;
  border-radius: 8px;
  background: rgba(239, 68, 68, 0.15);
  border: 1px solid rgba(239, 68, 68, 0.3);
  color: #f87171 !important;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s ease;
  text-decoration: none !important;
  flex-shrink: 0;
}

.user-logout-btn:hover {
  background: rgba(239, 68, 68, 0.4);
  color: #ffffff !important;
  transform: scale(1.08);
}

/* ── RESPONSIVE MOBILE SIDEBAR ──────────── */
.sidebar-close-btn {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  background: rgba(255, 255, 255, 0.08);
  border: 1px solid rgba(255, 255, 255, 0.15);
  color: #fff;
  display: flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  flex-shrink: 0;
  margin-left: auto;
  padding: 0;
}
.sidebar-close-btn:hover {
  background: rgba(239, 68, 68, 0.35);
  border-color: #ef4444;
  color: #fff;
}

@media (max-width: 1199.98px) {
  #sidenav-main {
    position: fixed !important;
    top: 0 !important;
    left: 0 !important;
    bottom: 0 !important;
    height: 100vh !important;
    max-height: 100vh !important;
    width: 275px !important;
    max-width: 82vw !important;
    border-radius: 0 24px 24px 0 !important;
    margin: 0 !important;
    transform: translateX(-110%) !important;
    transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
    z-index: 99999 !important;
  }
  #sidenav-main.show-mobile,
  body.g-sidenav-pinned #sidenav-main {
    transform: translateX(0) !important;
    box-shadow: 10px 0 50px rgba(0, 0, 0, 0.85) !important;
  }
  .sidenav-backdrop {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100vw;
    height: 100vh;
    background: rgba(0, 0, 0, 0.7);
    backdrop-filter: blur(5px);
    -webkit-backdrop-filter: blur(5px);
    z-index: 99990;
  }
  .sidenav-backdrop.show {
    display: block;
  }
}
</style>

{{-- Backdrop for Mobile Sidebar --}}
<div class="sidenav-backdrop" id="sidenavBackdrop"></div>

<script>
(function() {
  function initMobileSidenav() {
    const openBtn = document.getElementById('iconNavbarSidenav');
    const closeBtn = document.getElementById('closeSidenavBtn');
    const backdrop = document.getElementById('sidenavBackdrop');
    const sidenav = document.getElementById('sidenav-main');

    function openSidebar() {
      if (sidenav) sidenav.classList.add('show-mobile');
      if (backdrop) backdrop.classList.add('show');
      document.body.classList.add('g-sidenav-pinned');
    }

    function closeSidebar() {
      if (sidenav) sidenav.classList.remove('show-mobile');
      if (backdrop) backdrop.classList.remove('show');
      document.body.classList.remove('g-sidenav-pinned');
    }

    if (openBtn) {
      openBtn.onclick = function(e) {
        e.preventDefault();
        e.stopPropagation();
        openSidebar();
      };
    }
    if (closeBtn) {
      closeBtn.onclick = function(e) {
        e.preventDefault();
        e.stopPropagation();
        closeSidebar();
      };
    }
    if (backdrop) {
      backdrop.onclick = function(e) {
        e.preventDefault();
        closeSidebar();
      };
    }

    if (sidenav) {
      sidenav.querySelectorAll('a').forEach(function(link) {
        link.addEventListener('click', function() {
          if (window.innerWidth < 1200) closeSidebar();
        });
      });
    }
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initMobileSidenav);
  } else {
    initMobileSidenav();
  }
})();
</script>
