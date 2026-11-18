<div class="fixed-plugin">
  <a class="fixed-plugin-button text-white position-fixed px-3 py-2" title="Pengaturan Tampilan">
    <i class="fa fa-cog py-2"> </i>
  </a>
  <div class="card shadow-lg fixed-plugin-card">
    {{-- Header --}}
    <div class="card-header pb-0 pt-3 bg-transparent border-bottom border-subtle">
      <div class="d-flex align-items-center justify-content-between">
        <div>
          <h5 class="mt-2 mb-0 text-white fw-bold d-flex align-items-center gap-2">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="var(--neon-purple)" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
              <circle cx="12" cy="12" r="10"/>
              <path d="M12 2a14.5 14.5 0 0 0 0 20 10 10 0 0 0 0-20"/>
              <path d="M2 12h20"/>
            </svg>
            Warna Tampilan
          </h5>
          <p class="text-xs text-muted mb-2">Pilih warna tema & aksen dashboard</p>
        </div>
        <button class="btn btn-link text-white p-0 fixed-plugin-close-button" style="font-size: 1.1rem; opacity: 0.7;">
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
          </svg>
        </button>
      </div>
    </div>

    {{-- Body --}}
    <div class="card-body pt-3">
      {{-- Section 1: Pilihan Warna Aksen --}}
      <div class="mb-4">
        <label class="text-xs font-weight-bold text-uppercase d-block mb-2" style="color: var(--neon-purple-light); letter-spacing: 0.08em;">
          Pilih Warna Aksen Neon
        </label>
        <div class="theme-color-grid">
          {{-- Purple --}}
          <button type="button" class="theme-color-btn active" data-theme="purple" onclick="setAgroviaTheme('purple', this)" title="Ungu Neon">
            <span class="color-swatch-circle" style="background: linear-gradient(135deg, #8b2fd4, #b844f7); box-shadow: 0 0 12px rgba(184, 68, 247, 0.7);"></span>
            <span class="color-name-label">Ungu</span>
          </button>

          {{-- Green --}}
          <button type="button" class="theme-color-btn" data-theme="green" onclick="setAgroviaTheme('green', this)" title="Hijau Sawit">
            <span class="color-swatch-circle" style="background: linear-gradient(135deg, #15803d, #22c55e); box-shadow: 0 0 12px rgba(34, 197, 94, 0.7);"></span>
            <span class="color-name-label">Hijau</span>
          </button>

          {{-- Cyan --}}
          <button type="button" class="theme-color-btn" data-theme="cyan" onclick="setAgroviaTheme('cyan', this)" title="Cyan Cyber">
            <span class="color-swatch-circle" style="background: linear-gradient(135deg, #0e7490, #06b6d4); box-shadow: 0 0 12px rgba(6, 182, 212, 0.7);"></span>
            <span class="color-name-label">Cyan</span>
          </button>

          {{-- Gold --}}
          <button type="button" class="theme-color-btn" data-theme="gold" onclick="setAgroviaTheme('gold', this)" title="Emas Panen">
            <span class="color-swatch-circle" style="background: linear-gradient(135deg, #b45309, #f59e0b); box-shadow: 0 0 12px rgba(245, 158, 11, 0.7);"></span>
            <span class="color-name-label">Emas</span>
          </button>

          {{-- Rose --}}
          <button type="button" class="theme-color-btn" data-theme="rose" onclick="setAgroviaTheme('rose', this)" title="Ruby Merah">
            <span class="color-swatch-circle" style="background: linear-gradient(135deg, #be123c, #f43f5e); box-shadow: 0 0 12px rgba(244, 63, 94, 0.7);"></span>
            <span class="color-name-label">Merah</span>
          </button>

          {{-- Pink --}}
          <button type="button" class="theme-color-btn" data-theme="pink" onclick="setAgroviaTheme('pink', this)" title="Neon Pink">
            <span class="color-swatch-circle" style="background: linear-gradient(135deg, #be185d, #ec4899); box-shadow: 0 0 12px rgba(236, 72, 153, 0.7);"></span>
            <span class="color-name-label">Pink</span>
          </button>
        </div>
      </div>

      <hr class="horizontal dark my-3" style="border-color: rgba(255, 255, 255, 0.1) !important;">

      {{-- Section 2: Kecerahan Video Latar Belakang --}}
      <div class="mb-4">
        <label class="text-xs font-weight-bold text-uppercase d-block mb-2" style="color: var(--neon-purple-light); letter-spacing: 0.08em;">
          Kecerahan Video Background
        </label>
        <div class="btn-group w-100 bg-dark-subtle p-1 rounded-3" role="group">
          <button type="button" class="btn btn-sm btn-dim active" data-dim="0.45" onclick="setBgDim('0.45', this)">Redup</button>
          <button type="button" class="btn btn-sm btn-dim" data-dim="0.65" onclick="setBgDim('0.65', this)">Normal</button>
          <button type="button" class="btn btn-sm btn-dim" data-dim="0.85" onclick="setBgDim('0.85', this)">Terang</button>
        </div>
      </div>

      <hr class="horizontal dark my-3" style="border-color: rgba(255, 255, 255, 0.1) !important;">

      {{-- Section 3: Reset --}}
      <div>
        <button type="button" class="btn btn-outline-secondary w-100 py-2 text-xs fw-bold" onclick="resetAgroviaTheme()">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1">
            <path d="M3 12a9 9 0 1 0 9-9 9.75 9.75 0 0 0-6.74 2.74L3 8"/>
            <path d="M3 3v5h5"/>
          </svg>
          Kembalikan ke Default
        </button>
      </div>

    </div>
  </div>
</div>

<style>
/* ── CONFIGURATOR DRAWER STYLES ── */
.fixed-plugin .fixed-plugin-button {
  background: rgba(18, 19, 35, 0.85) !important;
  border: 1px solid var(--border-subtle) !important;
  color: #fff !important;
  box-shadow: 0 4px 18px var(--neon-glow-soft) !important;
  border-radius: 50% !important;
  width: 45px;
  height: 45px;
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 1050;
  transition: all 0.3s ease;
}
.fixed-plugin .fixed-plugin-button:hover {
  transform: rotate(45deg) scale(1.1);
  box-shadow: 0 0 20px var(--neon-glow) !important;
}

.fixed-plugin-card {
  background: rgba(14, 15, 28, 0.96) !important;
  backdrop-filter: blur(25px) !important;
  -webkit-backdrop-filter: blur(25px) !important;
  border-left: 1px solid var(--border-subtle) !important;
  color: #fff !important;
  width: 320px !important;
}

.theme-color-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 0.65rem;
}

.theme-color-btn {
  background: rgba(255, 255, 255, 0.04);
  border: 1.5px solid rgba(255, 255, 255, 0.1);
  border-radius: 12px;
  padding: 0.65rem 0.5rem;
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.45rem;
  cursor: pointer;
  transition: all 0.22s ease;
}

.theme-color-btn:hover {
  background: rgba(255, 255, 255, 0.08);
  border-color: rgba(255, 255, 255, 0.25);
  transform: translateY(-2px);
}

.theme-color-btn.active {
  background: rgba(255, 255, 255, 0.12);
  border-color: var(--neon-purple) !important;
  box-shadow: 0 0 15px var(--neon-glow-soft);
}

.color-swatch-circle {
  width: 28px;
  height: 28px;
  border-radius: 50%;
  display: block;
}

.color-name-label {
  font-size: 0.72rem;
  font-weight: 700;
  color: #fff;
}

.btn-dim {
  background: transparent;
  color: rgba(255, 255, 255, 0.6);
  border: none;
  font-weight: 600;
  font-size: 0.75rem;
  padding: 0.4rem 0.6rem;
  border-radius: 8px;
  transition: all 0.2s;
}

.btn-dim.active, .btn-dim:hover {
  background: var(--neon-purple) !important;
  color: #fff !important;
  box-shadow: 0 0 10px var(--neon-glow-soft);
}
</style>

<script>
// Pastikan fungsi window.setAgroviaTheme selalu tersedia
if (typeof window.setAgroviaTheme !== 'function') {
  window.setAgroviaTheme = function(themeKey, btnEl) {
    if (window.parent && typeof window.parent.setAgroviaTheme === 'function') {
      window.parent.setAgroviaTheme(themeKey, btnEl);
    }
  };
}

// Inisialisasi event tombol drawer & sinkronisasi UI saat DOM siap
document.addEventListener('DOMContentLoaded', function() {
  const fp = document.querySelector('.fixed-plugin');
  const btn = document.querySelector('.fixed-plugin-button');
  const closeBtn = document.querySelector('.fixed-plugin-close-button');

  if (btn && fp) {
    btn.addEventListener('click', function(e) {
      e.stopPropagation();
      fp.classList.toggle('show');
    });
  }

  if (closeBtn && fp) {
    closeBtn.addEventListener('click', function(e) {
      e.stopPropagation();
      fp.classList.remove('show');
    });
  }

  // Klik di luar panel menutup drawer
  document.addEventListener('click', function(e) {
    if (fp && fp.classList.contains('show')) {
      if (!fp.contains(e.target)) {
        fp.classList.remove('show');
      }
    }
  });

  // Sinkronkan tombol tema aktif
  const currentTheme = localStorage.getItem('agrovia_accent_theme') || 'purple';
  const themeBtn = document.querySelector(`.theme-color-btn[data-theme="${currentTheme}"]`);
  if (themeBtn) {
    document.querySelectorAll('.theme-color-btn').forEach(b => b.classList.remove('active'));
    themeBtn.classList.add('active');
  }

  // Sinkronkan kecerahan video
  const currentDim = localStorage.getItem('agrovia_bg_dim') || '0.65';
  const dimBtn = document.querySelector(`.btn-dim[data-dim="${currentDim}"]`);
  if (dimBtn) {
    document.querySelectorAll('.btn-dim').forEach(b => b.classList.remove('active'));
    dimBtn.classList.add('active');
  }
  const media = document.querySelector('.video-bg-media');
  if (media) {
    media.style.filter = `brightness(${currentDim}) contrast(1.15) saturate(1.2)`;
  }
});
</script>
