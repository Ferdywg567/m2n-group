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
        $kategori = Kategori::orderBy('created_at', 'DESC')->get();
        $sub      = SubKategori::orderBy('created_at', 'DESC')->get();
        $detail   = DetailSubKategori::orderBy('created_at', 'DESC')->get();
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
                'sku.*'          => 'required',
            ]);
        } else if ($status == 'detail sub kategori') {
            $validator = Validator::make($request->all(), [
                'sub_kategori'          => 'required',
                'detail_sub_kategori.*' => 'required',
                'sku.*'                 => 'required',
            ]);
        }


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            if ($status == 'kategori') {
                $kategori                = new Kategori();
                $kategori->nama_kategori = $request->get('nama_kategori');
                $kategori->sku           = $request->get('sku');
                $kategori->save();
            } elseif ($status == 'sub kategori') {
                $sku = $request->get('sku');
                $kategori = $request->get('sub_kategori');
                foreach ($sku as $key => $value) {
                    $sub                = new SubKategori();
                    $sub->kategori_id   = $request->get('kategori_utama');
                    $sub->nama_kategori = $kategori[$key];
                    $sub->sku           = $value;
                    $sub->save();
                }
            } elseif ($status == 'detail sub kategori') {
                $sku = $request->get('sku');
                $kategori = $request->get('detail_sub_kategori');
                foreach ($sku as $key => $value) {
                    $sub                  = new DetailSubKategori();
                    $sub->sub_kategori_id = $request->get('sub_kategori');
                    $sub->nama_kategori   = $kategori[$key];
                    $sub->sku             = $value;
                    $sub->save();
                }
            }

            return redirect()->route('kategori.index')->with('success', 'kategori berhasil disimpan');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $kategori = Kategori::findOrFail($id);

        if ($request->ajax()) {
            return response()->json(['data' => $kategori, 'status' => true]);
        }
        return view('backend.kategori.kategori.edit', ['kategori' => $kategori]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $status = $request->get('status');
            if ($status == 'kategori') {
                $kategori = Kategori::find($id)->delete();
                return response()->json([
                    'status' => true,
                    'data'   => $kategori
                ]);
                // $kategori = Kategori::where('id', $id)->doesntHave('sub_kategori')->first();
                // if ($kategori) {
                //     Kategori::where('id', $id)->doesntHave('sub_kategori')->delete();
                //     return response()->json([
                //         'status' => true,
                //         'data' => $kategori
                //     ]);
                // } else {
                //     return response()->json([
                //         'status' => false
                //     ]);
                // }
            } elseif ($status == 'sub kategori') {
                SubKategori::find($id)->delete();
                return response()->json([
                    'status' => true,
                ]);
                // $kategori = SubKategori::where('id', $id)->doesntHave('detail_sub')->first();
                // if ($kategori) {
                //     SubKategori::where('id', $id)->doesntHave('detail_sub')->delete();
                //     return response()->json([
                //         'status' => true
                //     ]);
                // } else {
                //     return response()->json([
                //         'status' => false
                //     ]);
                // }
            } else {
                DetailSubKategori::find($id)->delete();
                return response()->json([
                    'status' => true,
                ]);
                // $kategori = DetailSubKategori::where('id', $id)->doesntHave('bahan')->first();
                // if ($kategori) {
                //     DetailSubKategori::where('id', $id)->doesntHave('bahan')->delete();
                //     return response()->json([
                //         'status' => true
                //     ]);
                // } else {
                //     return response()->json([
                //         'status' => false
                //     ]);
                // }
            }
        }
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

    public function save_kategori(Request $request)
    {
        $status =  $request->get('status');
        if ($status == 'kategori') {
            $validator = Validator::make($request->all(), [
                'nama_kategori' => 'required',
                'sku' => 'required|unique:kategoris,sku',
                'file' => 'required',
            ]);

            if ($validator->fails()) {
                $html = '<div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';
                return response()->json([
                    'status' => false,
                    'data' => $html
                ]);
            } else {
                $file                    = $request->file('file');
                $kategori                = new Kategori();
                $kategori->nama_kategori = $request->get('nama_kategori');
                $kategori->sku           = $request->get('sku');

                if ($file) {
                    $imageName               = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/uploads/images/kategori/', $imageName);

                    $kategori->gambar = $imageName;
                } else {
                    $kategori->gambar = 'https://ui-avatars.com/api?name=' . urlencode($kategori->nama_kategori) . '&background=random';
                }

                $kategori->save();
                $request->session()->flash('success', 'Kategori berhasil disimpan!');
                return response()->json([
                    'status'  => true,
                    'message' => 'saved',

                ]);
            }
        }
    }

    public function update_kategori(Request $request)
    {
        $status =  $request->get('status');
        $id = $request->get('id');
        if ($status == 'kategori') {
            $validator = Validator::make($request->all(), [
                'file' => 'nullable|file',
                'id'   => 'required',
            ]);

            if ($validator->fails()) {
                $html = '<div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';
                return response()->json([
                    'status' => false,
                    'data'   => $html
                ]);
            } else {

                $kategori = Kategori::findOrFail($id);
                if ($request->hasFile('file')) {
                    if (!empty($kategori->gambar)) {
                        unlink(public_path('uploads/images/kategori/' . $kategori->gambar));
                    }
                    $file = $request->file('file');
                    $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path() . '/uploads/images/kategori/', $imageName);
                    $kategori->gambar = $imageName;
                }
                $kategori->save();
                $request->session()->flash('success', 'Kategori berhasil diupdate!');
                return response()->json([
                    'status'  => true,
                    'message' => 'saved',

                ]);
            }
        }
    }
}
