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
        $terkait = Produk::limit(4)->get();
        $target = ["S","L","M"];
        $detail = $produk->detail_produk->pluck('ukuran')->toArray();
        $seri = false;
        $harga_seri = 0;
        if(in_array('S',$detail) && in_array('M',$detail) && in_array('L', $detail)){
            $seri = true;
            $harga_seri = $produk->detail_produk->whereIn('ukuran', $target)->avg('harga');
            $detail = $produk->detail_produk->whereNotIn('ukuran', $target);
        }else{
            $detail = $produk->detail_produk;
        }

        return view('ecommerce.frontend.product.detail', ['produk' => $produk, 'seri' => $seri,'detail' => $detail, 'terkait' => $terkait]);
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
            $produk = Produk::where('sub_kategori', $kategori)->get();
        }

        return view('ecommerce.frontend.product.index', ['produk' => $produk, 'data' => $kategori]);
    }

    public function removeDuplicate($data)
    {
        if ($data) {
            $data = $data->toArray();
            $data = array_unique($data, SORT_REGULAR);
            return $data;
        }
    }

    public function cari(Request $request)
    {
        if ($request->ajax()) {
            $cari = $request->get('cari');
            $sub_kategori = Produk::select('sub_kategori')->where('sub_kategori', 'like', '%' . $cari . '%')->groupBy('sub_kategori')->get();
            $kategori = Produk::select('kategori')->where('kategori', 'like', '%' . $cari . '%')->groupBy('kategori')->get();
            $detail_sub_kategori = Produk::select('detail_sub_kategori')->where('detail_sub_kategori', 'like', '%' . $cari . '%')->groupBy('detail_sub_kategori')->get();
            $nama_produk = Produk::select('nama_produk')->where('nama_produk', 'like', '%' . $cari . '%')->groupBy('nama_produk')->get();
            $arr = [];
            $sub_kategori = $this->removeDuplicate($sub_kategori);
            $kategori = $this->removeDuplicate($kategori);
            $detail_sub_kategori = $this->removeDuplicate($detail_sub_kategori);
            $nama_produk = $this->removeDuplicate($nama_produk);
            foreach ($sub_kategori as $key => $value) {
                $x['sub_kategori'] =  $value['sub_kategori'];
                array_push($arr, $value['sub_kategori']);
            }
            foreach ($kategori as $key => $value) {
                $x['kategori'] =  $value['kategori'];
                array_push($arr, $value['kategori']);
            }
            foreach ($detail_sub_kategori as $key => $value) {
                $x['detail_sub_kategori'] =  $value['detail_sub_kategori'];
                array_push($arr, $value['detail_sub_kategori']);
            }
            foreach ($nama_produk as $key => $value) {
                $x['nama_produk'] =  $value['nama_produk'];
                array_push($arr, $value['nama_produk']);
            }
            return response()->json(['status' => true, 'data' => $arr]);
        }
    }

    public function showCari(Request $request)
    {
        $cari = $request->get('cari');
        $produk = Produk::where('sub_kategori', 'like', '%' . $cari . '%')->orwhere('kategori', 'like', '%' . $cari . '%')->orwhere('detail_sub_kategori', 'like', '%' . $cari . '%')->orwhere('nama_produk', 'like', '%' . $cari . '%')->get();
        return view('ecommerce.frontend.product.index', ['produk' => $produk, 'data' => $cari]);
    }
}
