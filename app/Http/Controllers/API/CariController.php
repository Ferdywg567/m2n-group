<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use App\DetailProdukImage;
use App\Produk;

class CariController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->has('data')) {
            $data = $request->get('data');

            if (Auth::guard('api')->check()) {
                $userid = Auth::guard('api')->user()->id;
                $produk = Produk::where('sub_kategori', 'like', '%' . $data . '%')->orwhere('kategori', 'like', '%' . $data . '%')->orwhere('detail_sub_kategori', 'like', '%' . $data . '%')->orwhere('nama_produk', 'like', '%' . $data . '%')->with(['ulasan' => function ($q) {
                    $q->with(['user' => function ($q) {
                        $userpath = asset('uploads/images/user/').'/';
                        $nullpath = asset('assets/img/avatar/avatar-3.png');
                        return $q->select('name', DB::raw('(CASE WHEN foto IS NULL THEN "' . $nullpath . '" ELSE CONCAT("' . $userpath . '",foto) END) foto'), 'id')->get();
                    }]);
                }])->withCount(['favorit' => function ($q) use ($userid) {
                    return  $q->where('user_id', $userid);
                }])->get();
            } else {
                $produk = Produk::where('sub_kategori', 'like', '%' . $data . '%')->orwhere('kategori', 'like', '%' . $data . '%')->orwhere('detail_sub_kategori', 'like', '%' . $data . '%')->orwhere('nama_produk', 'like', '%' . $data . '%')->with(['ulasan'=> function ($q) {
                    $q->with(['user' => function ($q) {
                        $userpath = asset('uploads/images/user/').'/';
                        $nullpath = asset('assets/img/avatar/avatar-3.png');
                        return $q->select('name', DB::raw('(CASE WHEN foto IS NULL THEN "' . $nullpath . '" ELSE CONCAT("' . $userpath . '",foto) END) foto'), 'id')->get();
                    }]);
                }])->withCount(['favorit' => function ($q)  {
                    return  $q->where('user_id', null);
                }])->get();
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
                $x['gambar'] = $gambar;
                $getukuran = new Produk();
                $arrdetail = $getukuran->get_ukuran($value);
                $x['detail_produk_ukuran'] = $arrdetail;
                $data = array_merge($x, $cv);
                array_push($arr, $data);
            }
            return response()->json([
                'status' => true,
                'data' => $arr,
                'code' => Response::HTTP_OK
            ]);
        }
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
