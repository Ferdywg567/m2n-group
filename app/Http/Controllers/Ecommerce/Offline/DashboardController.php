<?php

namespace App\Http\Controllers\Ecommerce\Offline;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Produk;
use Illuminate\Support\Carbon;
use App\Transaksi;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $offline = Transaksi::select(
                DB::raw("(sum(total_harga)) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as tanggal")
            )->where('status_transaksi', 'offline')
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))->limit(10)
                ->get();
            $online = Transaksi::select(
                DB::raw("(sum(total_harga)) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as tanggal")
            )->where('status_transaksi', 'online')
                ->where('status_bayar', 'sudah dibayar')
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))->limit(10)
                ->get();


            $semua = Transaksi::select(
                DB::raw("(sum(total_harga)) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as tanggal")
            )->orwhere('status_bayar', 'sudah dibayar')->orwhere('status_transaksi', 'offline')
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))->limit(10)
                ->get();
            return response()->json([
                'offline' => $offline,
                'online' => $online,
                'semua' => $semua,
                'status' => true
            ]);
        }

        $bulan = date('m');
        $tahun = date('Y');

        $pendapatan = Transaksi::where('status_transaksi', 'offline')->whereMonth('created_at', $bulan)
        ->whereYear('created_at', $tahun)
        ->sum('total_harga');
        $transaksi = Transaksi::whereMonth('created_at', $bulan)->where('status_transaksi', 'offline')
        ->whereYear('created_at', $tahun)
        ->count();
        $produk = Produk::count();
        return view('ecommerce.offline.dashboard.index', ['pendapatan' => $pendapatan, 'transaksi' => $transaksi, 'produk' => $produk]);
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

    public function transaksi()
    {
        $bulan = date('m');
        $tahun = date('Y');

        $transaksi = Transaksi::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        return view("ecommerce.offline.dashboard.transaksi", ['transaksi' => $transaksi]);
    }
}
