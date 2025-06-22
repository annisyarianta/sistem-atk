<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AtkMasuk;
use App\Models\AtkKeluar;
use App\Models\MasterAtk;
use App\Models\RequestAtk;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class DashboardController  extends Controller
{
    public function index(Request $request)
    {
        $selectedMonth = $request->input('bulan', Carbon::now()->month);
        $selectedYear = $request->input('tahun', Carbon::now()->year);
        $tanggalawal = $request->input('tanggalawalkeluar');
        $tanggalakhir = $request->input('tanggalakhirkeluar');

        if ($request->has('cari')) {
            $inventory_atk = MasterAtk::where("nama_atk", "LIKE", "%" . $request->cari . "%")
                ->orderBy('nama_atk')
                ->paginate();
            $atkmasuk = AtkMasuk::all();
            $atkkeluar = AtkKeluar::all();
            return view('daftar-atk.index', [
                'inventory_atk' => $inventory_atk,
                'atkmasuk' => $atkmasuk,
                'atkkeluar' => $atkkeluar
            ]);
        } else {
            $atkmasuk = AtkMasuk::all();
            $atkkeluar = AtkKeluar::all();
            $totalAtkMasuk = AtkMasuk::sum('jumlah_masuk');
            $totalAtkKeluar = AtkKeluar::sum('jumlah_keluar');
            $jumlah_atk_keseluruhan = $totalAtkMasuk - $totalAtkKeluar;

            $jumlah_atk_masuk_perbulan = AtkMasuk::whereMonth('tanggal_masuk', $selectedMonth)
                ->whereYear('tanggal_masuk', $selectedYear)
                ->sum('jumlah_masuk');

            $jumlah_atk_keluar_perbulan = AtkKeluar::whereMonth('tanggal_keluar', $selectedMonth)
                ->whereYear('tanggal_keluar', $selectedYear)
                ->sum('jumlah_keluar');

            $pendingRequestCount = RequestAtk::where('status', 'pending')->count();

            // Data untuk chart
            $monthlyData = [];

            for ($month = 1; $month <= 12; $month++) {
                $masuk = AtkMasuk::whereMonth('tanggal_masuk', $month)
                    ->whereYear('tanggal_masuk', $selectedYear)
                    ->sum('jumlah_masuk');
                $keluar = AtkKeluar::whereMonth('tanggal_keluar', $month)
                    ->whereYear('tanggal_keluar', $selectedYear)
                    ->sum('jumlah_keluar');

                $monthlyData[] = [
                    'month' => $month,
                    'atk_masuk' => $masuk,
                    'atk_keluar' => $keluar,
                ];
            }

            // Filter berdasarkan tanggal
            $topKeluarQuery = AtkKeluar::query();
            if ($tanggalawal && $tanggalakhir) {
                $topKeluarQuery->whereBetween('tanggal_keluar', [$tanggalawal, $tanggalakhir]);
            }

            // Data untuk chart pie
            $topKeluarQuery = AtkKeluar::query();
            if ($tanggalawal && $tanggalakhir) {
                $topKeluarQuery->whereBetween('tanggal_keluar', [$tanggalawal, $tanggalakhir]);
            } else {
                $topKeluarQuery->whereMonth('tanggal_keluar', $selectedMonth)
                    ->whereYear('tanggal_keluar', $selectedYear);
            }

            $topKeluar = $topKeluarQuery->select('id_atk', DB::raw('SUM(jumlah_keluar) as total_keluar'))
                ->groupBy('id_atk')
                ->orderBy('total_keluar', 'DESC')
                ->limit(5)
                ->get();

            $atkKeluarIds = $topKeluar->pluck('id_atk')->toArray();
            $masterAtkList = MasterAtk::whereIn('id_atk', $atkKeluarIds)->get()->keyBy('id_atk');

            // Menyusun data untuk chart pie
            $chartData = [];
            foreach ($topKeluar as $item) {
                $atk = $masterAtkList[$item->id_atk];
                $chartData['labels'][] = $atk->nama_atk;
                $chartData['data'][] = $item->total_keluar;
            }

            $akan_habis = MasterAtk::orderBy('kode_atk')
                ->get()
                ->filter(function ($item) {
                    return $item->stok_saat_ini <= $item->jumlah_minimum;
                });

            return view('dashboard.index', [
                'atkmasuk' => $atkmasuk,
                'atkkeluar' => $atkkeluar,
                'jumlah_atk_keseluruhan' => $jumlah_atk_keseluruhan,
                'jumlah_atk_masuk_perbulan' => $jumlah_atk_masuk_perbulan,
                'jumlah_atk_keluar_perbulan' => $jumlah_atk_keluar_perbulan,
                'chartData' => $chartData,
                'selectedMonth' => $selectedMonth,
                'selectedYear' => $selectedYear,
                'monthlyData' => $monthlyData,
                'topKeluar' => $topKeluar,
                'masterAtkList' => $masterAtkList,
                'tanggalawal' => $tanggalawal,
                'tanggalakhir' => $tanggalakhir,
                'pendingRequestCount' => $pendingRequestCount,
                'akan_habis' => $akan_habis
            ]);
        }
    }
}
