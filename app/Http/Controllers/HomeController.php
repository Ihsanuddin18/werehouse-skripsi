<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistic;
use App\Models\Supplier;
use App\Models\Inlogistic;
use App\Models\Outlogistic;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            // 🔥 WAJIB taruh ini di awal
            $bulan = $request->bulan ?? now()->month;
            $tahun = $request->tahun ?? now()->year;


            // ================= USER =================
            if ($usertype == 'user') {

                $inlogistics = Inlogistic::all();

                $logisticsCount = Logistic::count();
                $suppliersCount = Supplier::count();
                $inlogisticsCount = Inlogistic::whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->count();

                $outlogisticsCount = Outlogistic::whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->count();


                // ================= GRAFIK PENERIMAAN =================
                $currentMonth = $bulan;
                $currentYear = $tahun;

                // Penerimaan
                $penerimaan = Inlogistic::select(
                    DB::raw("
        CASE
            WHEN DAY(tanggal_masuk) BETWEEN 1 AND 7 THEN '1-7'
            WHEN DAY(tanggal_masuk) BETWEEN 8 AND 14 THEN '8-14'
            WHEN DAY(tanggal_masuk) BETWEEN 15 AND 21 THEN '15-21'
            WHEN DAY(tanggal_masuk) BETWEEN 22 AND 28 THEN '22-28'
            ELSE '29-31'
        END as minggu
    "),
                    DB::raw('SUM(jumlah_logistik_masuk) as total')
                )
                    ->whereMonth('tanggal_masuk', $currentMonth)
                    ->whereYear('tanggal_masuk', $currentYear)
                    ->groupBy('minggu')
                    ->get();

                $pengeluaran = Outlogistic::select(
                    DB::raw("
        CASE
            WHEN DAY(tanggal_keluar) BETWEEN 1 AND 7 THEN '1-7'
            WHEN DAY(tanggal_keluar) BETWEEN 8 AND 14 THEN '8-14'
            WHEN DAY(tanggal_keluar) BETWEEN 15 AND 21 THEN '15-21'
            WHEN DAY(tanggal_keluar) BETWEEN 22 AND 28 THEN '22-28'
            ELSE '29-31'
        END as minggu
    "),
                    DB::raw('SUM(jumlah_logistik_keluar) as total')
                )
                    ->whereMonth('tanggal_keluar', $currentMonth)
                    ->whereYear('tanggal_keluar', $currentYear)
                    ->groupBy('minggu')
                    ->get();

                // ================= STOK BERDASARKAN JENIS LOGISTIK =================

                $namaLogistik = [];
                $stokLogistik = [];

                $logistics = Logistic::all();

                foreach ($logistics as $logistic) {

                    $masuk = Inlogistic::where('id_logistik', $logistic->id)
                        ->sum('jumlah_logistik_masuk');

                    $keluar = Outlogistic::where('id_logistik', $logistic->id)
                        ->sum('jumlah_logistik_keluar');

                    $namaLogistik[] = $logistic->nama_logistik;

                    $stokLogistik[] = max(0, $masuk - $keluar);
                }

                // Aktivitas Terbaru
                $inActivities = Inlogistic::with(['logistic', 'supplier', 'user'])
                    ->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'type' => 'masuk',
                            'nama' => optional($item->logistic)->nama_logistik,
                            'jumlah' => $item->jumlah_logistik_masuk,
                            'satuan' => optional($item->logistic)->satuan_logistik,
                            'tanggal' => $item->created_at,
                            'user' => optional($item->user)->name ?? 'Sistem',
                        ];
                    });

                $outActivities = Outlogistic::with(['logistic', 'user'])
                    ->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(function ($item) {
                        return [
                            'type' => 'keluar',
                            'nama' => optional($item->logistic)->nama_logistik,
                            'jumlah' => $item->jumlah_logistik_keluar,
                            'satuan' => optional($item->logistic)->satuan_logistik,
                            'tanggal' => $item->created_at,
                            'user' => optional($item->user)->name ?? 'Sistem',
                        ];
                    });

                $recentActivities = $inActivities->merge($outActivities)
                    ->sortByDesc('tanggal')
                    ->take(10)
                    ->values();

                // Mendekati Kadaluarsa (sisa <= 7 hari)
                $expiringItems = Inlogistic::with(['logistic'])
                    ->whereDate('expayer_logistik', '>=', \Carbon\Carbon::today())
                    ->whereDate('expayer_logistik', '<=', \Carbon\Carbon::today()->addDays(7))
                    ->get()
                    ->unique('id_logistik')
                    ->map(fn($item) => [
                        'nama' => optional($item->logistic)->nama_logistik ?? '-',
                        'expayer_logistik' => $item->expayer_logistik,
                        'sisa_hari' => \Carbon\Carbon::today()->diffInDays($item->expayer_logistik),
                    ])
                    ->sortBy('sisa_hari')
                    ->values();

                // Stok Menipis (<= 20)
                $lowStockItems = Inlogistic::with('logistic')
                    ->where('jumlah_logistik_masuk', '<=', 20)
                    ->orderBy('jumlah_logistik_masuk', 'ASC')
                    ->get()
                    ->map(function ($item) {
                        return [
                            'nama' => optional($item->logistic)->nama_logistik ?? '-',
                            'stok' => $item->jumlah_logistik_masuk,
                           
                        ];
                    });

                return view('dashboard', compact(
                    'inlogistics',
                    'logisticsCount',
                    'suppliersCount',
                    'inlogisticsCount',
                    'outlogisticsCount',
                    'recentActivities',
                    'expiringItems',
                    'lowStockItems',
                    'penerimaan',
                    'pengeluaran',
                    'namaLogistik',
                    'stokLogistik',
                    'inActivities',
                    'outActivities',
                    'recentActivities'

                ));

            }

            // ================= STAFF =================
            elseif ($usertype == 'staff') {

                $inlogistics = Inlogistic::all();

                $logisticsCount = Logistic::count();
                $suppliersCount = Supplier::count();
                $inlogisticsCount = Inlogistic::count();
                $outlogisticsCount = Outlogistic::count();

                // Aktivitas Terbaru
                $inActivities = Inlogistic::with(['logistic', 'supplier', 'user'])
                    ->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(fn($item) => [
                        'type' => 'masuk',
                        'nama' => optional($item->logistic)->nama_logistik,
                        'jumlah' => $item->jumlah_logistik_masuk,
                        'satuan' => optional($item->logistic)->satuan_logistik,
                        'tanggal' => $item->created_at,
                        'user' => optional($item->user)->name ?? 'Sistem',
                    ]);

                $outActivities = Outlogistic::with(['logistic', 'user'])
                    ->whereMonth('created_at', $bulan)
                    ->whereYear('created_at', $tahun)
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(fn($item) => [
                        'type' => 'keluar',
                        'nama' => optional($item->logistic)->nama_logistik,
                        'jumlah' => $item->jumlah_logistik_keluar,
                        'satuan' => optional($item->logistic)->satuan_logistik,
                        'tanggal' => $item->created_at,
                        'user' => optional($item->user)->name ?? 'Sistem',
                    ]);

                $recentActivities = $inActivities->merge($outActivities)
                    ->sortByDesc('tanggal')
                    ->take(10)
                    ->values();

                // Mendekati Kadaluarsa (sisa <= 7 hari)
                $expiringItems = Inlogistic::with(['logistic'])
                    ->whereDate('expayer_logistik', '>=', \Carbon\Carbon::today())
                    ->whereDate('expayer_logistik', '<=', \Carbon\Carbon::today()->addDays(7))
                    ->get()
                    ->unique('id_logistik')
                    ->map(fn($item) => [
                        'nama' => optional($item->logistic)->nama_logistik ?? '-',
                        'expayer_logistik' => $item->expayer_logistik,
                        'sisa_hari' => \Carbon\Carbon::today()->diffInDays($item->expayer_logistik),
                    ])
                    ->sortBy('sisa_hari')
                    ->values();

                return view('staff.dashboard', compact(
                    'inlogistics',
                    'logisticsCount',
                    'suppliersCount',
                    'inlogisticsCount',
                    'outlogisticsCount',
                    'recentActivities',
                    'expiringItems'
                ));
            }

            // ================= ANGGOTA =================
            elseif ($usertype == 'anggota') {

                return view('anggota.anggotahome');
            }

            // ================= DEFAULT =================
            else {

                return redirect()->back();
            }
        }

        return redirect()->route('login');
    }

    public function post()
    {
        return view('post');
    }
}