<?php

namespace App\Http\Controllers\Backend\Warehouse;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\DetailRekapitulasiWarehouse;
use App\RekapitulasiWarehouse;
use Illuminate\Http\Request;
use App\Warehouse;
use Illuminate\Support\Facades\DB;
use PDF;
class RekapitulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekap = RekapitulasiWarehouse::all();
        return view('backend.warehouse.rekapitulasi.index', ['rekap' => $rekap]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouse = Warehouse::doesntHave('rekapitulasi_warehouse')->get();
        return view("backend.warehouse.rekapitulasi.create", ['warehouse' => $warehouse]);
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
            'kode_bahan' => 'required',
            'tanggal_kirim' => 'required|date_format:"Y-m-d"'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();

            try {
                $rekap = new RekapitulasiWarehouse();
                $rekap->warehouse_id = $request->get('kode_bahan');
                $rekap->tanggal_kirim = date('Y-m-d', strtotime($request->get('tanggal_kirim')));
                $rekap->tanggal_masuk = date('Y-m-d', strtotime($request->get('tanggal_masuk')));
                $rekap->total_barang = $request->get('total_barang');
                $rekap->save();


                $jumlah = $request->get('jumlah');
                $dataukuran = $request->get('dataukuran');
                $arr = [];
                foreach ($dataukuran as $key => $value) {
                    if (!empty($jumlah[$key])) {
                        $x['ukuran'] = $value;
                        $x['jumlah'] = $jumlah[$key];
                        array_push($arr, $x);
                    }
                }

                foreach ($arr as $key => $value) {
                    $detail = new DetailRekapitulasiWarehouse();
                    $detail->rekapitulasi_warehouse_id = $rekap->id;
                    $detail->ukuran = $value['ukuran'];
                    $detail->jumlah = $value['jumlah'];
                    $detail->save();
                }

                DB::commit();
                return redirect()->route('warehouse.rekapitulasi.index')->with('success', 'Rekapitulasi berhasil disimpan');
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
                dd($th);
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
        $rekap = RekapitulasiWarehouse::findOrFail($id);
        return view("backend.warehouse.rekapitulasi.show", ['rekap' => $rekap]);
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

    public function getDataRekapitulasi(Request $request)
    {
        if ($request->ajax()) {
            $warehouse = Warehouse::with(['finishing' => function ($q) {
                $q->with(['rekapitulasi' => function ($q) {
                    $q->with(['cuci' => function ($q) {
                        $q->with(['jahit' => function ($q) {
                            $q->with(['potong' => function ($q) {
                                $q->with('bahan');
                            }]);
                        }]);
                    }]);
                }]);
            }, 'detail_warehouse'])->where('id', $request->get('id'))->first();

            return response()->json([
                'status' => true,
                'data' => $warehouse
            ]);
        }
    }

    public function getDataPrint(Request $request)
    {
        if ($request->ajax()) {
            $rekap = RekapitulasiWarehouse::findOrFail($request->get('id'));
            $titlerekap = [
                'Kode SKU',
                'Tanggal Barang Masuk',
                'Tanggal Barang Dikirim',
                'Nama Produk',
                'Warna Produk',
                'Jenis Bahan',
                'Total Barang Siap Quality Control',
                'Ukuran Baju',
                'Harga Produk'
            ];


            $x['title'] = $titlerekap;
            $x['kode_bahan']=  $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan;
            $ukuran = '';

            foreach ($rekap->detail_rekap_warehouse as $key => $row) {
                $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
            }

            $jumlahproduk = $rekap->total_barang;
            $harga = $this->rupiah($rekap->warehouse->harga_produk);

            $x['data'] = [
                $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->sku,
                $rekap->tanggal_masuk,
                $rekap->tanggal_kirim,
                $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan,
                $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->warna,
                $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan,
                $jumlahproduk,
                $ukuran,
                $harga
            ];

            return response()->json([
                'status' => true,
                'data' => $x
            ]);
        }
    }

    public function cetakPdf(Request $request){
        $rekap = RekapitulasiWarehouse::findOrFail($request->get('id'));
        $titlerekap = [
            'Kode SKU',
            'Tanggal Barang Masuk',
            'Tanggal Barang Dikirim',
            'Nama Produk',
            'Warna Produk',
            'Jenis Bahan',
            'Total Barang Siap Quality Control',
            'Ukuran Baju',
            'Harga Produk'
        ];


        $x['title'] = $titlerekap;
        $x['kode_bahan']=  $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan;
        $ukuran = '';

        foreach ($rekap->detail_rekap_warehouse as $key => $row) {
            $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
        }

        $jumlahproduk = $rekap->total_barang;
        $harga = $this->rupiah($rekap->warehouse->harga_produk);

        $x['data'] = [
            $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->sku,
            $rekap->tanggal_masuk,
            $rekap->tanggal_kirim,
            $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan,
            $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->warna,
            $rekap->warehouse->finishing->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan,
            $jumlahproduk,
            $ukuran,
            $harga
        ];

        $pdf = PDF::loadView('backend.warehouse.rekapitulasi.pdf', ['data' => $x]);
        return $pdf->stream('rekapitulasi.pdf');
    }

    public function rupiah($expression)
    {
        return "Rp " . number_format($expression, 2, ',', '.');
    }
}
