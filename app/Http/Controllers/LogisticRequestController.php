<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LogisticRequest;
use App\Models\Logistic;
use App\Models\Inlogistic;
use App\Models\Outlogistic;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;

class LogisticRequestController extends Controller
{
    public function index(Request $request)
    {
        // Tahun default: tahun depan
        $tahun = $request->input('year', date('Y') + 1);

        // Ambil semua logistik
        $logistics = Logistic::with(['inlogistics', 'outlogistics'])->get();

        $logisticrequests = [];

        foreach ($logistics as $logistic) {
            // Total stok masuk dan keluar
            $stokMasuk = $logistic->inlogistics->sum('jumlah_logistik_masuk');
            $stokKeluar = $logistic->outlogistics->sum('jumlah_logistik_keluar');
            $stokSaatIni = $stokMasuk - $stokKeluar;

            // Rata-rata penggunaan per bulan tahun berjalan
            $rataBulanan = Outlogistic::where('id_logistik', $logistic->id)
                ->whereYear('tanggal_keluar', date('Y'))
                ->avg('jumlah_logistik_keluar') ?? 0;

            $rekomendasiTahunan = round($rataBulanan * 12, 2);
            $status = $stokSaatIni >= $rekomendasiTahunan ? 'Aman' : 'Perlu Pengadaan';

            $logisticrequests[] = [
                'nama_logistik' => $logistic->nama_logistik,
                'stok_saat_ini' => $stokSaatIni,
                'rata_bulanan' => round($rataBulanan, 2),
                'rekomendasi_tahunan' => $rekomendasiTahunan,
                'status' => $status,
            ];
        }

        // Tahun pertama data
        $firstYearDate = Inlogistic::min('tanggal_masuk');
        $firstYear = $firstYearDate ? date('Y', strtotime($firstYearDate)) : date('Y');
        $currentYear = date('Y');

        return view('logisticrequests.index', [
            'logisticrequests' => $logisticrequests,
            'firstYear' => $firstYear,
            'currentYear' => $currentYear,
            'tahun' => $tahun,
        ]);
    }

    /**
     * Export hasil rekomendasi stok ke PDF
     */
    public function export_logistic_request_pdf(Request $request)
    {
        $tahun = $request->input('year', date('Y') + 1);

        $logistics = Logistic::with(['inlogistics', 'outlogistics'])->get();

        $data = [];
        foreach ($logistics as $logistic) {
            $stokMasuk = $logistic->inlogistics->sum('jumlah_logistik_masuk');
            $stokKeluar = $logistic->outlogistics->sum('jumlah_logistik_keluar');
            $stokSaatIni = $stokMasuk - $stokKeluar;

            $rataBulanan = Outlogistic::where('id_logistik', $logistic->id)
                ->whereYear('tanggal_keluar', date('Y'))
                ->avg('jumlah_logistik_keluar') ?? 0;

            $rekomendasiTahunan = round($rataBulanan * 12, 2);
            $status = $stokSaatIni >= $rekomendasiTahunan ? 'Aman' : 'Perlu Pengadaan';

            $data[] = [
                'nama_logistik' => $logistic->nama_logistik,
                'stok_saat_ini' => $stokSaatIni,
                'rata_bulanan' => round($rataBulanan, 2),
                'rekomendasi_tahunan' => $rekomendasiTahunan,
                'status' => $status,
            ];
        }

        $pdf = PDF::loadView('pdf.export_logistic_request', [
            'logisticrequests' => $data,
            'tahun' => $tahun
        ]);

        return $pdf->download('Rekomendasi_Stok_' . $tahun . '.pdf');
    }

    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

}
