<!-- Navbar Premium Agrovia -->
<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">

        {{-- Breadcrumb --}}
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm">
                    <a class="opacity-5" href="{{ route('dashboard') }}" style="color: rgba(184,68,247,0.7) !important; text-decoration:none;">
                        <i class="fas fa-home me-1"></i>Agrovia
                    </a>
                </li>
                <li class="breadcrumb-item text-sm active text-capitalize" aria-current="page"
                    style="color: rgba(255,255,255,0.5) !important;">
                    {{ str_replace('-', ' ', Request::path()) }}
                </li>
            </ol>
            <h6 class="font-weight-bolder mb-0 text-capitalize" style="color: #fff !important; font-size:0.95rem;">
                {{ str_replace('-', ' ', Request::path()) }}
            </h6>
        </nav>

        {{-- Right side --}}
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4 d-flex justify-content-end" id="navbar">

            {{-- Search --}}
            <div class="ms-md-3 pe-md-3 d-flex align-items-center">
                <div class="navbar-search-wrap">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="navbar-search-icon">
                        <circle cx="11" cy="11" r="8"/>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"/>
                    </svg>
                    <input type="text" class="navbar-search-input" placeholder="Cari data...">
                </div>
            </div>

            <ul class="navbar-nav justify-content-end align-items-center ms-2" style="gap:0.5rem;">

                {{-- Mobile toggle --}}
                <li class="nav-item d-xl-none d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>

                {{-- Notification Bell --}}
                <li class="nav-item d-flex align-items-center">
                    <div class="navbar-icon-btn">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/>
                            <path d="M13.73 21a2 2 0 0 1-3.46 0"/>
                        </svg>
                        <span class="notif-badge">3</span>
                    </div>
                </li>

                {{-- User chip --}}
                <li class="nav-item d-flex align-items-center">
                    <div class="navbar-user-chip">
                        <div class="navbar-avatar">
                            @auth{{ strtoupper(substr(auth()->user()->nama ?? 'U', 0, 1)) }}@endauth
                        </div>
                        <div class="navbar-user-text d-none d-sm-flex">
                            <span class="navbar-user-name">@auth{{ auth()->user()->nama ?? 'User' }}@endauth</span>
                            <span class="navbar-user-role">@auth{{ ucfirst(auth()->user()->role ?? '') }}@endauth</span>
                        </div>
                    </div>
                </li>

                {{-- Logout --}}
                <li class="nav-item d-flex align-items-center">
                    <a href="{{ url('/logout') }}" class="navbar-logout-btn" title="Keluar">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                            <polyline points="16 17 21 12 16 7"/>
                            <line x1="21" y1="12" x2="9" y2="12"/>
                        </svg>
                    </a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- End Navbar -->

<style>
/* ── PREMIUM NAVBAR ───────────────── */
#navbarBlur {
  background: rgba(10,10,20,0.65) !important;
  backdrop-filter: blur(20px) !important;
  border-bottom: 1px solid var(--border-subtle) !important;
  box-shadow: 0 2px 20px rgba(0,0,0,0.3) !important;
}

.navbar-search-wrap {
  display: flex;
  align-items: center;
  background: rgba(255,255,255,0.05);
  border: 1px solid var(--border-subtle);
  border-radius: 50px;
  padding: 0.4rem 1rem;
  gap: 0.5rem;
  transition: all 0.25s;
}
.navbar-search-wrap:focus-within {
  border-color: var(--neon-purple);
  box-shadow: 0 0 0 3px var(--neon-glow-soft);
  background: rgba(255, 255, 255, 0.08);
}
.navbar-search-icon { font-size: 0.75rem; color: var(--neon-purple-light) !important; }
.navbar-search-input {
  background: transparent !important;
  border: none !important;
  outline: none !important;
  color: #fff !important;
  font-size: 0.8rem;
  width: 130px;
  font-family: 'Poppins', sans-serif;
}
.navbar-search-input::placeholder { color: rgba(255,255,255,0.3) !important; }

.navbar-icon-btn {
  position: relative;
  width: 36px; height: 36px;
  border-radius: 10px;
  background: rgba(255,255,255,0.05);
  border: 1px solid var(--border-subtle);
  display: flex; align-items: center; justify-content: center;
  cursor: pointer;
  color: rgba(255,255,255,0.7) !important;
  font-size: 0.85rem;
  transition: all 0.25s;
}
.navbar-icon-btn:hover {
  background: var(--neon-glow-soft);
  border-color: var(--neon-purple);
}
.notif-badge {
  position: absolute;
  top: -4px; right: -4px;
  width: 15px; height: 15px;
  border-radius: 50%;
  background: linear-gradient(135deg, #ef4444, #f87171);
  font-size: 0.5rem;
  font-weight: 800;
  color: #fff !important;
  display: flex; align-items: center; justify-content: center;
  box-shadow: 0 2px 8px rgba(239,68,68,0.5);
}

.navbar-user-chip {
  display: flex;
  align-items: center;
  gap: 0.5rem;
  background: rgba(255,255,255,0.05);
  border: 1px solid var(--border-subtle);
  border-radius: 50px;
  padding: 0.3rem 0.75rem 0.3rem 0.3rem;
  cursor: pointer;
  transition: all 0.25s;
}
.navbar-user-chip:hover {
  background: var(--neon-glow-soft);
  border-color: var(--neon-purple);
}
.navbar-avatar {
  width: 30px; height: 30px;
  border-radius: 50%;
  background: linear-gradient(135deg, var(--neon-purple-dark), var(--neon-purple));
  display: flex; align-items: center; justify-content: center;
  font-size: 0.8rem;
  font-weight: 800;
  color: #fff !important;
  box-shadow: 0 2px 8px var(--neon-glow);
  flex-shrink: 0;
}
.navbar-user-text { display: flex; flex-direction: column; }
.navbar-user-name {
  font-size: 0.75rem;
  font-weight: 700;
  color: #fff !important;
  line-height: 1.1;
  max-width: 100px;
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
  width: 36px; height: 36px;
  border-radius: 10px;
  background: rgba(239,68,68,0.08);
  border: 1px solid rgba(239,68,68,0.2);
  color: #f87171 !important;
  display: flex; align-items: center; justify-content: center;
  font-size: 0.85rem;
  transition: all 0.25s;
  text-decoration: none;
}
.navbar-logout-btn:hover {
  background: rgba(239,68,68,0.2);
  box-shadow: 0 4px 12px rgba(239,68,68,0.3);
  color: #fff !important;
}
</style>
