<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use App\Http\Controllers\Controller;
use App\Produk;
use App\SubKategori;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("ecommerce.frontend.product.index");
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
        return view('ecommerce.frontend.product.detail', ['produk' => $produk]);
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

    public function CariKategori(Request $request)
    {
        $kategori = $request->get('kategori');

        if ($kategori == 'Semua Kategori') {
            $produk = Produk::all();
        } else {
            $produk = Produk::with(['warehouse' => function ($q) use ($kategori) {
                $q->with(['finishing' => function ($q) use ($kategori) {
                    $q->with(['cuci' => function ($q) use ($kategori) {
                        $q->with(['jahit' => function ($q) use ($kategori) {
                            $q->with(['potong' => function ($q) use ($kategori) {
                                $q->with(['bahan'  => function ($q) use ($kategori) {
                                    $q->with(['detail_sub' => function ($q) use ($kategori) {
                                        $q->with(['sub_kategori' => function ($q) use ($kategori) {
                                            $q->where('nama_kategori', $kategori);
                                        }]);
                                    }]);
                                }]);
                            }]);
                        }]);
                    }]);
                }]);
            }])->get();
        }

        return view('ecommerce.frontend.product.index', ['produk' => $produk, 'data' => $kategori]);
    }
}
