@extends('layouts.user_type.auth')

@section('content')

{{-- ═══════════════════════════════════════════════
     AGROVIA PREMIUM DASHBOARD
═══════════════════════════════════════════════ --}}

{{-- Canvas Particle Background --}}
<canvas id="particles-canvas"></canvas>

<div class="dash-wrapper">

  {{-- ══════════════ ROW 1: HEADER ══════════════ --}}
  <div class="dash-header mb-4">
    <div>
      <p class="dash-greeting">Selamat datang kembali,</p>
      <h2 class="dash-title">{{ ucfirst(auth()->user()->nama) }} <span class="wave-emoji">👋</span></h2>
      <p class="dash-subtitle">{{ now()->isoFormat('dddd, D MMMM Y') }} &nbsp;·&nbsp; Agrovia Farm Management</p>
    </div>
    <div class="dash-header-actions">
      <div class="dash-time-badge">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
          <circle cx="12" cy="12" r="10"/>
          <polyline points="12 6 12 12 16 14"/>
        </svg>
        <span id="live-clock"></span>
      </div>
      @if(auth()->user()->role === 'admin')
      <a href="{{ route('lahan.create') }}" class="btn-dash-primary">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" class="me-2">
          <line x1="12" y1="5" x2="12" y2="19"/>
          <line x1="5" y1="12" x2="19" y2="12"/>
        </svg>
        Tambah Lahan
      </a>
      @endif
    </div>
  </div>

  {{-- ══════════════ ROW 2: STAT CARDS ══════════════ --}}
  <div class="dash-stats-grid mb-4">

    {{-- Stat: Total Lahan --}}
    <div class="stat-card stat-purple">
      <div class="stat-card-glow glow-purple"></div>
      <div class="stat-icon-wrap">
        <div class="stat-icon bg-purple">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 21s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 7.2c0 7.3 8 11.8 8 11.8z"/>
            <circle cx="12" cy="10" r="3"/>
          </svg>
        </div>
      </div>
      <div class="stat-info">
        <p class="stat-label">Total Lahan</p>
        <div class="stat-value-row">
          <h3 class="stat-value">{{ $totalLahan ?? 0 }}</h3>
          <span class="stat-unit">Blok Kebun</span>
        </div>
        <div class="stat-bar"><div class="stat-bar-fill bg-purple" style="width: 75%"></div></div>
      </div>
      <div class="stat-trend up">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        Lahan Terdaftar
      </div>
    </div>

    {{-- Stat: Total Pekerja --}}
    <div class="stat-card stat-cyan">
      <div class="stat-card-glow glow-cyan"></div>
      <div class="stat-icon-wrap">
        <div class="stat-icon bg-cyan">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
            <circle cx="9" cy="7" r="4"/>
            <path d="M23 21v-2a4 4 0 0 0-3-3.87"/>
            <path d="M16 3.13a4 4 0 0 1 0 7.75"/>
          </svg>
        </div>
      </div>
      <div class="stat-info">
        <p class="stat-label">Total Pekerja</p>
        <div class="stat-value-row">
          <h3 class="stat-value">{{ $totalPekerja ?? 0 }}</h3>
          <span class="stat-unit">Orang</span>
        </div>
        <div class="stat-bar"><div class="stat-bar-fill bg-cyan" style="width: 60%"></div></div>
      </div>
      <div class="stat-trend up">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1"><path d="M20 6L9 17l-5-5"/></svg>
        Aktif Bekerja
      </div>
    </div>

    {{-- Stat: Produksi Bulan Ini --}}
    <div class="stat-card stat-gold">
      <div class="stat-card-glow glow-gold"></div>
      <div class="stat-icon-wrap">
        <div class="stat-icon bg-gold">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="12" cy="12" r="9"/>
            <path d="M12 3a9 9 0 0 1 9 9M12 3a9 9 0 0 0-9 9"/>
            <circle cx="12" cy="12" r="3" fill="currentColor"/>
          </svg>
        </div>
      </div>
      <div class="stat-info">
        <p class="stat-label">Produksi Bulan Ini</p>
        <div class="stat-value-row">
          <h3 class="stat-value">{{ number_format($produksiBulan ?? 0, 0, ',', '.') }}</h3>
          <span class="stat-unit">Kg TBS</span>
        </div>
        <div class="stat-bar"><div class="stat-bar-fill bg-gold" style="width: 85%"></div></div>
      </div>
      <div class="stat-trend up">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1"><polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/><polyline points="17 6 23 6 23 12"/></svg>
        Hasil Panen
      </div>
    </div>

    {{-- Stat: Kegiatan Aktif --}}
    <div class="stat-card stat-green">
      <div class="stat-card-glow glow-green"></div>
      <div class="stat-icon-wrap">
        <div class="stat-icon bg-green">
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
            <line x1="16" y1="2" x2="16" y2="6"/>
            <line x1="8" y1="2" x2="8" y2="6"/>
            <line x1="3" y1="10" x2="21" y2="10"/>
            <path d="m9 16 2 2 4-4"/>
          </svg>
        </div>
      </div>
      <div class="stat-info">
        <p class="stat-label">Kegiatan Bulan Ini</p>
        <div class="stat-value-row">
          <h3 class="stat-value">{{ isset($kegiatanTerbaru) ? $kegiatanTerbaru->count() : 0 }}</h3>
          <span class="stat-unit">Aktivitas</span>
        </div>
        <div class="stat-bar"><div class="stat-bar-fill bg-green" style="width: 50%"></div></div>
      </div>
      <div class="stat-trend up">
        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-1"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
        Operasional
      </div>
    </div>

  </div>

  {{-- ══════════════ ROW 3: CHART + QUICK ACCESS ══════════════ --}}
  <div class="dash-main-grid mb-4">

    {{-- Chart Card --}}
    <div class="glass-card chart-card">
      <div class="glass-card-header">
        <div>
          <h6 class="glass-card-title">
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
              <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"/>
              <polyline points="17 6 23 6 23 12"/>
            </svg>
            Grafik Produksi TBS
          </h6>
          <p class="glass-card-sub">Perkembangan hasil panen TBS per bulan — {{ now()->year }}</p>
        </div>
        <div class="chart-legend">
          <span class="legend-dot bg-purple"></span>
          <span class="legend-text">Kg Panen TBS</span>
        </div>
      </div>
      <div class="chart-container">
        <canvas id="productionChart" height="260"></canvas>
      </div>
    </div>

    {{-- Quick Access Panel --}}
    <div class="quick-panel">
      <div class="glass-card h-100">
        <div class="glass-card-header">
          <h6 class="glass-card-title">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#fbbf24" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
              <polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/>
            </svg>
            Akses Cepat
          </h6>
          <span class="badge-pill">Navigasi</span>
        </div>
        <div class="quick-links">

          @if(auth()->user()->role === 'admin')
          <a href="{{ route('lahan.index') }}" class="quick-link-item ql-purple">
            <div class="ql-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 21s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 7.2c0 7.3 8 11.8 8 11.8z"/>
                <circle cx="12" cy="10" r="3"/>
              </svg>
            </div>
            <div class="ql-info">
              <span class="ql-title">Data Lahan</span>
              <span class="ql-desc">Kelola blok lahan kebun</span>
            </div>
            <i class="fas fa-chevron-right ql-arrow"></i>
          </a>
          <a href="{{ route('pekerja.index') }}" class="quick-link-item ql-cyan">
            <div class="ql-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/>
                <circle cx="9" cy="7" r="4"/>
              </svg>
            </div>
            <div class="ql-info">
              <span class="ql-title">Data Pekerja</span>
              <span class="ql-desc">Manajemen pekerja kebun</span>
            </div>
            <i class="fas fa-chevron-right ql-arrow"></i>
          </a>
          @endif

          <a href="{{ route('panen.index') }}" class="quick-link-item ql-gold">
            <div class="ql-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <circle cx="12" cy="12" r="9"/>
                <path d="M12 7v5l3 3"/>
              </svg>
            </div>
            <div class="ql-info">
              <span class="ql-title">Hasil Panen</span>
              <span class="ql-desc">Catat & lihat produksi</span>
            </div>
            <i class="fas fa-chevron-right ql-arrow"></i>
          </a>

          @if(auth()->user()->role === 'admin')
          <a href="{{ route('kegiatan.index') }}" class="quick-link-item ql-green">
            <div class="ql-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                <line x1="16" y1="2" x2="16" y2="6"/>
                <line x1="8" y1="2" x2="8" y2="6"/>
              </svg>
            </div>
            <div class="ql-info">
              <span class="ql-title">Kegiatan Operasional</span>
              <span class="ql-desc">Catatan rawat & pemupukan</span>
            </div>
            <i class="fas fa-chevron-right ql-arrow"></i>
          </a>
          @endif

          <a href="{{ route('laporan.index') }}" class="quick-link-item ql-orange">
            <div class="ql-icon">
              <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="18" y1="20" x2="18" y2="10"/>
                <line x1="12" y1="20" x2="12" y2="4"/>
                <line x1="6" y1="20" x2="6" y2="14"/>
              </svg>
            </div>
            <div class="ql-info">
              <span class="ql-title">Laporan Analitik</span>
              <span class="ql-desc">Rekap & filter hasil panen</span>
            </div>
            <i class="fas fa-chevron-right ql-arrow"></i>
          </a>

        </div>
      </div>
    </div>

  </div>

  {{-- ══════════════ ROW 4: FEATURE CARDS + ACTIVITY ══════════════ --}}
  <div class="dash-bottom-grid">

    {{-- Feature Cards (seperti referensi) --}}
    <div class="feature-cards-wrap">
      <h6 class="section-label mb-3">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
          <rect x="3" y="3" width="7" height="7"/>
          <rect x="14" y="3" width="7" height="7"/>
          <rect x="14" y="14" width="7" height="7"/>
          <rect x="3" y="14" width="7" height="7"/>
        </svg>
        Menu Cepat Modul Agrovia
      </h6>
      <div class="feature-cards-grid">

        <a href="{{ route('panen.create') }}" class="feature-card fc-purple">
          <div class="fc-glow"></div>
          <div class="fc-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 2v20M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/>
            </svg>
          </div>
          <div class="fc-content">
            <h6>Catat Panen Baru</h6>
            <p>Input timbangan TBS kelapa sawit hari ini</p>
          </div>
        </a>

        @if(auth()->user()->role === 'admin')
        <a href="{{ route('lahan.create') }}" class="feature-card fc-cyan">
          <div class="fc-glow"></div>
          <div class="fc-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M12 21s8-4.5 8-11.8A8 8 0 0 0 12 2a8 8 0 0 0-8 7.2c0 7.3 8 11.8 8 11.8z"/>
              <line x1="12" y1="8" x2="12" y2="12"/>
              <line x1="10" y1="10" x2="14" y2="10"/>
            </svg>
          </div>
          <div class="fc-content">
            <h6>Tambah Blok Lahan</h6>
            <p>Daftarkan blok perkebunan baru</p>
          </div>
        </a>

        <a href="{{ route('pekerja.create') }}" class="feature-card fc-green">
          <div class="fc-glow"></div>
          <div class="fc-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"/>
              <circle cx="9" cy="7" r="4"/>
              <line x1="19" y1="8" x2="19" y2="14"/>
              <line x1="22" y1="11" x2="16" y2="11"/>
            </svg>
          </div>
          <div class="fc-content">
            <h6>Tambah Pekerja</h6>
            <p>Input data karyawan / pemanen baru</p>
          </div>
        </a>

        <a href="{{ route('kegiatan.create') }}" class="feature-card fc-gold">
          <div class="fc-glow"></div>
          <div class="fc-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/>
              <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/>
            </svg>
          </div>
          <div class="fc-content">
            <h6>Catat Kegiatan</h6>
            <p>Jadwal pemupukan, semprot & rawat</p>
          </div>
        </a>
        @else
        <a href="{{ route('laporan.index') }}" class="feature-card fc-cyan">
          <div class="fc-glow"></div>
          <div class="fc-icon">
            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <line x1="18" y1="20" x2="18" y2="10"/>
              <line x1="12" y1="20" x2="12" y2="4"/>
              <line x1="6" y1="20" x2="6" y2="14"/>
            </svg>
          </div>
          <div class="fc-content">
            <h6>Lihat Laporan</h6>
            <p>Rekapitulasi total produksi kebun</p>
          </div>
        </a>
        @endif

      </div>
    </div>

    {{-- Activity Feed --}}
    <div class="glass-card activity-card">
      <div class="glass-card-header">
        <h6 class="glass-card-title">
          <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#22d3ee" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="me-2">
            <circle cx="12" cy="12" r="10"/>
            <polyline points="12 6 12 12 16 14"/>
          </svg>
          Aktivitas Terbaru
        </h6>
        <span class="badge-live"><span class="live-dot"></span>Live</span>
      </div>
      <div class="activity-feed">
        @forelse($kegiatanTerbaru ?? [] as $k)
        <div class="activity-item">
          <div class="activity-dot"></div>
          <div class="activity-line"></div>
          <div class="activity-body">
            <div class="activity-top">
              <span class="activity-title">{{ $k->jenis }}</span>
              <span class="activity-time">{{ $k->tanggal ? $k->tanggal->diffForHumans() : '-' }}</span>
            </div>
            <p class="activity-meta">
              <span>📍 {{ $k->lahan->nama_lahan ?? '-' }}</span>
              @if($k->pekerja)
              <span> · 👤 {{ $k->pekerja->nama }}</span>
              @endif
            </p>
          </div>
        </div>
        @empty
        <div class="activity-empty">
          <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="mb-2 opacity-5">
            <rect x="2" y="4" width="20" height="16" rx="2"/>
            <path d="M10 4v4M14 4v4M2 12h20"/>
          </svg>
          <p class="mb-0">Belum ada kegiatan tercatat</p>
        </div>
        @endforelse
      </div>
    </div>

  </div>

</div>{{-- end dash-wrapper --}}

@push('css')
<style>
/* ═══════════════════════════════════════════════
   AGROVIA PREMIUM DASHBOARD STYLES
═══════════════════════════════════════════════ */

/* Particle Canvas */
#particles-canvas {
  position: fixed;
  top: 0; left: 0;
  width: 100%; height: 100%;
  pointer-events: none;
  z-index: 0;
}

/* Wrapper */
.dash-wrapper {
  position: relative;
  z-index: 1;
  padding: 0.5rem 0.25rem;
}

/* ── HEADER ─────────────────────────── */
.dash-header {
  display: flex;
  align-items: flex-start;
  justify-content: space-between;
  flex-wrap: wrap;
  gap: 1rem;
}
.dash-greeting {
  font-size: 0.8rem;
  color: rgba(255,255,255,0.45) !important;
  margin-bottom: 0.1rem;
}
.dash-title {
  font-size: 1.75rem;
  font-weight: 700;
  color: #fff !important;
  line-height: 1.2;
  margin-bottom: 0.25rem;
}
.wave-emoji { font-style: normal; animation: wave 2s ease-in-out infinite; display:inline-block; }
@keyframes wave {
  0%,100% { transform: rotate(0deg); }
  25% { transform: rotate(20deg); }
  75% { transform: rotate(-10deg); }
}
.dash-subtitle {
  font-size: 0.78rem;
  color: rgba(255,255,255,0.4) !important;
}
.dash-header-actions {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  flex-wrap: wrap;
}
.dash-time-badge {
  display: flex;
  align-items: center;
  background: rgba(255,255,255,0.06);
  border: 1px solid var(--border-subtle);
  border-radius: 50px;
  padding: 0.4rem 1rem;
  font-size: 0.82rem;
  color: var(--neon-purple-light) !important;
  font-weight: 600;
}
.btn-dash-primary {
  display: inline-flex;
  align-items: center;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  color: #fff !important;
  border: none;
  border-radius: 50px;
  padding: 0.5rem 1.25rem;
  font-size: 0.82rem;
  font-weight: 600;
  box-shadow: 0 4px 16px rgba(34,197,94,0.35);
  text-decoration: none;
  transition: all 0.3s;
}
.btn-dash-primary:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 24px rgba(34,197,94,0.5);
  color: #fff !important;
}

/* ── STAT CARDS GRID ────────────────── */
.dash-stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 1rem;
}
@media (max-width: 1200px) { .dash-stats-grid { grid-template-columns: repeat(2,1fr); } }
@media (max-width: 576px)  { .dash-stats-grid { grid-template-columns: 1fr; } }

.stat-card {
  position: relative;
  background: rgba(18,18,34,0.75);
  backdrop-filter: blur(16px);
  border-radius: 20px;
  padding: 1.25rem;
  border: 1px solid transparent;
  overflow: hidden;
  display: flex;
  flex-direction: column;
  gap: 0.6rem;
  transition: transform 0.3s, box-shadow 0.3s;
  cursor: default;
}
.stat-card:hover { transform: translateY(-4px); }

.stat-purple { border-color: var(--neon-purple) !important; }
.stat-cyan   { border-color: rgba(34,211,238,0.3); }
.stat-gold   { border-color: rgba(251,191,36,0.3); }
.stat-green  { border-color: rgba(34,197,94,0.3); }

.stat-card-glow {
  position: absolute;
  top: -40px; right: -40px;
  width: 120px; height: 120px;
  border-radius: 50%;
  filter: blur(50px);
  opacity: 0.35;
  pointer-events: none;
}
.glow-purple { background: var(--neon-purple) !important; }
.glow-cyan   { background: #22d3ee; }
.glow-gold   { background: #fbbf24; }
.glow-green  { background: #22c55e; }

.stat-icon-wrap { display: flex; }
.stat-icon {
  width: 44px; height: 44px;
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem;
  color: #fff;
}
.bg-purple { background: linear-gradient(135deg, var(--neon-purple-dark), var(--neon-purple)) !important; box-shadow: 0 4px 14px var(--neon-glow) !important; }
.bg-cyan   { background: linear-gradient(135deg, #0ea5e9, #22d3ee); box-shadow: 0 4px 14px rgba(34,211,238,0.4); }
.bg-gold   { background: linear-gradient(135deg, #d97706, #fbbf24); box-shadow: 0 4px 14px rgba(251,191,36,0.4); }
.bg-green  { background: linear-gradient(135deg, #16a34a, #22c55e); box-shadow: 0 4px 14px rgba(34,197,94,0.4); }

.stat-info { flex: 1; }
.stat-label {
  font-size: 0.72rem;
  font-weight: 600;
  color: rgba(255,255,255,0.45) !important;
  text-transform: uppercase;
  letter-spacing: 0.06em;
  margin-bottom: 0.2rem;
}
.stat-value-row { display: flex; align-items: baseline; gap: 0.4rem; }
.stat-value {
  font-size: 2rem;
  font-weight: 800;
  color: #fff !important;
  line-height: 1;
}
.stat-unit {
  font-size: 0.75rem;
  color: rgba(255,255,255,0.45) !important;
  font-weight: 600;
}
.stat-bar {
  height: 4px;
  background: rgba(255,255,255,0.08);
  border-radius: 10px;
  margin-top: 0.5rem;
  overflow: hidden;
}
.stat-bar-fill {
  height: 100%;
  border-radius: 10px;
  animation: bar-grow 1.2s cubic-bezier(.17,.67,.3,1.5) forwards;
  transform-origin: left;
}
@keyframes bar-grow { from { transform: scaleX(0); } to { transform: scaleX(1); } }

.stat-trend {
  font-size: 0.7rem;
  font-weight: 600;
  color: rgba(255,255,255,0.4) !important;
  align-self: flex-start;
  background: rgba(255,255,255,0.06);
  border-radius: 50px;
  padding: 0.2rem 0.6rem;
}
.stat-trend.up { color: #4ade80 !important; background: rgba(34,197,94,0.12); }

/* ── MAIN GRID (Chart + Quick Access) ─ */
.dash-main-grid {
  display: grid;
  grid-template-columns: 1fr 320px;
  gap: 1rem;
}
@media (max-width: 992px) { .dash-main-grid { grid-template-columns: 1fr; } }

/* ── GLASS CARD ─────────────────────── */
.glass-card {
  background: rgba(18,18,34,0.78);
  backdrop-filter: blur(20px);
  border: 1px solid var(--border-subtle);
  border-radius: 20px;
  overflow: hidden;
}
.glass-card-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 1.1rem 1.3rem 0.6rem;
  border-bottom: 1px solid rgba(255,255,255,0.05);
}
.glass-card-title {
  font-size: 0.9rem;
  font-weight: 700;
  color: #fff !important;
  margin: 0;
}
.glass-card-sub {
  font-size: 0.72rem;
  color: rgba(255,255,255,0.4) !important;
  margin: 0;
}
.text-purple { color: var(--neon-purple) !important; }
.text-gold   { color: #fbbf24 !important; }
.text-cyan   { color: #22d3ee !important; }

.chart-legend { display: flex; align-items: center; gap: 0.4rem; }
.legend-dot { width: 10px; height: 10px; border-radius: 50%; display: inline-block; }
.legend-text { font-size: 0.72rem; color: rgba(255,255,255,0.4) !important; }
.chart-container { padding: 1rem 1.3rem 1.3rem; }

.badge-pill {
  font-size: 0.65rem;
  font-weight: 700;
  background: var(--neon-glow-soft);
  color: var(--neon-purple-light) !important;
  border: 1px solid var(--border-subtle);
  border-radius: 50px;
  padding: 0.2rem 0.65rem;
  text-transform: uppercase;
  letter-spacing: 0.05em;
}
.badge-live {
  display: inline-flex;
  align-items: center;
  gap: 0.4rem;
  font-size: 0.65rem;
  font-weight: 700;
  background: rgba(34,197,94,0.1);
  color: #4ade80 !important;
  border: 1px solid rgba(34,197,94,0.25);
  border-radius: 50px;
  padding: 0.2rem 0.65rem;
}
.live-dot {
  width: 7px; height: 7px;
  background: #22c55e;
  border-radius: 50%;
  animation: pulse-green 1.5s ease-in-out infinite;
}
@keyframes pulse-green {
  0%,100% { box-shadow: 0 0 0 0 rgba(34,197,94,0.6); }
  50%      { box-shadow: 0 0 0 5px rgba(34,197,94,0); }
}

/* ── QUICK LINKS ─────────────────────── */
.quick-links { padding: 0.6rem; display: flex; flex-direction: column; gap: 0.4rem; }
.quick-link-item {
  display: flex;
  align-items: center;
  gap: 0.75rem;
  padding: 0.65rem 0.75rem;
  border-radius: 12px;
  text-decoration: none;
  border: 1px solid transparent;
  transition: all 0.25s;
  background: rgba(255,255,255,0.03);
}
.quick-link-item:hover { background: rgba(255,255,255,0.06); transform: translateX(4px); }
.ql-purple:hover { border-color: var(--neon-purple) !important; background: var(--neon-glow-soft) !important; }
.ql-cyan:hover   { border-color: rgba(34,211,238,0.3); background: rgba(34,211,238,0.08) !important; }
.ql-gold:hover   { border-color: rgba(251,191,36,0.3); background: rgba(251,191,36,0.08) !important; }
.ql-green:hover  { border-color: rgba(34,197,94,0.3); background: rgba(34,197,94,0.08) !important; }
.ql-orange:hover { border-color: rgba(249,115,22,0.3); background: rgba(249,115,22,0.08) !important; }

.ql-icon {
  width: 36px; height: 36px;
  border-radius: 10px;
  display: flex; align-items: center; justify-content: center;
  font-size: 0.9rem;
  flex-shrink: 0;
}
.ql-purple .ql-icon { background: var(--neon-glow-soft); color: var(--neon-purple-light) !important; }
.ql-cyan   .ql-icon { background: rgba(34,211,238,0.15); color: #22d3ee !important; }
.ql-gold   .ql-icon { background: rgba(251,191,36,0.15); color: #fbbf24 !important; }
.ql-green  .ql-icon { background: rgba(34,197,94,0.15); color: #4ade80 !important; }
.ql-orange .ql-icon { background: rgba(249,115,22,0.15); color: #fb923c !important; }

.ql-info { flex: 1; min-width: 0; }
.ql-title { display: block; font-size: 0.8rem; font-weight: 700; color: #fff !important; }
.ql-desc  { display: block; font-size: 0.68rem; color: rgba(255,255,255,0.4) !important; }
.ql-arrow { font-size: 0.65rem; color: rgba(255,255,255,0.25) !important; transition: 0.25s; }
.quick-link-item:hover .ql-arrow { color: rgba(255,255,255,0.6) !important; }

/* ── BOTTOM GRID ─────────────────────── */
.dash-bottom-grid {
  display: grid;
  grid-template-columns: 1fr 350px;
  gap: 1rem;
}
@media (max-width: 992px) { .dash-bottom-grid { grid-template-columns: 1fr; } }

.section-label {
  font-size: 0.75rem;
  font-weight: 700;
  color: rgba(255,255,255,0.5) !important;
  text-transform: uppercase;
  letter-spacing: 0.08em;
}

/* ── FEATURE CARDS GRID ─────────────── */
.feature-cards-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 0.75rem;
}
@media (max-width: 576px) { .feature-cards-grid { grid-template-columns: 1fr; } }

.feature-card {
  position: relative;
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  padding: 1.2rem;
  border-radius: 18px;
  text-decoration: none;
  border: 1px solid transparent;
  overflow: hidden;
  background: rgba(18,18,34,0.78);
  backdrop-filter: blur(16px);
  transition: all 0.3s;
  gap: 0.75rem;
  min-height: 120px;
}
.feature-card:hover { transform: translateY(-4px); }
.fc-purple { border-color: var(--border-subtle); }
.fc-cyan   { border-color: rgba(34,211,238,0.25); }
.fc-green  { border-color: rgba(34,197,94,0.25); }
.fc-gold   { border-color: rgba(251,191,36,0.25); }

.fc-purple:hover { box-shadow: 0 10px 40px var(--neon-glow-soft); border-color: var(--neon-purple); }
.fc-cyan:hover   { box-shadow: 0 10px 40px rgba(34,211,238,0.25); border-color: rgba(34,211,238,0.5); }
.fc-green:hover  { box-shadow: 0 10px 40px rgba(34,197,94,0.25); border-color: rgba(34,197,94,0.5); }
.fc-gold:hover   { box-shadow: 0 10px 40px rgba(251,191,36,0.25); border-color: rgba(251,191,36,0.5); }

.fc-glow {
  position: absolute;
  top: -30px; right: -30px;
  width: 100px; height: 100px;
  border-radius: 50%;
  filter: blur(40px);
  opacity: 0.3;
  pointer-events: none;
  transition: opacity 0.3s;
}
.fc-purple .fc-glow { background: var(--neon-purple); }
.fc-cyan   .fc-glow { background: #22d3ee; }
.fc-green  .fc-glow { background: #22c55e; }
.fc-gold   .fc-glow { background: #fbbf24; }
.feature-card:hover .fc-glow { opacity: 0.6; }

.fc-icon {
  width: 44px; height: 44px;
  border-radius: 12px;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.1rem;
  color: #fff;
  position: relative;
  z-index: 1;
}
.fc-purple .fc-icon { background: linear-gradient(135deg, var(--neon-purple-dark), var(--neon-purple)); box-shadow: 0 4px 14px var(--neon-glow); }
.fc-cyan   .fc-icon { background: linear-gradient(135deg, #0ea5e9, #22d3ee); box-shadow: 0 4px 14px rgba(34,211,238,0.4); }
.fc-green  .fc-icon { background: linear-gradient(135deg, #16a34a, #22c55e); box-shadow: 0 4px 14px rgba(34,197,94,0.4); }
.fc-gold   .fc-icon { background: linear-gradient(135deg, #d97706, #fbbf24); box-shadow: 0 4px 14px rgba(251,191,36,0.4); }

.fc-content { position: relative; z-index: 1; }
.fc-content h6 {
  font-size: 0.85rem;
  font-weight: 700;
  color: #fff !important;
  margin-bottom: 0.2rem;
}
.fc-content p {
  font-size: 0.72rem;
  color: rgba(255,255,255,0.45) !important;
  margin: 0;
}

/* ── ACTIVITY FEED ───────────────────── */
.activity-card { height: 100%; }
.activity-feed { padding: 0.75rem 1.3rem 1rem; display: flex; flex-direction: column; gap: 0; }

.activity-item {
  display: flex;
  align-items: flex-start;
  gap: 0.75rem;
  padding: 0.6rem 0;
  position: relative;
}
.activity-dot {
  width: 10px; height: 10px;
  border-radius: 50%;
  background: linear-gradient(135deg, #b844f7, #22d3ee);
  flex-shrink: 0;
  margin-top: 0.3rem;
  box-shadow: 0 0 8px rgba(184,68,247,0.6);
}
.activity-line {
  position: absolute;
  left: 4px; top: 20px;
  width: 2px;
  height: calc(100% - 10px);
  background: linear-gradient(to bottom, rgba(184,68,247,0.3), transparent);
}
.activity-item:last-child .activity-line { display: none; }

.activity-body { flex: 1; min-width: 0; }
.activity-top { display: flex; align-items: baseline; justify-content: space-between; gap: 0.5rem; margin-bottom: 0.15rem; }
.activity-title {
  font-size: 0.82rem;
  font-weight: 700;
  color: #fff !important;
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
}
.activity-time {
  font-size: 0.65rem;
  color: rgba(255,255,255,0.35) !important;
  white-space: nowrap;
  flex-shrink: 0;
}
.activity-meta {
  font-size: 0.7rem;
  color: rgba(255,255,255,0.4) !important;
  margin: 0;
}
.activity-empty {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 2rem 1rem;
  color: rgba(255,255,255,0.3) !important;
  font-size: 0.8rem;
}
</style>
@endpush

@push('dashboard')
<script>
/* ── LIVE CLOCK ────────────────────── */
function updateClock() {
  const now = new Date();
  const h = String(now.getHours()).padStart(2,'0');
  const m = String(now.getMinutes()).padStart(2,'0');
  const s = String(now.getSeconds()).padStart(2,'0');
  const el = document.getElementById('live-clock');
  if(el) el.textContent = `${h}:${m}:${s}`;
}
updateClock();
setInterval(updateClock, 1000);

/* ── PARTICLE BACKGROUND ────────────── */
(function() {
  const canvas = document.getElementById('particles-canvas');
  const ctx    = canvas.getContext('2d');
  let W, H, particles = [];
  const COLORS = ['rgba(184,68,247,', 'rgba(34,211,238,', 'rgba(251,191,36,', 'rgba(34,197,94,'];

  function resize() {
    W = canvas.width  = window.innerWidth;
    H = canvas.height = window.innerHeight;
  }
  resize();
  window.addEventListener('resize', resize);

  function Particle() {
    this.x  = Math.random() * W;
    this.y  = Math.random() * H;
    this.r  = Math.random() * 1.5 + 0.3;
    this.vx = (Math.random() - 0.5) * 0.3;
    this.vy = (Math.random() - 0.5) * 0.3;
    this.a  = Math.random() * 0.5 + 0.1;
    this.c  = COLORS[Math.floor(Math.random() * COLORS.length)];
  }
  Particle.prototype.draw = function() {
    ctx.beginPath();
    ctx.arc(this.x, this.y, this.r, 0, Math.PI * 2);
    ctx.fillStyle = this.c + this.a + ')';
    ctx.fill();
  };
  Particle.prototype.update = function() {
    this.x += this.vx;
    this.y += this.vy;
    if(this.x < 0 || this.x > W) this.vx *= -1;
    if(this.y < 0 || this.y > H) this.vy *= -1;
  };

  for(let i = 0; i < 90; i++) particles.push(new Particle());

  function connect() {
    for(let i = 0; i < particles.length; i++) {
      for(let j = i+1; j < particles.length; j++) {
        const dx = particles[i].x - particles[j].x;
        const dy = particles[i].y - particles[j].y;
        const d  = Math.sqrt(dx*dx + dy*dy);
        if(d < 120) {
          ctx.beginPath();
          ctx.strokeStyle = 'rgba(184,68,247,' + (0.08 * (1 - d/120)) + ')';
          ctx.lineWidth = 0.5;
          ctx.moveTo(particles[i].x, particles[i].y);
          ctx.lineTo(particles[j].x, particles[j].y);
          ctx.stroke();
        }
      }
    }
  }

  function animate() {
    ctx.clearRect(0, 0, W, H);
    particles.forEach(p => { p.update(); p.draw(); });
    connect();
    requestAnimationFrame(animate);
  }
  animate();
})();

/* ── PRODUCTION CHART ───────────────── */
document.addEventListener('DOMContentLoaded', function() {
  const labels = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
  const rawData = @json($produksiBulanan ?? []);
  const chartData = new Array(12).fill(0);
  rawData.forEach(function(item) {
    if(item.bulan >= 1 && item.bulan <= 12) chartData[item.bulan - 1] = parseFloat(item.total) || 0;
  });

  const ctx2 = document.getElementById('productionChart');
  if(!ctx2) return;

  function getThemeColors() {
    const style = getComputedStyle(document.documentElement);
    return {
      primary: style.getPropertyValue('--neon-purple').trim() || '#b844f7',
      glow: style.getPropertyValue('--neon-glow').trim() || 'rgba(184,68,247,0.4)',
      glowSoft: style.getPropertyValue('--neon-glow-soft').trim() || 'rgba(184,68,247,0.15)'
    };
  }

  const tc = getThemeColors();
  const cContext = ctx2.getContext('2d');
  function createGradient(color1, color2) {
    const g = cContext.createLinearGradient(0, 0, 0, 260);
    g.addColorStop(0, color1);
    g.addColorStop(0.5, color2);
    g.addColorStop(1, 'rgba(0,0,0,0)');
    return g;
  }

  window.agroviaProductionChart = new Chart(ctx2, {
    type: 'line',
    data: {
      labels: labels,
      datasets: [{
        label: 'Produksi (Kg)',
        data: chartData,
        borderColor: tc.primary,
        borderWidth: 2.5,
        pointBackgroundColor: tc.primary,
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        pointRadius: 5,
        pointHoverRadius: 8,
        fill: true,
        backgroundColor: createGradient(tc.glow, tc.glowSoft),
        tension: 0.4,
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      plugins: {
        legend: { display: false },
        tooltip: {
          backgroundColor: 'rgba(18,18,34,0.95)',
          borderColor: tc.primary,
          borderWidth: 1,
          titleColor: '#fff',
          bodyColor: '#fff',
          callbacks: {
            label: function(ctx) {
              return ' ' + ctx.parsed.y.toLocaleString('id-ID') + ' Kg';
            }
          }
        }
      },
      scales: {
        x: {
          grid: { color: 'rgba(255,255,255,0.04)', drawBorder: false },
          ticks: { color: 'rgba(255,255,255,0.4)', font: { size: 11, family: 'Poppins' } }
        },
        y: {
          grid: { color: 'rgba(255,255,255,0.04)', drawBorder: false },
          ticks: {
            color: 'rgba(255,255,255,0.4)',
            font: { size: 11, family: 'Poppins' },
            callback: function(v) { return v.toLocaleString('id-ID') + ' Kg'; }
          },
          beginAtZero: true
        }
      }
    }
  });

  window.addEventListener('agrovia-theme-change', function(e) {
    if (!window.agroviaProductionChart) return;
    const p = e.detail.preset;
    const chart = window.agroviaProductionChart;
    chart.data.datasets[0].borderColor = p.primary;
    chart.data.datasets[0].pointBackgroundColor = p.primary;
    chart.data.datasets[0].backgroundColor = createGradient(p.glow, p.glowSoft);
    if (chart.options.plugins.tooltip) {
      chart.options.plugins.tooltip.borderColor = p.primary;
    }
    chart.update();
  });
});
</script>
@endpush
@endsection