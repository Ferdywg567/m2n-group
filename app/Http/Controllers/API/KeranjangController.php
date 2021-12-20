<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Keranjang;
use App\Produk;

class KeranjangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            $userid = Auth::guard('api')->user()->id;
            $produk = Produk::where('kode_produk', $request->get('kode_produk'))->first();
            DB::beginTransaction();

            try {
                if ($produk) {
                    //cek keranjang
                    $keranjang = Keranjang::where('user_id', $userid)->where('produk_id', $produk->id)->first();

                    if ($keranjang) {
                        $keranjang->jumlah = $keranjang->jumlah + 1;
                        $keranjang->subtotal = $keranjang->jumlah * $keranjang->harga;
                        $keranjang->save();
                    } else {
                        $keranjang = new Keranjang();
                        $keranjang->user_id = $userid;
                        $keranjang->produk_id = $produk->id;
                        $keranjang->harga = $produk->harga_promo;
                        $keranjang->check = 1;
                        $keranjang->jumlah = 1;
                        $keranjang->subtotal = $keranjang->jumlah * $keranjang->harga;
                        $keranjang->save();
                    }
                }

                DB::commit();
                return response()->json([
                    'status' => true,
                    'message' => 'saved',
                    'code' => Response::HTTP_OK
                ]);
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Maaf ada yang error',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR
                ]);
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
        $userid = Auth::guard('api')->user()->id;
        DB::beginTransaction();
        try {
            $produk = Produk::where('kode_produk', $id)->first();
            if($produk){
                Keranjang::where('user_id', $userid)->where('produk_id', $produk->id)->delete();
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'message' => 'deleted',
                'code' => Response::HTTP_OK
            ]);
        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();

            return response()->json([
                'status' => false,
                'message' => 'Maaf ada yang error',
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR
            ]);
        }
    }
}
