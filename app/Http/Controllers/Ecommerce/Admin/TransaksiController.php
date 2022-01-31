<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use App\NotificationEcommerce;
use App\DetailProduk;
use App\Produk;
use App\Alamat;
use Illuminate\Http\Request;
use App\Transaksi;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $belumbayar = Transaksi::where('status_bayar', 'belum dibayar')->orwhere('status_bayar', 'sudah di upload')->orderBy('created_at', 'DESC')->get();
        $sudahbayar = Transaksi::where('status_bayar', 'sudah dibayar')->where('status', '!=', 'dikirim')->where('status', '!=', 'telah tiba')->orderBy('created_at', 'DESC')->get();
        $dikirim = Transaksi::where('status', 'dikirim')->orderBy('created_at', 'DESC')->get();
        $selesai = Transaksi::where('status', 'telah tiba')->orWhere('status_bayar','dibatalkan')->orderBy('created_at', 'DESC')->get();
        return view('ecommerce.admin.transaksi.index', [
            'belumbayar' => $belumbayar, 'sudahbayar' => $sudahbayar, 'dikirim' => $dikirim, 'selesai' => $selesai
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
        if ($request->ajax()) {
            $status = $request->get('status');
            $id = $request->get('id');

            DB::beginTransaction();
            try {
                if ($status == 'konfirmasi bayar') {
                    $transaksi = Transaksi::findOrFail($id);
                    $transaksi->status_bayar = $request->get('status_bayar');
                    $transaksi->save();
                    $html = ' <div class="alert alert-success" role="alert"> Pembayaran berhasil di konfirmasi </div>';
                }

                if ($status == 'konfirmasi kirim') {
                    $validator = Validator::make($request->all(), [
                        'id' => 'required',
                        'nomor_resi' => 'required',
                    ]);

                    if ($validator->fails()) {
                        $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

                        return response()->json([
                            'status' => false,
                            'data' => $html
                        ]);
                    } else {
                        $transaksi = Transaksi::findOrFail($id);
                        $transaksi->status = "dikirim";
                        $transaksi->no_resi = $request->get('nomor_resi');
                        $transaksi->save();

                        foreach ($transaksi->detail_transaksi as $key => $value) {

                            if($value->ukuran == 'S,M,L'){
                                $ukuran = ['S','M','L'];
                            }else{
                                $ukuran = $value->ukuran;
                            }

                            $produk = Produk::findOrFail($value->produk_id);
                            $jumproduk = DetailProduk::where('produk_id', $produk->id)->whereIn('ukuran', $ukuran)->count();
                            $produk->stok = $produk->stok - ($jumproduk * $value->jumlah);
                            $detailpro = DetailProduk::where('produk_id', $produk->id)->whereIn('ukuran',$ukuran)->get();
                            foreach ($detailpro as $key => $row) {
                                $detailProduk = DetailProduk::findOrFail($row->id);
                                $detailProduk->jumlah = $detailProduk->jumlah - $value->jumlah;
                                $detailProduk->save();
                            }
                            $produk->save();
                        }

                        //notifikasi kirim
                        $notif = new NotificationEcommerce();
                        $notif->user_id = $transaksi->user_id;
                        $notif->transaksi_id = $transaksi->id;
                        $notif->pesan = "Pesanan dengan nomor transaksi ".$transaksi->kode_transaksi." dalam proses pengiriman!";
                        $notif->save();


                        $html = ' <div class="alert alert-success" role="alert"> Status berhasil di update ke kirim </div>';
                    }
                }
                DB::commit();
                return response()->json([
                    'status' => true,
                    'data' => $html
                ]);
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
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

    public function download($id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $filename = $transaksi->bukti_bayar;
        $file_path = public_path() . '/uploads/images/bukti_bayar/' . $filename;

        if (file_exists($file_path)) {
            // Send Download
            return Response::download($file_path, $filename, [
                'Content-Length: ' . filesize($file_path)
            ]);
        } else {
            // Error
            exit('Requested file does not exist on our server!');
        }
    }

    public function getAlamat(Request $request){
        if($request->ajax()){
            $id = $request->get('id');
            $transaksi = Transaksi::where('id',$id)->first();

            if($transaksi){
                $alamat = Alamat::findOrFail($transaksi->alamat_id);

                return response()->json([
                    'status' => true,
                    'data' => $alamat
                ]);
            }else{
                return response()->json([
                    'status' => false,

                ]);
            }
        }
    }
}
