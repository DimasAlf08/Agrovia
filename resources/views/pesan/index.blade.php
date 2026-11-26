@extends('layouts.user_type.auth')

@section('content')
<div class="container-fluid py-4">

  {{-- Header --}}
  <div class="d-flex align-items-center justify-content-between mb-4 flex-wrap gap-2">
    <div>
      <h5 class="mb-0 fw-bold" style="color:#fff;">
        <i class="fas fa-envelope-open-text me-2" style="color: var(--neon-purple-light);"></i>Pesan Email (Admin & Pengawas)
      </h5>
      <p class="text-sm mb-0" style="color:rgba(255,255,255,0.5);">
        Kirim dan terima pesan internal antar Admin & Pengawas, serta kirim ke alamat email tujuan (SMTP)
      </p>
    </div>
    <button type="button" class="btn-agrovia-add" data-bs-toggle="modal" data-bs-target="#modalTulisPesan">
      <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" class="me-2">
        <line x1="22" y1="2" x2="11" y2="13"></line>
        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
      </svg>
      Tulis Pesan Baru
    </button>
  </div>

  {{-- Tab Navigation --}}
  <div class="agr-mail-tabs mb-3">
    <a href="{{ route('pesan.index', ['tab' => 'masuk']) }}"
       class="agr-mail-tab {{ $tab !== 'terkirim' ? 'active' : '' }}">
      <i class="fas fa-inbox me-2"></i>Kotak Masuk
      @if($unreadCount > 0)
        <span class="agr-mail-badge">{{ $unreadCount }}</span>
      @endif
    </a>
    <a href="{{ route('pesan.index', ['tab' => 'terkirim']) }}"
       class="agr-mail-tab {{ $tab === 'terkirim' ? 'active' : '' }}">
      <i class="fas fa-paper-plane me-2"></i>Pesan Terkirim
      <span class="agr-mail-count">{{ $pesanTerkirim->total() }}</span>
    </a>
  </div>

  {{-- Table Card --}}
  <div class="agr-table-card">
    <div class="agr-table-toolbar">
      <div class="agr-toolbar-left">
        <div class="agr-search-box">
          <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#b844f7" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
          <input type="text" id="searchPesan" placeholder="Cari subjek atau nama..." onkeyup="filterPesan()">
        </div>
      </div>
      <div class="agr-toolbar-right">
        <span class="agr-count-badge">
          <i class="fas fa-envelope me-1"></i>
          {{ $tab === 'terkirim' ? $pesanTerkirim->total() . ' Pesan Terkirim' : $pesanMasuk->total() . ' Pesan Masuk' }}
        </span>
      </div>
    </div>

    <div class="table-responsive">
      @php
        $listPesan = $tab === 'terkirim' ? $pesanTerkirim : $pesanMasuk;
      @endphp
      <table class="agr-table" id="pesanTable">
        <thead>
          <tr>
            <th><span class="th-label">No</span></th>
            <th><span class="th-label">{{ $tab === 'terkirim' ? 'Penerima' : 'Pengirim' }}</span></th>
            <th><span class="th-label">Subjek & Ringkasan</span></th>
            <th><span class="th-label">Status</span></th>
            <th><span class="th-label">Waktu</span></th>
            <th class="text-center"><span class="th-label">Aksi</span></th>
          </tr>
        </thead>
        <tbody>
          @forelse($listPesan as $i => $p)
          @php
            $isUnread = $tab !== 'terkirim' && is_null($p->dibaca_pada);
            $partner = $tab === 'terkirim' ? $p->penerima : $p->pengirim;
          @endphp
          <tr class="{{ $isUnread ? 'agr-mail-unread' : '' }}">
            <td style="width: 60px;">
              <span class="agr-no">{{ $listPesan->firstItem() + $i }}</span>
            </td>
            <td>
              <div class="d-flex flex-column">
                <span class="fw-bold" style="color:#fff;">
                  {{ $partner ? $partner->nama : ($p->email_tujuan ?? '-') }}
                </span>
                @if($partner)
                  <small style="color: var(--neon-purple-light); font-size: 0.72rem;">
                    {{ strtoupper($partner->role) }}
                  </small>
                @endif
                @if($p->email_tujuan)
                  <small style="color: rgba(255,255,255,0.45); font-size: 0.72rem;">
                    <i class="fas fa-at me-1"></i>{{ $p->email_tujuan }}
                  </small>
                @endif
              </div>
            </td>
            <td>
              <div class="d-flex flex-column" style="max-width: 360px;">
                <span class="fw-semibold" style="color:#fff;">
                  @if($isUnread)
                    <span class="agr-unread-dot me-1"></span>
                  @endif
                  {{ $p->subjek }}
                </span>
                <small class="text-truncate" style="color: rgba(255,255,255,0.5);">
                  {{ \Illuminate\Support\Str::limit($p->isi, 70) }}
                </small>
              </div>
            </td>
            <td>
              @if($p->status_smtp === 'terkirim')
                <span class="agr-tag agr-tag-green"><i class="fas fa-check-circle me-1"></i>Email SMTP Terkirim</span>
              @elseif($p->status_smtp === 'gagal_smtp')
                <span class="agr-tag agr-tag-warn"><i class="fas fa-database me-1"></i>Internal (SMTP Off)</span>
              @else
                <span class="agr-tag agr-tag-purple"><i class="fas fa-comments me-1"></i>Pesan Internal</span>
              @endif
            </td>
            <td>
              <span style="color: rgba(255,255,255,0.65); font-size: 0.8rem;">
                {{ $p->created_at?->format('d M Y, H:i') }}
              </span>
            </td>
            <td class="text-center" style="width: 130px;">
              <div class="agr-action-group">
                <button type="button" class="agr-btn-view" title="Baca Pesan"
                        onclick="bukaDetailPesan('{{ route('pesan.show', $p) }}', this)">
                  <i class="fas fa-eye"></i>
                </button>
                <form action="{{ route('pesan.destroy', $p) }}" method="POST" class="d-inline form-delete">
                  @csrf @method('DELETE')
                  <button type="submit" class="agr-btn-delete" title="Hapus Pesan">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"/></svg>
                  </button>
                </form>
              </div>
            </td>
          </tr>
          @empty
          <tr>
            <td colspan="6" class="agr-empty-state">
              {{ $tab === 'terkirim' ? 'Belum ada pesan yang Anda kirim.' : 'Kotak masuk masih kosong.' }}
            </td>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>

    @if($listPesan->hasPages())
    <div class="p-3 border-top" style="border-color: rgba(255,255,255,0.06) !important;">
      {{ $listPesan->appends(['tab' => $tab])->links() }}
    </div>
    @endif
  </div>
</div>

{{-- MODAL TULIS PESAN --}}
<div class="modal fade" id="modalTulisPesan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content agr-modal-content">
      <div class="modal-header agr-modal-header">
        <h6 class="modal-title fw-bold text-white mb-0">
          <i class="fas fa-paper-plane me-2" style="color: var(--neon-purple-light);"></i>Tulis Pesan Email Baru
        </h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <form action="{{ route('pesan.store') }}" method="POST">
        @csrf
        <div class="modal-body p-4">
          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label agr-form-label">Penerima (Admin / Pengawas)</label>
              <select name="penerima_id" class="form-select agr-input">
                <option value="">-- Pilih Akun Internal (Opsional) --</option>
                @foreach($penerimaList as $u)
                  <option value="{{ $u->id }}" {{ old('penerima_id') == $u->id ? 'selected' : '' }}>
                    {{ $u->nama }} ({{ ucfirst($u->role) }}{{ $u->email ? ' - ' . $u->email : '' }})
                  </option>
                @endforeach
              </select>
            </div>
            <div class="col-md-6">
              <label class="form-label agr-form-label">Alamat Email Tujuan (Opsional SMTP)</label>
              <input type="email" name="email_tujuan" class="form-control agr-input"
                     value="{{ old('email_tujuan') }}" placeholder="contoh@email.com">
            </div>
            <div class="col-12">
              <label class="form-label agr-form-label">Subjek Pesan <span class="text-danger">*</span></label>
              <input type="text" name="subjek" class="form-control agr-input" required
                     value="{{ old('subjek') }}" placeholder="Masukkan subjek pesan...">
            </div>
            <div class="col-12">
              <label class="form-label agr-form-label">Isi Pesan <span class="text-danger">*</span></label>
              <textarea name="isi" rows="5" class="form-control agr-input" required
                        placeholder="Tulis isi pesan untuk Admin atau Pengawas di sini...">{{ old('isi') }}</textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer agr-modal-footer">
          <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3" data-bs-dismiss="modal">Batal</button>
          <button type="submit" class="btn-agrovia-add">
            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

{{-- MODAL DETAIL PESAN --}}
<div class="modal fade" id="modalDetailPesan" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content agr-modal-content">
      <div class="modal-header agr-modal-header">
        <h6 class="modal-title fw-bold text-white mb-0" id="detailSubjek">Detail Pesan</h6>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Tutup"></button>
      </div>
      <div class="modal-body p-4">
        <div class="agr-detail-meta mb-3">
          <div><strong>Pengirim:</strong> <span id="detailPengirim">-</span></div>
          <div><strong>Penerima:</strong> <span id="detailPenerima">-</span></div>
          <div id="detailEmailWrap" style="display:none;"><strong>Email Tujuan:</strong> <span id="detailEmail">-</span></div>
          <div><strong>Waktu:</strong> <span id="detailWaktu">-</span></div>
        </div>
        <div class="agr-detail-body" id="detailIsi">Memuat pesan...</div>
      </div>
      <div class="modal-footer agr-modal-footer">
        <button type="button" class="btn btn-sm btn-outline-light rounded-pill px-3" data-bs-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
@endsection

@push('css')
<style>
.btn-agrovia-add {
  display: inline-flex; align-items: center;
  background: linear-gradient(135deg, #22c55e, #16a34a);
  color: #fff !important; border: none; border-radius: 50px;
  padding: 0.55rem 1.3rem; font-size: 0.82rem; font-weight: 700;
  box-shadow: 0 4px 16px rgba(34,197,94,0.35); text-decoration: none;
  transition: all 0.3s; cursor: pointer;
}
.btn-agrovia-add:hover {
  transform: translateY(-2px); box-shadow: 0 8px 24px rgba(34,197,94,0.5);
  color: #fff !important;
}
.agr-mail-tabs {
  display: flex; gap: 0.65rem; flex-wrap: wrap;
}
.agr-mail-tab {
  display: inline-flex; align-items: center; gap: 0.35rem;
  padding: 0.55rem 1.15rem; border-radius: 50px;
  background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);
  color: rgba(255,255,255,0.7) !important; font-size: 0.82rem; font-weight: 600;
  text-decoration: none; transition: all 0.25s ease;
}
.agr-mail-tab:hover {
  background: var(--neon-glow-soft); border-color: var(--neon-purple); color: #fff !important;
}
.agr-mail-tab.active {
  background: linear-gradient(135deg, var(--neon-purple-dark), var(--neon-purple));
  border-color: var(--neon-purple-light); color: #fff !important;
  box-shadow: 0 4px 16px var(--neon-glow-soft);
}
.agr-mail-badge {
  background: #ef4444; color: #fff; border-radius: 999px;
  padding: 0.1rem 0.48rem; font-size: 0.7rem; font-weight: 700;
}
.agr-mail-count {
  background: rgba(255,255,255,0.15); color: #fff; border-radius: 999px;
  padding: 0.1rem 0.48rem; font-size: 0.7rem; font-weight: 700;
}
.agr-mail-unread {
  background: rgba(184, 68, 247, 0.08) !important;
}
.agr-unread-dot {
  display: inline-block; width: 8px; height: 8px; border-radius: 50%;
  background: #22c55e; box-shadow: 0 0 8px #22c55e;
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
.agr-search-box {
  display: flex; align-items: center; gap: 0.5rem;
  background: rgba(255,255,255,0.04); border: 1px solid rgba(255,255,255,0.1);
  border-radius: 50px; padding: 0.4rem 0.9rem;
}
.agr-search-box input {
  background: transparent; border: none; outline: none; color: #fff; font-size: 0.82rem; width: 210px;
}
.agr-count-badge {
  display: inline-flex; align-items: center;
  background: rgba(184,68,247,0.12); border: 1px solid rgba(184,68,247,0.28);
  color: var(--neon-purple-light); border-radius: 50px;
  padding: 0.35rem 0.85rem; font-size: 0.76rem; font-weight: 600;
}
.agr-table { width: 100%; border-collapse: separate; border-spacing: 0; }
.agr-table thead th {
  padding: 0.75rem 1.25rem;
  background: rgba(255,255,255,0.03);
  border-bottom: 1px solid rgba(184,68,247,0.15);
}
.th-label {
  font-size: 0.65rem; font-weight: 800; letter-spacing: 0.08em;
  text-transform: uppercase; color: rgba(184,68,247,0.85) !important;
}
.agr-table tbody tr {
  border-bottom: 1px solid rgba(255,255,255,0.03);
  transition: background 0.2s;
}
.agr-table tbody tr:hover { background: rgba(184,68,247,0.06); }
.agr-table tbody td {
  padding: 0.85rem 1.25rem; vertical-align: middle;
  color: rgba(255,255,255,0.9) !important; font-size: 0.85rem;
}
.agr-no {
  display: inline-flex; align-items: center; justify-content: center;
  width: 26px; height: 26px; border-radius: 8px;
  background: rgba(184,68,247,0.12); color: #d580ff !important;
  font-size: 0.75rem; font-weight: 700;
}
.agr-action-group { display: flex; align-items: center; justify-content: center; gap: 0.5rem; }
.agr-btn-delete {
  width: 32px; height: 32px; border-radius: 8px;
  display: inline-flex; align-items: center; justify-content: center;
  border: 1px solid rgba(239,68,68,0.25); background: rgba(239,68,68,0.12);
  color: #f87171 !important; cursor: pointer; transition: all 0.22s;
}
.agr-btn-delete:hover {
  background: rgba(239,68,68,0.35); transform: scale(1.1); color: #fff !important;
}
.agr-empty-state {
  text-align: center; padding: 3rem !important; color: rgba(255,255,255,0.45) !important;
}
.agr-tag {
  display: inline-flex; align-items: center; padding: 0.28rem 0.68rem;
  border-radius: 50px; font-size: 0.74rem; font-weight: 600;
}
.agr-tag-green { background: rgba(34,197,94,0.15); color: #4ade80; border: 1px solid rgba(34,197,94,0.3); }
.agr-tag-purple { background: rgba(184,68,247,0.15); color: #d580ff; border: 1px solid rgba(184,68,247,0.3); }
.agr-tag-warn { background: rgba(245,158,11,0.15); color: #fbbf24; border: 1px solid rgba(245,158,11,0.3); }
.agr-btn-view {
  width: 32px; height: 32px; border-radius: 9px; border: 1px solid rgba(6,182,212,0.3);
  background: rgba(6,182,212,0.12); color: #22d3ee;
  display: inline-flex; align-items: center; justify-content: center;
  transition: all 0.2s; cursor: pointer;
}
.agr-btn-view:hover { background: rgba(6,182,212,0.28); color: #fff; transform: scale(1.06); }
.agr-modal-content {
  background: rgba(13, 14, 28, 0.96);
  backdrop-filter: blur(24px);
  border: 1px solid var(--border-subtle);
  border-radius: 20px;
  color: #fff;
  box-shadow: 0 20px 50px rgba(0,0,0,0.75), 0 0 30px var(--neon-glow-soft);
}
.agr-modal-header, .agr-modal-footer {
  border-color: rgba(255,255,255,0.08);
}
.agr-form-label {
  font-size: 0.8rem; font-weight: 600; color: rgba(255,255,255,0.8);
}
.agr-input {
  background: rgba(255,255,255,0.05) !important;
  border: 1px solid rgba(255,255,255,0.12) !important;
  color: #fff !important;
  border-radius: 12px !important;
}
.agr-input option {
  background: #111224; color: #fff;
}
.agr-input:focus {
  border-color: var(--neon-purple) !important;
  box-shadow: 0 0 0 3px var(--neon-glow-soft) !important;
}
.agr-detail-meta {
  background: rgba(255,255,255,0.04);
  border: 1px solid rgba(255,255,255,0.08);
  border-radius: 12px;
  padding: 0.85rem 1rem;
  font-size: 0.82rem;
  color: rgba(255,255,255,0.8);
  display: grid; gap: 0.35rem;
}
.agr-detail-body {
  background: rgba(255,255,255,0.03);
  border: 1px solid rgba(255,255,255,0.07);
  border-radius: 12px;
  padding: 1rem;
  min-height: 120px;
  white-space: pre-wrap;
  color: #fff;
  font-size: 0.88rem;
  line-height: 1.6;
}
</style>
@endpush

@push('dashboard')
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Pindahkan modal ke body agar tidak terpotong container mana pun
  ['modalTulisPesan', 'modalDetailPesan'].forEach(function(id) {
    const el = document.getElementById(id);
    if (el && el.parentElement !== document.body) {
      document.body.appendChild(el);
    }
  });
});

function filterPesan() {
  const input = document.getElementById('searchPesan').value.toLowerCase();
  const rows = document.querySelectorAll('#pesanTable tbody tr');
  rows.forEach(function(row) {
    const text = row.innerText.toLowerCase();
    row.style.display = text.includes(input) ? '' : 'none';
  });
}

function bukaDetailPesan(url, btnEl) {
  fetch(url, { headers: { 'Accept': 'application/json' } })
    .then(function(res) { return res.json(); })
    .then(function(data) {
      document.getElementById('detailSubjek').textContent = data.subjek || 'Detail Pesan';
      document.getElementById('detailPengirim').textContent = data.pengirim || '-';
      document.getElementById('detailPenerima').textContent = data.penerima || '-';
      document.getElementById('detailWaktu').textContent = data.waktu || '-';
      document.getElementById('detailIsi').textContent = data.isi || '';

      const emailWrap = document.getElementById('detailEmailWrap');
      if (data.email_tujuan) {
        emailWrap.style.display = 'block';
        document.getElementById('detailEmail').textContent = data.email_tujuan;
      } else {
        emailWrap.style.display = 'none';
      }

      const row = btnEl.closest('tr');
      if (row) {
        row.classList.remove('agr-mail-unread');
        const dot = row.querySelector('.agr-unread-dot');
        if (dot) dot.remove();
      }

      const modal = new bootstrap.Modal(document.getElementById('modalDetailPesan'));
      modal.show();
    });
}
</script>
@endpush
