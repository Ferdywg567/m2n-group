<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Sku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SkuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sku = Sku::orderBy('created_at', 'DESC')->get();
        return view("backend.sku.index", ['sku' => $sku]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sku.create');
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
            'kode_sku' => 'required|unique:skus,kode_sku',
            'nama_produk' => 'required',
            'warna' => 'required',
            'jenis_bahan' => 'required',
            'ukuran' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $sku = new Sku();
            $sku->kode_sku = $request->get('kode_sku');
            $sku->nama_produk = $request->get('nama_produk');
            $sku->warna = $request->get('warna');
            $sku->jenis_bahan = $request->get('jenis_bahan');
            $sku->ukuran = $request->get('ukuran');
            $sku->save();

            return redirect()->route('sku.index')->with('success', 'sku berhasil disimpan');
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
        $sku = Sku::findOrFail($id);
        return view("backend.sku.show", ['sku' => $sku]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sku = Sku::findOrFail($id);
        return view("backend.sku.edit", ['sku' => $sku]);
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
        $validator = Validator::make($request->all(), [
            'nama_produk' => 'required',
            'warna' => 'required',
            'jenis_bahan' => 'required',
            'ukuran' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $sku = Sku::findOrFail($id);
            $sku->nama_produk = $request->get('nama_produk');
            $sku->warna = $request->get('warna');
            $sku->jenis_bahan = $request->get('jenis_bahan');
            $sku->ukuran = $request->get('ukuran');
            $sku->save();

            return redirect()->route('sku.index')->with('success', 'sku berhasil diupdate');
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
}
