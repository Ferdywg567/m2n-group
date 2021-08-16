<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\RekapitulasiWarehouse;
use App\Warehouse;
use App\Finishing;
use App\CuciDibuang;
use App\JahitDibuang;
use App\Jahit;
use App\Bahan;
use App\Cuci;
use App\Potong;
use App\Retur;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        if ($request->ajax()) {
            $user = Auth::user();
            $bulan = $request->get('bulan');
            $tahun = $request->get('tahun');
            $bulan = date('m', strtotime($bulan));
            if ($user->hasRole('production')) {
                $jumlah_kain = Bahan::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('panjang_bahan');
                $jenis_bahan = Bahan::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->count();
                $berhasil_cuci = Cuci::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('berhasil_cuci');
                $hasil_cutting = Potong::whereMonth('tanggal_cutting', $bulan)->whereYear('tanggal_cutting', $tahun)->sum('hasil_cutting');
                $berhasil_jahit = Jahit::whereMonth('tanggal_jahit', $bulan)->whereYear('tanggal_jahit', $tahun)->sum('berhasil');
                $cucidibuang = CuciDibuang::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('jumlah');
                $jahitdibuang = JahitDibuang::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('jumlah');
                $baju_rusak = $cucidibuang + $jahitdibuang;

                $potong = Potong::with(['bahan'])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();
                $jahit = Jahit::with(['potong' => function ($q) {
                    $q->with('bahan');
                }])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();
                $cuci = Cuci::with(['jahit' => function ($q) {
                    $q->with(['potong' => function ($q) {
                        $q->with('bahan');
                    }]);
                }])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();

                $group_kain = Bahan::select(
                    DB::raw('sum(panjang_bahan) as jumlah'),
                    DB::raw("DATE_FORMAT(tanggal_masuk,'%M %Y') as months")
                )->whereYear('tanggal_masuk', $tahun)
                    ->groupBy('months')
                    ->get();

                //grafik pie chart
                $berhasil = $berhasil_cuci + $berhasil_jahit + $hasil_cutting;
                $cucidirepair = Cuci::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('barang_direpair');
                $jahitdirepair =  Jahit::whereMonth('tanggal_jahit', $bulan)->whereYear('tanggal_jahit', $tahun)->sum('barang_direpair');
                $gagal = $baju_rusak;
                $repair = $cucidirepair + $jahitdirepair;
                $retur = 0;
                $label = ['Berhasil', 'Repair', 'Retur', 'Gagal'];
                $datapie = [$berhasil, $repair, $retur, $gagal];
                $pie = [
                    'label' => $label,
                    'data' => $datapie
                ];

                //grafik pesanan tiap tahun
                $jumlahbahan = Bahan::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                )->whereYear('created_at', $tahun)
                    ->groupBy('months')
                    ->get();
                $jumlahbahan = collect($jumlahbahan);
                $jumlahpotong = Potong::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                )->whereYear('created_at', $tahun)
                    ->groupBy('months')
                    ->get();
                $jumlahpotong = collect($jumlahpotong);
                $jumlahjahit = Jahit::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                )->whereYear('created_at', $tahun)
                    ->groupBy('months')
                    ->get();
                $jumlahjahit = collect($jumlahjahit);
                $jumlahcuci = Cuci::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                )->whereYear('created_at', $tahun)
                    ->groupBy('months')
                    ->get();
                $jumlahcuci = collect($jumlahcuci);
                $result = $jumlahbahan->merge($jumlahpotong);
                $result = $jumlahjahit->merge($result);
                $result = $jumlahcuci->merge($result);
                $res = [];

                foreach ($result as $key => $value) {
                    if (array_key_exists($value->months, $res)) {
                        $res[$value->months]['jumlah'] += $value->jumlah;
                        $res[$value->months]['months'] = $value->months;
                    } else {
                        $res[$value->months] = $value;
                    }
                }

                $res = array_values($res);
                return response()->json([
                    'status' => true,
                    'jumlah_kain' => $jumlah_kain,
                    'jenis_bahan' => $jenis_bahan,
                    'berhasil_cuci' => $berhasil_cuci,
                    'hasil_cutting' => $hasil_cutting,
                    'berhasil_jahit' => $berhasil_jahit,
                    'baju_rusak' => $baju_rusak,
                    'potong' => $potong,
                    'jahit' => $jahit,
                    'cuci' => $cuci,
                    'group_kain' => $group_kain,
                    'pie' => $pie,
                    'line' => $res
                ]);
            } elseif ($user->hasRole('warehouse')) {

                $rekap = RekapitulasiWarehouse::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('total_barang');
                $retur = Finishing::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('barang_diretur');
                $buang = Finishing::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('barang_dibuang');
                $avg = Warehouse::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->avg('harga_produk');

                if(empty($avg)){
                    $avg = 0;
                }
                $finish = Finishing::with(['rekapitulasi' => function ($q) {
                    $q->with(['cuci' => function ($q) {
                        $q->with(['jahit' => function ($q) {
                            $q->with(['potong' => function ($q) {
                                $q->with('bahan');
                            }]);
                        }]);
                    }]);
                }])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();


                $warehouse = Warehouse::with(['finishing' => function ($q) {
                    $q->with(['rekapitulasi' => function ($q) {
                        $q->with(['cuci' => function ($q) {
                            $q->with(['jahit' => function ($q) {
                                $q->with(['potong' => function ($q) {
                                    $q->with('bahan');
                                }]);
                            }]);
                        }]);
                    }]);
                }])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();


                $dataretur = Retur::with(['finishing' => function ($q) {
                    $q->with(['rekapitulasi' => function ($q) {
                        $q->with(['cuci' => function ($q) {
                            $q->with(['jahit' => function ($q) {
                                $q->with(['potong' => function ($q) {
                                    $q->with('bahan');
                                }]);
                            }]);
                        }]);
                    }]);
                }])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();


                $line = RekapitulasiWarehouse::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                )->whereYear('created_at', $tahun)
                    ->groupBy('months')
                    ->get();

                $label = ['Berhasil',  'Retur', 'Gagal'];
                $datapie = [$rekap, $retur, $buang];
                $pie = [
                    'label' => $label,
                    'data' => $datapie
                ];

                $bar = RekapitulasiWarehouse::select(
                    DB::raw('sum(total_barang) as jumlah'),
                    DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                )->whereYear('created_at', $tahun)
                    ->groupBy('months')
                    ->get();


                return response()->json([
                    'status' => true,
                    'rekap' => $rekap,
                    'retur' => $retur,
                    'buang' => $buang,
                    'avg' => $avg,
                    'finish' => $finish,
                    'warehouse' => $warehouse,
                    'dataretur' => $dataretur,
                    'line' => $line,
                    'pie' => $pie,
                    'bar' => $bar,
                ]);
            }
        }

        $tahun = [];

        for ($i = 2018; $i <= date('Y'); $i++) {
            array_push($tahun, $i);
        }
        return view("backend.dashboard.index", ['month' => $month, 'tahun' => $tahun]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
