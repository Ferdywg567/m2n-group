<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Potong;
use App\Jahit;
use App\PembayaranJahit;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jahit = Jahit::where('vendor', 'eksternal')->orderBy('created_at', 'DESC')->get();
        return view('backend.pembayaran.index', ['jahit' => $jahit]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->get('status') == 'jahit') {
            $jahit = Jahit::where('vendor', 'eksternal')->doesntHave('pembayaran_jahit')->get();
            return view("backend.pembayaran.jahit.create", ['jahit' => $jahit]);
        } else {
            // $keluar = Jahit::all()->where('status', 'jahitan selesai')->where('status_jahit', 'selesai');
            $keluar = Jahit::all()->where('status', 'jahitan selesai');
            return view("backend.jahit.keluar.create", ['keluar' => $keluar]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $status = $request->get('status');

        if ($status == 'jahit') {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'pembayaran1' => 'required'
            ]);
        }


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                // dd($request->all());
                if ($status == 'jahit') {
                    $pembayaran1 = $request->get('pembayaran1');
                    if ($pembayaran1 == 'Lunas') {
                        $jahit = Jahit::findOrFail($request->get('kode_transaksi'));
                        $jahit->total_bayar = $request->get('total_harga');
                        $jahit->sisa_bayar = 0;
                        $jahit->status_pembayaran = "Lunas";
                        $jahit->save();

                        $pembayaran = new PembayaranJahit();
                        $pembayaran->jahit_id = $jahit->id;
                        $pembayaran->status = "Lunas";
                        $pembayaran->nominal = $request->get('nominal1');
                        $pembayaran->save();
                    } elseif ($pembayaran1 == 'Termin 1') {
                        $nominal1 = $request->get('nominal1');
                        $nominal2 = $request->get('nominal2');
                        $nominal3 = $request->get('nominal3');

                        if ($nominal1 > 0 && $nominal2 > 0 && $nominal3 > 0) {
                            $total = $nominal1 + $nominal2 + $nominal3;
                            if ($request->get('total_harga') == $total) {
                                $status = 'Lunas';
                                $jahit = Jahit::findOrFail($request->get('kode_transaksi'));
                                $jahit->total_bayar = $total;
                                $jahit->sisa_bayar = 0;
                                $jahit->status_pembayaran = "Lunas";
                                $jahit->save();

                                $pembayaran = new PembayaranJahit();
                                $pembayaran->jahit_id = $jahit->id;
                                $pembayaran->status = "Termin 1";
                                $pembayaran->nominal = $nominal1;
                                $pembayaran->save();

                                $pembayaran = new PembayaranJahit();
                                $pembayaran->jahit_id = $jahit->id;
                                $pembayaran->status = "Termin 2";
                                $pembayaran->nominal = $nominal2;
                                $pembayaran->save();

                                $pembayaran = new PembayaranJahit();
                                $pembayaran->jahit_id = $jahit->id;
                                $pembayaran->status = "Termin 3";
                                $pembayaran->nominal = $nominal3;
                                $pembayaran->save();
                            }
                        } else  if ($nominal1 > 0 && $nominal2 > 0) {
                            $total = $nominal1 + $nominal2;
                            if($total == $request->get('total_harga')){
                                $status = 'Lunas';
                            }else{
                                $status = 'Termin 2';
                            }
                            $sisa =  $request->get('total_harga') - $total;
                            $jahit = Jahit::findOrFail($request->get('kode_transaksi'));
                            $jahit->total_bayar = $total;
                            $jahit->sisa_bayar = $sisa;
                            $jahit->status_pembayaran = $status;
                            $jahit->save();

                            $pembayaran = new PembayaranJahit();
                            $pembayaran->jahit_id = $jahit->id;
                            $pembayaran->status = "Termin 1";
                            $pembayaran->nominal = $nominal1;
                            $pembayaran->save();

                            $pembayaran = new PembayaranJahit();
                            $pembayaran->jahit_id = $jahit->id;
                            $pembayaran->status = "Termin 2";
                            $pembayaran->nominal = $nominal2;
                            $pembayaran->save();
                        } else  if ($nominal1 > 0 ) {
                            $total = $nominal1;
                            if($total == $request->get('total_harga')){
                                $status = 'Lunas';
                            }else{
                                $status = 'Termin 2';
                            }
                            $sisa =  $request->get('total_harga') - $total;
                            $jahit = Jahit::findOrFail($request->get('kode_transaksi'));
                            $jahit->total_bayar = $total;
                            $jahit->sisa_bayar = $sisa;
                            $jahit->status_pembayaran =  $status;
                            $jahit->save();

                            $pembayaran = new PembayaranJahit();
                            $pembayaran->jahit_id = $jahit->id;
                            $pembayaran->status = "Termin 1";
                            $pembayaran->nominal = $nominal1;
                            $pembayaran->save();
                        }
                    }
                }
                DB::commit();
                return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil disimpan');
            } catch (\Throwable $th) {
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
}
