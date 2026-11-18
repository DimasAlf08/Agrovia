@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-7">

            {{-- Header --}}
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('panen.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <div>
                    <h5 class="mb-0 fw-bold">
                        {{ $panen->exists ? '✏️ Edit Data Panen' : '🌾 Catat Hasil Panen Baru' }}
                    </h5>
                    <p class="text-sm mb-0 opacity-7">
                        {{ $panen->exists ? 'Perbarui catatan hasil panen' : 'Catat produksi panen ke sistem' }}
                    </p>
                </div>
            </div>

            <div class="card" style="border-top: 3px solid #b844f7 !important;">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center gap-2">
                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#8b2fd4,#b844f7);color:#fff;font-size:0.8rem;box-shadow:0 0 10px rgba(184,68,247,0.4);">
                            <i class="ni ni-cart"></i>
                        </span>
                        <h6 class="mb-0">Data Hasil Panen</h6>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <form method="POST" action="{{ $panen->exists ? route('panen.update', $panen) : route('panen.store') }}" novalidate>
                        @csrf
                        @if($panen->exists) @method('PUT') @endif

                        {{-- Tanggal --}}
                        <div class="mb-4">
                            <label class="form-field-label-panen" for="tanggal">
                                <i class="fas fa-calendar-alt me-1" style="color:#b844f7;"></i>Tanggal Panen
                            </label>
                            <input type="date" id="tanggal" name="tanggal"
                                class="form-control form-control-dark @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal', optional($panen->tanggal)->format('Y-m-d') ?? date('Y-m-d')) }}"
                                required>
                            @error('tanggal')<div class="invalid-feedback-dark"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- Lahan --}}
                        <div class="mb-4">
                            <label class="form-field-label-panen" for="lahan_id">
                                <i class="fas fa-map-marker-alt me-1" style="color:#b844f7;"></i>Blok Lahan
                            </label>
                            <select id="lahan_id" name="lahan_id"
                                class="form-control form-control-dark @error('lahan_id') is-invalid @enderror"
                                required>
                                <option value="" disabled {{ !old('lahan_id', $panen->lahan_id) ? 'selected' : '' }}>-- Pilih Lahan --</option>
                                @foreach($lahanList as $l)
                                    <option value="{{ $l->id }}" @selected(old('lahan_id', $panen->lahan_id) == $l->id)>{{ $l->nama_lahan }}</option>
                                @endforeach
                            </select>
                            @error('lahan_id')<div class="invalid-feedback-dark"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- Pekerja --}}
                        <div class="mb-4">
                            <label class="form-field-label-panen" for="pekerja_id">
                                <i class="fas fa-user-hard-hat me-1" style="color:#b844f7;"></i>Pekerja / Tim (Opsional)
                            </label>
                            <select id="pekerja_id" name="pekerja_id" class="form-control form-control-dark">
                                <option value="">-- Tidak Ditentukan --</option>
                                @foreach($pekerjaList as $p)
                                    <option value="{{ $p->id }}" @selected(old('pekerja_id', $panen->pekerja_id) == $p->id)>{{ $p->nama }} ({{ $p->jabatan }})</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Berat --}}
                        <div class="mb-4">
                            <label class="form-field-label-panen" for="berat">
                                <i class="fas fa-weight-hanging me-1" style="color:#b844f7;"></i>Berat Panen
                            </label>
                            <div style="position:relative;">
                                <input type="number" id="berat" name="berat" step="0.01" min="0"
                                    class="form-control form-control-dark @error('berat') is-invalid @enderror"
                                    value="{{ old('berat', $panen->berat) }}"
                                    placeholder="Contoh: 1500"
                                    style="padding-right:3rem !important;"
                                    required>
                                <span style="position:absolute;right:0.9rem;top:50%;transform:translateY(-50%);font-size:0.8rem;font-weight:600;color:#b844f7;pointer-events:none;">Kg</span>
                            </div>
                            @error('berat')<div class="invalid-feedback-dark"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- Actions --}}
                        <div class="mt-4 pt-3" style="border-top:1px solid rgba(184,68,247,0.12);">
                            <button type="submit" class="btn bg-gradient-primary w-100" style="font-size:0.9rem;padding:0.75rem 1.5rem;">
                                <i class="fas fa-save me-2"></i>
                                {{ $panen->exists ? 'Simpan Perubahan' : 'Simpan Data Panen' }}
                            </button>
                            <a href="{{ route('panen.index') }}" class="btn btn-outline-secondary w-100 mt-2">
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
.form-field-label-panen {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #d580ff !important;
    margin-bottom: 0.4rem;
    letter-spacing: 0.02em;
}
.form-control-dark {
    background: rgba(255,255,255,0.05) !important;
    border: 1.5px solid rgba(184,68,247,0.2) !important;
    color: #fff !important;
    border-radius: 10px !important;
    padding: 0.65rem 0.9rem !important;
    font-size: 0.9rem !important;
    transition: all 0.25s !important;
    width: 100%;
}
.form-control-dark:focus {
    border-color: #b844f7 !important;
    box-shadow: 0 0 0 3px rgba(184,68,247,0.2) !important;
    background: rgba(184,68,247,0.07) !important;
    outline: none !important;
}
.form-control-dark::placeholder { color: rgba(255,255,255,0.3) !important; }
.form-control-dark option { background: #1a1a2e !important; color: #fff !important; }
.form-control-dark.is-invalid { border-color: #ef4444 !important; }
.invalid-feedback-dark {
    font-size: 0.75rem;
    color: #f87171 !important;
    margin-top: 0.3rem;
}
</style>
@endpush
@endsection