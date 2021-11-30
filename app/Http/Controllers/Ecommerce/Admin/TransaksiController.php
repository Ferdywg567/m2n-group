<?php

namespace App\Http\Controllers\Ecommerce\Admin;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
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
        $sudahbayar = Transaksi::where('status_bayar', 'sudah dibayar')->where('status','!=','dikirim')->orderBy('created_at', 'DESC')->get();
        $dikirim = Transaksi::where('status','dikirim')->orderBy('created_at', 'DESC')->get();
        return view('ecommerce.admin.transaksi.index', [
            'belumbayar' => $belumbayar, 'sudahbayar' => $sudahbayar,'dikirim' => $dikirim
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

            if ($status == 'konfirmasi bayar') {
                $transaksi = Transaksi::findOrFail($id);
                $transaksi->status_bayar = $request->get('status_bayar');
                $transaksi->save();
                $html = ' <div class="alert alert-success" role="alert"> Pembayaran berhasil di konfirmasi </div>';
            }

            if ($status == 'konfirmasi kirim') {
                $validator = Validator::make($request->all(),[
                    'id' => 'required',
                    'nomor_resi' => 'required',
                ]);

                if ($validator->fails()) {
                    $html = ' <div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';

                    return response()->json([
                        'status' => false,
                        'data' => $html
                    ]);
                } else{
                    $transaksi = Transaksi::findOrFail($id);
                    $transaksi->status = "dikirim";
                    $transaksi->no_resi = $request->get('nomor_resi');
                    $transaksi->save();
                    $html = ' <div class="alert alert-success" role="alert"> Status berhasil di update ke kirim </div>';

                }


            }

            return response()->json([
                'status' => true,
                'data' => $html
            ]);
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
}
