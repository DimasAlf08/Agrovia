@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-12 col-sm-10 col-md-8 col-lg-7">

            {{-- Header --}}
            <div class="d-flex align-items-center mb-3">
                <a href="{{ route('pekerja.index') }}" class="btn btn-sm btn-outline-secondary me-3">
                    <i class="fas fa-arrow-left me-1"></i> Kembali
                </a>
                <div>
                    <h5 class="mb-0 fw-bold">
                        {{ $pekerja->exists ? '✏️ Edit Data Pekerja' : '👷 Tambah Pekerja Baru' }}
                    </h5>
                    <p class="text-sm mb-0 opacity-7">
                        {{ $pekerja->exists ? 'Perbarui informasi pekerja' : 'Daftarkan pekerja ke sistem' }}
                    </p>
                </div>
            </div>

            <div class="card" style="border-top: 3px solid #b844f7 !important;">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center gap-2">
                        <span style="display:inline-flex;align-items:center;justify-content:center;width:32px;height:32px;border-radius:8px;background:linear-gradient(135deg,#8b2fd4,#b844f7);color:#fff;font-size:0.8rem;box-shadow:0 0 10px rgba(184,68,247,0.4);">
                            <i class="ni ni-single-02"></i>
                        </span>
                        <h6 class="mb-0">Informasi Pekerja</h6>
                    </div>
                </div>
                <div class="card-body pt-3">
                    <form method="POST" action="{{ $pekerja->exists ? route('pekerja.update', $pekerja) : route('pekerja.store') }}" novalidate>
                        @csrf
                        @if($pekerja->exists) @method('PUT') @endif

                        {{-- Nama --}}
                        <div class="mb-4">
                            <label class="form-field-label-pekerja" for="nama">
                                <i class="fas fa-user me-1" style="color:#b844f7;"></i>Nama Lengkap
                            </label>
                            <input type="text" id="nama" name="nama"
                                class="form-control form-control-dark-p @error('nama') is-invalid @enderror"
                                value="{{ old('nama', $pekerja->nama) }}"
                                placeholder="Masukkan nama lengkap"
                                required autocomplete="off">
                            @error('nama')<div class="invalid-feedback-p"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- Jabatan --}}
                        <div class="mb-4">
                            <label class="form-field-label-pekerja" for="jabatan">
                                <i class="fas fa-id-badge me-1" style="color:#b844f7;"></i>Jabatan
                            </label>
                            <input type="text" id="jabatan" name="jabatan"
                                class="form-control form-control-dark-p @error('jabatan') is-invalid @enderror"
                                value="{{ old('jabatan', $pekerja->jabatan) }}"
                                placeholder="Contoh: Pemanen, Mandor, Teknisi">
                            @error('jabatan')<div class="invalid-feedback-p"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- Telepon --}}
                        <div class="mb-4">
                            <label class="form-field-label-pekerja" for="telp">
                                <i class="fas fa-phone me-1" style="color:#b844f7;"></i>No. Telepon
                            </label>
                            <input type="text" id="telp" name="telp"
                                class="form-control form-control-dark-p @error('telp') is-invalid @enderror"
                                value="{{ old('telp', $pekerja->telp) }}"
                                placeholder="Contoh: 0812-3456-7890">
                            @error('telp')<div class="invalid-feedback-p"><i class="fas fa-exclamation-circle me-1"></i>{{ $message }}</div>@enderror
                        </div>

                        {{-- Actions --}}
                        <div class="mt-4 pt-3" style="border-top:1px solid rgba(184,68,247,0.12);">
                            <button type="submit" class="btn bg-gradient-primary w-100" style="font-size:0.9rem;padding:0.75rem 1.5rem;">
                                <i class="fas fa-save me-2"></i>
                                {{ $pekerja->exists ? 'Simpan Perubahan' : 'Simpan Data Pekerja' }}
                            </button>
                            <a href="{{ route('pekerja.index') }}" class="btn btn-outline-secondary w-100 mt-2">
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
.form-field-label-pekerja {
    display: block;
    font-size: 0.8rem;
    font-weight: 600;
    color: #d580ff !important;
    margin-bottom: 0.4rem;
    letter-spacing: 0.02em;
}
.form-control-dark-p {
    background: rgba(255,255,255,0.05) !important;
    border: 1.5px solid rgba(184,68,247,0.2) !important;
    color: #fff !important;
    border-radius: 10px !important;
    padding: 0.65rem 0.9rem !important;
    font-size: 0.9rem !important;
    transition: all 0.25s !important;
    width: 100%;
}
.form-control-dark-p:focus {
    border-color: #b844f7 !important;
    box-shadow: 0 0 0 3px rgba(184,68,247,0.2) !important;
    background: rgba(184,68,247,0.07) !important;
    outline: none !important;
}
.form-control-dark-p::placeholder { color: rgba(255,255,255,0.3) !important; }
.form-control-dark-p.is-invalid { border-color: #ef4444 !important; }
.invalid-feedback-p {
    font-size: 0.75rem;
    color: #f87171 !important;
    margin-top: 0.3rem;
}
</style>
@endpush
@endsection