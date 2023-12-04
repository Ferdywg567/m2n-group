<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use App\Http\Controllers\Controller;
use App\Produk;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
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

            $bulan = date('m', strtotime($bulan));
            $semua = Transaksi::select(
                DB::raw("(sum(total_harga)) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as tanggal")
            )->orwhere('status_bayar', 'sudah dibayar')->orwhere('status_transaksi', 'offline')
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))->limit(10)
                ->get();
            $pendapatan = Transaksi::where('status_bayar', 'sudah dibayar')->whereMonth('created_at', $bulan)
                ->whereYear('created_at', $tahun)
                ->sum('total_harga');
            // $transaksi = Transaksi::whereMonth('created_at', $bulan)->where('status_transaksi', 'online')
            //     ->whereYear('created_at', $tahun)
            //     ->count();
            $transaksi['belum_dibayar'] = Transaksi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->where('status_transaksi', 'online')->whereNull('bukti_bayar')->count();

            $transaksi['belum_dikirim'] = Transaksi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->where('status_transaksi', 'online')->where('status_bayar', 'sudah dibayar')->where('status', 'butuh konfirmasi')->count();

            $transaksi['dikirim'] = Transaksi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->where('status_transaksi', 'online')->whereIn('status', ['dikirim', 'retur'])->count();

            $transaksi['selesai'] = Transaksi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->where('status_transaksi', 'online')->where('status', 'telah tiba')->count();

            $produk = Produk::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
            return response()->json([
                'offline'    => $offline,
                'online'     => $online,
                'semua'      => $semua,
                'pendapatan' => $pendapatan,
                'transaksi'  => $transaksi,
                'produk'     => $produk,
                'status'     => true
            ]);
        }

        $bulan = date('m');
        $tahun = date('Y');

        $pendapatan = Transaksi::where('status_bayar', 'sudah dibayar')->whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->sum('total_harga');
        $produk = Produk::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->count();
        $tahun = [];

        $transaksi['belum_dibayar'] = Transaksi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->where('status_transaksi', 'online')->whereNull('bukti_bayar')->count();

        $transaksi['belum_dikirim'] = Transaksi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->where('status_transaksi', 'online')->where('status_bayar', 'sudah dibayar')->where('status', 'butuh konfirmasi')->count();

        $transaksi['dikirim'] = Transaksi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->where('status_transaksi', 'online')->whereIn('status', ['dikirim', 'retur'])->count();

        $transaksi['selesai'] = Transaksi::whereMonth('created_at', $bulan)->whereYear('created_at', $tahun)->where('status_transaksi', 'online')->where('status', 'telah tiba')->count();

        for ($i = 2018; $i <= date('Y'); $i++) {
            array_push($tahun, $i);
        }

        // dd($transaksi);

        $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        return view("ecommerce.admin.dashboard.index", [
            'pendapatan' => $pendapatan,
            'transaksi'  => $transaksi,
            'produk'     => $produk,
            'month'      => $month,
            'tahun'      => $tahun
        ]);
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
        if (session()->has('bulan') && session()->has('tahun')) {
            $bulan = session('bulan');
            $tahun = session('tahun');
            $bulan = date('m', strtotime($bulan));
        } else {
            $bulan = date('m');
            $tahun = date('Y');
        }

        $transaksi = Transaksi::whereMonth('created_at', $bulan)
            ->whereYear('created_at', $tahun)
            ->get();

        return view("ecommerce.admin.dashboard.transaksi", ['transaksi' => $transaksi]);
    }
}
