<div class="fixed-plugin">
  <a class="fixed-plugin-button text-white position-fixed px-3 py-2" id="agrovia-plugin-toggle" title="Pengaturan Tampilan" onclick="toggleAgroviaConfigurator(event)">
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
        <button type="button" class="btn btn-link text-white p-0 fixed-plugin-close-button" onclick="closeAgroviaConfigurator(event)" style="font-size: 1.1rem; opacity: 0.7;">
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

      {{-- Section 3: Efek Suara Interaktif (UI Sound Effects) --}}
      <div class="mb-4">
        <div class="d-flex align-items-center justify-content-between p-2 rounded-3" style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.08);">
          <div>
            <label class="text-xs font-weight-bold text-uppercase d-block mb-0" style="color: var(--neon-purple-light); letter-spacing: 0.06em;">
              🔊 Suara Hover & Klik
            </label>
            <span class="text-xxs text-muted" id="agroviaSoundStatusLabel" style="font-size: 0.68rem;">Efek audio taktil aktif</span>
          </div>
          <div class="form-check form-switch ps-0 mb-0">
            <input class="form-check-input ms-auto" type="checkbox" id="agroviaSoundSwitch" checked onchange="toggleAgroviaSound(this)" style="cursor: pointer;">
          </div>
        </div>
      </div>

      <hr class="horizontal dark my-3" style="border-color: rgba(255, 255, 255, 0.1) !important;">

      {{-- Section 4: Reset --}}
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
.fixed-plugin {
  position: fixed !important;
  z-index: 99990 !important;
}

.fixed-plugin .fixed-plugin-button {
  background: rgba(18, 19, 35, 0.88) !important;
  border: 1.5px solid var(--neon-purple, #b844f7) !important;
  color: #fff !important;
  box-shadow: 0 4px 20px var(--neon-glow, rgba(184, 68, 247, 0.5)) !important;
  border-radius: 50% !important;
  width: 48px !important;
  height: 48px !important;
  display: flex !important;
  align-items: center !important;
  justify-content: center !important;
  bottom: 25px !important;
  right: 25px !important;
  position: fixed !important;
  z-index: 99995 !important;
  cursor: pointer !important;
  transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275) !important;
}

.fixed-plugin .fixed-plugin-button i {
  pointer-events: none !important;
  font-size: 1.15rem !important;
}

.fixed-plugin .fixed-plugin-button:hover {
  transform: rotate(60deg) scale(1.12) !important;
  box-shadow: 0 0 25px var(--neon-purple, #b844f7) !important;
}

.fixed-plugin-card {
  position: fixed !important;
  top: 0 !important;
  right: -380px !important;
  bottom: 0 !important;
  height: 100vh !important;
  width: 320px !important;
  background: rgba(14, 15, 28, 0.97) !important;
  backdrop-filter: blur(25px) !important;
  -webkit-backdrop-filter: blur(25px) !important;
  border-left: 1px solid var(--border-subtle, rgba(184, 68, 247, 0.3)) !important;
  box-shadow: -10px 0 40px rgba(0, 0, 0, 0.8) !important;
  color: #fff !important;
  z-index: 99999 !important;
  transition: right 0.35s cubic-bezier(0.16, 1, 0.3, 1) !important;
}

.fixed-plugin.show .fixed-plugin-card {
  right: 0 !important;
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
  border-color: var(--neon-purple, #b844f7) !important;
  box-shadow: 0 0 15px var(--neon-glow-soft, rgba(184, 68, 247, 0.3));
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
  background: var(--neon-purple, #b844f7) !important;
  color: #fff !important;
  box-shadow: 0 0 10px var(--neon-glow-soft, rgba(184, 68, 247, 0.3));
}
</style>

<script>
// Fungsi eksplisit untuk membuka dan menutup konfigurator
window.toggleAgroviaConfigurator = function(e) {
  if (e) {
    e.preventDefault();
    e.stopPropagation();
  }
  const fp = document.querySelector('.fixed-plugin');
  if (fp) {
    fp.classList.toggle('show');
  }
};

window.closeAgroviaConfigurator = function(e) {
  if (e) {
    e.preventDefault();
    e.stopPropagation();
  }
  const fp = document.querySelector('.fixed-plugin');
  if (fp) {
    fp.classList.remove('show');
  }
};

// Inisialisasi event & sinkronisasi UI saat DOM siap
document.addEventListener('DOMContentLoaded', function() {
  const fp = document.querySelector('.fixed-plugin');
  const btn = document.getElementById('agrovia-plugin-toggle');

  // Bersihkan handler onclick lama dari template bawaan agar tidak saling menimpa
  if (btn) {
    btn.onclick = window.toggleAgroviaConfigurator;
  }

  // Klik di luar panel menutup drawer
  window.addEventListener('click', function(e) {
    if (!fp || !fp.classList.contains('show')) return;
    if (e.target.closest('.fixed-plugin-card') || e.target.closest('#agrovia-plugin-toggle')) {
      return;
    }
    fp.classList.remove('show');
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
  // Sinkronkan toggle suara UI
  const soundSwitch = document.getElementById('agroviaSoundSwitch');
  const soundLabel = document.getElementById('agroviaSoundStatusLabel');
  const isSoundActive = localStorage.getItem('agrovia_sound_enabled') !== 'false';
  if (soundSwitch) {
    soundSwitch.checked = isSoundActive;
    if (soundLabel) {
      soundLabel.textContent = isSoundActive ? 'Efek audio taktil aktif' : 'Efek audio dinonaktifkan';
    }
  }
});

// Fungsi handler toggle suara
window.toggleAgroviaSound = function(checkbox) {
  if (window.AgroviaSound) {
    window.AgroviaSound.setEnabled(checkbox.checked);
    const soundLabel = document.getElementById('agroviaSoundStatusLabel');
    if (soundLabel) {
      soundLabel.textContent = checkbox.checked ? 'Efek audio taktil aktif' : 'Efek audio dinonaktifkan';
    }
    if (checkbox.checked) {
      window.AgroviaSound.click();
    }
  }
};
</script>
