<!-- Navbar Premium Agrovia (Fully Responsive Desktop & Mobile) -->
<nav class="navbar navbar-main navbar-expand px-0 mx-2 mx-sm-3 mx-lg-4 my-2 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-2 px-sm-3 d-flex align-items-center justify-content-between">

        {{-- Left side: Hamburger Toggle & Breadcrumb --}}
        <div class="d-flex align-items-center gap-2 min-width-0">
            {{-- Mobile Sidebar Toggle Button --}}
            <button class="navbar-mobile-toggle d-xl-none" id="iconNavbarSidenav" type="button" aria-label="Menu Navigasi">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>

            {{-- Breadcrumb & Title --}}
            <nav aria-label="breadcrumb" class="nav-breadcrumb-wrap">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-0 px-0 d-none d-sm-flex">
                    <li class="breadcrumb-item text-xs">
                        <a class="opacity-5" href="{{ route('dashboard') }}" style="color: rgba(184,68,247,0.85) !important; text-decoration:none;">
                            <i class="fas fa-home me-1"></i>Agrovia
                        </a>
                    </li>
                    <li class="breadcrumb-item text-xs active text-capitalize" aria-current="page" style="color: rgba(255,255,255,0.5) !important;">
                        {{ str_replace('-', ' ', Request::path()) }}
                    </li>
                </ol>
                <h6 class="font-weight-bolder mb-0 text-capitalize nav-page-heading" style="color: #fff !important;">
                    {{ str_replace('-', ' ', Request::path()) }}
                </h6>
            </nav>
        </div>

        {{-- Right side: Pesan Email, User chip & Logout --}}
        <div class="d-flex align-items-center gap-2 ms-auto flex-shrink-0">
            @php
                $navUnreadPesan = 0;
                try {
                    if (auth()->check() && \Illuminate\Support\Facades\Schema::hasTable('pesan_emails')) {
                        $navUnreadPesan = \App\Models\PesanEmail::where('penerima_id', auth()->id())
                            ->whereNull('dibaca_pada')
                            ->count();
                    }
                } catch (\Throwable $e) {
                    $navUnreadPesan = 0;
                }
            @endphp
            <a href="{{ route('pesan.index') }}" class="navbar-mail-btn position-relative" title="Pesan Email (Admin & Pengawas)">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="2" y="4" width="20" height="16" rx="2"/>
                    <path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/>
                </svg>
                @if($navUnreadPesan > 0)
                    <span class="navbar-mail-badge">{{ $navUnreadPesan > 9 ? '9+' : $navUnreadPesan }}</span>
                @endif
            </a>

            {{-- User chip (Link ke Pengaturan Profil) --}}
            <a href="{{ route('profil.edit') }}" class="navbar-user-chip text-decoration-none" title="Pengaturan Profil">
                <div class="navbar-avatar" style="overflow:hidden;">
                    @auth
                        @if(auth()->user()->foto_profil)
                            <img src="{{ asset(auth()->user()->foto_profil) }}" alt="Avatar" style="width:100%;height:100%;object-fit:cover;">
                        @else
                            {{ strtoupper(substr(auth()->user()->nama ?? 'U', 0, 1)) }}
                        @endif
                    @endauth
                </div>
                <div class="navbar-user-text d-none d-md-flex">
                    <span class="navbar-user-name">@auth{{ auth()->user()->nama ?? 'User' }}@endauth</span>
                    <span class="navbar-user-role">@auth{{ ucfirst(auth()->user()->role ?? '') }}@endauth</span>
                </div>
            </a>

            {{-- Logout Button --}}
            <a href="{{ url('/logout') }}" class="navbar-logout-btn" title="Keluar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                    <polyline points="16 17 21 12 16 7"/>
                    <line x1="21" y1="12" x2="9" y2="12"/>
                </svg>
            </a>
        </div>

    </div>
</nav>
<!-- End Navbar -->

<style>
/* ── PREMIUM NAVBAR ───────────────── */
#navbarBlur {
  background: rgba(10,10,20,0.72) !important;
  backdrop-filter: blur(20px) !important;
  -webkit-backdrop-filter: blur(20px) !important;
  border: 1px solid var(--border-subtle) !important;
  box-shadow: 0 4px 20px rgba(0,0,0,0.35) !important;
  z-index: 1020;
}

.navbar-mobile-toggle {
  width: 38px;
  height: 38px;
  border-radius: 10px;
  background: rgba(255, 255, 255, 0.06);
  border: 1px solid var(--border-subtle);
  color: #fff !important;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  cursor: pointer;
  transition: all 0.2s ease;
  flex-shrink: 0;
  padding: 0;
}

.navbar-mobile-toggle:hover,
.navbar-mobile-toggle:active {
  background: var(--neon-glow-soft);
  border-color: var(--neon-purple);
  color: var(--neon-purple-light) !important;
  transform: scale(1.05);
}

.nav-breadcrumb-wrap {
  min-width: 0;
}

.nav-page-heading {
  font-size: 0.95rem;
  line-height: 1.2;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  max-width: 180px;
}
@media (min-width: 576px) {
  .nav-page-heading {
    max-width: none;
    font-size: 1rem;
  }
}

.navbar-user-chip {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: rgba(255,255,255,0.06);
  border: 1px solid var(--border-subtle);
  border-radius: 50px;
  padding: 0.25rem 0.65rem 0.25rem 0.25rem;
  cursor: pointer;
  transition: all 0.25s;
}
.navbar-user-chip:hover {
  background: var(--neon-glow-soft);
  border-color: var(--neon-purple);
}

.navbar-avatar {
  width: 32px;
  height: 32px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--neon-purple-dark), var(--neon-purple));
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.82rem;
  font-weight: 800;
  color: #fff !important;
  box-shadow: 0 2px 8px var(--neon-glow);
  flex-shrink: 0;
}

.navbar-user-text {
  display: flex;
  flex-direction: column;
}

.navbar-user-name {
  font-size: 0.75rem;
  font-weight: 700;
  color: #fff !important;
  line-height: 1.1;
  max-width: 120px;
  overflow: hidden;
  text-overflow: ellipsis;
  white-space: nowrap;
}

.navbar-user-role {
  font-size: 0.6rem;
  color: var(--neon-purple-light) !important;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}

.navbar-logout-btn {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: rgba(239,68,68,0.1);
  border: 1px solid rgba(239,68,68,0.25);
  color: #f87171 !important;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 0.85rem;
  transition: all 0.25s;
  text-decoration: none;
  flex-shrink: 0;
}

.navbar-logout-btn:hover {
  background: rgba(239,68,68,0.25);
  box-shadow: 0 4px 12px rgba(239,68,68,0.35);
  color: #fff !important;
  transform: scale(1.05);
}

.navbar-mail-btn {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: rgba(184, 68, 247, 0.12);
  border: 1px solid rgba(184, 68, 247, 0.28);
  color: var(--neon-purple-light) !important;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.25s;
  text-decoration: none;
  flex-shrink: 0;
}

.navbar-mail-btn:hover {
  background: var(--neon-glow-soft);
  border-color: var(--neon-purple);
  box-shadow: 0 4px 14px var(--neon-glow-soft);
  color: #fff !important;
  transform: scale(1.06);
}

.navbar-mail-badge {
  position: absolute;
  top: -5px;
  right: -5px;
  min-width: 17px;
  height: 17px;
  padding: 0 4px;
  border-radius: 999px;
  background: #ef4444;
  color: #fff;
  font-size: 0.62rem;
  font-weight: 800;
  display: flex;
  align-items: center;
  justify-content: center;
  box-shadow: 0 0 8px rgba(239, 68, 68, 0.7);
}
</style>
