<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Bahan;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masuk = Bahan::all()->where('status', 'bahan masuk');
        $keluar = Bahan::all()->where('status', 'bahan keluar');
        return view("backend.bahan.index", ['masuk' => $masuk, 'keluar' => $keluar]);
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

        if ($request->get('status') == 'bahan masuk') {
            $validator = Validator::make($request->all(), [
                'kode_bahan' =>  'required',
                'no_surat' => 'required',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal' => 'required',
                'panjang_bahan' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_bahan' =>  'required',
                'no_surat' => 'required',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal' => 'required',
                'panjang_bahan' => 'required',
                'sku' => 'required'
            ]);
        }

        if ($validator->fails()) {
            $html = '';
            $html .= '<div class="alert alert-danger" role="alert">
                ' . $validator->errors()->first() . '
              </div>';

            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {

            if ($request->get('status') == 'bahan masuk') {
                $bahan = new Bahan();
                $bahan->kode_bahan = $request->get('kode_bahan');
            } else {
                $bahan = Bahan::findOrFail($request->get('kode_bahan'));
            }
            $bahan->no_surat = $request->get('no_surat');
            $bahan->nama_bahan = $request->get('nama_bahan');
            $bahan->jenis_bahan = $request->get('jenis_bahan');
            $bahan->warna = $request->get('warna');
            $bahan->vendor = $request->get('vendor');
            if ($request->get('status') == 'bahan masuk') {
                $bahan->tanggal_masuk = $request->get('tanggal');
                $bahan->status = "bahan masuk";
            } else {
                $bahan->sku = $request->get('sku');
                $bahan->status = "bahan keluar";
                $bahan->tanggal_keluar = $request->get('tanggal');
            }

            $bahan->panjang_bahan = $request->get('panjang_bahan');

            $bahan->save();

            $html = '<div class="alert alert-success" role="alert">bahan berhasil disimpan</div>';
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
    public function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $bahan = Bahan::findOrFail($id);

            return response()->json($bahan);
        }
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
        if ($request->get('status') == 'bahan masuk') {
            $validator = Validator::make($request->all(), [

                'no_surat' => 'required',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal' => 'required',
                'panjang_bahan' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [

                'no_surat' => 'required',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal' => 'required',
                'panjang_bahan' => 'required',
                'sku' => 'required'
            ]);
        }

        if ($validator->fails()) {
            $html = '';
            $html .= '<div class="alert alert-danger" role="alert">
                ' . $validator->errors()->first() . '
              </div>';

            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {

            $bahan = Bahan::findOrFail($id);
            $bahan->no_surat = $request->get('no_surat');
            $bahan->nama_bahan = $request->get('nama_bahan');
            $bahan->jenis_bahan = $request->get('jenis_bahan');
            $bahan->warna = $request->get('warna');
            $bahan->vendor = $request->get('vendor');
            if ($request->get('status') == 'bahan masuk') {
                $bahan->tanggal_masuk = $request->get('tanggal');
                $bahan->status = "bahan masuk";
            } else {
                $bahan->sku = $request->get('sku');
                $bahan->status = "bahan keluar";
                $bahan->tanggal_keluar = $request->get('tanggal');
            }

            $bahan->panjang_bahan = $request->get('panjang_bahan');

            $bahan->save();

            $html = '<div class="alert alert-success" role="alert">bahan berhasil diupdate</div>';
            return response()->json([
                'status' => true,
                'data' => $html
            ]);
        }
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

    public function getDataBahan(Request $request)
    {
        if ($request->ajax()) {
            $bahan = Bahan::findOrFail($request->get('id'));

            return response()->json([
                'status' => true,
                'data' => $bahan
            ]);
        }
    }
}
