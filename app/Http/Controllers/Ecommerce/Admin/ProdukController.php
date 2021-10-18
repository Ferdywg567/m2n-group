<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\DetailWarehouse;
use App\Warehouse;
use App\Produk;
use App\DetailProduk;
use App\DetailProdukImage;
use App\Promo;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('ecommerce.admin.produk.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Warehouse::where('harga_produk', '>', 0)->get();
        $today = date('Y-m-d');
        $promo = Promo::whereDate('promo_mulai', '<=', $today)->whereDate('promo_berakhir', '>=', $today)->get();
        $cekmax = Produk::max('id');
        if ($cekmax) {
            $jumlah = $cekmax + 1;
            $kode = "PRD-" . $jumlah;
        } else {
            $kode = "PRD-1";
        }
        return view("ecommerce.admin.produk.create", ['produk' => $produk, 'promo' => $promo, 'kode' => $kode]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $file = $request->file('file');

        foreach ($file as $key => $value) {
            $imageName = strtotime(now()).rand(11111,99999).'.'.$value->getClientOriginalExtension();
            $value->move(public_path() . '/uploads/images/', $imageName);
        }
        return response()->json($request->file('file'));
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

    public function getDetailProduk(Request $request)
    {
        if ($request->ajax()) {
            $produk = Warehouse::with(['finishing' => function ($q) {
                $q->with(['cuci' => function ($q) {
                    $q->with(['jahit' => function ($q) {
                        $q->with(['potong' => function ($q) {
                            $q->with(['bahan'  => function ($q) {
                                $q->with(['detail_sub' => function ($q) {
                                    $q->with(['sub_kategori' => function ($q) {
                                        $q->with('kategori');
                                    }]);
                                }]);
                            }]);
                        }]);
                    }]);
                }]);
            }, 'detail_warehouse'])->where('id', $request->get('id'))->first();

            return response()->json([
                'data' => $produk,
                'status' => true
            ]);
        }
    }
}
