<?php

namespace App\Http\Controllers\Ecommerce\Offline;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaksi;
use App\Produk;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        return view('ecommerce.offline.transaksi.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (session()->has('transaksi')) {
            $transaksi = session('transaksi');
        } else {
            $data = [
                'total_harga' => 0,
            ];
            $transaksi = session(['transaksi' => $data]);
            $transaksi = session('transaksi');
        }
        $produk = Produk::orderBy('created_at', 'DESC')->get();
        $kode = $this->generateKode();
        return view('ecommerce.offline.transaksi.create', ['produk' => $produk, 'kode' => $kode, 'transaksi' => $transaksi]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function getDataProduk(Request $request)
    {
        if ($request->ajax()) {
            $produk = Produk::with(['warehouse' => function ($q) {
                $q->with(['finishing' => function ($q) {
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
                }]);
            }, 'detail_produk'])->where('id', $request->get('id'))->first();
            $namaproduk = $produk->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan;
            $res =  $this->store_detail($produk->kode_produk, $namaproduk, $produk->harga);
            return response()->json([
                'data' => $produk,
                'total_harga' => $res['total_harga'],
                'status' => true
            ]);
        }
    }

    public function store_detail($kode, $nama, $harga)
    {
        $transaksi = session('transaksi');
        $total = 0;
        $subtotal = 1 * $harga;
        $arr = [];

        $totalqty = 0;

        if (session()->has('detail_transaksi')) {
            $datadetail = session('detail_transaksi');
            $no = 0;
            $cek = false;

            foreach ($datadetail as $key => $value) {
                $total = $total + $value["subtotal"];
                if ($value['kode'] == $kode) {
                    $cek = true;
                    $value['qty'] = 1 + $value['qty'];
                    $value['subtotal'] = $value['qty'] * $value['harga'];
                }
                $totalqty += $value['qty'];
                $no = $value["urut"];
                array_push($arr, $value);
            }

            if (!$cek) {
                $data = [
                    'urut' => $no + 1,
                    'kode' => $kode,
                    'nama' => $nama,
                    'harga' => $harga,
                    'qty' => 1,
                    'subtotal' => $subtotal,
                ];
                $totalqty += 1;
                array_push($arr, $data);
            }

            $total = $total + $subtotal;

            session()->forget('detail_transaksi');
            session(['detail_transaksi' => $arr]);
            session()->save();
        } else {
            $data = [
                'urut' =>  1,
                'kode' => $kode,
                'nama' => $nama,
                'harga' => $harga,
                'qty' => 1,
                'subtotal' => $subtotal,
            ];
            $totalqty += 1;
            $total = $total + $subtotal;
            array_push($arr, $data);
            session()->forget('detail_transaksi');
            session(['detail_transaksi' => $arr]);
            session()->save();
        }

        $data = [
            'total_harga' => $total,
        ];
        session(['transaksi' => $data]);
        session()->save();

        $res = [
            'total_harga' => $total,
            'totalqty' => $totalqty
        ];

        return $res;
    }

    public function getDataDetail(Request $request)
    {
        if ($request->ajax()) {
            $datadetail = session('detail_transaksi');
            $data2 = array();
            if ($datadetail != null) {
                $count = count($datadetail);
                $no = 1;
                foreach ($datadetail as $row) {
                    $sub = array();
                    $sub["urut"] = $row['urut'];
                    $sub["kode"] = $row['kode'];
                    $sub["nama"] = $row['nama'];
                    $sub["harga"] = $row['harga'];
                    $sub["qty"] = $row['qty'];
                    $sub["subtotal"] = $row['subtotal'];
                    $sub["action"] = '<button data-kode="' . $row['kode'] . '" class="btn btn-danger ml-2 btnDelete">Delete</button>';
                    $data2[] = $sub;
                }
            } else {
                $count = 0;
            }
            $output = [
                "draw" => $request->get('draw'),
                "recordsTotal" => $count,
                "recordsFiltered" => $count,
                "data" => $data2
            ];
            return response()->json($output);
        }
    }
}
