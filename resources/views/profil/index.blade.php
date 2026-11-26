@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">

  {{-- Header --}}
  <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
      <h5 class="mb-0 fw-bold" style="color:#fff;">
        <i class="fas fa-user-cog me-2" style="color: var(--neon-purple-light);"></i>Pengaturan Profil
      </h5>
      <p class="text-sm mb-0" style="color:rgba(255,255,255,0.5);">
        Kelola informasi akun, alamat email, dan kata sandi Anda
      </p>
    </div>
    <span class="agr-role-pill">
      <i class="fas fa-shield-alt me-1"></i> {{ strtoupper($user->role) }}
    </span>
  </div>

  <div class="row g-4">
    {{-- Kartu Ringkasan Profil --}}
    <div class="col-lg-4">
      <div class="agr-profile-card h-100">
        <div class="agr-profile-avatar-lg" id="avatarPreviewBox">
          @if($user->foto_profil)
            <img src="{{ asset($user->foto_profil) }}" alt="Foto Profil" id="avatarPreviewImg" class="agr-profile-avatar-img">
          @else
            <span id="avatarPreviewInitial">{{ strtoupper(substr($user->nama ?? 'U', 0, 1)) }}</span>
          @endif
        </div>
        <h5 class="fw-bold text-white mb-1 mt-3">{{ $user->nama }}</h5>
        <p class="mb-2" style="color: var(--neon-purple-light); font-size: 0.8rem; font-weight: 700;">
          {{ '@' . $user->username }}
        </p>
        <div class="agr-profile-meta">
          <div><i class="fas fa-envelope me-2"></i>{{ $user->email ?: 'Email belum diatur' }}</div>
          <div><i class="fas fa-user-tag me-2"></i>Role: {{ ucfirst($user->role) }}</div>
          <div><i class="fas fa-calendar-alt me-2"></i>Bergabung: {{ $user->created_at?->format('d M Y') ?? '-' }}</div>
        </div>
      </div>
    </div>

    {{-- Form Edit Profil & Kata Sandi --}}
    <div class="col-lg-8">
      <div class="agr-table-card p-4">
        <form action="{{ route('profil.update') }}" method="POST" enctype="multipart/form-data" class="form-edit-update">
          @csrf

          <h6 class="text-white fw-bold mb-3">
            <i class="fas fa-id-card me-2" style="color: #22c55e;"></i>Informasi Akun
          </h6>

          <div class="row g-3 mb-4">
            <div class="col-12">
              <label class="form-label agr-form-label">Foto Profil</label>
              <div class="d-flex align-items-center gap-3 flex-wrap">
                <input type="file" name="foto_profil" id="inputFotoProfil"
                       class="form-control agr-input" style="max-width: 340px;"
                       accept="image/png,image/jpeg,image/jpg,image/webp">
                @if($user->foto_profil)
                  <label class="d-inline-flex align-items-center gap-2 text-danger mb-0" style="font-size: 0.8rem; cursor: pointer;">
                    <input type="checkbox" name="hapus_foto" value="1" class="form-check-input mt-0">
                    Hapus foto saat ini
                  </label>
                @endif
              </div>
              <small style="color: rgba(255,255,255,0.45); font-size: 0.74rem;">
                Format: JPG, PNG, atau WEBP (maks. 2 MB).
              </small>
            </div>
            <div class="col-md-6">
              <label class="form-label agr-form-label">Nama Lengkap <span class="text-danger">*</span></label>
              <input type="text" name="nama" class="form-control agr-input"
                     value="{{ old('nama', $user->nama) }}" required>
            </div>
            <div class="col-md-6">
              <label class="form-label agr-form-label">Username <span class="text-danger">*</span></label>
              <input type="text" name="username" class="form-control agr-input"
                     value="{{ old('username', $user->username) }}" required>
            </div>
            <div class="col-12">
              <label class="form-label agr-form-label">Alamat Email</label>
              <input type="email" name="email" class="form-control agr-input"
                     value="{{ old('email', $user->email) }}" placeholder="contoh@agrovia.com">
              <small style="color: rgba(255,255,255,0.45); font-size: 0.74rem;">
                Email dapat digunakan untuk login dan menerima pesan dari Admin/Pengawas.
              </small>
            </div>
          </div>

          <hr style="border-color: rgba(255,255,255,0.08);" class="my-4">

          <h6 class="text-white fw-bold mb-1">
            <i class="fas fa-lock me-2" style="color: #f59e0b;"></i>Ubah Kata Sandi (Opsional)
          </h6>
          <p class="mb-3" style="color: rgba(255,255,255,0.45); font-size: 0.78rem;">
            Kosongkan bagian ini jika tidak ingin mengganti kata sandi.
          </p>

          <div class="row g-3 mb-4">
            <div class="col-md-12">
              <label class="form-label agr-form-label">Kata Sandi Saat Ini</label>
              <input type="password" name="current_password" class="form-control agr-input"
                     placeholder="Masukkan kata sandi saat ini" autocomplete="current-password">
            </div>
            <div class="col-md-6">
              <label class="form-label agr-form-label">Kata Sandi Baru</label>
              <input type="password" name="password" class="form-control agr-input"
                     placeholder="Minimal 6 karakter" autocomplete="new-password">
            </div>
            <div class="col-md-6">
              <label class="form-label agr-form-label">Konfirmasi Kata Sandi Baru</label>
              <input type="password" name="password_confirmation" class="form-control agr-input"
                     placeholder="Ulangi kata sandi baru" autocomplete="new-password">
            </div>
          </div>

          <div class="d-flex justify-content-end">
            <button type="submit" class="btn-agrovia-add">
              <i class="fas fa-save me-2"></i>Simpan Perubahan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection

@push('css')
<style>
.agr-role-pill {
  display: inline-flex; align-items: center;
  padding: 0.4rem 1rem; border-radius: 50px;
  background: rgba(184, 68, 247, 0.14);
  border: 1px solid rgba(184, 68, 247, 0.35);
  color: var(--neon-purple-light);
  font-size: 0.76rem; font-weight: 800; letter-spacing: 0.05em;
}
.agr-profile-card {
  background: rgba(14,14,28,0.85);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(184,68,247,0.2);
  border-radius: 20px;
  padding: 2rem 1.5rem;
  display: flex; flex-direction: column; align-items: center; text-align: center;
}
.agr-profile-avatar-lg {
  width: 88px; height: 88px; border-radius: 50%;
  background: linear-gradient(135deg, var(--neon-purple-dark), var(--neon-purple));
  display: flex; align-items: center; justify-content: center;
  font-size: 2rem; font-weight: 800; color: #fff;
  box-shadow: 0 0 24px var(--neon-glow);
  border: 2px solid rgba(255,255,255,0.25);
  overflow: hidden;
}
.agr-profile-avatar-img {
  width: 100%; height: 100%; object-fit: cover;
}
.agr-profile-meta {
  width: 100%; margin-top: 1.25rem; padding-top: 1.25rem;
  border-top: 1px solid rgba(255,255,255,0.08);
  display: grid; gap: 0.65rem; text-align: left;
  font-size: 0.82rem; color: rgba(255,255,255,0.75);
}
.agr-table-card {
  background: rgba(14,14,28,0.85);
  backdrop-filter: blur(20px);
  border: 1px solid rgba(184,68,247,0.18);
  border-radius: 20px;
}
.agr-form-label {
  font-size: 0.8rem; font-weight: 600; color: rgba(255,255,255,0.82);
}
.agr-input {
  background: rgba(255,255,255,0.05) !important;
  border: 1px solid rgba(255,255,255,0.12) !important;
  color: #fff !important;
  border-radius: 12px !important;
  padding: 0.6rem 0.9rem !important;
}
.agr-input:focus {
  border-color: var(--neon-purple) !important;
  box-shadow: 0 0 0 3px var(--neon-glow-soft) !important;
}
.btn-agrovia-add {
  display: inline-flex; align-items: center;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  color: #fff !important; border: none; border-radius: 50px;
  padding: 0.6rem 1.4rem; font-size: 0.84rem; font-weight: 700;
  box-shadow: 0 4px 16px rgba(34,197,94,0.35);
  transition: all 0.3s; cursor: pointer;
}
.btn-agrovia-add:hover {
  transform: translateY(-2px); box-shadow: 0 8px 24px rgba(34,197,94,0.5);
}
</style>
@endpush

@push('dashboard')
<script>
document.addEventListener('DOMContentLoaded', function() {
  const inputFoto = document.getElementById('inputFotoProfil');
  const previewBox = document.getElementById('avatarPreviewBox');
  if (inputFoto && previewBox) {
    inputFoto.addEventListener('change', function() {
      const file = this.files && this.files[0];
      if (!file) return;
      const reader = new FileReader();
      reader.onload = function(e) {
        previewBox.innerHTML = '<img src="' + e.target.result + '" alt="Preview Foto Profil" class="agr-profile-avatar-img">';
      };
      reader.readAsDataURL(file);
    });
  }
});
</script>
@endpush
