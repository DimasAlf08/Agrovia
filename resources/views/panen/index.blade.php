@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">

  {{-- Header --}}
  <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
      <h5 class="mb-0 fw-bold" style="color:#fff;">🌾 Data Hasil Panen TBS</h5>
      <p class="text-sm mb-0" style="color:rgba(255,255,255,0.4);">Kelola dan pantau seluruh catatan hasil panen</p>
    </div>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('panen.create') }}" class="btn-agrovia-add">
      <i class="fas fa-plus me-2"></i>Catat Panen Baru
    </a>
    @endif
  </div>

  {{-- Table Card --}}
  <div class="agr-table-card">

    {{-- Search & info bar --}}
    <div class="agr-table-toolbar">
      <div class="agr-toolbar-left">
        <div class="agr-search-box">
          <i class="fas fa-search"></i>
          <input type="text" id="searchInput" placeholder="Cari data panen..." onkeyup="filterTable()">
        </div>
      </div>
      <div class="agr-toolbar-right">
        <span class="agr-count-badge">
          <i class="fas fa-database me-1"></i>
          {{ $data->count() }} Data
        </span>
      </div>
    </div>

    {{-- Table --}}
    <div class="table-responsive">
      <table class="agr-table" id="panenTable">
        <thead>
          <tr>
            <th><span class="th-label">No</span></th>
            <th><span class="th-label">Tanggal</span></th>
            <th><span class="th-label">Lahan</span></th>
            <th><span class="th-label">Pekerja / Tim</span></th>
            <th><span class="th-label">Berat (Kg)</span></th>
            @if(auth()->user()->role === 'admin')
            <th class="text-center"><span class="th-label">Aksi</span></th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($data as $i => $p)
          <tr>
            <td><span class="agr-no">{{ $i + 1 }}</span></td>
            <td>
              <div class="agr-date-cell">
                <i class="fas fa-calendar-alt me-2" style="color:#b844f7;font-size:0.75rem;"></i>
                {{ $p->tanggal->format('d M Y') }}
              </div>
            </td>
            <td>
              <span class="agr-tag agr-tag-purple">
                <i class="fas fa-map-pin me-1"></i>{{ $p->lahan->nama_lahan ?? '-' }}
              </span>
            </td>
            <td>
              @if($p->pekerja)
              <div class="agr-worker-cell">
                <div class="agr-worker-avatar">{{ strtoupper(substr($p->pekerja->nama, 0, 1)) }}</div>
                <span>{{ $p->pekerja->nama }}</span>
              </div>
              @else
              <span style="color:rgba(255,255,255,0.3);font-size:0.78rem;">— Tidak ditentukan</span>
              @endif
            </td>
            <td>
              <span class="agr-weight">{{ number_format($p->berat, 0, ',', '.') }} <small>Kg</small></span>
            </td>
            @if(auth()->user()->role === 'admin')
            <td class="text-center">
              <div class="agr-action-group">
                <a href="{{ route('panen.edit', $p) }}" class="agr-btn-edit" title="Edit">
                  <i class="fas fa-pen"></i>
                </a>
                <form action="{{ route('panen.destroy', $p) }}" method="POST" class="d-inline" onsubmit="return confirm('Hapus data ini?')">
                  @csrf @method('DELETE')
                  <button class="agr-btn-delete" title="Hapus">
                    <i class="fas fa-trash"></i>
                  </button>
                </form>
              </div>
            </td>
            @endif
          </tr>
          @empty
          <tr>
            <td colspan="6" class="agr-empty-state">
              <i class="fas fa-inbox fa-2x mb-2 d-block" style="opacity:0.3;"></i>
              Belum ada data panen.
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>

@push('css')
<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap");
/* ── SHARED TABLE STYLES ──────────────────── */
.btn-agrovia-add {
  display: inline-flex; align-items: center;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  color: #fff !important; border: none; border-radius: 50px;
  padding: 0.55rem 1.3rem; font-size: 0.82rem; font-weight: 700;
  box-shadow: 0 4px 16px rgba(34,197,94,0.35); text-decoration: none;
  transition: all 0.3s;
}
.btn-agrovia-add:hover {
  transform: translateY(-2px); box-shadow: 0 8px 24px rgba(34,197,94,0.5);
  color: #fff !important;
}
.agr-table-card {
  background: rgba(14,14,28,0.82);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(184,68,247,0.15);
  border-radius: 20px;
  overflow: hidden;
}
.agr-table-toolbar {
  display: flex; align-items: center; justify-content: space-between;
  padding: 1rem 1.25rem;
  border-bottom: 1px solid rgba(255,255,255,0.05);
  flex-wrap: wrap; gap: 0.75rem;
}
.agr-toolbar-left, .agr-toolbar-right { display: flex; align-items: center; gap: 0.5rem; }
.agr-search-box {
  display: flex; align-items: center; gap: 0.5rem;
  background: rgba(255,255,255,0.05);
  border: 1px solid rgba(184,68,247,0.2);
  border-radius: 50px; padding: 0.4rem 1rem;
  transition: all 0.25s;
}
.agr-search-box:focus-within {
  border-color: rgba(184,68,247,0.5);
  box-shadow: 0 0 0 3px rgba(184,68,247,0.1);
  background: rgba(184,68,247,0.07);
}
.agr-search-box i { font-size: 0.75rem; color: rgba(184,68,247,0.6) !important; }
.agr-search-box input {
  background: transparent !important; border: none !important; outline: none !important;
  color: #fff !important; font-size: 0.8rem; width: 180px;
  font-family: 'Poppins', sans-serif;
}
.agr-search-box input::placeholder { color: rgba(255,255,255,0.3) !important; }
.agr-count-badge {
  display: inline-flex; align-items: center;
  background: rgba(184,68,247,0.1); color: #d580ff !important;
  border: 1px solid rgba(184,68,247,0.25); border-radius: 50px;
  padding: 0.3rem 0.8rem; font-size: 0.72rem; font-weight: 700;
}
/* Table */
.agr-table { width: 100%; border-collapse: separate; border-spacing: 0; }
.agr-table thead th {
  padding: 0.75rem 1rem;
  background: rgba(255,255,255,0.03);
  border-bottom: 1px solid rgba(184,68,247,0.12);
}
.th-label {
  font-size: 0.65rem; font-weight: 800; letter-spacing: 0.08em;
  text-transform: uppercase; color: rgba(184,68,247,0.7) !important;
}
.agr-table tbody tr {
  border-bottom: 1px solid rgba(255,255,255,0.03);
  transition: background 0.2s;
}
.agr-table tbody tr:hover { background: rgba(184,68,247,0.05); }
.agr-table tbody td { padding: 0.75rem 1rem; vertical-align: middle; color: rgba(255,255,255,0.85) !important; font-size: 0.83rem; }
.agr-no {
  display: inline-flex; align-items: center; justify-content: center;
  width: 24px; height: 24px; border-radius: 6px;
  background: rgba(184,68,247,0.12); color: #d580ff !important;
  font-size: 0.72rem; font-weight: 700;
}
.agr-date-cell { display: flex; align-items: center; color: rgba(255,255,255,0.8) !important; font-size: 0.82rem; }
.agr-tag {
  display: inline-flex; align-items: center;
  padding: 0.25rem 0.65rem; border-radius: 50px;
  font-size: 0.72rem; font-weight: 700;
}
.agr-tag-purple { background: rgba(184,68,247,0.12); color: #d580ff !important; border: 1px solid rgba(184,68,247,0.2); }
.agr-tag-green  { background: rgba(34,197,94,0.12);  color: #4ade80 !important; border: 1px solid rgba(34,197,94,0.2); }
.agr-tag-cyan   { background: rgba(34,211,238,0.12); color: #22d3ee !important; border: 1px solid rgba(34,211,238,0.2); }
.agr-worker-cell { display: flex; align-items: center; gap: 0.5rem; }
.agr-worker-avatar {
  width: 26px; height: 26px; border-radius: 7px; flex-shrink: 0;
  background: linear-gradient(135deg, #0ea5e9, #22d3ee);
  display: flex; align-items: center; justify-content: center;
  font-size: 0.7rem; font-weight: 800; color: #fff !important;
}
.agr-weight { font-size: 0.88rem; font-weight: 700; color: #4ade80 !important; }
.agr-weight small { font-size: 0.65rem; color: rgba(255,255,255,0.4) !important; font-weight: 600; }
.agr-action-group { display: flex; align-items: center; justify-content: center; gap: 0.4rem; }
.agr-btn-edit, .agr-btn-delete {
  width: 30px; height: 30px; border-radius: 8px;
  display: inline-flex; align-items: center; justify-content: center;
  font-size: 0.72rem; border: none; cursor: pointer;
  transition: all 0.22s; text-decoration: none;
}
.agr-btn-edit { background: rgba(99,102,241,0.15); color: #818cf8 !important; border: 1px solid rgba(99,102,241,0.25); }
.agr-btn-edit:hover { background: rgba(99,102,241,0.3); transform: scale(1.1); color: #fff !important; }
.agr-btn-delete { background: rgba(239,68,68,0.12); color: #f87171 !important; border: 1px solid rgba(239,68,68,0.2); }
.agr-btn-delete:hover { background: rgba(239,68,68,0.3); transform: scale(1.1); color: #fff !important; }
.agr-empty-state { text-align: center; padding: 3rem; color: rgba(255,255,255,0.3) !important; font-size: 0.85rem; }
</style>
@endpush

@push('dashboard')
<script>
function filterTable() {
  const q = document.getElementById('searchInput').value.toLowerCase();
  const rows = document.querySelectorAll('#panenTable tbody tr');
  rows.forEach(r => {
    r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
}
</script>
@endpush
@endsection
