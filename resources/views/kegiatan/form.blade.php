@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-7">

            {{-- Header --}}
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('kegiatan.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <div>
                    <h5 class="mb-0 fw-bold">
                        {{ $kegiatan->exists ? '✏️ Edit Kegiatan' : '📋 Tambah Kegiatan Baru' }}
                    </h5>
                    <p class="text-sm mb-0 opacity-7">
                        {{ $kegiatan->exists ? 'Perbarui data kegiatan operasional' : 'Catat kegiatan operasional perkebunan' }}
                    </p>
                </div>
            </div>

            <div class="card" style="border-top: 3px solid #b844f7 !important;">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center gap-2">
                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#8b2fd4,#b844f7);color:#fff;font-size:0.8rem;box-shadow:0 0 10px rgba(184,68,247,0.4);">
                            <i class="ni ni-calendar-grid-58"></i>
                        </span>
                        <h6 class="mb-0">Detail Kegiatan</h6>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <form method="POST" action="{{ $kegiatan->exists ? route('kegiatan.update', $kegiatan) : route('kegiatan.store') }}" novalidate>
                        @csrf
                        @if($kegiatan->exists) @method('PUT') @endif

                        {{-- Tanggal --}}
                        <div class="mb-4">
                            <label class="form-field-label-kegiatan" for="tanggal">
                                <i class="fas fa-calendar-alt me-1" style="color:#b844f7;"></i>Tanggal Kegiatan
                            </label>
                            <input type="date" id="tanggal" name="tanggal"
                                class="form-control form-control-dark-k @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', optional($kegiatan->tanggal)->format('Y-m-d') ?? date('Y-m-d')) }}"
                                required>
                            @error('tanggal')<div class="invalid-feedback-k"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- Jenis --}}
                        <div class="mb-4">
                            <label class="form-field-label-kegiatan" for="jenis">
                                <i class="fas fa-tasks me-1" style="color:#b844f7;"></i>Jenis Kegiatan
                            </label>
                            <input type="text" id="jenis" name="jenis"
                                class="form-control form-control-dark-k @error('jenis') is-invalid @enderror"
                                value="{{ old('jenis', $kegiatan->jenis) }}"
                                placeholder="Contoh: Pemupukan, Penyemprotan, Pemangkasan"
                                required autocomplete="off">
                            @error('jenis')<div class="invalid-feedback-k"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- Lahan --}}
                        <div class="mb-4">
                            <label class="form-field-label-kegiatan" for="lahan_id">
                                <i class="fas fa-map-marker-alt me-1" style="color:#b844f7;"></i>Blok Lahan
                            </label>
                            <select id="lahan_id" name="lahan_id"
                                class="form-control form-control-dark-k @error('lahan_id') is-invalid @enderror"
                                required>
                                <option value="" disabled {{ !old('lahan_id', $kegiatan->lahan_id) ? 'selected' : '' }}>-- Pilih Lahan --</option>
                                @foreach($lahanList as $l)
                                    <option value="{{ $l->id }}" @selected(old('lahan_id', $kegiatan->lahan_id) == $l->id)>{{ $l->nama_lahan }}</option>
                                @endforeach
                            </select>
                            @error('lahan_id')<div class="invalid-feedback-k"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- Pekerja --}}
                        <div class="mb-4">
                            <label class="form-field-label-kegiatan" for="pekerja_id">
                                <i class="fas fa-user-hard-hat me-1" style="color:#b844f7;"></i>Penanggung Jawab (Opsional)
                            </label>
                            <select id="pekerja_id" name="pekerja_id" class="form-control form-control-dark-k">
                                <option value="">-- Tidak Ditentukan --</option>
                                @foreach($pekerjaList as $p)
                                    <option value="{{ $p->id }}" @selected(old('pekerja_id', $kegiatan->pekerja_id) == $p->id)>{{ $p->nama }} ({{ $p->jabatan }})</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Actions --}}
                        <div class="mt-4 pt-3" style="border-top:1px solid rgba(184,68,247,0.12);">
                            <button type="submit" class="btn bg-gradient-primary w-100" style="font-size:0.9rem;padding:0.75rem 1.5rem;">
                                <i class="fas fa-save me-2"></i>
                                {{ $kegiatan->exists ? 'Simpan Perubahan' : 'Simpan Kegiatan' }}
                            </button>
                            <a href="{{ route('kegiatan.index') }}" class="btn btn-outline-secondary w-100 mt-2">
                                <i class="fas fa-times me-2"></i>Batal
                            </a>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

@push('css')
<style>
.form-field-label-kegiatan {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #d580ff !important;
    margin-bottom: 0.4rem;
    letter-spacing: 0.02em;
}
.form-control-dark-k {
    background: rgba(255,255,255,0.05) !important;
    border: 1.5px solid rgba(184,68,247,0.2) !important;
    color: #fff !important;
    border-radius: 10px !important;
    padding: 0.65rem 0.9rem !important;
    font-size: 0.9rem !important;
    transition: all 0.25s !important;
    width: 100%;
}
.form-control-dark-k:focus {
    border-color: #b844f7 !important;
    box-shadow: 0 0 0 3px rgba(184,68,247,0.2) !important;
    background: rgba(184,68,247,0.07) !important;
    outline: none !important;
}
.form-control-dark-k::placeholder { color: rgba(255,255,255,0.3) !important; }
.form-control-dark-k option { background: #1a1a2e !important; color: #fff !important; }
.form-control-dark-k.is-invalid { border-color: #ef4444 !important; }
.invalid-feedback-k {
    font-size: 0.75rem;
    color: #f87171 !important;
    margin-top: 0.3rem;
}
</style>
@endpush
@endsection