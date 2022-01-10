<?php

namespace App\Http\Controllers\Ecommerce\Offline;

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
        $cetak = Produk::all();
        // $count =  Produk::count();
        // $bagi = $count / 4;

        // if($cetak->isNotEmpty()){
        //     $cetak = $cetak->toArray();
        // }else{
        //     $cetak = [];
        // }

        // // dd($bagi);
        // $arr = [];
        // $length = 4;
        // $from  = 0;
        // for ($i = 0; $i < $bagi; $i++) {
        //     $x = array_slice($cetak, $from, $length);
        //     $from = $from + 4;
        //     // $length = $length + 4;
        //     array_push($arr, $x);
        // }

        // dd($arr);
        $hitung = count($cetak) * 150;
        $height =count($cetak) * 3;
        $customPaper = array(0,0,215,$hitung);
        $pdf = PDF::loadview(
            "ecommerce.offline.cetak_label.pdf",
            [
                'cetak' => $cetak,
                'height' => $height
            ]
        )->setPaper($customPaper);



        return $pdf->stream('cetak-barcode-produk.pdf', array('Attachment' => 0));
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
