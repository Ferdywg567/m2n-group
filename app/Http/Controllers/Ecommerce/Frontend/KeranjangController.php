<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Keranjang;
use App\Produk;
use App\Helpers\AppHelper;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $keranjang = AppHelper::instance()->data_keranjang();
        $iduser = auth()->user()->id;
        $semua = Keranjang::where('user_id', $iduser)->count();
        $check = Keranjang::where('user_id', $iduser)->where('check', 1)->count();


        if ($semua == $check) {
            $checked = true;
        } else {
            $checked = false;
        }
        return view('ecommerce.frontend.cart.index', ['keranjang' => $keranjang, 'checked' => $checked]);
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
        if ($request->ajax()) {
            // return response()->json($request->all());
            $validator = Validator::make($request->all(),[
                'id' => 'required',
                'jumlah' => 'required|min:1|integer'
            ]);

            if ($validator->fails()) {
                $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

                return response()->json([
                    'status' => false,
                    'data' => $html
                ]);
            }else{
                $iduser = auth()->user()->id;
                $idproduk = $request->get('id');
                $jumlah = $request->get('jumlah');
                DB::beginTransaction();
                try {

                    $produk = Produk::findOrFail($idproduk);
                    $cek = Keranjang::where('user_id', $iduser)->where('produk_id', $produk->id)->first();
                    if ($cek) {
                        $cek->jumlah = $jumlah;
                    } else {
                        $keranjang = new Keranjang();
                        $keranjang->user_id = $iduser;
                        $keranjang->produk_id = $produk->id;
                        $keranjang->jumlah = $jumlah;
                        $keranjang->check = 1;
                        $keranjang->harga = $produk->harga_promo;
                        $keranjang->subtotal = $produk->harga_promo * $jumlah;
                        $keranjang->save();
                    }
                    $total = Keranjang::where('user_id', $iduser)->count();
                    DB::commit();
                    return response()->json([
                        'status' => true,
                        'total' => $total
                    ]);
                } catch (\Exception $th) {
                    DB::rollBack();
                    //throw $th;
                }
            }


        }
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

    public function update_checkbox(Request $request)
    {
        if ($request->ajax()) {

            $nilai = $request->get('nilai');
            $update = $request->get('update');
            $iduser = auth()->user()->id;
            if ($update == 'one') {
                $id = $request->get('id');
                if ($nilai == 'true') {
                    $cek = Keranjang::where('user_id', $iduser)->where('id', $id)->first();
                    $cek->check = 1;
                    $cek->save();
                } else {
                    $cek = Keranjang::where('user_id', $iduser)->where('id', $id)->first();
                    $cek->check = 0;
                    $cek->save();
                }
            } else {
                if ($nilai == 'true') {
                    $cek = Keranjang::where('user_id', $iduser)->update([
                        'check' => 1
                    ]);
                } else {
                    $cek = Keranjang::where('user_id', $iduser)->update([
                        'check' => 0
                    ]);
                }
            }

            $totalharga = Keranjang::where('user_id', $iduser)->where('check', 1)->sum('subtotal');
            $semua = Keranjang::where('user_id', $iduser)->count();
            $check = Keranjang::where('user_id', $iduser)->where('check', 1)->count();
            if ($totalharga > 0) {
                $btn = true;
            } else {
                $btn = false;
            }

            if ($semua == $check) {
                $checked = true;
            } else {
                $checked = false;
            }
            return response()->json([
                'status' => true,
                'totalharga' => AppHelper::instance()->rupiah($totalharga),
                'btn' => $btn,
                'checked' => $checked,

            ]);
        }
    }



    public function update_jumlah(Request $request)
    {
        if ($request->ajax()) {
            $jumlah = $request->get('jumlah');
            $iduser = auth()->user()->id;
            $id = $request->get('id');
            $cek = Keranjang::where('user_id', $iduser)->where('id', $id)->first();
            if ($jumlah > 0) {
                $cek->jumlah = $jumlah;
                $cek->subtotal = $cek->harga * $jumlah;
                $cek->save();

                $hapus = false;
                $subtotal = $cek->subtotal;
            } else {
                Keranjang::where('user_id', $iduser)->where('id', $id)->delete();
                $hapus = true;
                $subtotal = 0;
            }

            $totalharga = Keranjang::where('user_id', $iduser)->where('check', 1)->sum('subtotal');
            $semua = Keranjang::where('user_id', $iduser)->count();
            $check = Keranjang::where('user_id', $iduser)->where('check', 1)->count();
            if ($totalharga > 0) {
                $btn = true;
            } else {
                $btn = false;
            }

            if ($semua == $check) {
                $checked = true;
            } else {
                $checked = false;
            }

            return response()->json([
                'status' => true,
                'totalharga' => AppHelper::instance()->rupiah($totalharga),
                'btn' => $btn,
                'subtotal' => AppHelper::instance()->rupiah($subtotal),
                'checked' => $checked,
                'hapus' => $hapus
            ]);
        }
    }

    public function hapus($id)
    {
        $iduser = auth()->user()->id;
        Keranjang::where('user_id', $iduser)->where('id', $id)->delete();
        return redirect()->route('frontend.keranjang.index');
    }

    public function showDataSidebar(Request $request)
    {
        if ($request->ajax()) {
            $iduser = auth()->user()->id;
            $keranjang =  Keranjang::where('user_id', $iduser)->get();
            $helper = AppHelper::instance();
            $totalharga = 0;
            $arr = [];
            foreach ($keranjang as $key => $value) {
                    $x['gambar'] = asset('uploads/images/produk/'.$value->produk->detail_gambar[0]->filename);
                    $x['nama_produk'] = $value->produk->nama_produk;
                    $x['jumlah'] = $value->jumlah;
                    $x['harga'] = $helper->rupiah($value->harga);

                    $totalharga += $value->subtotal;
                    array_push($arr, $x);
            }

            return response()->json([
                'status' => true,
                'data' => $arr,
                'totalharga' => $helper->rupiah($totalharga)
            ]);
        }
    }
}
