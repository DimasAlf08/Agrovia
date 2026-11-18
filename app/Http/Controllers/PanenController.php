<?php

namespace App\Http\Controllers;

use App\Models\{HasilPanen, Lahan, Pekerja};
use Illuminate\Http\Request;

class PanenController extends Controller
{
    private function requireAdmin()
    {
        abort_unless(auth()->user()->isAdmin(), 403);
    }

    public function index()
    {
        $data = HasilPanen::with(['lahan', 'pekerja'])->latest('tanggal')->paginate(10);
        return view('panen.index', compact('data'));
    }
    public function create()
    {
        return view('panen.form', [
            'panen' => new HasilPanen(),
            'lahanList' => Lahan::orderBy('nama_lahan')->get(),
            'pekerjaList' => Pekerja::orderBy('nama')->get(),
        ]);
    }
    public function store(Request $request)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'berat' => 'required|numeric|min:0',
            'lahan_id' => 'required|exists:lahan,id',
            'pekerja_id' => 'nullable|exists:pekerja,id'
        ]);
        HasilPanen::create($request->only('tanggal', 'berat', 'lahan_id', 'pekerja_id'));
        return redirect()->route('panen.index')->with('success', 'Hasil panen berhasil dicatat.');
    }
    public function edit(HasilPanen $panen)
    {
        $this->requireAdmin();
        return view('panen.form', [
            'panen' => $panen,
            'lahanList' => Lahan::orderBy('nama_lahan')->get(),
            'pekerjaList' => Pekerja::orderBy('nama')->get(),
        ]);
    }
    public function update(Request $request, HasilPanen $panen)
    {
        $this->requireAdmin();
        $request->validate([
            'tanggal' => 'required|date',
            'berat' => 'required|numeric|min:0',
            'lahan_id' => 'required|exists:lahan,id',
            'pekerja_id' => 'nullable|exists:pekerja,id'
        ]);
        $panen->update($request->only('tanggal', 'berat', 'lahan_id', 'pekerja_id'));
        return redirect()->route('panen.index')->with('success', 'Data panen diperbarui.');
    }
    public function destroy(HasilPanen $panen)
    {
        $this->requireAdmin();
        $panen->delete();
        return redirect()->route('panen.index')->with('success', 'Data panen dihapus.');
    }
}
