@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">

  {{-- Header --}}
  <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
      <h5 class="mb-0 fw-bold" style="color:#fff;">👷 Data Pekerja Perkebunan</h5>
      <p class="text-sm mb-0" style="color:rgba(255,255,255,0.45);">Daftar seluruh tim mandor, pemanen, dan karyawan kebun</p>
    </div>
    @if(auth()->user()->role === 'admin')
    <a href="{{ route('pekerja.create') }}" class="btn-agrovia-add">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
      Tambah Pekerja
    </a>
    @endif
  </div>

  {{-- Table Card --}}
  <div class="agr-table-card">

    <div class="agr-table-toolbar">
      <div class="agr-toolbar-left">
        <div class="agr-search-box">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#b844f7" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" id="searchPekerja" placeholder="Cari nama atau jabatan..." onkeyup="filterPekerja()">
        </div>
      </div>
      <div class="agr-toolbar-right">
        <span class="agr-count-badge">
          <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/></svg>
          {{ $data->count() }} Orang Terdaftar
        </span>
      </div>
    </div>

    <div class="table-responsive">
      <table class="agr-table" id="pekerjaTable">
        <thead>
          <tr>
            <th><span class="th-label">No</span></th>
            <th><span class="th-label">Pekerja</span></th>
            <th><span class="th-label">Jabatan</span></th>
            <th><span class="th-label">Kontak / Telepon</span></th>
            @if(auth()->user()->role === 'admin')
            <th class="text-center"><span class="th-label">Aksi</span></th>
            @endif
          </tr>
        </thead>
        <tbody>
          @forelse($data as $i => $p)
          <tr>
            <td style="width: 60px;"><span class="agr-no">{{ $i + 1 }}</span></td>
            <td>
              <div class="d-flex align-items-center gap-2">
                <div class="agr-avatar-circle">
                  {{ strtoupper(substr($p->nama, 0, 1)) }}
                </div>
                <span class="fw-bold text-white">{{ $p->nama }}</span>
              </div>
            </td>
            <td>
              <span class="agr-tag agr-tag-cyan">
                {{ $p->jabatan ?? 'Karyawan' }}
              </span>
            </td>
            <td>
              <span style="color: rgba(255,255,255,0.7); font-size: 0.85rem;">
                {{ $p->telp ?? '— Tidak ada no. hp' }}
              </span>
            </td>
            @if(auth()->user()->role === 'admin')
            <td class="text-center" style="width: 140px;">
              <div class="agr-action-group">
                <a href="{{ route('pekerja.edit', $p) }}" class="agr-btn-edit" title="Edit Data Pekerja">
                  <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                </a>
                <form action="{{ route('pekerja.destroy', $p) }}" method="POST" class="d-inline form-delete">
                  @csrf @method('DELETE')
                  <button class="agr-btn-delete" title="Hapus Pekerja">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                  </button>
                </form>
              </div>
            </td>
            @endif
          </tr>
          @empty
          <tr>
            <td colspan="5" class="agr-empty-state">Belum ada data pekerja.</td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

  </div>
</div>

@push('css')
<style>
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
  background: rgba(14,14,28,0.85);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(184,68,247,0.18);
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
  border: 1px solid rgba(184,68,247,0.25);
  border-radius: 50px; padding: 0.4rem 1rem;
}
.agr-search-box input {
  background: transparent !important; border: none !important; outline: none !important;
  color: #fff !important; font-size: 0.8rem; width: 180px; font-family: 'Poppins', sans-serif;
}
.agr-search-box input::placeholder { color: rgba(255,255,255,0.3) !important; }
.agr-count-badge {
  display: inline-flex; align-items: center;
  background: rgba(184,68,247,0.12); color: #d580ff !important;
  border: 1px solid rgba(184,68,247,0.3); border-radius: 50px;
  padding: 0.3rem 0.8rem; font-size: 0.72rem; font-weight: 700;
}
.agr-table { width: 100%; border-collapse: separate; border-spacing: 0; }
.agr-table thead th {
  padding: 0.75rem 1.25rem;
  background: rgba(255,255,255,0.03);
  border-bottom: 1px solid rgba(184,68,247,0.15);
}
.th-label {
  font-size: 0.65rem; font-weight: 800; letter-spacing: 0.08em;
  text-transform: uppercase; color: rgba(184,68,247,0.8) !important;
}
.agr-table tbody tr {
  border-bottom: 1px solid rgba(255,255,255,0.03);
  transition: background 0.2s;
}
.agr-table tbody tr:hover { background: rgba(184,68,247,0.06); }
.agr-table tbody td { padding: 0.85rem 1.25rem; vertical-align: middle; color: rgba(255,255,255,0.9) !important; font-size: 0.85rem; }
.agr-no {
  display: inline-flex; align-items: center; justify-content: center;
  width: 26px; height: 26px; border-radius: 8px;
  background: rgba(184,68,247,0.12); color: #d580ff !important;
  font-size: 0.75rem; font-weight: 700;
}
.agr-avatar-circle {
  width: 32px; height: 32px; border-radius: 9px;
  background: linear-gradient(135deg, #0284c7, #38bdf8);
  display: flex; align-items: center; justify-content: center;
  color: #fff; font-weight: 800; font-size: 0.8rem;
  box-shadow: 0 0 10px rgba(56,189,248,0.35);
}
.agr-tag-cyan {
  display: inline-flex; align-items: center;
  padding: 0.3rem 0.75rem; border-radius: 50px;
  font-size: 0.75rem; font-weight: 700;
  background: rgba(14,165,233,0.12); color: #38bdf8 !important;
  border: 1px solid rgba(14,165,233,0.25);
}
.agr-action-group { display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
.agr-btn-edit, .agr-btn-delete {
  width: 32px; height: 32px; border-radius: 8px;
  display: inline-flex; align-items: center; justify-content: center;
  border: none; cursor: pointer; transition: all 0.22s; text-decoration: none;
}
.agr-btn-edit { background: rgba(99,102,241,0.15); color: #818cf8 !important; border: 1px solid rgba(99,102,241,0.3); }
.agr-btn-edit:hover { background: rgba(99,102,241,0.35); transform: scale(1.1); color: #fff !important; }
.agr-btn-delete { background: rgba(239,68,68,0.12); color: #f87171 !important; border: 1px solid rgba(239,68,68,0.25); }
.agr-btn-delete:hover { background: rgba(239,68,68,0.35); transform: scale(1.1); color: #fff !important; }
.agr-empty-state { text-align: center; padding: 3rem; color: rgba(255,255,255,0.4) !important; }
</style>
@endpush

@push('dashboard')
<script>
function filterPekerja() {
  const q = document.getElementById('searchPekerja').value.toLowerCase();
  const rows = document.querySelectorAll('#pekerjaTable tbody tr');
  rows.forEach(r => {
    r.style.display = r.textContent.toLowerCase().includes(q) ? '' : 'none';
  });
}
</script>
@endpush
@endsection
