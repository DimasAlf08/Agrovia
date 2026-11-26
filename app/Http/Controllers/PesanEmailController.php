<?php

namespace App\Http\Controllers;

use App\Models\PesanEmail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PesanEmailController extends Controller
{
    public function index(Request $request)
    {
        $userId = auth()->id();
        $tab = $request->get('tab', 'masuk');

        $pesanMasuk = PesanEmail::with(['pengirim', 'penerima'])
            ->where('penerima_id', $userId)
            ->latest()
            ->paginate(10, ['*'], 'masuk_page');

        $pesanTerkirim = PesanEmail::with(['pengirim', 'penerima'])
            ->where('pengirim_id', $userId)
            ->latest()
            ->paginate(10, ['*'], 'terkirim_page');

        $unreadCount = PesanEmail::where('penerima_id', $userId)
            ->whereNull('dibaca_pada')
            ->count();

        $penerimaList = User::where('id', '!=', $userId)
            ->orderBy('role')
            ->orderBy('nama')
            ->get();

        return view('pesan.index', compact(
            'tab',
            'pesanMasuk',
            'pesanTerkirim',
            'unreadCount',
            'penerimaList'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'penerima_id' => 'nullable|exists:users,id',
            'email_tujuan' => 'nullable|email|max:150',
            'subjek' => 'required|string|max:150',
            'isi' => 'required|string|max:5000',
        ]);

        if (!$request->filled('penerima_id') && !$request->filled('email_tujuan')) {
            return back()
                ->withInput()
                ->with('error', 'Pilih penerima (Admin/Pengawas) atau isi alamat email tujuan.');
        }

        $statusSmtp = 'internal';
        $emailTujuan = $request->email_tujuan;

        // Jika email tujuan diisi, coba kirim juga via Laravel Mail (SMTP)
        if ($request->filled('email_tujuan')) {
            try {
                $pengirimNama = auth()->user()->nama ?? auth()->user()->username;
                $pengirimRole = strtoupper(auth()->user()->role ?? 'USER');
                $subjek = $request->subjek;
                $isiBody = "Pesan dari: {$pengirimNama} ({$pengirimRole}) - Agrovia\n\n" . $request->isi;

                Mail::raw($isiBody, function ($message) use ($emailTujuan, $subjek) {
                    $message->to($emailTujuan)->subject('[Agrovia] ' . $subjek);
                });

                $statusSmtp = 'terkirim';
            } catch (\Throwable $e) {
                $statusSmtp = 'gagal_smtp';
            }
        }

        PesanEmail::create([
            'pengirim_id' => auth()->id(),
            'penerima_id' => $request->penerima_id ?: null,
            'email_tujuan' => $emailTujuan ?: null,
            'subjek' => $request->subjek,
            'isi' => $request->isi,
            'status_smtp' => $statusSmtp,
        ]);

        $infoTambahan = match ($statusSmtp) {
            'terkirim' => ' dan berhasil dikirim ke email tujuan.',
            'gagal_smtp' => ' (tersimpan di kotak pesan internal; pengiriman SMTP belum aktif/gagal).',
            default => ' ke kotak pesan internal.',
        };

        return redirect()
            ->route('pesan.index', ['tab' => 'terkirim'])
            ->with('success', 'Pesan berhasil dikirim' . $infoTambahan);
    }

    public function show(PesanEmail $pesan)
    {
        $userId = auth()->id();

        if ($pesan->pengirim_id !== $userId && $pesan->penerima_id !== $userId) {
            abort(403, 'Anda tidak memiliki akses ke pesan ini.');
        }

        if ($pesan->penerima_id === $userId && is_null($pesan->dibaca_pada)) {
            $pesan->update(['dibaca_pada' => now()]);
        }

        $pesan->load(['pengirim', 'penerima']);

        return response()->json([
            'id' => $pesan->id,
            'subjek' => $pesan->subjek,
            'isi' => $pesan->isi,
            'pengirim' => $pesan->pengirim ? ($pesan->pengirim->nama . ' (' . ucfirst($pesan->pengirim->role) . ')') : '-',
            'penerima' => $pesan->penerima ? ($pesan->penerima->nama . ' (' . ucfirst($pesan->penerima->role) . ')') : '-',
            'email_tujuan' => $pesan->email_tujuan,
            'status_smtp' => $pesan->status_smtp,
            'waktu' => $pesan->created_at?->format('d M Y, H:i'),
        ]);
    }

    public function destroy(PesanEmail $pesan)
    {
        $userId = auth()->id();

        if ($pesan->pengirim_id !== $userId && $pesan->penerima_id !== $userId && !auth()->user()->isAdmin()) {
            abort(403, 'Anda tidak memiliki akses untuk menghapus pesan ini.');
        }

        $pesan->delete();

        return back()->with('success', 'Pesan berhasil dihapus.');
    }
}
