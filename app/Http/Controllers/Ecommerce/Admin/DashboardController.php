<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use App\Http\Controllers\Controller;
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
            $offline = Transaksi::select(
                DB::raw("(sum(total_harga)) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as tanggal")
            )->where('status_transaksi', 'offline')
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                ->get();
            $online = Transaksi::select(
                DB::raw("(sum(total_harga)) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as tanggal")
            )->where('status_transaksi', 'online')
                ->where('status', 'telah tiba')
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                ->get();


            $semua = Transaksi::select(
                DB::raw("(sum(total_harga)) as total"),
                DB::raw("(DATE_FORMAT(created_at, '%m-%Y')) as tanggal")
            )->orwhere('status', 'telah tiba')->orwhere('status_transaksi', 'offline')
                ->orderBy('created_at')
                ->groupBy(DB::raw("DATE_FORMAT(created_at, '%m-%Y')"))
                ->get();

            return response()->json([
                'offline' => $offline,
                'online' => $online,
                'semua' => $semua,
                'status' => true
            ]);
        }
        return view("ecommerce.admin.dashboard.index");
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
