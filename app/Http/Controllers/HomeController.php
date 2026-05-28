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

                $logisticsCount = Logistic::count();
                $suppliersCount = Supplier::count();
                $inlogisticsCount = Inlogistic::count();
                $outlogisticsCount = Outlogistic::count();

                return view('dashboard', compact(
                    'inlogistics',
                    'logisticsCount',
                    'suppliersCount',
                    'inlogisticsCount',
                    'outlogisticsCount'
                ));
            }

            // ================= STAFF =================
            elseif ($usertype == 'staff') {

                $inlogistics = Inlogistic::all();

                $logisticsCount = Logistic::count();
                $suppliersCount = Supplier::count();
                $inlogisticsCount = Inlogistic::count();
                $outlogisticsCount = Outlogistic::count();

                return view('staff.dashboard', compact(
                    'inlogistics',
                    'logisticsCount',
                    'suppliersCount',
                    'inlogisticsCount',
                    'outlogisticsCount'
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
