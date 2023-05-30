<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use DateTime;
use Illuminate\Http\Request;
use App\Notification;
use App\RekapitulasiWarehouse;
use App\Warehouse;
use App\Finishing;
use App\CuciDibuang;
use App\JahitDibuang;
use App\Jahit;
use App\Bahan;
use App\Cuci;
use App\DetailWarehouse;
use App\Potong;
use App\Produk;
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
            if ($request->get('status') == 'change') {
                $bulan = $request->get('bulan');
                $tahun = $request->get('tahun');
                session(['bulan' => $bulan]);
                session(['tahun' => $tahun]);
            } elseif (session()->has('bulan') && session()->has('tahun')) {
                $bulan = session('bulan');
                $tahun = session('tahun');
            } else {
                $bulan = date('F');
                $tahun = date('Y');
            }

            $bulan = date('m', strtotime($bulan));
            if ($user->hasRole('production')) {
                $tanggal = $tahun . '-' . $bulan;
                $bulanlalu = date('m', strtotime($tanggal . " -1 month"));
                // dd(Bahan::selectRaw('MAX(panjang_bahan) as jumlah_bahan')
                // ->whereMonth('tanggal_masuk', $bulan)
                // ->whereYear('tanggal_masuk', $tahun)
                // ->groupBy('kode_bahan')->get());
                $jumlah_kain_db = Bahan::selectRaw('MAX(panjang_bahan) as jumlah_bahan')
                                    ->whereMonth('tanggal_masuk', $bulan)
                                    ->whereYear('tanggal_masuk', $tahun)
                                    ->groupBy('kode_bahan')
                                    ->get();
                $jumlah_kain = 0;
                foreach($jumlah_kain_db as $kain) $jumlah_kain += $kain->jumlah_bahan;
                
                $jumlah_kain_lalu_db = Bahan::selectRaw('MAX(panjang_bahan) as jumlah_bahan')
                                    ->whereMonth('tanggal_masuk', $bulanlalu)
                                    ->whereYear('tanggal_masuk', $tahun)
                                    ->groupBy('kode_bahan')
                                    ->get();
                $jumlah_kain_lalu = 0;
                foreach($jumlah_kain_lalu_db as $kain) $jumlah_kain_lalu += $kain->jumlah_bahan;

                  // $cucidibuang = Cuci::whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->sum('barang_dibuang');
                  // $jahitdibuang = Jahit::whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->sum('barang_dibuang');
                $jenis_bahan    = Bahan::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->groupBy('kode_bahan')->count();
                $berhasil_cuci  = Cuci::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('berhasil_cuci');
                $hasil_cutting  = Potong::whereMonth('tanggal_cutting', $bulan)->whereYear('tanggal_cutting', $tahun)->sum('hasil_cutting');
                $berhasil_jahit = Jahit::whereMonth('tanggal_jahit', $bulan)->whereYear('tanggal_jahit', $tahun)->sum('berhasil');
                $cucidibuang    = CuciDibuang::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
                $jahitdibuang   = JahitDibuang::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
                $gagal_jahit    = Jahit::whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->sum('gagal_jahit');
                $baju_rusak     = $cucidibuang + $jahitdibuang;
                $reslalu        = $jumlah_kain - $jumlah_kain_lalu;
                $potong         = Potong::with(['bahan'])->whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->limit(5)->get();
                $jahit          = Jahit::with(['potong' => function ($q) {
                    $q->with('bahan');
                }])->whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->limit(5)->get();
                $cuci = Cuci::with(['jahit' => function ($q) {
                    $q->with(['potong' => function ($q) {
                        $q->with('bahan');
                    }]);
                }])->whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->limit(5)->get();
                  // dd(Cuci::whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->limit(5)->get());
                $group_kain = Bahan::select(
                    DB::raw('sum(panjang_bahan) as jumlah'),
                    DB::raw("DATE_FORMAT(tanggal_masuk,'%M %Y') as months")
                )->whereYear('tanggal_masuk', $tahun)->orderBy('months', 'DESC')
                    ->groupBy('months')
                    ->get();

                //grafik pie chart
                $berhasil = $berhasil_cuci + $berhasil_jahit + $hasil_cutting;
                $cucidirepair = Cuci::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('barang_direpair');
                $jahitdirepair =  Jahit::whereMonth('tanggal_jahit', $bulan)->whereYear('tanggal_jahit', $tahun)->sum('barang_direpair');
                $gagal = $baju_rusak;
                $repair = $cucidirepair + $jahitdirepair;
                $retur = Finishing::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('barang_diretur');
                $label = ['Berhasil', 'Repair', 'Retur', 'Gagal'];
                $datapie = [$berhasil, $repair, $retur, $gagal];
                $pie = [
                    'label' => $label,
                    'data' => $datapie
                ];

                //grafik pesanan tiap tahun
                $jumlahbahan = Bahan::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(tanggal_keluar,'%M %Y') as months")
                )->whereYear('tanggal_keluar', $tahun)->orderBy('months', 'DESC')
                    ->groupBy('months')
                    ->get();
                $jumlahbahan = collect($jumlahbahan);
                $jumlahpotong = Potong::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(tanggal_keluar,'%M %Y') as months")
                )->whereYear('tanggal_keluar', $tahun)->orderBy('months', 'DESC')
                    ->groupBy('months')
                    ->get();
                $jumlahpotong = collect($jumlahpotong);
                $jumlahjahit = Jahit::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(tanggal_selesai,'%M %Y') as months")
                )->whereYear('tanggal_selesai', $tahun)->orderBy('months', 'DESC')
                    ->groupBy('months')
                    ->get();
                $jumlahjahit = collect($jumlahjahit);
                $jumlahcuci = Cuci::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(tanggal_selesai,'%M %Y') as months")
                )->whereYear('tanggal_selesai', $tahun)->orderBy('months', 'DESC')
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
                usort($res, function ($a, $b) {
                    $a = strtotime($a['months']);
                    $b = strtotime($b['months']);
                    return $a - $b;
                });

                if ($request->get('status') == 'change') {
                    $bulan = $request->get('bulan');
                    $tahun = $request->get('tahun');
                    session(['bulan' => $bulan]);
                    session(['tahun' => $tahun]);
                } elseif (session()->has('bulan') && session()->has('tahun')) {
                    $bulan = session('bulan');
                    $tahun = session('tahun');
                } else {
                    $bulan = date('F');
                    $tahun = date('Y');
                }

                return response()->json([
                    'status'           => true,
                    'jumlah_kain'      => $jumlah_kain,
                    'jumlah_kain_lalu' => $reslalu,
                    'jenis_bahan'      => $jenis_bahan,
                    'berhasil_cuci'    => $berhasil_cuci,
                    'hasil_cutting'    => $hasil_cutting,
                    'berhasil_jahit'   => $berhasil_jahit,
                    'baju_rusak'       => $baju_rusak,
                    'potong'           => $potong,
                    'jahit'            => $jahit,
                    'cuci'             => $cuci,
                    'group_kain'       => $group_kain,
                    'pie'              => $pie,
                    'line'             => $res,
                    'bulan'            => $bulan,
                    'tahun'            => $tahun,
                    'gagal_jahit'      => $gagal_jahit,
                ]);
            } elseif ($user->hasRole('warehouse')) {

                $rekap = DetailWarehouse::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('jumlah');

                $retur      = Finishing::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('barang_diretur');
                $buang      = Finishing::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('barang_dibuang');
                $warehouse  = Warehouse::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->get();
                $dWarehouse = [];
                foreach($warehouse as $w){
                    $dWarehouse[] = $w->detail_warehouse->avg('harga');
                }

                $avg = number_format(count($dWarehouse) > 0 ? round(array_sum($dWarehouse) / count($dWarehouse)) : 0 , 0, ',', '.');

                $finish = Finishing::with(['cuci' => function ($q) {
                    $q->with(['jahit' => function ($q) {
                        $q->with(['potong' => function ($q) {
                            $q->with('bahan');
                        }]);
                    }]);
                }])->whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->limit(5)->get();


                $warehouse = Warehouse::with(['finishing' => function ($q) {
                    $q->with(['cuci' => function ($q) {
                        $q->with(['jahit' => function ($q) {
                            $q->with(['potong' => function ($q) {
                                $q->with('bahan');
                            }]);
                        }]);
                    }]);
                }])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();
                foreach($warehouse as $wh){
                    // dd(Produk::where('warehouse_id', $wh->id)->first()
                    // ->detail_produk);
                    if(Produk::where('warehouse_id', $wh->id)->exists()){
                        $wh->harga_produk = Produk::where('warehouse_id', $wh->id)->first()
                        ->detail_produk
                        ->avg('harga');
                    }
                    
                }
                // dd($warehouse);


                $dataretur = Retur::with(['finishing' => function ($q) use ($bulan, $tahun) {

                    $q->with(['cuci' => function ($q) {
                        $q->with(['jahit' => function ($q) {
                            $q->with(['potong' => function ($q) {
                                $q->with('bahan');
                            }]);
                        }]);
                    }]);
                }])->whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->limit(5)->get();


                // $cucidibuang    = Cuci::whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->sum('barang_dibuang');
                // $jahitdibuang   = Jahit::whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->sum('barang_dibuang');
                $line = RekapitulasiWarehouse::select(
                    DB::raw('count(*) as jumlah'),
                    DB::raw("DATE_FORMAT(tanggal_masuk,'%M %Y') as months")
                )->whereYear('tanggal_masuk', $tahun)->orderBy('months', 'DESC')
                    ->groupBy('months')
                    ->get();
                $berhasil_cuci  = Cuci::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('berhasil_cuci');
                $hasil_cutting  = Potong::whereMonth('tanggal_cutting', $bulan)->whereYear('tanggal_cutting', $tahun)->sum('hasil_cutting');
                $berhasil_jahit = Jahit::whereMonth('tanggal_jahit', $bulan)->whereYear('tanggal_jahit', $tahun)->sum('berhasil');
                $gagal_jahit    = Jahit::whereMonth('tanggal_selesai', $bulan)->whereYear('tanggal_selesai', $tahun)->sum('gagal_jahit');
                $baju_rusak     = $buang;
                // $cucidibuang    = CuciDibuang::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
                // $jahitdibuang   = JahitDibuang::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
                // $baju_rusak     = $cucidibuang + $jahitdibuang;

                $cucidirepair  = Cuci::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('barang_direpair');
                $jahitdirepair = Jahit::whereMonth('tanggal_jahit', $bulan)->whereYear('tanggal_jahit', $tahun)->sum('barang_direpair');
                $berhasil      = $berhasil_cuci + $berhasil_jahit + $hasil_cutting;
                $gagal         = $baju_rusak;
                $repair        = $cucidirepair + $jahitdirepair;
                $retur         = Finishing::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('barang_diretur');
                $label         = ['Berhasil', 'Repair', 'Retur', 'Gagal'];
                $datapie       = [$berhasil, $repair, $retur, $gagal];
                $pie           = [
                    'label' => $label,
                    'data'  => $datapie
                ];

            
                $bar = DetailWarehouse::select(
                    DB::raw('sum(jumlah) as jumlah'),
                    DB::raw("DATE_FORMAT(created_at,'%M %Y') as months")
                )->whereYear('created_at', $tahun)->orderBy('months', 'DESC')
                    ->groupBy('months')
                    ->get();
                $line = $bar;
                if ($request->get('status') == 'change') {
                    $bulan = $request->get('bulan');
                    $tahun = $request->get('tahun');
                    session(['bulan' => $bulan]);
                    session(['tahun' => $tahun]);
                } elseif (session()->has('bulan') && session()->has('tahun')) {
                    $bulan = session('bulan');
                    $tahun = session('tahun');
                } else {
                    $bulan = date('F');
                    $tahun = date('Y');
                }
                return response()->json([
                    'status'    => true,
                    'rekap'     => $rekap,
                    'retur'     => $retur,
                    'buang'     => $buang,
                    'avg'       => $avg,
                    'finish'    => $finish,
                    'warehouse' => $warehouse,
                    'dataretur' => $dataretur,
                    'line'      => $line,
                    'pie'       => $pie,
                    'bar'       => $bar,
                    'bulan'     => $bulan,
                    'tahun'     => $tahun,
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


    public function read(Request $request)
    {
        if ($request->ajax()) {
            $user = Auth::user();
            if ($user->hasRole('production')) {
                $notif = Notification::where('role', 'production')->update(['aktif' => '1']);
            } else {
                $notif = Notification::where('role', 'warehouse')->update(['aktif' => '1']);
            }

            session()->forget('notification');
            return response()->json(['status' => true]);
        }
    }

    public function readklik(Request $request)
    {
        if ($request->ajax()) {
            $id    = $request->get('id');
            $notif = Notification::where('id', $id)->update(['read' => '1']);
            return response()->json(['status' => true]);
        }
    }
}
