<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaksi;

class RekapitulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $month = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
        $tahun = [];

        for ($i = 2018; $i <= date('Y'); $i++) {
            array_push($tahun, $i);
        }

        $transaksi = Transaksi::where('status_transaksi', 'online')->where('status','telah tiba')->orderBy('created_at', 'DESC')->get();
       return view('ecommerce.admin.rekapitulasi.index', ['transaksi' => $transaksi, 'month' => $month, 'tahun' => $tahun]);
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
        $transaksi = Transaksi::findOrFail($id);
        return view('ecommerce.offline.rekapitulasi.show', ['transaksi' => $transaksi]);
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
