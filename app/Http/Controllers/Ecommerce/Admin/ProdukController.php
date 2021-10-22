<?php

namespace App\Http\Controllers\Ecommerce\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\DetailWarehouse;
use App\Warehouse;
use App\Produk;
use App\DetailProduk;
use App\DetailProdukImage;
use App\Promo;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::orderBy('created_at', 'DESC')->get();
        return view('ecommerce.admin.produk.index', ['produk' => $produk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Warehouse::where('harga_produk', '>', 0)->doesntHave('produk')->get();
        $today = date('Y-m-d');
        $promo = Promo::whereDate('promo_mulai', '<=', $today)->whereDate('promo_berakhir', '>=', $today)->get();
        $cekmax = Produk::max('id');
        if ($cekmax) {
            $jumlah = $cekmax + 1;
            $kode = "PRD-" . $jumlah;
        } else {
            $kode = "PRD-1";
        }
        return view("ecommerce.admin.produk.create", ['produk' => $produk, 'promo' => $promo, 'kode' => $kode]);
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
            'barang' => 'required',
            'file' => 'required',
            'file.*' => 'image|mimes:jpg,jpeg,png',
            'deskripsi_produk' => 'required',
            'stok' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            $html = '<div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';
            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $file = $request->file('file');
            $produk = new Produk();
            $produk->kode_produk = $this->generateKode();
            $produk->warehouse_id = $request->get('barang');
            $produk->harga = $request->get('harga');
            $produk->stok = $request->get('stok');
            $produk->deskripsi_produk = $request->get('deskripsi_produk');
            $hargapromo = 0;
            if ($request->get('promo') != 0) {
                $promo = Promo::findOrFail($request->get('promo'));
                $produk->promo_id = $request->get('promo');
                $hargapromo = $request->get('harga') - ($request->get('harga') * ($promo->potongan / 100));
            } else {
                $hargapromo = $request->get('harga');
            }
            $produk->harga_promo = $hargapromo;
            $produk->save();

            $detailwarehouse = DetailWarehouse::where('warehouse_id', $produk->warehouse_id)->get();

            foreach ($detailwarehouse as $key => $value) {
                $detailproduk = new DetailProduk();
                $detailproduk->produk_id = $produk->id;
                $detailproduk->ukuran = $value->ukuran;
                $detailproduk->jumlah = $value->jumlah;
                $detailproduk->save();
            }

            foreach ($file as $key => $value) {
                $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $value->getClientOriginalExtension();
                $value->move(public_path() . '/uploads/images/produk/', $imageName);
                $detailimage = new DetailProdukImage();
                $detailimage->produk_id = $produk->id;
                $detailimage->filename = $imageName;
                $detailimage->save();
            }
            $request->session()->flash('success', 'Produk berhasil disimpan!');
            return response()->json([
                'status' => true,
                'message' => 'saved'
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
        $produk = Produk::findOrFail($id);
        $today = date('Y-m-d');
        $promo = Promo::whereDate('promo_mulai', '<=', $today)->whereDate('promo_berakhir', '>=', $today)->get();
        $detail = DetailProduk::where('produk_id', $id)->get();
        $ukuran = '';
        foreach ($detail as $key => $value) {
            $ukuran .= $value->ukuran . ', ';
        }

        $ukuran = rtrim($ukuran, ', ');
        return view("ecommerce.admin.produk.show", ['produk' => $produk, 'promo' => $promo, 'ukuran' => $ukuran]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $produk = Produk::findOrFail($id);
        $today = date('Y-m-d');
        $promo = Promo::whereDate('promo_mulai', '<=', $today)->whereDate('promo_berakhir', '>=', $today)->get();
        $detail = DetailProduk::where('produk_id', $id)->get();
        $ukuran = '';
        foreach ($detail as $key => $value) {
            $ukuran .= $value->ukuran . ', ';
        }

        $ukuran = rtrim($ukuran, ', ');
        return view("ecommerce.admin.produk.edit", ['produk' => $produk, 'promo' => $promo, 'ukuran' => $ukuran]);
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
        return response()->json($request->get('oldimage'));
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

    public function getDetailProduk(Request $request)
    {
        if ($request->ajax()) {
            $produk = Warehouse::with(['finishing' => function ($q) {
                $q->with(['cuci' => function ($q) {
                    $q->with(['jahit' => function ($q) {
                        $q->with(['potong' => function ($q) {
                            $q->with(['bahan'  => function ($q) {
                                $q->with(['detail_sub' => function ($q) {
                                    $q->with(['sub_kategori' => function ($q) {
                                        $q->with('kategori');
                                    }]);
                                }]);
                            }]);
                        }]);
                    }]);
                }]);
            }, 'detail_warehouse'])->where('id', $request->get('id'))->first();

            return response()->json([
                'data' => $produk,
                'status' => true
            ]);
        }
    }

    public function generateKode()
    {
        $cekmax = Produk::max('id');
        if ($cekmax) {
            $jumlah = $cekmax + 1;
            $kode = "PRD-" . $jumlah;
        } else {
            $kode = "PRD-1";
        }
        return $kode;
    }

    public function getDetailImage(Request $request)
    {
        if ($request->ajax()) {
            $detail = DetailProdukImage::where('produk_id', $request->get('id'))->get();
            return response()->json([
                'status' => true,
                'data' => $detail
            ]);
        }
    }

    public function update_data(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deskripsi_produk' => 'required',
            'stok' => 'required|min:1',
        ]);

        if ($validator->fails()) {
            $html = '<div class="alert alert-danger" role="alert">' . $validator->errors()->first() . '</div>';
            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $oldimage = explode(',', $request->get('oldimage'));
            $id = $request->get('id');
            $produk = Produk::findOrFail($id);
            $produk->deskripsi_produk = $request->get('deskripsi_produk');
            $hargapromo = 0;
            if ($request->get('promo') != 0) {
                $promo = Promo::findOrFail($request->get('promo'));
                $produk->promo_id = $request->get('promo');
                $hargapromo = $request->get('harga') - ($request->get('harga') * ($promo->potongan / 100));
            } else {
                $hargapromo = $request->get('harga');
            }
            $produk->harga_promo = $hargapromo;
            $produk->save();
            if (!empty($oldimage)) {
                foreach ($oldimage as $key => $value) {
                    $detail = DetailProdukImage::where('filename', $value)->where('produk_id', $id)->first();
                    if ($detail) {
                        unlink(public_path('uploads/images/produk/' . $value));
                        DetailProdukImage::where('filename', $value)->where('produk_id', $id)->delete();
                    }
                }
            }
            if ($request->has('file')) {
                $file = $request->file('file');
                foreach ($file as $key => $value) {
                    $imageName = strtotime(now()) . rand(11111, 99999) . '.' . $value->getClientOriginalExtension();
                    $value->move(public_path() . '/uploads/images/produk/', $imageName);
                    $detailimage = new DetailProdukImage();
                    $detailimage->produk_id = $produk->id;
                    $detailimage->filename = $imageName;
                    $detailimage->save();
                }
            }
            $request->session()->flash('success', 'Produk berhasil diupdate!');
            return response()->json([
                'status' => true,
                'message' => 'saved'
            ]);
        }
    }
}
