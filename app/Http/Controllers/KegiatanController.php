<?php

namespace App\Http\Controllers;

use App\Models\{KegiatanOperasional, Lahan, Pekerja};
use Illuminate\Http\Request;

class KegiatanController extends Controller
{
    public function index()
    {
        $data = KegiatanOperasional::with(['lahan', 'pekerja'])->latest('tanggal')->paginate(10);
        return view('kegiatan.index', compact('data'));
    }
    public function create()
    {
        return view('kegiatan.form', [
            'kegiatan' => new KegiatanOperasional(),
            'lahanList' => Lahan::orderBy('nama_lahan')->get(),
            'pekerjaList' => Pekerja::orderBy('nama')->get(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|max:100',
            'tanggal' => 'required|date',
            'lahan_id' => 'required|exists:lahan,id',
            'pekerja_id' => 'nullable|exists:pekerja,id'
        ]);
        KegiatanOperasional::create($request->only('jenis', 'tanggal', 'lahan_id', 'pekerja_id'));
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
    }
    public function edit(KegiatanOperasional $kegiatan)
    {
        return view('kegiatan.form', [
            'kegiatan' => $kegiatan,
            'lahanList' => Lahan::orderBy('nama_lahan')->get(),
            'pekerjaList' => Pekerja::orderBy('nama')->get(),
        ]);
    }
    public function update(Request $request, KegiatanOperasional $kegiatan)
    {
        $request->validate([
            'jenis' => 'required|max:100',
            'tanggal' => 'required|date',
            'lahan_id' => 'required|exists:lahan,id',
            'pekerja_id' => 'nullable|exists:pekerja,id'
        ]);
        $kegiatan->update($request->only('jenis', 'tanggal', 'lahan_id', 'pekerja_id'));
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan diperbarui.');
    }
    public function destroy(KegiatanOperasional $kegiatan)
    {
        $kegiatan->delete();
        return redirect()->route('kegiatan.index')->with('success', 'Kegiatan dihapus.');
    }
}
