<?php

namespace App\Http\Controllers\API;

use App\DetailProdukImage;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Produk;
use App\Helpers\AppHelper;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::guard('api')->check()) {
            $userid = Auth::guard('api')->user()->id;
            $produk = Produk::with(['ulasan' => function ($q) {
                $q->with(['user' => function ($q) {
                    $userpath = asset('uploads/images/user/') . '/';
                    $nullpath = asset('assets/img/avatar/avatar-3.png');
                    return $q->select('name', DB::raw('(CASE WHEN foto IS NULL THEN "' . $nullpath . '" ELSE CONCAT("' . $userpath . '",foto) END) foto'), 'id')->get();
                }]);
            }])->withCount(['favorit' => function ($q) use ($userid) {
                return  $q->where('user_id', $userid);
            }])->get()->makeHidden(['harga', 'harga_promo', 'detail_produk']);
        } else {
            $produk = Produk::with(['ulasan' => function ($q) {
                $q->with(['user' => function ($q) {
                    $userpath = asset('uploads/images/user/') . '/';
                    $nullpath = asset('assets/img/avatar/avatar-3.png');
                    return $q->select('name', DB::raw('(CASE WHEN foto IS NULL THEN "' . $nullpath . '" ELSE CONCAT("' . $userpath . '",foto) END) foto'), 'id')->get();
                }]);
            }])->withCount(['favorit' => function ($q) {
                return  $q->where('user_id', null);
            }])->get()->makeHidden(['harga', 'harga_promo', 'detail_produk']);
        }

        $arr = [];
        foreach ($produk as $key => $value) {
            $gambar = '';
            $argambar = [];
            $detailgambar = DetailProdukImage::where('produk_id', $value->id)->first();
            if ($detailgambar) {
                $gambar = asset('uploads/images/produk/' . $detailgambar->filename);
            }


            $jumlah = 0;
            foreach ($value->ulasan as $key => $ulasan) {
                $jumlah += $ulasan->rating;
            }
            if (count($value->ulasan) > 0) {
                $x['summary_ulasan'] = $jumlah / count($value->ulasan);
            } else {
                $x['summary_ulasan'] = 0;
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
            $getukuran = new Produk();
            $arrdetail = $getukuran->get_ukuran($value);
            $x['detail_produk_ukuran'] = $arrdetail;
            $x['gambar'] = $gambar;
            $x['jumlah_ulasan'] = AppHelper::instance()->jumlah_ulasan($value->id);
            $x['jumlah_pesanan'] = AppHelper::instance()->jumlah_pesanan($value->id);
            $x['harga_min'] = $value->detail_produk->min('harga');
            $x['harga_max'] = $value->detail_produk->max('harga');
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

        if (Auth::guard('api')->check()) {
            $userid = Auth::guard('api')->user()->id;
            $produk = Produk::where('kode_produk', $id)->with(['ulasan' => function ($q) {
                $q->with(['user' => function ($q) {
                    $userpath = asset('uploads/images/user/') . '/';
                    $nullpath = asset('assets/img/avatar/avatar-3.png');
                    return $q->select('name', DB::raw('(CASE WHEN foto IS NULL THEN "' . $nullpath . '" ELSE CONCAT("' . $userpath . '",foto) END) foto'), 'id')->get();
                }]);
            }])->withCount(['favorit' => function ($q) use ($userid) {
                return  $q->where('user_id', $userid);
            }])->firstOrFail()->makeHidden(['harga', 'harga_promo', 'detail_produk']);
        } else {
            $produk = Produk::where('kode_produk', $id)->with(['ulasan' => function ($q) {
                $q->with(['user' => function ($q) {
                    $userpath = asset('uploads/images/user/') . '/';
                    $nullpath = asset('assets/img/avatar/avatar-3.png');
                    return $q->select('name', DB::raw('(CASE WHEN foto IS NULL THEN "' . $nullpath . '" ELSE CONCAT("' . $userpath . '",foto) END) foto'), 'id')->get();
                }]);
            }])->withCount(['favorit' => function ($q) {
                return  $q->where('user_id', null);
            }])->firstOrFail()->makeHidden(['harga', 'harga_promo', 'detail_produk']);
        }

        $arr = [];

        $detailgambarall = DetailProdukImage::where('produk_id', $produk->id)->get();
        foreach ($detailgambarall as $key => $value) {
            $x['gambar'] = asset('uploads/images/produk/' . $value->filename);
            array_push($arr, $x);
        }

        $jumlah = 0;
        foreach ($produk->ulasan as $key => $ulasan) {
            $jumlah += $ulasan->rating;
        }
        if (count($produk->ulasan) > 0) {
            $hasil_ulasan = $jumlah / count($produk->ulasan);
        } else {
            $hasil_ulasan = 0;
        }
        $arrdetail = $produk->get_ukuran($produk);
        $produk->detail_produk_ukuran = $arrdetail;
        $produk->summary_ulasan = $hasil_ulasan;
        $produk->detail_gambar = $arr;
        $produk->jumlah_ulasan = AppHelper::instance()->jumlah_ulasan($produk->id);
        $produk->jumlah_pesanan = AppHelper::instance()->jumlah_pesanan($produk->id);
        $produk->harga_min = $produk->detail_produk->min('harga');
        $produk->harga_max = $produk->detail_produk->max('harga');
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
