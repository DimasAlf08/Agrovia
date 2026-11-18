<?php

namespace App\Http\Controllers;

use App\Models\Lahan;
use Illuminate\Http\Request;

class LahanController extends Controller
{
    public function index()
    {
        $data = Lahan::with('user')->orderBy('nama_lahan')->paginate(10);
        return view('lahan.index', compact('data'));
    }
    public function create()
    {
        return view('lahan.form', ['lahan' => new Lahan()]);
    }
    public function store(Request $request)
    {
        $request->validate(['nama_lahan' => 'required|unique:lahan|max:100', 'luas' => 'required|numeric|min:0']);
        Lahan::create($request->only('nama_lahan', 'luas') + ['user_id' => auth()->id()]);
        return redirect()->route('lahan.index')->with('success', 'Lahan berhasil ditambahkan.');
    }
    public function edit(Lahan $lahan)
    {
        return view('lahan.form', compact('lahan'));
    }
    public function update(Request $request, Lahan $lahan)
    {
        $request->validate(['nama_lahan' => 'required|max:100|unique:lahan,nama_lahan,' . $lahan->id, 'luas' => 'required|numeric|min:0']);
        $lahan->update($request->only('nama_lahan', 'luas'));
        return redirect()->route('lahan.index')->with('success', 'Lahan berhasil diperbarui.');
    }
    public function destroy(Lahan $lahan)
    {
        $lahan->delete();
        return redirect()->route('lahan.index')->with('success', 'Lahan berhasil dihapus.');
    }
}
