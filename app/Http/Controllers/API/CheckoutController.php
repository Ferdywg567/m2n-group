<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Notification;
use App\Transaksi;
use App\Keranjang;
use App\Alamat;
use App\Produk;
use App\DetailTransaksi;

class CheckoutController extends Controller
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
            'bank_id' => 'required',
            'status' => 'required|in:keranjang,langsung'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            $userid = Auth::guard('api')->user()->id;
            $status = $request->get('status');
            $alamat = Alamat::where('user_id', $userid)->where('status', 'Utama')->first();
            DB::beginTransaction();
            try {

                if ($alamat) {
                    if ($status == 'keranjang') {
                        $data = Keranjang::where('user_id', $userid)->where('check', 1)->get();
                        if (count($data) > 0) {
                            $jumlahqty = Keranjang::where('user_id', $userid)->where('check', 1)->sum('jumlah');
                            $totalharga = Keranjang::where('user_id', $userid)->where('check', 1)->sum('subtotal');
                            $jmlproduk = Keranjang::where('user_id', $userid)->where('check', 1)->count();

                            $jumlah =  $jmlproduk;
                            $totalharga = $totalharga;
                            $transaksi = new Transaksi();
                            $transaksi->user_id = $userid;
                            $transaksi->bank_id = $request->get('bank_id');
                            $transaksi->alamat_id = $alamat->id;
                            $transaksi->kode_transaksi = $this->generateKode();
                            $transaksi->tgl_transaksi = date('Y-m-d H:i:s');
                            $transaksi->qty = $jumlahqty;
                            $transaksi->total_harga = $totalharga;
                            $transaksi->status_transaksi = "online";
                            $transaksi->status_bayar = "belum dibayar";
                            $transaksi->status = "butuh konfirmasi";
                            $transaksi->biaya_admin = 2500;
                            $transaksi->save();

                            foreach ($data as $key => $value) {
                                $detail_trans = new DetailTransaksi();
                                $detail_trans->produk_id = $value->produk_id;
                                $detail_trans->transaksi_id = $transaksi->id;
                                $detail_trans->jumlah = $value->jumlah;
                                $detail_trans->harga = $value->harga;
                                $detail_trans->ukuran = $value->ukuran;
                                $detail_trans->total_harga = $value->subtotal;
                                $detail_trans->save();
                            }
                            $resdata = Transaksi::where('id', $transaksi->id)->with('bank')->first();
                            $resdata->bank->logo = asset('uploads/images/bank/' . $resdata->bank->logo);
                            Keranjang::where('user_id', $userid)->where('check', 1)->delete();
                            $status_akhir = true;
                            $message = 'saved';

                            $notif = new Notification();
                            $notif->description = "Ada transaksi baru " . $transaksi->kode_transaksi;
                            $notif->url = route('ecommerce.transaksi.index');
                            $notif->aktif = 0;
                            $notif->role = 'online';
                            $notif->save();
                        } else {
                            $status_akhir = false;
                            $message = 'Keranjang tidak boleh kosong';
                            $resdata = [];
                        }
                    } else {
                        $validator = Validator::make($request->all(), [
                            'jumlah' => 'required|min:1|integer',
                            'kode_produk' => 'required'
                        ]);

                        if ($validator->fails()) {
                            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
                        } else {
                            $produk = Produk::where('kode_produk', $request->get('kode_produk'))->first();
                            if ($produk) {

                                $validator = Validator::make($request->all(), [
                                    'ukuran' => 'required',
                                    'jumlah' => 'required|integer'
                                ]);

                                if ($validator->fails()) {
                                    return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
                                }

                                $ukuran = $request->get('ukuran');

                                if ($ukuran == 'S,M,L') {
                                    $resukuran = ['S', 'M', 'L'];
                                } elseif(str_contains($ukuran, ',')){
                                    $resukuran = explode(',', $ukuran);
                                } else {
                                    $resukuran = [$ukuran];
                                }
                                $harga = $produk->detail_produk->whereIn('ukuran', $resukuran)->avg('harga');
                                if ($harga) {

                                    $transaksi = new Transaksi();
                                    $transaksi->bank_id = $request->get('bank_id');
                                    $transaksi->user_id = $userid;
                                    $transaksi->alamat_id = $alamat->id;
                                    $transaksi->kode_transaksi = $this->generateKode();
                                    $transaksi->tgl_transaksi = date('Y-m-d H:i:s');
                                    $transaksi->qty = 1;
                                    $transaksi->total_harga =  ($harga * $request->get('jumlah'));
                                    $transaksi->biaya_admin = 2500;
                                    $transaksi->status_transaksi = "online";
                                    $transaksi->status_bayar = "belum dibayar";
                                    $transaksi->status = "butuh konfirmasi";
                                    $transaksi->save();
                                    $totalharga = $transaksi->total_harga;
                                    $detail_trans = new DetailTransaksi();
                                    $detail_trans->produk_id = $produk->id;
                                    $detail_trans->transaksi_id = $transaksi->id;
                                    $detail_trans->jumlah = $request->get('jumlah');
                                    $detail_trans->ukuran = $request->get('ukuran');
                                    $detail_trans->harga =  $harga;
                                    $detail_trans->total_harga =  $harga * $request->get('jumlah');
                                    $detail_trans->save();

                                    $resdata = Transaksi::where('id', $transaksi->id)->with('bank')->first();
                                    $resdata->bank->logo = asset('uploads/images/bank/' . $resdata->bank->logo);
                                    $message = 'saved';
                                    $status_akhir = true;

                                    $notif = new Notification();
                                    $notif->description = "Ada transaksi baru " . $transaksi->kode_transaksi;
                                    $notif->url = route('ecommerce.transaksi.index');
                                    $notif->aktif = 0;
                                    $notif->role = 'online';
                                    $notif->save();
                                }else{
                                    $message = 'not found';
                                    $status_akhir = false;
                                    $resdata = [];
                                }
                            } else {
                                $status_akhir = false;
                                $message = 'Produk harus di pilih';
                                $resdata = [];
                            }
                        }
                    }
                } else {
                    $status_akhir = false;
                    $message = 'Alamat harus di pilih';
                    $resdata = [];
                }


                DB::commit();
                return response()->json([
                    'status' => $status_akhir,
                    'message' => $message,
                    'code' => Response::HTTP_OK,
                    'data' => $resdata
                ]);
            } catch (\Exception $th) {

                //throw $th;
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Maaf ada yang error',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => $th
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

    public function generateKode()
    {
        $transaksi = Transaksi::select('id', 'kode_transaksi')->orderBy('created_at', 'DESC')->first();
        if ($transaksi) {
            $lastid = $transaksi->id;
            $jumlah = $lastid + 1;
            $kode = "INV" . date("dmY") . $jumlah;
        } else {
            $kode = "INV" . date("dmY") . "1";
        }

        return $kode;
    }

    public function upload_bukti(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'kode_transaksi' => 'required',
            'gambar' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => false, 'message' => $validator->errors()->first(), 'code' => Response::HTTP_OK]);
        } else {
            DB::beginTransaction();
            try {
                if ($request->hasFile('gambar')) {
                    $userid = Auth::guard('api')->user()->id;
                    $kode = $request->get('kode_transaksi');
                    $transaksi = Transaksi::where('user_id', $userid)->where('kode_transaksi', $kode)->first();
                    if ($transaksi) {
                        $file = $request->file('gambar');
                        $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path() . '/uploads/images/bukti_bayar/', $imageName);
                        $transaksi->status_bayar = "sudah di upload";
                        $transaksi->bukti_bayar = $imageName;
                        $transaksi->save();
                        $message = 'saved';
                        $status = true;
                    } else {
                        $status = false;
                        $message = 'kode tidak ditemukan';
                    }
                }

                DB::commit();

                return response()->json([
                    'status' => $status,
                    'message' => $message,
                    'code' => Response::HTTP_OK,
                ]);
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'message' => 'Maaf ada yang error',
                    'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                    'data' => $th
                ]);
            }
        }
    }
}
