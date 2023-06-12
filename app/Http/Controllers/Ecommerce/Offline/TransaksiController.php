<?php

namespace App\Http\Controllers\Ecommerce\Offline;

use Illuminate\Support\Facades\Validator;
use App\DetailProduk;
use App\DetailTransaksi;
use App\DetailWarehouse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Transaksi;
use App\Produk;
use App\Warehouse;
use Barryvdh\DomPDF\Facade as PDF;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $transaksi = Transaksi::where('status_transaksi', 'offline')->orderBy('created_at', 'DESC')->get();
        return view('ecommerce.offline.transaksi.index', ['transaksi' => $transaksi]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        session()->forget('detail_transaksi');
        if (session()->has('transaksi')) {
            $transaksi = session('transaksi');
        } else {
            $data = [
                'total_harga' => 0,
            ];
            $transaksi = session(['transaksi' => $data]);
            $transaksi = session('transaksi');
        }
        $produk = Produk::where('stok', '>', 0)->orderBy('created_at', 'DESC')->get();
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
        if (session()->has('detail_transaksi') && session()->has('transaksi')) {
            $total_harga = str_replace('.', '', $request->get('total_harga'));
            $bayar = str_replace('.', '', $request->get('bayar'));
            $kembalian = str_replace('.', '', $request->get('kembalian'));
            $detail = session('detail_transaksi');

            DB::beginTransaction();
            try {

                $totalproduk = 0;
                foreach ($detail as $key => $value) {
                    $produk = Produk::where('kode_produk', $value['kode'])->first();
                    $value['ukuran'] = str_replace(' ', '', $value['ukuran']);
                    // dd(DetailProduk::where('produk_id', $produk->id)->whereIn('ukuran', [$value['ukuran']])->sum('jumlah'));
                    if ($produk) {
                        $totalproduk += $value['qty'];
                        if ($value['ukuran'] == 'seri') {
                            $ukuran = ['S', 'M', 'L'];
                        } elseif (str_contains($value['ukuran'], ',')) {
                            $ukuran = explode(',', $value['ukuran']);
                        } else {
                            $ukuran = [$value['ukuran']];
                        }
                        $jumproduk = DetailProduk::where('produk_id', $produk->id)->whereIn('ukuran', $ukuran)->count();
                        $detailpro = DetailProduk::where('produk_id', $produk->id)->whereIn('ukuran', $ukuran)->get();

                        // dd($produk->warehouse->detail_warehouse);
                        $produk->stok = $produk->stok - ($jumproduk * $value['qty']);
                        foreach ($detailpro as $key => $row) {

                            $detailProduk = DetailProduk::findOrFail($row->id);
                            $detailWarehouse = DetailWarehouse::where('warehouse_id', $detailProduk->produk->warehouse->id)
                                ->where('ukuran', $detailProduk->ukuran)
                                ->first();

                            if ($detailProduk->jumlah < $value['qty'] or $detailWarehouse->jumlah < $value['qty']) {
                                DB::rollBack();
                                // $request->session()->flash('error', 'insufficient stock');
                                return response()->json([
                                    'status' => false,
                                    'message' => [
                                        'title' => 'Stok Tidak mencukupi',
                                        'body' => 'Stok tidak mencukupi, sisa stok ' . $detailProduk->jumlah
                                    ],
                                ]);
                            } else {
                                $detailProduk->jumlah = $detailProduk->jumlah - $value['qty'];
                                $detailProduk->save();

                                //didan - deduct jumlah barang from warehouse detail - old
                                // $warehouse = $detailProduk->produk->warehouse;
                                // foreach($warehouse->detail_warehouse as $d){
                                //     if($d->ukuran == $value['ukuran']){
                                //         $d->jumlah = $d->jumlah - $value['qty'];
                                //         $d->save();
                                //     }
                                // }
                                //end deduct jumlah barang from warehouse detail

                                //didan - deduct jumlah barang from warehouse detail - new
                                $detailWarehouse->jumlah = $detailWarehouse->jumlah - $value['qty'];
                                $detailWarehouse->save();
                                //end deduct jumlah barang from warehouse detail
                            }
                        }
                        $produk->save();
                        // $produk
                    }
                }
                $transaksi = new Transaksi();
                $transaksi->kode_transaksi = $this->generateKode();
                $transaksi->nama = $request->get('nama');
                $transaksi->no_hp = $request->get('no_hp');
                $transaksi->alamat = $request->get('alamat');
                $transaksi->tgl_transaksi = date('Y-m-d H:i:s');
                $transaksi->pembayaran = $request->get('pembayaran');
                $transaksi->qty = $totalproduk;
                $transaksi->total_harga = $total_harga;
                $transaksi->bayar = $bayar;
                $transaksi->kembalian = $kembalian;
                $transaksi->status_transaksi = "offline";
                $transaksi->save();


                foreach ($detail as $key => $value) {
                    // dd($value);
                    if ($value['ukuran'] == 'seri') {
                        $ukuran = "S,M,L";
                    } elseif (str_contains($value['ukuran'], ',')) {
                        $ukuran = explode(',', $value['ukuran']);
                    } else {
                        $ukuran = $value['ukuran'];
                    }

                    $produk = Produk::where('kode_produk', $value['kode'])->first();
                    foreach (is_array($ukuran) ? $ukuran : [$ukuran] as $k) {
                        $detail_trans = new DetailTransaksi;
                        $detail_trans->produk_id = $produk->id;
                        $detail_trans->transaksi_id = $transaksi->id;
                        $detail_trans->ukuran = $k;
                        $detail_trans->jumlah = $value['qty'];
                        $detail_trans->harga = $value['harga'];
                        $detail_trans->total_harga = $value['subtotal'];
                        $detail_trans->save();
                    }
                }

                session()->forget('transaksi');
                session()->forget('detail_transaksi');
                $request->session()->flash('success', 'Transaksi berhasil disimpan!');
                DB::commit();
                return response()->json([
                    'status' => true,
                    'data' => $transaksi->id,
                    'kode_transaksi' => $this->generateKode()
                ]);
            } catch (\Exception $th) {
                DB::rollBack();
                return response()->json([
                    'status' => false,
                    'msg' => $th->getMessage(),
                    'line' => $th->getLine()
                ]);
                // dd($th);
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
            $status = $request->get('status');
            $target = ["S", "L", "M"];
            if ($status == 'produk') {
                // old logic
                // $produk = Produk::with('detail_produk')->where('id', $request->get('id'))->first();

                // $detail = $produk->detail_produk->pluck('ukuran')->toArray();
                // $seri = false;
                // $harga_seri = 0;
                // $arr = [];
                // if(in_array('S',$detail) && in_array('M',$detail) && in_array('L', $detail)){
                //     $seri = true;
                //     $harga_seri = $produk->detail_produk->whereIn('ukuran', $target)->avg('harga');
                //     $detail = $produk->detail_produk->whereNotIn('ukuran', $target);
                //     if($detail->isNotEmpty()){
                //         foreach ($detail as $key => $value) {
                //            array_push($arr, $value);
                //         }
                //     }
                // }else{
                //     $detail = $produk->detail_produk;
                //     if($detail->isNotEmpty()){
                //         foreach ($detail as $key => $value) {
                //            array_push($arr, $value);
                //         }
                //     }
                // }
                // end old logic


                // new logic
                $produk = Produk::with('detail_produk')->where('id', $request->get('id'))->first();
                $detail = $produk->detail_produk->chunk(3);
                $returnData = [];
                foreach ($detail as $d) {
                    $label = '';
                    $price = 0;
                    foreach ($d as $data) {
                        $label .= $data->ukuran;
                        $price = $data->harga;
                        if ($data != $d->last()) {
                            $label .= ', ';
                        }
                    }
                    $returnData[] = [
                        'label' => $label,
                        'price' => $price,
                        'data' => $d
                    ];
                }
                // end new logic
                // dd($detail);
                return response()->json([
                    'data' => $returnData,
                    'seri' => false,
                    'harga_seri' => 0,
                    'status' => true
                ]);
            } else {
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


                $ukuran = $request->get('ukuran');
                // old logic
                // if($ukuran == 'seri'){
                //     $harga = DetailProduk::whereIn('ukuran',$target)->where('produk_id',$produk->id)->avg('harga');
                //     $resukuran = 'S,M,L';
                // }else{
                //     $harga = DetailProduk::where('ukuran',$ukuran)->where('produk_id',$produk->id)->avg('harga');
                //     $resukuran = $ukuran;
                // }
                //end old logic

                //new logic
                $detail = $produk->detail_produk->chunk(3)[$ukuran - 1];
                $produk->stok = $detail->min('jumlah');
                $harga = $detail->avg('harga');
                $label = '';
                foreach ($detail as $data) {
                    $label .= $data->ukuran;
                    $price = $data->harga;
                    if ($data != $detail->last()) {
                        $label .= ', ';
                    }
                }
                //end new logic
                $namaproduk = $produk->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan;
                $res =  $this->store_detail($produk->kode_produk, $namaproduk, $harga, $label);
                return response()->json([
                    'data' => $produk,
                    'harga' => $harga,
                    'total_harga' => $res['total_harga'],
                    'status' => true,
                    'ukuran' => $label
                ]);
            }
        }
    }

    public function store_detail($kode, $nama, $harga, $ukuran)
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
                if ($value['kode'] == $kode && $value['ukuran'] == $ukuran) {
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
                    'ukuran' => $ukuran
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
                'ukuran' => $ukuran
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

                    if ($row['ukuran'] == 'seri') {
                        $ukuran = 'S,M,L';
                    } else {
                        $ukuran = $row['ukuran'];
                    }

                    $sub["urut"] = $row['urut'];
                    $sub["kode"] = $row['kode'];
                    $sub["nama"] = $row['nama'];
                    $sub["ukuran"] = $ukuran;
                    $sub["harga"] = $row['harga'];
                    $sub["qty"] = $row['qty'];
                    $sub["subtotal"] = $row['subtotal'];
                    $sub["action"] = '<button data-ukuran="' . $row['ukuran'] . '" data-kode="' . $row['kode'] . '" class="btn btn-danger ml-2 btnDelete">Delete</button>';
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

    public function cekTransaksi(Request $request)
    {
        if ($request->ajax()) {
            if (session()->has('detail_transaksi')) {
                return response()->json([
                    'status' => true
                ]);
            } else {
                return response()->json([
                    'status' => false
                ]);
            }
        }
    }

    public function delete_data($kode, $ukuran)
    {
        if (session()->has('detail_transaksi')) {
            $datadetail = session('detail_transaksi');
            $total  = 0;
            $arr = [];
            // dd($datadetail);
            foreach ($datadetail as $key => $value) {
                if (($value['kode'] === $kode && $value['ukuran'] === $ukuran) == FALSE) {
                    $total = $total + $value["subtotal"];
                    array_push($arr, $value);
                }
            }

            if ($total == 0) {
                session()->forget('detail_transaksi');
            } else {
                session(['detail_transaksi' => $arr]);
                session()->save();
            }

            $data = [
                'total_harga' => $total,
            ];
            session(['transaksi' => $data]);
            session()->save();

            return redirect()->route('offline.transaksi.create')->with("success", "Detail transaksi berhasil dihapus");
        }
    }

    public function cetak(Request $request, $id)
    {
        $transaksi = Transaksi::findOrFail($id);
        $customPaper = array(0, 0, 269, 311);
        $cetak = $request->get('cetak');
        if ($cetak == 'Push') {
            $pdf = PDF::loadView('ecommerce.offline.transaksi.pdf', ['transaksi' => $transaksi]);
        } else {
            $pdf = PDF::loadView('ecommerce.offline.transaksi.pdf2', ['transaksi' => $transaksi]);
        }

        // $pdf->setPaper('A5','potrait');
        // $pdf->setPaper($customPaper);
        // return view('ecommerce.offline.transaksi.pdf2', compact('transaksi'));
        return $pdf->stream('transaksi-offline.pdf', array("Attachment" => 0));
    }

    public function update_detail_barang(Request $request)
    {
        if ($request->ajax()) {
            $validator = Validator::make($request->all(), [
                'id_barang' => 'required',
                'qty' => 'required',
                'ukuran' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors());
            } else {
                $kode = $request->get('id_barang');
                $ukuran = $request->get('ukuran');
                $produk = Produk::where('kode_produk', $kode)->first();
                if ($request->get('qty') <= $produk->stok) {
                    $total = 0;

                    $arr = [];

                    $totalqty = 0;

                    if (session()->has('detail_transaksi')) {
                        $datadetail = session('detail_transaksi');
                        $no = 0;
                        $cek = false;

                        foreach ($datadetail as $key => $value) {
                            if ($value['kode'] == $kode && $value['ukuran'] == $ukuran) {
                                $cek = true;
                                $value['qty'] = $request->get('qty');
                                $value['subtotal'] = $value['qty'] * $value['harga'];
                            }
                            $total = $total + $value['subtotal'];
                            $totalqty += $value['qty'];
                            $no = $value["urut"];
                            array_push($arr, $value);
                        }

                        session()->forget('detail_transaksi');
                        session(['detail_transaksi' => $arr]);
                        session()->save();
                    }

                    $data = [
                        'total_harga' => $total,
                    ];
                    session(['transaksi' => $data]);
                    session()->save();

                    return response()->json(['total_harga' => $total, 'totalqty' => $totalqty, 'status' => true]);
                } else {
                    return response()->json(['status' => false]);
                }
            }
        }
    }
}
