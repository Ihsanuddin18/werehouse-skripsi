<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlogistic;
use App\Models\Logistic;
use App\Models\Inlogistic;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

class OutLogisticController extends Controller
{
    public function index(Request $request)
    {
        $query = Outlogistic::with('logistic', 'user');

        $month = $request->input('month');
        $year = $request->input('year');

        if ($month && $year) {
            $query->whereYear('tanggal_keluar', $year)
                ->whereMonth('tanggal_keluar', $month);
        } elseif ($year) {
            $query->whereYear('tanggal_keluar', $year);
        }

        $outlogistics = $query->latest()->paginate(15);
        $logistics = Logistic::with('outlogistics')->get();

        $firstYearDate = Outlogistic::min('tanggal_keluar');
        $firstYear = $firstYearDate ? date('Y', strtotime($firstYearDate)) : date('Y');
        $currentYear = date('Y');

        if (Auth::user()->usertype == 'staff') {
            return view('staff.outlogistics.index', [
                'outlogistics' => $outlogistics,
                'logistics' => $logistics,
                'firstYear' => $firstYear,
                'currentYear' => $currentYear,
            ]);
        }

        return view('outlogistics.index', [
            'outlogistics' => $outlogistics,
            'logistics' => $logistics,
            'firstYear' => $firstYear,
            'currentYear' => $currentYear,
        ]);
    }

    public function export_outlogistic_pdf(Request $request)
    {
        $query = Outlogistic::with('logistic');

        $month = $request->input('month');
        $year = $request->input('year');

        if ($month && $year) {
            $query->whereYear('tanggal_keluar', $year)
                ->whereMonth('tanggal_keluar', $month);
        } elseif ($year) {
            $query->whereYear('tanggal_keluar', $year);
        }

        $outlogistics = $query->get();

        foreach ($outlogistics as $outlogistic) {
            $outlogistic->dokumentasi_keluar = $outlogistic->dokumentasi_keluar
                ? public_path('uploads/outlogistic/' . basename($outlogistic->dokumentasi_keluar))
                : null;
            Log::info('Jalur gambar: ' . $outlogistic->dokumentasi_keluar);
        }

        $pdf = PDF::loadView('pdf.export_outlogistic_pdf', ['outlogistics' => $outlogistics]);

        return $pdf->download('export_outlogistic_pdf.pdf');
    }

    public function export_show_outlogistic_pdf($id)
    {
        $outlogistic = Outlogistic::with('logistic')->findOrFail($id);

        if ($outlogistic->dokumentasi_keluar) {
            $outlogistic->dokumentasi_keluar = public_path(
                'uploads/outlogistic/' . basename($outlogistic->dokumentasi_keluar)
            );
            Log::info('Jalur gambar: ' . $outlogistic->dokumentasi_keluar);
        }

        $pdf = PDF::loadView('pdf.export_show_outlogistic_pdf', compact('outlogistic'));

        return $pdf->download('export_show_outlogistic.pdf');
    }

    public function create()
    {
        // Muat relasi outlogistics juga agar stok aktual bisa dihitung di blade
        $logistics = Logistic::with('inlogistics', 'outlogistics')->get();

        if (Auth::user()->usertype == 'staff') {
            return view('staff.outlogistics.create', compact('logistics'));
        }

        return view('outlogistics.create', compact('logistics'));
    }

    /**
     * Store — mendukung penyimpanan BANYAK data sekaligus (array).
     * Data dikirim dalam format:
     *   id_logistik[]
     *   jumlah_logistik_keluar[]
     *   tanggal_keluar[]
     *   nama_penerima[]
     *   nik_kk_penerima[]
     *   nomor_telepon[]
     *   alamat_penerima[]
     *   keterangan_keluar[]
     *   dokumentasi_keluar[]  (file, opsional)
     */
    public function store(Request $request)
    {
        // ── Validasi array ────────────────────────────────────────────────
        $request->validate([
            'id_logistik' => 'required|array|min:1',
            'id_logistik.*' => 'required|exists:logistics,id',
            'jumlah_logistik_keluar' => 'required|array|min:1',
            'jumlah_logistik_keluar.*' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|array|min:1',
            'tanggal_keluar.*' => 'required|date',
            'nama_penerima' => 'required|array|min:1',
            'nama_penerima.*' => 'required|string',
            'nik_kk_penerima' => 'required|array|min:1',
            'nik_kk_penerima.*' => 'required|string',
            'nomor_telepon' => 'required|array|min:1',
            'nomor_telepon.*' => 'required|string',
            'alamat_penerima' => 'required|array|min:1',
            'alamat_penerima.*' => 'required|string',
            'keterangan_keluar' => 'required|array|min:1',
            'keterangan_keluar.*' => 'required|string',
            'dokumentasi_keluar' => 'nullable|array',
            'dokumentasi_keluar.*' => 'nullable|mimes:png,jpg,jpeg,webp|max:5120',
        ]);

        $idLogistikArr = $request->input('id_logistik');
        $jumlahArr = $request->input('jumlah_logistik_keluar');
        $tanggalArr = $request->input('tanggal_keluar');
        $namaArr = $request->input('nama_penerima');
        $nikArr = $request->input('nik_kk_penerima');
        $teleponArr = $request->input('nomor_telepon');
        $alamatArr = $request->input('alamat_penerima');
        $keteranganArr = $request->input('keterangan_keluar');
        $filesArr = $request->file('dokumentasi_keluar') ?? [];

        $total = count($idLogistikArr);
        $path = 'uploads/outlogistic/';

        // Pastikan folder upload ada
        if (!File::exists(public_path($path))) {
            File::makeDirectory(public_path($path), 0755, true);
        }

        // ── Validasi stok sebelum menyimpan satu pun ─────────────────────
        // Kumpulkan total permintaan per logistik dari request ini
        $permintaan = [];
        foreach ($idLogistikArr as $i => $idLogistik) {
            $permintaan[$idLogistik] = ($permintaan[$idLogistik] ?? 0) + (int) $jumlahArr[$i];
        }

        foreach ($permintaan as $idLogistik => $totalDiminta) {
            $logistic = Logistic::with('inlogistics', 'outlogistics')->findOrFail($idLogistik);

            $stokMasuk = $logistic->inlogistics->sum('jumlah_logistik_masuk');
            $stokKeluar = $logistic->outlogistics->sum('jumlah_logistik_keluar');
            $stokAktual = $stokMasuk - $stokKeluar;

            if ($totalDiminta > $stokAktual) {
                return redirect()->back()->withErrors([
                    'jumlah_logistik_keluar' =>
                        'Jumlah logistik "' . $logistic->nama_logistik .
                        '" tidak mencukupi. Stok tersedia: ' . $stokAktual .
                        ', diminta: ' . $totalDiminta . '.',
                ])->withInput();
            }
        }

        // ── Loop simpan satu per satu ─────────────────────────────────────
        for ($i = 0; $i < $total; $i++) {

            $savedPath = null;

            // Upload file jika ada
            if (!empty($filesArr[$i]) && $filesArr[$i]->isValid()) {
                $file = $filesArr[$i];
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '_' . $i . '_' . uniqid() . '.' . $extension;
                $file->move(public_path($path), $filename);
                $savedPath = $path . $filename;
            }

            Outlogistic::create([
                'user_id' => Auth::id(),
                'id_logistik' => $idLogistikArr[$i],
                'jumlah_logistik_keluar' => $jumlahArr[$i],
                'tanggal_keluar' => $tanggalArr[$i],
                'nama_penerima' => $namaArr[$i],
                'nik_kk_penerima' => $nikArr[$i],
                'nomor_telepon' => $teleponArr[$i],
                'alamat_penerima' => $alamatArr[$i],
                'keterangan_keluar' => $keteranganArr[$i],
                'dokumentasi_keluar' => $savedPath,
            ]);

            // ── Kurangi stok inlogistic (FIFO: ambil yang paling lama dulu) ──
            $sisa = (int) $jumlahArr[$i];

            $inlogistics = Inlogistic::where('id_logistik', $idLogistikArr[$i])
                ->where('jumlah_logistik_masuk', '>', 0)
                ->orderBy('tanggal_masuk', 'asc')
                ->get();

            foreach ($inlogistics as $inlogistic) {
                if ($sisa <= 0)
                    break;

                if ($inlogistic->jumlah_logistik_masuk >= $sisa) {
                    $inlogistic->jumlah_logistik_masuk -= $sisa;
                    $sisa = 0;
                } else {
                    $sisa -= $inlogistic->jumlah_logistik_masuk;
                    $inlogistic->jumlah_logistik_masuk = 0;
                }

                $inlogistic->save();
            }
        }

        if (Auth::user()->usertype == 'staff') {
            return redirect()
                ->route('staff.outlogistics.index')
                ->with('success', $total . ' data logistik keluar berhasil disimpan!');
        }

        return redirect()
            ->route('outlogistics')
            ->with('success', $total . ' data logistik keluar berhasil disimpan!');
    }

    public function show($id)
    {
        $outlogistic = Outlogistic::findOrFail($id);
        $inlogistic = $outlogistic->inlogistic;

        if (Auth::user()->usertype == 'staff') {
            return view('staff.outlogistics.show', compact('outlogistic', 'inlogistic'));
        }

        return view('outlogistics.show', compact('outlogistic', 'inlogistic'));
    }

    public function edit(string $id)
    {
        $outlogistic = Outlogistic::findOrFail($id);
        $logistics = Logistic::all();

        if (Auth::user()->usertype == 'staff') {
            return view('staff.outlogistics.edit', compact('outlogistic', 'logistics'));
        }

        return view('outlogistics.edit', compact('outlogistic', 'logistics'));
    }

    public function update(Request $request, $id)
    {
        $outlogistic = Outlogistic::findOrFail($id);

        $oldJumlah = $outlogistic->jumlah_logistik_keluar;

        Log::info('Request Data:', $request->all());

        $validated = $request->validate([
            'tanggal_keluar' => 'required|date',
            'nama_penerima' => 'required|string|max:255',
            'nik_kk_penerima' => 'required|string|max:255',
            'nomor_telepon' => 'required|string|max:255',
            'alamat_penerima' => 'required|string|max:255',
            'jumlah_logistik_keluar' => 'required|integer|min:1',
            'keterangan_keluar' => 'nullable|string',
            'dokumentasi_keluar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $newJumlah = $validated['jumlah_logistik_keluar'];
        $difference = $newJumlah - $oldJumlah; // positif = butuh stok lebih

        if ($difference > 0) {
            // Cek apakah stok cukup untuk tambahan
            $inlogistic = Inlogistic::where('id_logistik', $outlogistic->id_logistik)
                ->where('jumlah_logistik_masuk', '>', 0)
                ->first();

            $totalTersedia = Inlogistic::where('id_logistik', $outlogistic->id_logistik)
                ->sum('jumlah_logistik_masuk');

            if ($difference > $totalTersedia) {
                return redirect()->back()->withErrors([
                    'jumlah_logistik_keluar' => 'Jumlah logistik tidak mencukupi.',
                ]);
            }

            // Kurangi stok (FIFO)
            $sisa = $difference;
            $inlogistics = Inlogistic::where('id_logistik', $outlogistic->id_logistik)
                ->where('jumlah_logistik_masuk', '>', 0)
                ->orderBy('tanggal_masuk', 'asc')
                ->get();

            foreach ($inlogistics as $inlog) {
                if ($sisa <= 0)
                    break;
                if ($inlog->jumlah_logistik_masuk >= $sisa) {
                    $inlog->jumlah_logistik_masuk -= $sisa;
                    $sisa = 0;
                } else {
                    $sisa -= $inlog->jumlah_logistik_masuk;
                    $inlog->jumlah_logistik_masuk = 0;
                }
                $inlog->save();
            }

        } elseif ($difference < 0) {
            // Jumlah dikurangi → kembalikan stok ke inlogistic terbaru
            $kembalikan = abs($difference);
            $inlogistic = Inlogistic::where('id_logistik', $outlogistic->id_logistik)
                ->orderBy('tanggal_masuk', 'desc')
                ->first();

            if ($inlogistic) {
                $inlogistic->jumlah_logistik_masuk += $kembalikan;
                $inlogistic->save();
            }
        }

        $outlogistic->tanggal_keluar = $validated['tanggal_keluar'];
        $outlogistic->nama_penerima = $validated['nama_penerima'];
        $outlogistic->nik_kk_penerima = $validated['nik_kk_penerima'];
        $outlogistic->nomor_telepon = $validated['nomor_telepon'];
        $outlogistic->alamat_penerima = $validated['alamat_penerima'];
        $outlogistic->jumlah_logistik_keluar = $validated['jumlah_logistik_keluar'];
        $outlogistic->keterangan_keluar = $validated['keterangan_keluar'];

        if ($request->hasFile('dokumentasi_keluar')) {
            // Hapus file lama jika ada
            if ($outlogistic->dokumentasi_keluar && File::exists(public_path($outlogistic->dokumentasi_keluar))) {
                File::delete(public_path($outlogistic->dokumentasi_keluar));
            }
            $file = $request->file('dokumentasi_keluar');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '_' . uniqid() . '.' . $extension;
            $path = 'uploads/outlogistic/';
            $file->move(public_path($path), $filename);
            $outlogistic->dokumentasi_keluar = $path . $filename;
        }

        $outlogistic->save();

        if (Auth::user()->usertype == 'staff') {
            return redirect()->route('staff.outlogistics.index')->with('success', 'Data berhasil diperbarui!');
        }

        return redirect()->route('outlogistics')->with('success', 'Data berhasil diperbarui!');
    }

    public function destroy(string $id)
    {
        $outlogistic = Outlogistic::findOrFail($id);

        if ($outlogistic->dokumentasi_keluar && File::exists(public_path($outlogistic->dokumentasi_keluar))) {
            File::delete(public_path($outlogistic->dokumentasi_keluar));
        }

        // Kembalikan stok ke inlogistic (FIFO terbalik: kembalikan ke yang terbaru)
        $inlogistic = Inlogistic::where('id_logistik', $outlogistic->id_logistik)
            ->orderBy('tanggal_masuk', 'desc')
            ->first();

        if ($inlogistic) {
            $inlogistic->jumlah_logistik_masuk += $outlogistic->jumlah_logistik_keluar;
            $inlogistic->save();
        }

        $outlogistic->delete();

        if (Auth::user()->usertype == 'staff') {
            return redirect()->route('staff.outlogistics.index')->with('success', 'Data berhasil dihapus!');
        }

        return redirect()->route('outlogistics')->with('success', 'Data berhasil dihapus!');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:proses,dikirim,selesai',
        ]);

        $outlogistic = Outlogistic::findOrFail($id);
        $outlogistic->update(['status' => $request->status]);

        return response()->json([
            'success' => true,
            'status' => $outlogistic->status,
            'message' => 'Status berhasil diperbarui.',
        ]);
    }
}