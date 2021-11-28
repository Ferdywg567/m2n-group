<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DetailTransaksi;
use App\Transaksi;
use App\Keranjang;
use App\Alamat;
use App\Bank;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iduser = auth()->user()->id;
        $data = Keranjang::where('user_id', $iduser)->where('check', 1)->get();
        $totalharga = Keranjang::where('user_id', $iduser)->where('check', 1)->sum('subtotal');
        $admin = 2500;
        $totaltagihan = $totalharga + $admin;
        $alamat = Alamat::where('user_id', $iduser)->where('status', 'Utama')->first();
        $bank = Bank::all();
        return view('ecommerce.frontend.checkout.index', [
            'data' => $data,
            'admin' => $admin, 'totaltagihan' => $totaltagihan,
            'totalharga' => $totalharga, 'alamat' => $alamat,
            'bank' => $bank
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
        $bank = $request->get('bank');
        $iduser = auth()->user()->id;
        $data = Keranjang::where('user_id', $iduser)->where('check', 1)->get();
        if(count($data) > 0){
            $transaksi = new Transaksi();
            $transaksi->kode_transaksi = $this->generateKode();
            $transaksi->tgl_transaksi = date('Y-m-d H:i:s');
        }
        $token = $this->generateRandomString(30);
        session(['token_checkout' => $token]);
        session(['bank' => $bank]);
        return redirect()->route('frontend.checkout.success',[$token]);
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
    function generateRandomString($length = 10)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return md5($randomString);
    }

    public function get_checkout_success()
    {
        if(session()->has('token_checkout')){

            $bank = Bank::findOrFail(1);
            return view('ecommerce.frontend.checkout.success');
        }else{
            return redirect()->route('landingpage.index');
        }

    }

    public function checkout_success()
    {
        $token = $this->generateRandomString(30);
        session(['token_checkout' => $token]);
        return redirect()->route('frontend.checkout.success',[$token]);
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

}
