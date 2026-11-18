@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-6 col-xl-5">

            {{-- Header Halaman --}}
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('lahan.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <div>
                    <h5 class="mb-0 fw-bold">
                        {{ $lahan->exists ? '✏️ Edit Data Lahan' : '🌿 Tambah Lahan Baru' }}
                    </h5>
                    <p class="text-sm mb-0 opacity-7">
                        {{ $lahan->exists ? 'Perbarui informasi blok lahan' : 'Daftarkan blok lahan ke sistem' }}
                    </p>
                </div>
            </div>

            {{-- Card Form --}}
            <div class="card form-card-agrovia">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center gap-2">
                        <span class="icon-label-purple">
                            <i class="ni ni-pin-3"></i>
                        </span>
                        <h6 class="mb-0">Informasi Lahan</h6>
                    </div>
                </div>

                <div class="card-body pt-3">
                    <form method="POST" action="{{ $lahan->exists ? route('lahan.update', $lahan) : route('lahan.store') }}" novalidate>
                        @csrf
                        @if($lahan->exists) @method('PUT') @endif

                        {{-- Nama Lahan --}}
                        <div class="form-field-group mb-4">
                            <label class="form-field-label" for="nama_lahan">
                                <i class="fas fa-map-marker-alt me-1 text-purple-accent"></i>
                                Nama / Kode Lahan
                            </label>
                            <input
                                type="text"
                                id="nama_lahan"
                                name="nama_lahan"
                                class="form-control form-control-agrovia @error('nama_lahan') is-invalid @enderror"
                                value="{{ old('nama_lahan', $lahan->nama_lahan) }}"
                                placeholder="Contoh: Blok C1, Blok A3"
                                required
                                autocomplete="off"
                            >
                            @error('nama_lahan')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Luas Lahan --}}
                        <div class="form-field-group mb-4">
                            <label class="form-field-label" for="luas">
                                <i class="fas fa-ruler-combined me-1 text-purple-accent"></i>
                                Luas Lahan
                            </label>
                            <div class="input-with-addon">
                                <input
                                    type="number"
                                    id="luas"
                                    name="luas"
                                    step="0.01"
                                    min="0"
                                    class="form-control form-control-agrovia @error('luas') is-invalid @enderror"
                                    value="{{ old('luas', $lahan->luas) }}"
                                    placeholder="0.00"
                                    required
                                >
                                <span class="input-addon-unit">Ha</span>
                            </div>
                            @error('luas')
                                <div class="invalid-feedback d-block">
                                    <i class="fas fa-exclamation-circle me-1"></i>{{ $message }}
                                </div>
                            @enderror
                            <small class="form-hint">Masukkan luas dalam satuan Hektar (Ha)</small>
                        </div>

                        {{-- Action Buttons --}}
                        <div class="form-actions mt-4 pt-3">
                            <button type="submit" class="btn bg-gradient-primary btn-action-save w-100">
                                <i class="fas fa-save me-2"></i>
                                {{ $lahan->exists ? 'Simpan Perubahan' : 'Simpan Data Lahan' }}
                            </button>
                            <a href="{{ route('lahan.index') }}" class="btn btn-outline-secondary btn-action-cancel w-100 mt-2">
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
/* ── Form Lahan Tambahan ─────────────────────────── */
.form-card-agrovia {
    border-top: 3px solid var(--neon-purple, #b844f7) !important;
}

.icon-label-purple {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px; height: 32px;
    border-radius: 8px;
    background: linear-gradient(135deg, #8b2fd4, #b844f7);
    color: #fff;
    font-size: 0.8rem;
    box-shadow: 0 0 10px rgba(184,68,247,0.4);
}

.text-purple-accent { color: #b844f7 !important; }

.form-field-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #d580ff !important;
    margin-bottom: 0.4rem;
    letter-spacing: 0.02em;
}

.form-control-agrovia {
    background: rgba(255,255,255,0.05) !important;
    border: 1.5px solid rgba(184,68,247,0.2) !important;
    color: #fff !important;
    border-radius: 10px !important;
    padding: 0.65rem 0.9rem !important;
    font-size: 0.9rem !important;
    transition: all 0.25s !important;
    width: 100%;
}

.form-control-agrovia:focus {
    border-color: #b844f7 !important;
    box-shadow: 0 0 0 3px rgba(184,68,247,0.2), 0 0 14px rgba(184,68,247,0.15) !important;
    background: rgba(184,68,247,0.07) !important;
    outline: none !important;
}

.form-control-agrovia::placeholder { color: rgba(255,255,255,0.3) !important; }

.form-control-agrovia.is-invalid {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239,68,68,0.15) !important;
}

.input-with-addon {
    position: relative;
}
.input-with-addon .form-control-agrovia {
    padding-right: 3rem !important;
}
.input-addon-unit {
    position: absolute;
    right: 0.9rem;
    top: 50%;
    transform: translateY(-50%);
    font-size: 0.8rem;
    font-weight: 600;
    color: #b844f7;
    pointer-events: none;
}

.form-hint {
    font-size: 0.72rem;
    color: rgba(255,255,255,0.4) !important;
    margin-top: 0.3rem;
    display: block;
}

.invalid-feedback {
    font-size: 0.75rem;
    color: #f87171 !important;
    margin-top: 0.3rem;
}

.form-actions { border-top: 1px solid rgba(184,68,247,0.12); }

.btn-action-save {
    font-size: 0.9rem !important;
    padding: 0.75rem 1.5rem !important;
    letter-spacing: 0.03em !important;
}

.btn-action-cancel {
    font-size: 0.85rem !important;
}

/* Responsive adjustments */
@media (max-width: 576px) {
    .d-flex.align-items-center.mb-3 { flex-direction: column; align-items: flex-start !important; gap: 0.75rem; }
    .btn-action-save, .btn-action-cancel { font-size: 0.85rem !important; }
}
</style>
@endpush
@endsection