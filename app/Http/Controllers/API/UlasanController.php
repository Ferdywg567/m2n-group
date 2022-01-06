<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Produk;
use App\Transaksi;
use App\Ulasan;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required',
            'rating' => 'nullable|min:1|max:5',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        }else{
            if ($request->has('kode_produk')) {
                $kode_produk = $request->get('kode_produk');
                $ulasan = Ulasan::whereHas('produk' ,function ($q) use ($kode_produk) {
                    $q->where('kode_produk', $kode_produk);
                })->get();

                if($request->has('rating')){
                    $rating = $request->get('rating');
                    $ulasan = Ulasan::where('rating', $rating)->whereHas('produk' ,function ($q) use ($kode_produk) {
                        $q->where('kode_produk', $kode_produk);
                    })->get();
                }

                return response()->json([
                    'status' => true,
                    'data' => $ulasan,
                    'code' => Response::HTTP_OK
                ]);
            }
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
        $validator = Validator::make($request->all(), [
            'kode_transaksi' => 'required',
            'rating' => 'required|min:1|max:5',
            'ulasan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            $rating = $request->get('rating');

            DB::beginTransaction();

            try {
                $userid = Auth::guard('api')->user()->id;
                $transaksi = Transaksi::where('kode_transaksi', $request->get('kode_transaksi'))->where('user_id', $userid)->first();

                if ($transaksi) {
                    foreach ($transaksi->detail_transaksi as $key => $value) {

                        $cekulasan = Ulasan::where('user_id', $userid)->where('transaksi_id', $value->transaksi_id)->where('produk_id', $value->produk_id)->first();

                        if ($cekulasan) {
                            $cekulasan->rating = $rating;
                            $cekulasan->ulasan = $request->get('ulasan');
                            $cekulasan->save();
                        } else {
                            $ulasan = new Ulasan();
                            $ulasan->user_id = $userid;
                            $ulasan->transaksi_id = $value->transaksi_id;
                            $ulasan->produk_id = $value->produk_id;
                            $ulasan->rating = $rating;
                            $ulasan->ulasan = $request->get('ulasan');
                            $ulasan->save();
                        }
                    }
                } else {
                    return response()->json([
                        'status' => true,
                        'message' => 'not found',
                        'code' => Response::HTTP_OK
                    ]);
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
        //
    }
}
