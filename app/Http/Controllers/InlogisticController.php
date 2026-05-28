<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inlogistic;
use App\Models\Logistic;
use App\Models\Outlogistic;
use App\Models\Supplier;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class InlogisticController extends Controller
{
    public function index(Request $request)
    {
        $query = Inlogistic::with('logistic', 'supplier', 'user');

        $month = $request->input('month');
        $year = $request->input('year');

        if ($month && $year) {
            $query->whereYear('tanggal_masuk', $year)
                ->whereMonth('tanggal_masuk', $month);
        } elseif ($year) {
            $query->whereYear('tanggal_masuk', $year);
        }

        $inlogistics = $query->latest()->paginate(15);
        $logistics = Logistic::with('inlogistics')->get();
        $suppliers = Supplier::all();

        $firstYearDate = Inlogistic::min('tanggal_masuk');
        $firstYear = $firstYearDate ? date('Y', strtotime($firstYearDate)) : date('Y');
        $currentYear = date('Y');

        if (Auth::user()->usertype == 'staff') {
            return view('staff.inlogistics.index', [
                'inlogistics' => $inlogistics,
                'logistics' => $logistics,
                'suppliers' => $suppliers,
                'firstYear' => $firstYear,
                'currentYear' => $currentYear,
            ]);
        }

        return view('inlogistics.index', [
            'inlogistics' => $inlogistics,
            'logistics' => $logistics,
            'suppliers' => $suppliers,
            'firstYear' => $firstYear,
            'currentYear' => $currentYear,
        ]);
    }

    public function export_inlogistic_pdf(Request $request)
    {
        $query = Inlogistic::with('logistic', 'supplier');

        $month = $request->input('month');
        $year = $request->input('year');

        if ($month && $year) {
            $query->whereYear('tanggal_masuk', $year)
                ->whereMonth('tanggal_masuk', $month);
        } elseif ($year) {
            $query->whereYear('tanggal_masuk', $year);
        }

        $inlogistics = $query->get();

        foreach ($inlogistics as $inlogistic) {
            $inlogistic->dokumentasi_masuk =
                $inlogistic->dokumentasi_masuk
                ? public_path('uploads/inlogistic/' . basename($inlogistic->dokumentasi_masuk))
                : null;
        }

        $pdf = PDF::loadView('pdf.export_inlogistic_pdf', ['inlogistics' => $inlogistics]);

        return $pdf->download('export_inlogistic_pdf.pdf');
    }

    public function export_show_inlogistic_pdf($id)
    {
        $inlogistic = Inlogistic::with('logistic', 'supplier')->findOrFail($id);

        if ($inlogistic->dokumentasi_masuk) {
            $inlogistic->dokumentasi_masuk =
                public_path('uploads/inlogistic/' . basename($inlogistic->dokumentasi_masuk));
        }

        $pdf = PDF::loadView('pdf.export_show_inlogistic_pdf', compact('inlogistic'));

        return $pdf->download('export_show_inlogistic.pdf');
    }

    public function create()
    {
        $logistics = Logistic::all();
        $suppliers = Supplier::all();

        if (Auth::user()->usertype == 'staff') {
            return view('staff.inlogistics.create', compact('logistics', 'suppliers'));
        }

        return view('inlogistics.create', compact('logistics', 'suppliers'));
    }

    /**
     * Store — mendukung penyimpanan BANYAK data sekaligus (array).
     * Data dikirim dalam format:
     *   id_logistik[]
     *   id_supplier[]
     *   jumlah_logistik_masuk[]
     *   satuan_logistik[]
     *   tanggal_masuk[]
     *   expayer_logistik[]
     *   keterangan_masuk[]
     *   dokumentasi_masuk[]   (file, opsional)
     */
    public function store(Request $request)
    {
        // ── Validasi array ───────────────────────────────────────────────────
        $request->validate([
            'id_logistik' => 'required|array|min:1',
            'id_logistik.*' => 'required|exists:logistics,id',
            'id_supplier' => 'required|array|min:1',
            'id_supplier.*' => 'required|exists:suppliers,id',
            'jumlah_logistik_masuk' => 'required|array|min:1',
            'jumlah_logistik_masuk.*' => 'required|integer|min:1',
            'tanggal_masuk' => 'required|array|min:1',
            'tanggal_masuk.*' => 'required|date',
            'expayer_logistik' => 'required|array|min:1',
            'expayer_logistik.*' => 'required|date',
            'keterangan_masuk' => 'required|array|min:1',
            'keterangan_masuk.*' => 'required|string',
            'dokumentasi_masuk' => 'nullable|array',
            'dokumentasi_masuk.*' => 'nullable|mimes:png,jpg,jpeg,webp|max:5120',
        ]);

        $idLogistikArr = $request->input('id_logistik');
        $idSupplierArr = $request->input('id_supplier');
        $jumlahArr = $request->input('jumlah_logistik_masuk');
        $tanggalMasukArr = $request->input('tanggal_masuk');
        $expayerArr = $request->input('expayer_logistik');
        $keteranganArr = $request->input('keterangan_masuk');
        $filesArr = $request->file('dokumentasi_masuk') ?? [];

        $total = count($idLogistikArr);
        $path = 'uploads/inlogistic/';

        // Pastikan folder upload ada
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0755, true);
        }

        // ── Loop simpan satu per satu ────────────────────────────────────────
        for ($i = 0; $i < $total; $i++) {
            $savedPath = null;

            // Upload file jika ada di index ke-i
            if (!empty($filesArr[$i]) && $filesArr[$i]->isValid()) {
                $file = $filesArr[$i];
                $extension = $file->getClientOriginalExtension();
                // Gunakan microtime + index agar filename unik antar iterasi
                $filename = time() . '_' . $i . '_' . uniqid() . '.' . $extension;
                $file->move(public_path($path), $filename);
                $savedPath = $path . $filename;
            }

            Inlogistic::create([
                'user_id' => Auth::id(),
                'id_logistik' => $idLogistikArr[$i],
                'id_supplier' => $idSupplierArr[$i],
                'jumlah_logistik_masuk' => $jumlahArr[$i],
                'tanggal_masuk' => $tanggalMasukArr[$i],
                'expayer_logistik' => $expayerArr[$i],
                'keterangan_masuk' => $keteranganArr[$i],
                'dokumentasi_masuk' => $savedPath,
            ]);
        }

        return redirect()->route('inlogistics')
            ->with('success', $total . ' data logistik masuk berhasil ditambahkan!');
    }

    public function show(string $id)
    {
        $inlogistic = Inlogistic::findOrFail($id);
        $logistics = Logistic::all();

        if (Auth::user()->usertype == 'staff') {
            return view('staff.inlogistics.show', compact('inlogistic', 'logistics'));
        }

        return view('inlogistics.show', compact('inlogistic', 'logistics'));
    }

    public function edit(string $id)
    {
        $inlogistic = Inlogistic::findOrFail($id);
        $logistics = Logistic::all();
        $suppliers = Supplier::all();

        if (Auth::user()->usertype == 'staff') {
            return view('staff.inlogistics.edit', compact('inlogistic', 'logistics', 'suppliers'));
        }

        return view('inlogistics.edit', compact('inlogistic', 'logistics', 'suppliers'));
    }

    public function update(Request $request, string $id)
    {
        $inlogistic = Inlogistic::findOrFail($id);
        $inlogistic->update($request->all());

        return redirect()->route('inlogistics')
            ->with('success', 'Data berhasil diubah!');
    }

    public function destroy($id)
    {
        $inlogistic = Inlogistic::findOrFail($id);

        if ($inlogistic->dokumentasi_masuk && File::exists(public_path($inlogistic->dokumentasi_masuk))) {
            File::delete(public_path($inlogistic->dokumentasi_masuk));
        }

        $inlogistic->delete();

        $outlogistic = Outlogistic::where('id_inlogistik', $id)->first();
        if ($outlogistic) {
            $outlogistic->delete();
        }

        return redirect()->route('inlogistics')
            ->with('success', 'Data berhasil dihapus!');
    }
}