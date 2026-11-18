@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">

    <!-- Tombol Navigasi & Export -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
        <a href="{{ route('laporan.index') }}" class="btn btn-sm btn-outline-secondary mb-0">
            <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali ke Filter
        </a>
        <a href="{{ route('laporan.export', ['tahun'=>$tahun]) }}" class="btn btn-sm btn-agrovia-add mb-0">
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/><polyline points="7 10 12 15 17 10"/><line x1="12" y1="15" x2="12" y2="3"/></svg>
            Export ke Excel / CSV
        </a>
    </div>

    <!-- Summary Box -->
    <div class="agr-table-card mb-4 p-4 d-flex justify-content-between align-items-center flex-wrap gap-3">
        <div>
            <span class="text-xs font-weight-bold text-uppercase d-block" style="color:rgba(184,68,247,0.8); letter-spacing:0.08em;">
                Rekapitulasi Produksi TBS
            </span>
            <h4 class="mb-0 fw-bold text-white">Tahun {{ $tahun }}</h4>
        </div>
        <div class="text-end">
            <span class="text-xs font-weight-bold text-uppercase d-block" style="color:rgba(255,255,255,0.5);">
                Total Produksi
            </span>
            <h3 class="mb-0 fw-bold" style="color:#4ade80;">
                {{ number_format($data->sum('berat'), 0, ',', '.') }} <small style="font-size:0.9rem; color:rgba(255,255,255,0.6);">Kg</small>
            </h3>
        </div>
    </div>

    <div class="agr-table-card">
        <div class="table-responsive">
            <table class="agr-table">
                <thead>
                    <tr>
                        <th><span class="th-label">No</span></th>
                        <th><span class="th-label">Tanggal Panen</span></th>
                        <th><span class="th-label">Blok Lahan</span></th>
                        <th><span class="th-label">Pekerja / Tim</span></th>
                        <th><span class="th-label">Berat Panen (Kg)</span></th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data as $i => $r)
                    <tr>
                        <td style="width:60px;"><span class="agr-no">{{ $i + 1 }}</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-2" style="font-size:0.83rem;">
                                📅 {{ $r->tanggal->format('d M Y') }}
                            </div>
                        </td>
                        <td>
                            <span class="agr-tag agr-tag-green">
                                📍 {{ $r->lahan->nama_lahan ?? '-' }}
                            </span>
                        </td>
                        <td>
                            <span style="color:rgba(255,255,255,0.85); font-size:0.83rem;">
                                👤 {{ $r->pekerja->nama ?? '—' }}
                            </span>
                        </td>
                        <td>
                            <span class="agr-weight">
                                {{ number_format($r->berat, 0, ',', '.') }} <small style="color:rgba(255,255,255,0.5);">Kg</small>
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="agr-empty-state">
                            Tidak ada data hasil panen pada tahun {{ $tahun }}.
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
.agr-tag-green {
  display: inline-flex; align-items: center;
  padding: 0.3rem 0.75rem; border-radius: 50px;
  font-size: 0.75rem; font-weight: 700;
  background: rgba(34,197,94,0.12); color: #4ade80 !important;
  border: 1px solid rgba(34,197,94,0.25);
}
.agr-weight { font-size: 0.92rem; font-weight: 700; color: #4ade80 !important; }
.agr-empty-state { text-align: center; padding: 3rem; color: rgba(255,255,255,0.4) !important; }
</style>
@endpush
@endsection
