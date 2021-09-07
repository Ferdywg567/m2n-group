<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Kategori;
use App\SubKategori;
use App\DetailSubKategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::all();
        $sub = SubKategori::all();
        $detail = DetailSubKategori::all();
        return view("backend.kategori.index", ['kategori' => $kategori, 'sub' => $sub, 'detail' => $detail]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $status = $request->get('status');
        if ($status == 'kategori') {
            return view("backend.kategori.kategori.create");
        } elseif ($status == 'Sub Kategori') {
            $kategori = Kategori::all();
            return view("backend.kategori.subkategori.create", ['kategori' => $kategori]);
        } else {
            $kategori = Kategori::all();
            $sub = SubKategori::all();
            return view("backend.kategori.detail_sub_kategori.create", ['kategori' => $kategori, 'sub' => $sub]);
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
        $status =  $request->get('status');
        if ($status == 'kategori') {
            $validator = Validator::make($request->all(), [
                'nama_kategori' => 'required',
                'sku' => 'required|unique:kategoris,sku'
            ]);
        } else if ($status == 'sub kategori') {
            $validator = Validator::make($request->all(), [
                'kategori_utama' => 'required',
                'sub_kategori.*' => 'required',
                'sku.*' => 'required',
            ]);
        } else if ($status == 'detail sub kategori') {
            $validator = Validator::make($request->all(), [
                'sub_kategori' => 'required',
                'detail_sub_kategori.*' => 'required',
                'sku.*' => 'required',
            ]);
        }


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            if ($status == 'kategori') {
                $kategori = new Kategori();
                $kategori->nama_kategori = $request->get('nama_kategori');
                $kategori->sku = $request->get('sku');
                $kategori->save();
            } elseif ($status == 'sub kategori') {
                $sku = $request->get('sku');
                $kategori = $request->get('sub_kategori');
                foreach ($sku as $key => $value) {
                    $sub = new SubKategori();
                    $sub->kategori_id = $request->get('kategori_utama');
                    $sub->nama_kategori = $kategori[$key];
                    $sub->sku = $value;
                    $sub->save();
                }
            } elseif ($status == 'detail sub kategori') {
                $sku = $request->get('sku');
                $kategori = $request->get('detail_sub_kategori');
                foreach ($sku as $key => $value) {
                    $sub = new DetailSubKategori();
                    $sub->sub_kategori_id = $request->get('sub_kategori');
                    $sub->nama_kategori = $kategori[$key];
                    $sub->sku = $value;
                    $sub->save();
                }
            }

            return redirect()->route('kategori.index')->with('success', 'kategori berhasil disimpan');
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

    public function getKategori(Request $request)
    {
        if ($request->ajax()) {
            $kategori = Kategori::where('id', $request->get('kategori'))->with([
                'sub_kategori'
            ])->first();
            return response()->json([
                'status' => true,
                'data' => $kategori
            ]);
        }
    }

    public function getSubKategori(Request $request)
    {
        if ($request->ajax()) {
            $kategori = SubKategori::where('id', $request->get('kategori'))->with('detail_sub')->first();
            return response()->json([
                'status' => true,
                'data' => $kategori
            ]);
        }
    }

    public function getDetailSubKategori(Request $request)
    {
        if ($request->ajax()) {
            $kategori = DetailSubKategori::where('id', $request->get('kategori'))->first();
            return response()->json([
                'status' => true,
                'data' => $kategori
            ]);
        }
    }

}
