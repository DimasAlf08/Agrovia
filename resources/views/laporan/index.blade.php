@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-7 col-lg-5">

            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('dashboard') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-1"><polyline points="15 18 9 12 15 6"/></svg>
                    Dashboard
                </a>
                <div>
                    <h5 class="mb-0 fw-bold text-white">📊 Rekap & Cetak Laporan</h5>
                    <p class="text-sm mb-0 opacity-7" style="color:rgba(255,255,255,0.5);">Pilih periode tahun untuk menampilkan data</p>
                </div>
            </div>

            <div class="card" style="border-top: 3px solid #b844f7 !important;">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center gap-2">
                        <span style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border-radius:10px;background:linear-gradient(135deg,#8b2fd4,#b844f7);color:#fff;box-shadow:0 0 12px rgba(184,68,247,0.4);">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="20" x2="18" y2="10"/><line x1="12" y1="20" x2="12" y2="4"/><line x1="6" y1="20" x2="6" y2="14"/><path d="M3 20h18"/></svg>
                        </span>
                        <h6 class="mb-0 text-white">Periode Laporan</h6>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <form method="GET" action="{{ route('laporan.produksi') }}">
                        <div class="mb-4">
                            <label class="d-block text-xs font-weight-bold text-uppercase mb-2" style="color:#d580ff; letter-spacing:0.05em;">
                                📅 Tahun Laporan Produksi
                            </label>
                            <select name="tahun" class="form-control" style="background:rgba(255,255,255,0.06)!important; border:1px solid rgba(184,68,247,0.3)!important; color:#fff!important; border-radius:10px!important; padding:0.65rem 0.9rem!important;">
                                @foreach($tahunList as $t)
                                    <option value="{{ $t }}" @selected($t == $tahun) style="background:#131324; color:#fff;">Tahun {{ $t }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center mt-4 pt-2">
                            <button type="submit" class="btn bg-gradient-primary w-100 mb-2" style="font-size:0.9rem; padding:0.75rem 1.5rem;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" class="me-2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                                Tampilkan Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
