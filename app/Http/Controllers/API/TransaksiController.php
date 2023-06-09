<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userid = Auth::guard('api')->user()->id;
        $status = $request->get('status');
        if ($status == 'menunggu konfirmasi') {
            $transaksi = Transaksi::where('user_id', $userid)->where(function ($q) {
                $q->orwhere('status_bayar', 'belum dibayar')->orwhere('status_bayar', 'sudah di upload');
            })->orderBy('created_at', 'DESC')->get();
        } elseif ($status == 'diproses') {
            $transaksi = Transaksi::where('user_id', $userid)->where('status_bayar', 'sudah dibayar')->where('status', '!=', 'dikirim')->where('status', '!=', 'telah tiba')->orderBy('created_at', 'DESC')->get();
        } elseif ($status == 'dikirim') {
            $transaksi = Transaksi::where('user_id', $userid)->where('status', 'dikirim')->orderBy('created_at', 'DESC')->get();
        } elseif ($status == 'sampai tujuan') {
            $transaksi = Transaksi::where('user_id', $userid)->where('status', 'dikirim')->orderBy('created_at', 'DESC')->get();
        } else {
            $transaksi = Transaksi::where('user_id', $userid)->where(function ($q) {
                $q->orwhere('status', 'telah tiba')->orWhere('status_bayar', 'dibatalkan');
            })->orderBy('created_at', 'DESC')->get();
        }

        return response()->json([
            'status' => true,
            'data' => $transaksi,
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
            'kode_transaksi' => 'required',
            'status' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            $transaksi = Transaksi::where('kode_transaksi', $request->get('kode_transaksi'))->first();

            if ($transaksi) {
                if ($transaksi->status == 'dikirim') {
                    $transaksi->status = "telah tiba";
                    $transaksi->save();
                    return response()->json(['status' => true, 'message' => 'transaksi berhasil di konfirmasi', 'code' => Response::HTTP_OK]);
                }else{
                    return response()->json(['status' => false, 'message' => 'produk belum dikirim', 'code' => Response::HTTP_OK]);
                }
            } else {
                return response()->json(['status' => false, 'message' => 'not found', 'code' => Response::HTTP_OK]);
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
        $userid = Auth::guard('api')->user()->id;
        $transaksi = Transaksi::where('user_id', $userid)->where('kode_transaksi', $id)->with(['detail_transaksi' => function ($q) use ($userid) {
            $q->with(['produk' => function ($q) use ($userid) {
                $q->with('detail_gambar');
                $q->withCount(['favorit' => function ($q) use ($userid) {
                    return $q->where('user_id', $userid);
                }]);
            }]);
        }, 'alamat'])->first();

        if ($transaksi) {
            foreach ($transaksi->detail_transaksi as $key => $value) {
                foreach ($value->produk->detail_gambar as $key => $row) {
                    $value->produk->gambar = asset('uploads/images/produk/' . $row->filename);
                }
                unset($value->produk->detail_gambar);
            }
            return response()->json([
                'status' => true,
                'data' => $transaksi,
                'code' => Response::HTTP_OK
            ]);
        } else {
            return response()->json([
                'status' => true,
                'data' => [],
                'message' => 'not found',
                'code' => Response::HTTP_OK
            ]);
        }
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
