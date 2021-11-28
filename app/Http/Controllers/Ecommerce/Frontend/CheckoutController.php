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

        DB::beginTransaction();
        try {
            if (count($data) > 0) {
                $jumlahqty = Keranjang::where('user_id', $iduser)->where('check', 1)->sum('jumlah');
                $totalharga = Keranjang::where('user_id', $iduser)->where('check', 1)->sum('subtotal');
                $totalharga = $totalharga + 2500;
                $transaksi = new Transaksi();
                $transaksi->bank_id = $bank;
                $transaksi->kode_transaksi = $this->generateKode();
                $transaksi->tgl_transaksi = date('Y-m-d H:i:s');
                $transaksi->qty = $jumlahqty;
                $transaksi->total_harga = $totalharga;
                $transaksi->status_transaksi = "online";
                $transaksi->status_bayar = "belum dibayar";
                $transaksi->status = "butuh konfirmasi";
                $transaksi->save();

                foreach ($data as $key => $value) {
                    $detail_trans = new DetailTransaksi();
                    $detail_trans->produk_id = $value->produk_id;
                    $detail_trans->transaksi_id = $transaksi->id;
                    $detail_trans->jumlah = $value->jumlah;
                    $detail_trans->harga = $value->harga;
                    $detail_trans->total_harga = $value->subtotal;
                    $detail_trans->save();
                }

                Keranjang::where('user_id', $iduser)->where('check', 1)->delete();
            }
            $token = $this->generateRandomString(30);
            session(['token_checkout' => $token]);

            $transaksi = [
                'bank' => $bank,
                'total_harga' => $totalharga,
            ];
            session(['transaksi_online' => $transaksi]);
            DB::commit();
            return redirect()->route('frontend.checkout.success', [$token]);
        } catch (\Exception $th) {
            //throw $th;

            DB::rollBack();
            dd($th);
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
        if (session()->has('token_checkout')) {
            $transaksi = session('transaksi_online');
            $idbank = $transaksi['bank'];
            $bank = Bank::findOrFail($idbank);
            return view('ecommerce.frontend.checkout.success', ['bank' => $bank, 'transaksi' => $transaksi]);
        } else {
            return redirect()->route('landingpage.index');
        }
    }

    public function checkout_success()
    {
        $token = $this->generateRandomString(30);
        session(['token_checkout' => $token]);
        return redirect()->route('frontend.checkout.success', [$token]);
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
