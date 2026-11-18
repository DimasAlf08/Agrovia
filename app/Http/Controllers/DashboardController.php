<?php

namespace App\Http\Controllers;

use App\Models\{Lahan, Pekerja, HasilPanen, KegiatanOperasional};

class DashboardController extends Controller
{
    public function index()
    {
        $bulanIni = now()->month;
        $tahunIni = now()->year;

        $totalLahan    = Lahan::count();
        $totalPekerja  = Pekerja::count();
        $produksiBulan = HasilPanen::whereMonth('tanggal', $bulanIni)
            ->whereYear('tanggal', $tahunIni)->sum('berat');

        $produksiBulanan = HasilPanen::selectRaw('MONTH(tanggal) as bulan, SUM(berat) as total')
            ->whereYear('tanggal', $tahunIni)
            ->groupBy('bulan')->orderBy('bulan')->get();

        $kegiatanTerbaru = KegiatanOperasional::with(['lahan', 'pekerja'])
            ->latest('tanggal')->take(5)->get();

        return view('dashboard', compact(
            'totalLahan',
            'totalPekerja',
            'produksiBulan',
            'produksiBulanan',
            'kegiatanTerbaru'
        ));
    }
}
