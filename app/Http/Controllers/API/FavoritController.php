<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\DetailProdukImage;
use App\Favorit;
use App\Produk;
use Illuminate\Http\Request;

class FavoritController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = Auth::guard('api')->user()->id;
        $produk = Produk::whereHas('favorit', function ($q) use ($userid) {
            return $q->where('user_id', $userid);
        })->get();
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
        $validator = Validator::make($request->all(), [
            'kode_produk' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            $userid = Auth::guard('api')->user()->id;
            DB::beginTransaction();
            try {
                $produk = Produk::where('kode_produk', $request->get('kode_produk'))->firstOrFail();
                $cek = Favorit::where('user_id', $userid)->where('produk_id', $produk->id)->first();

                if (!$cek) {
                    $favorit = new Favorit();
                    $favorit->user_id = $userid;
                    $favorit->produk_id = $produk->id;
                    $favorit->save();
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
                Favorit::where('user_id', $userid)->where('produk_id', $produk->id)->delete();
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
