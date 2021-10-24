<?php

namespace App\Http\Controllers\Ecommerce\Offline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DetailProduk;
use App\Promo;
use App\Produk;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'DESC')->get();
        return view('ecommerce.offline.produk.index', ['produk' => $produk]);
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
        $produk = Produk::findOrFail($id);
        $today = date('Y-m-d');
        $promo = Promo::whereDate('promo_mulai', '<=', $today)->whereDate('promo_berakhir', '>=', $today)->get();
        $detail = DetailProduk::where('produk_id', $id)->get();
        $ukuran = '';
        foreach ($detail as $key => $value) {
            $ukuran .= $value->ukuran . ', ';
        }

        $ukuran = rtrim($ukuran, ', ');
        return view("ecommerce.offline.produk.show", ['produk' => $produk, 'promo' => $promo, 'ukuran' => $ukuran]);
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