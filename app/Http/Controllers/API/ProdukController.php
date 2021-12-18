<?php

namespace App\Http\Controllers\API;

use App\DetailProdukImage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Produk;
use App\Helpers\AppHelper;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::all();

        $arr = [];
        foreach ($produk as $key => $value) {
            $gambar = '';
            $argambar = [];
            $detailgambar = DetailProdukImage::where('produk_id', $value->id)->first();
            if ($detailgambar) {
                $gambar = asset('uploads/images/produk/' . $detailgambar->filename);
            }

            $detailgambarall = DetailProdukImage::where('produk_id', $value->id)->get();
            if ($detailgambarall->isNotEmpty()) {
                foreach ($detailgambarall as $key => $row) {
                    $y['gambar'] = asset('uploads/images/produk/' . $row->filename);
                    array_push($argambar, $y);
                }
                $x['detail_gambar'] = $argambar;
            } else {
                $x['detail_gambar'] = [];
            }

            $cv = json_decode(json_encode($value), true);
            $x['gambar'] = $gambar;

            $data = array_merge($x, $cv);
            array_push($arr, $data);
        }

        return response()->json([
            'status' => true,
            'data' => $arr,
            'code' => Response::HTTP_OK
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
        $produk = Produk::where('kode_produk', $id)->with('ulasan')->firstOrFail();

        $arr = [];

        $detailgambarall = DetailProdukImage::where('produk_id', $produk->id)->get();
        foreach ($detailgambarall as $key => $value) {
            $x['gambar'] = asset('uploads/images/produk/' . $value->filename);
            array_push($arr, $x);
        }

        $produk->detail_gambar = $arr;
        $produk->jumlah_ulasan = AppHelper::instance()->jumlah_ulasan($produk->id);
        $produk->jumlah_pesanan = AppHelper::instance()->jumlah_pesanan($produk->id);

        return response()->json([
            'status' => true,
            'data' => $produk,
            'code' => Response::HTTP_OK
        ]);
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
