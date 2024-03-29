<?php

namespace App\Http\Controllers\Ecommerce\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DetailTransaksi;
use App\Notification;
use App\Transaksi;
use App\Keranjang;
use App\Produk;
use App\Alamat;
use App\Bank;
use App\DetailProduk;
use Exception;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {
        $iduser = auth()->user()->id;
        $data = Keranjang::where('user_id', $iduser)->where('check', 1)->get();
        $bank = Bank::all();

        // dd($bank, session()->has('checkout_langsung'));

        if (count($bank) == 0) {
            return redirect()->route('landingpage.index');
        }


        if (session()->has('checkout_langsung') || count($data) > 0) {
            $totalharga = 0;
            $totalproduk = 0;
            if (session()->has('checkout_langsung')) {
                $checkout_langsung = session('checkout_langsung');
                $totalharga = $checkout_langsung['subtotal'];
                $totalproduk = $checkout_langsung['total_produk'];
            } elseif (count($data) > 0) {
                $totalharga = Keranjang::where('user_id', $iduser)->where('check', 1)->sum('subtotal');
                $totalproduk = Keranjang::where('user_id', $iduser)->where('check', 1)->count();
            }
            $admin = 2500;
            // dd($totalproduk);
            $totaltagihan = $totalharga + $admin;
            $alamat = Alamat::where('user_id', $iduser)->where('status', 'Utama')->first();

            return view('ecommerce.frontend.checkout.index', [
                'data' => $data,
                'admin' => $admin, 'totaltagihan' => $totaltagihan,
                'totalharga' => $totalharga, 'alamat' => $alamat,
                'bank' => $bank,
                'totalproduk' => $totalproduk
            ]);
        } else {
            return redirect()->route('landingpage.index');
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
            'bank' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors());
        } else {
            $bank = $request->get('bank');
            $iduser = auth()->user()->id;
            $data = Keranjang::where('user_id', $iduser)->where('check', 1)->get();
            $alamat = Alamat::where('user_id', $iduser)->where('status', 'Utama')->first();
            DB::beginTransaction();
            try {
                $totalharga = 0;
                $jumlah = 0;
                if (session()->has('checkout_langsung')) {
                    $checkout_langsung = session('checkout_langsung');

                    $transaksi = new Transaksi();
                    $transaksi->bank_id = $bank;
                    $transaksi->user_id = $iduser;
                    $transaksi->alamat_id = $alamat->id;
                    $transaksi->kode_transaksi = $this->generateKode();
                    $transaksi->tgl_transaksi = date('Y-m-d H:i:s');
                    $transaksi->qty = 1;
                    $transaksi->total_harga = $checkout_langsung['total_harga'];
                    $transaksi->status_transaksi = "online";
                    $transaksi->status_bayar = "belum dibayar";
                    $transaksi->status = "butuh konfirmasi";
                    $transaksi->save();
                    $totalharga = $transaksi->total_harga;

                    //save detail transaction
                    $dp = DetailProduk::where('produk_id', $checkout_langsung['id_produk'])
                        ->where('ukuran', $checkout_langsung['ukuran']);

                    if ($dp->exists() and $dp->first()->jumlah >= $checkout_langsung['total_produk']) {
                        $detail_trans = new DetailTransaksi();
                        $detail_trans->produk_id = $checkout_langsung['id_produk'];
                        $detail_trans->transaksi_id = $transaksi->id;
                        $detail_trans->jumlah = $checkout_langsung['total_produk'];
                        $detail_trans->harga = $checkout_langsung['harga'];
                        $detail_trans->ukuran = $checkout_langsung['ukuran'];
                        $detail_trans->total_harga = $checkout_langsung['subtotal'];
                        $detail_trans->save();
                    } else {
                        throw new Exception("Stok tidak mencukupi");
                    }

                    $jumlah = $checkout_langsung['total_produk'];
                    session()->forget('checkout_langsung');
                } elseif (count($data) > 0) {
                    session()->forget('checkout_langsung');
                    $jumlahqty = Keranjang::where('user_id', $iduser)->where('check', 1)->sum('jumlah');
                    $totalharga = Keranjang::where('user_id', $iduser)->where('check', 1)->sum('subtotal');
                    $jmlproduk = Keranjang::where('user_id', $iduser)->where('check', 1)->count();
                    $jumlah =  $jmlproduk;
                    $totalharga = $totalharga + 2500;
                    $transaksi = new Transaksi();
                    $transaksi->user_id = $iduser;
                    $transaksi->bank_id = $bank;
                    $transaksi->alamat_id = $alamat->id;
                    $transaksi->kode_transaksi = $this->generateKode();
                    $transaksi->tgl_transaksi = date('Y-m-d H:i:s');
                    $transaksi->qty = $jumlahqty;
                    $transaksi->total_harga = $totalharga;
                    $transaksi->status_transaksi = "online";
                    $transaksi->status_bayar = "belum dibayar";
                    $transaksi->status = "butuh konfirmasi";
                    $transaksi->save();

                    //save detail transaksi
                    foreach ($data as $key => $value) {
                        // dd($value, explode(', ', $value->ukuran), $dp->first());
                        // $ukurans = explode(', ', $value->ukuran);

                        $dp = DetailProduk::where('produk_id', $value->produk_id)
                            ->whereIn('ukuran', explode(',', $value->ukuran));

                        // foreach ($ukurans as $ukuran) {
                        // $dp = DetailProduk::where('produk_id', $value->produk_id)
                        // ->where('ukuran', $ukuran);
                        if ($dp->exists() && $dp->first()->jumlah >= $value->jumlah) {
                            $detail_trans               = new DetailTransaksi();
                            $detail_trans->produk_id    = $value->produk_id;
                            $detail_trans->transaksi_id = $transaksi->id;
                            $detail_trans->jumlah       = $value->jumlah;
                            $detail_trans->harga        = $value->harga;
                            $detail_trans->ukuran       = $value->ukuran;
                            // $detail_trans->ukuran = $ukuran;
                            $detail_trans->total_harga = $value->subtotal;
                            $detail_trans->save();
                        } else {
                            throw new Exception("Stok tidak mencukupi");
                        }
                        // }


                    }

                    Keranjang::where('user_id', $iduser)->where('check', 1)->delete();
                }

                $notif = new Notification();
                $notif->description = "Ada transaksi baru " . $transaksi->kode_transaksi;
                $notif->url = route('ecommerce.transaksi.index');
                $notif->aktif = 0;
                $notif->role = 'online';
                $notif->save();
                $token = $this->generateRandomString(30);
                session(['token_checkout' => $token]);
                session(['kode_transaksi' => $transaksi->kode_transaksi]);
                session()->forget('bukti_bayar');
                $transaksi = [
                    'bank' => $bank,
                    'total_harga' => $totalharga,
                    'jumlah_produk' => $jumlah
                ];
                session(['transaksi_online' => $transaksi]);
                DB::commit();
                return redirect()->route('frontend.checkout.success', [$token]);
            } catch (\Exception $th) {
                //throw $th;

                DB::rollBack();
                if (str_starts_with($th->getMessage(), "Stok tidak mencukupi")) {
                    return redirect()->back()->withErrors(['error' => $th->getMessage()]);
                }
                dd($th->getLine());
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

    function generateRandomString($length)
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
        $token = $this->generateRandomString(50);
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

    public function beli_langsung(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'jumlah' => 'required|min:1|integer',
            'ukuran' => 'required'
        ]);

        if ($validator->fails()) {
            $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $id = $request->get('id');
            $jumlah = $request->get('jumlah');
            $ukuran = $request->get('ukuran');
            $produk = Produk::findOrFail($id);
            $checkout = [
                'id_produk' => $produk->id,
                'harga' =>  $produk->harga_promo,
                'ukuran' => $ukuran,
                'subtotal' => $produk->harga_promo * $jumlah,
                'total_produk' => $jumlah,
                'total_harga' => ($produk->harga_promo *  $jumlah) + 2500
            ];
            session(['checkout_langsung' => $checkout]);
            $html = '<div class="alert alert-success" role="alert"> Berhasil Beli Langsung </div>';

            return response()->json([
                'html'   => $html,
                'status' => true
            ]);
        }
    }

    public function upload_bukti(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'file' => 'required',

            ]);
            if ($validator->fails()) {
                $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

                return response()->json([
                    'status' => false,
                    'data' => $html
                ]);
            } else {
                if ($request->hasFile('file')) {

                    if (session()->has('kode_transaksi')) {
                        $userid = auth()->user()->id;
                        $kode = session('kode_transaksi');
                        $transaksi = Transaksi::where('user_id', $userid)->where('kode_transaksi', $kode)->firstOrFail();
                        $file = $request->file('file');
                        $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                        $file->move(public_path() . '/uploads/images/bukti_bayar/', $imageName);
                        $transaksi->status_bayar = "sudah di upload";
                        $transaksi->bukti_bayar = $imageName;
                        $transaksi->save();
                        $html = ' <div class="alert alert-success" role="alert"> Bukti Pembayaran berhasil di simpan </div>';
                        $status = true;

                        session(['bukti_bayar' => true]);
                        session()->forget('kode_transaksi');
                    } else {
                        $html = ' <div class="alert alert-danger" role="alert"> Maaf ada salah </div>';
                        $status = false;
                    }
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
}
