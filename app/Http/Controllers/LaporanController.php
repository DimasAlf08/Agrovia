<?php

namespace App\Http\Controllers;

use App\Models\HasilPanen;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $tahun = $request->get('tahun', now()->year);
        $tahunList = HasilPanen::selectRaw('YEAR(tanggal) as t')->distinct()->pluck('t')
            ->push(now()->year)->unique()->sortDesc();
        return view('laporan.index', compact('tahun', 'tahunList'));
    }

    public function produksi(Request $request)
    {
        $tahun = $request->get('tahun', now()->year);
        $data = HasilPanen::with(['lahan', 'pekerja'])
            ->whereYear('tanggal', $tahun)->orderBy('tanggal')->get();

        $perBulan = HasilPanen::selectRaw('MONTH(tanggal) as bulan, SUM(berat) as total')
            ->whereYear('tanggal', $tahun)->groupBy('bulan')->orderBy('bulan')->get();

        $perLahan = HasilPanen::selectRaw('lahan_id, SUM(berat) as total')
            ->with('lahan')->whereYear('tanggal', $tahun)->groupBy('lahan_id')->get();

        return view('laporan.hasil', compact('data', 'perBulan', 'perLahan', 'tahun'));
    }

    public function export(Request $request)
    {
        $tahun = $request->get('tahun', now()->year);
        $data  = HasilPanen::with(['lahan', 'pekerja'])->whereYear('tanggal', $tahun)->get();
        $filename = "laporan_produksi_{$tahun}.csv";

        return response()->streamDownload(function () use ($data) {
            $out = fopen('php://output', 'w');
            fputcsv($out, ['Tanggal', 'Lahan', 'Pekerja', 'Berat (kg)']);
            foreach ($data as $row) {
                fputcsv($out, [
                    $row->tanggal->format('Y-m-d'),
                    $row->lahan->nama_lahan ?? '-',
                    $row->pekerja->nama ?? '-',
                    $row->berat,
                ]);
            }
            fclose($out);
        }, $filename, ['Content-Type' => 'text/csv']);
    }
}
