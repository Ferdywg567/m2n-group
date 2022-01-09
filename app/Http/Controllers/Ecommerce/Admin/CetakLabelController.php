<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Produk;
use PDF;

class CetakLabelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $cetak = Produk::whereNotNull('barcode')->get();
        $count =  Produk::whereNotNull('barcode')->count();
        $bagi = $count / 4;

        // dd($bagi);
        $arr = [];
        $length = 4;
        $from  = 0;
        for ($i = 0; $i < $bagi; $i++) {
            $x = array_slice($cetak, $from, $length);
            $from = $from + 4;
            // $length = $length + 4;
            array_push($arr, $x);
        }

        dd($arr);
        $pdf = PDF::loadview(
            "ecommerce.admin.cetak_label.pdf",
            [
                'cetak' => $arr
            ]
        )->setPaper('a4', 'potrait');
        return $pdf->stream('cetak-barcode-produk.pdf', array('Attachment' => 0));
        // return view('ecommerce.admin.cetak_label.index');
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
