<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CuciDibuang;
use App\JahitDibuang;
use App\Jahit;
use App\Bahan;
use App\Cuci;
use App\Potong;

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
            $bulan = $request->get('bulan');
            $tahun = $request->get('tahun');
            $bulan = date('m',strtotime($bulan));
            $jumlah_kain = Bahan::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('panjang_bahan');
            $jenis_bahan = Bahan::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->count();
            $berhasil_cuci = Cuci::whereMonth('tanggal_masuk', $bulan)->whereYear('tanggal_masuk', $tahun)->sum('berhasil_cuci');
            $hasil_cutting = Potong::whereMonth('tanggal_cutting', $bulan)->whereYear('tanggal_cutting', $tahun)->sum('hasil_cutting');
            $berhasil_jahit = Jahit::whereMonth('tanggal_jahit', $bulan)->whereYear('tanggal_jahit', $tahun)->sum('berhasil');
            $cucidibuang = CuciDibuang::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('jumlah');
            $jahitdibuang = JahitDibuang::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->sum('jumlah');
            $baju_rusak = $cucidibuang + $jahitdibuang;

            $potong = Potong::with(['bahan'])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();
            $jahit = Jahit::with(['potong'=> function($q){
                $q->with('bahan');
            }])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();
            $cuci = Cuci::with(['jahit'=> function($q){
                $q->with(['potong' => function($q){
                    $q->with('bahan');
                }]);
            }])->whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->limit(5)->get();
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
            ]);
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
