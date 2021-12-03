<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Transaksi;
use App\Ulasan;
use Illuminate\Http\Request;

class UlasanController extends Controller
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
            'id' => 'required',
            'rating' => 'required',
            'ulasan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            $html = '<div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';
            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        }else{
            $rating = $request->get('rating');

            if($rating <= 0){
                $html = '<div class="alert alert-danger" role="alert">Rating harus dipilih</div>';
                return response()->json([
                    'status' => false,
                    'data' => $html
                ]);
            }else{
                $userid = auth()->user()->id;

                $transaksi = Transaksi::where('id', $request->get('id'))->where('user_id', $userid)->first();

                if($transaksi){
                    foreach ($transaksi->detail_transaksi as $key => $value) {

                        $cekulasan = Ulasan::where('user_id',$userid)->where('transaksi_id', $value->transaksi_id)->where('produk_id', $value->produk_id)->first();

                        if($cekulasan){
                            $cekulasan->rating = $rating;
                            $cekulasan->ulasan = $request->get('ulasan');
                            $cekulasan->save();
                        }else{
                            $ulasan = new Ulasan();
                            $ulasan->user_id = $userid;
                            $ulasan->transaksi_id = $value->transaksi_id;
                            $ulasan->produk_id = $value->produk_id;
                            $ulasan->rating = $rating;
                            $ulasan->ulasan = $request->get('ulasan');
                            $ulasan->save();
                        }

                    }
                }
                $html = '<div class="alert alert-success" role="alert">Ulasan berhasil disubmit</div>';
                return response()->json([
                    'status' => true,
                    'data' => $html
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
