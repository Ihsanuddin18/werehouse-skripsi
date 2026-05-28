<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Logistic;
use App\Models\Supplier;
use App\Models\Inlogistic;
use App\Models\Outlogistic;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if (Auth::id()) {

            $usertype = Auth::user()->usertype;

            // ================= USER =================
            if ($usertype == 'user') {

                $inlogistics = Inlogistic::all();

                $logisticsCount    = Logistic::count();
                $suppliersCount    = Supplier::count();
                $inlogisticsCount  = Inlogistic::count();
                $outlogisticsCount = Outlogistic::count();

                // Aktivitas Terbaru
                $inActivities = Inlogistic::with(['logistic', 'supplier', 'user'])
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(fn($item) => [
                        'type'    => 'masuk',
                        'nama'    => optional($item->logistic)->nama_logistik,
                        'jumlah'  => $item->jumlah_logistik_masuk,
                        'satuan'  => optional($item->logistic)->satuan_logistik,
                        'tanggal' => $item->created_at,
                        'user'    => optional($item->user)->name ?? 'Sistem',
                    ]);

                $outActivities = Outlogistic::with(['logistic', 'user'])
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(fn($item) => [
                        'type'    => 'keluar',
                        'nama'    => optional($item->logistic)->nama_logistik,
                        'jumlah'  => $item->jumlah_logistik_keluar,
                        'satuan'  => optional($item->logistic)->satuan_logistik,
                        'tanggal' => $item->created_at,
                        'user'    => optional($item->user)->name ?? 'Sistem',
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
                        'nama'             => optional($item->logistic)->nama_logistik ?? '-',
                        'expayer_logistik' => $item->expayer_logistik,
                        'sisa_hari'        => \Carbon\Carbon::today()->diffInDays($item->expayer_logistik),
                    ])
                    ->sortBy('sisa_hari')
                    ->values();

                return view('dashboard', compact(
                    'inlogistics',
                    'logisticsCount',
                    'suppliersCount',
                    'inlogisticsCount',
                    'outlogisticsCount',
                    'recentActivities',
                    'expiringItems'
                ));
            }

            // ================= STAFF =================
            elseif ($usertype == 'staff') {

                $inlogistics = Inlogistic::all();

                $logisticsCount    = Logistic::count();
                $suppliersCount    = Supplier::count();
                $inlogisticsCount  = Inlogistic::count();
                $outlogisticsCount = Outlogistic::count();

                // Aktivitas Terbaru
                $inActivities = Inlogistic::with(['logistic', 'supplier', 'user'])
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(fn($item) => [
                        'type'    => 'masuk',
                        'nama'    => optional($item->logistic)->nama_logistik,
                        'jumlah'  => $item->jumlah_logistik_masuk,
                        'satuan'  => optional($item->logistic)->satuan_logistik,
                        'tanggal' => $item->created_at,
                        'user'    => optional($item->user)->name ?? 'Sistem',
                    ]);

                $outActivities = Outlogistic::with(['logistic', 'user'])
                    ->latest()
                    ->take(10)
                    ->get()
                    ->map(fn($item) => [
                        'type'    => 'keluar',
                        'nama'    => optional($item->logistic)->nama_logistik,
                        'jumlah'  => $item->jumlah_logistik_keluar,
                        'satuan'  => optional($item->logistic)->satuan_logistik,
                        'tanggal' => $item->created_at,
                        'user'    => optional($item->user)->name ?? 'Sistem',
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
                        'nama'             => optional($item->logistic)->nama_logistik ?? '-',
                        'expayer_logistik' => $item->expayer_logistik,
                        'sisa_hari'        => \Carbon\Carbon::today()->diffInDays($item->expayer_logistik),
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