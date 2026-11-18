<?php

namespace App\Http\Controllers;

use App\Models\Pekerja;
use Illuminate\Http\Request;

class PekerjaController extends Controller
{
    public function index()
    {
        $data = Pekerja::orderBy('nama')->paginate(10);
        return view('pekerja.index', compact('data'));
    }
    public function create()
    {
        return view('pekerja.form', ['pekerja' => new Pekerja()]);
    }
    public function store(Request $request)
    {
        $request->validate(['nama' => 'required|max:100', 'jabatan' => 'nullable|max:50', 'telp' => 'nullable|max:15']);
        Pekerja::create($request->only('nama', 'jabatan', 'telp'));
        return redirect()->route('pekerja.index')->with('success', 'Pekerja berhasil ditambahkan.');
    }
    public function edit(Pekerja $pekerja)
    {
        return view('pekerja.form', compact('pekerja'));
    }
    public function update(Request $request, Pekerja $pekerja)
    {
        $request->validate(['nama' => 'required|max:100', 'jabatan' => 'nullable|max:50', 'telp' => 'nullable|max:15']);
        $pekerja->update($request->only('nama', 'jabatan', 'telp'));
        return redirect()->route('pekerja.index')->with('success', 'Pekerja berhasil diperbarui.');
    }
    public function destroy(Pekerja $pekerja)
    {
        $pekerja->delete();
        return redirect()->route('pekerja.index')->with('success', 'Pekerja berhasil dihapus.');
    }
}
