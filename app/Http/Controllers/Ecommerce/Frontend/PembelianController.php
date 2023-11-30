<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use App\Alamat;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Transaksi;
use Illuminate\Http\Request;

class PembelianController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userid = auth()->user()->id;
        $menunggu = Transaksi::where('user_id', $userid)->where('status_bayar', 'belum dibayar')->orderBy('created_at','DESC')->get();
        $transaksi = Transaksi::with('ulasan')->where('user_id', $userid)->where(function ($q) {
            $q->orwhere('status_bayar', 'sudah di upload')->orWhere('status_bayar', 'sudah dibayar')->orWhere('status', 'dikirim')->orWhere('status', 'telah tiba');
        })->orderBy('created_at','DESC')->get();
        // dd($transaksi);
        return view('ecommerce.frontend.pembelian.index', ['menunggu' => $menunggu, 'transaksi' => $transaksi]);
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
            $validator = Validator::make($request->all(), [
                'file' => 'required',
                'id' => 'required'
            ]);
            if ($validator->fails()) {
                $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

                return response()->json([
                    'status' => false,
                    'data' => $html
                ]);
            } else {
                if ($request->hasFile('file')) {
                    $userid = auth()->user()->id;
                    $transaksi = Transaksi::where('user_id', $userid)->where('id', $request->get('id'))->firstOrFail();
                    $file = $request->file('file');
                    $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/uploads/images/bukti_bayar/', $imageName);
                    $transaksi->status_bayar = "sudah di upload";
                    $transaksi->bukti_bayar = $imageName;
                    $transaksi->save();
                    $html = ' <div class="alert alert-success" role="alert"> Bukti Pembayaran berhasil di simpan </div>';
                    $status = true;
                } else {
                    $html = ' <div class="alert alert-danger" role="alert"> Maaf ada salah </div>';
                    $status = false;
                }

                return response()->json([
                    'status' => $status,
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
        $userid = auth()->user()->id;
        $menunggu = Transaksi::where('user_id', $userid)->where('status_bayar', 'belum dibayar')->orderBy('created_at','DESC')->get();
        $transaksi = Transaksi::where('user_id', $userid)->where('id',$id)->firstOrFail();
        $transaksi->{'alamat'} = Alamat::find($transaksi->alamat_id);
        return view('ecommerce.frontend.pembelian.show', [ 'transaksi' => $transaksi]);
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

    public function update_selesai(Request $request){
        if($request->ajax()){
            $userid = auth()->user()->id;
            $id = $request->get('id');
            $transaksi = Transaksi::where('user_id', $userid)->where('id', $id)->firstOrFail();
            $transaksi->status = "telah tiba";
            $transaksi->save();

            $request->session()->flash('success', 'Transaksi berhasil di konfirmasi!');
            return response()->json([
                'status' => true
            ]);
        }
    }
}
