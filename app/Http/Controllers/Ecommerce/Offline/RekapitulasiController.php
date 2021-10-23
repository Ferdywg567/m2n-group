<?php

namespace App\Http\Controllers\Ecommerce\Offline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaksi;
use PDF;

class RekapitulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transaksi = Transaksi::where('status_transaksi', 'offline')->orderBy('created_at', 'DESC')->get();
        return view('ecommerce.offline.rekapitulasi.index', ['transaksi' => $transaksi]);
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

    public function cetak($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $pdf = PDF::loadView('ecommerce.offline.rekapitulasi.pdf', ['transaksi' => $transaksi]);
        return $pdf->stream('rekapitulasi.pdf');
        // return view('ecommerce.offline.rekapitulasi.pdf', ['transaksi' => $transaksi]);
    }
}
