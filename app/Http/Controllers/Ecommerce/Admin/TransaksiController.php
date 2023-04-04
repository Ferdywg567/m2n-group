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
use App\DetailRetur;
use App\DetailWarehouse;
use App\Retur;
use Illuminate\Http\Request;
use App\Transaksi;
use Exception;

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
        $selesai = Transaksi::whereIn('status', ['telah tiba', 'retur', 'refund'])->orWhere('status_bayar','dibatalkan')->orderBy('created_at', 'DESC')->get();
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
                            $value->ukuran = str_replace(' ', '', $value->ukuran);
                            if($value->ukuran == 'S,M,L'){
                                $ukuran = ['S','M','L'];
                            }elseif(str_contains($value->ukuran, ',')){
                                $ukuran = explode(',', $value->ukuran);
                            }else{
                                $ukuran = [$value->ukuran];
                            }
                            
                            $produk = Produk::findOrFail($value->produk_id);
                            $jumproduk = DetailProduk::where('produk_id', $produk->id)->whereIn('ukuran', $ukuran)->count();
                            $produk->stok = $produk->stok - ($jumproduk * $value->jumlah);
                            $detailpro = DetailProduk::where('produk_id', $produk->id)->whereIn('ukuran',$ukuran)->get();
                            foreach ($detailpro as $key => $row) {
                                $detailProduk = DetailProduk::findOrFail($row->id);
                                $detailProduk->jumlah = $detailProduk->jumlah - $value->jumlah;
                                $detailProduk->save();

                                //didan - deduct jumlah barang from warehouse detail
                                $warehouse = $detailProduk->produk->warehouse;
                                foreach($warehouse->detail_warehouse as $d){
                                    if($d->ukuran == $value['ukuran']){
                                        $d->jumlah = $d->jumlah - $value['qty'];
                                        $d->save();
                                    }
                                }
                                //end deduct jumlah barang from warehouse detail
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
                dd($th->getMessage());
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

    public function retur(Request $request){

        $trx = Transaksi::find($request->id);
        DB::beginTransaction();
        try{
            $trx->status = "retur";
            $trx->save();

            foreach($trx->detail_transaksi as $detail){
            
                $finishing = $detail->produk->warehouse->finishing;
                $produk = $detail->produk;
                $warehouse = $produk->warehouse;
                
                $retur = new Retur;
                $retur->finishing_id = $finishing->id;
                $retur->tanggal_masuk = date('Y-m-d');
                $retur->keterangan_diretur = "retur dari customer";
                $retur->total_barang = $detail->jumlah;
                $retur->save();

                foreach(explode(",", str_replace(" ", "", $detail->ukuran)) as $d){
                    $dRetur = new DetailRetur;
                    $dRetur->retur_id = $retur->id;
                    $dRetur->ukuran = $d;
                    $dRetur->jumlah = $detail->jumlah;
                    $dRetur->save();

                    $dProduk = DetailProduk::where('produk_id', $produk->id)
                        ->where('ukuran', $d)->first();
                    $dWarehouse = DetailWarehouse::where('warehouse_id', $warehouse->id)
                        ->where('ukuran', $d)->first();

                    if($dProduk->jumlah >= $detail->jumlah and $dWarehouse->jumlah >= $detail->jumlah){
                        $dProduk->jumlah = $dProduk->jumlah - $detail->jumlah;
                        $dProduk->save();

                        $dWarehouse->jumlah = $dWarehouse->jumlah - $detail->jumlah;
                        $dWarehouse->save();
                    }else{
                        DB::rollBack();
                        return response()->json([
                            'status' => false,
                            'data' => "stok tidak mencukupi"
                        ]);
                    }
                }
            }
            DB::commit();
            return response()->json([
                'status' => true,
                'data' => "Berhasil melakukan retur"
            ]);

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }

    }

    public function refund(Request $request){
        $trx = Transaksi::find($request->id);
        DB::beginTransaction();
        try{
            $trx->status = "refund";
            $trx->save();
            
            foreach($trx->detail_transaksi as $detail){
            
                $finishing = $detail->produk->warehouse->finishing;
                
                $retur = new Retur;
                $retur->finishing_id = $finishing->id;
                $retur->tanggal_masuk = date('Y-m-d');
                $retur->keterangan_diretur = "retur dari customer";
                $retur->total_barang = $detail->jumlah;
                $retur->save();

                foreach(explode(",", str_replace(" ", "", $detail->ukuran)) as $d){
                    $dRetur = new DetailRetur;
                    $dRetur->retur_id = $retur->id;
                    $dRetur->ukuran = $d;
                    $dRetur->jumlah = $detail->jumlah;
                    $dRetur->save();
                }
            }

            DB::commit();
            return response()->json([
                'status' => true,
                'data' => "Berhasil melakukan refund"
            ]);

        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
