<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rekapitulasi;
use App\DetailRekapitulasi;
use App\Jahit;
use App\Cuci;
use PDF;
use Illuminate\Support\Facades\DB;

class RekapitulasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $rekap = Rekapitulasi::generateRekap();
        $rekap = Rekapitulasi::all();
        return view("backend.rekapitulasi.index", ['rekap' => $rekap]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuci = Cuci::where('status_cuci', 'selesai')->doesntHave('rekapitulasi')->get();
        return view("backend.rekapitulasi.create", ['cuci' => $cuci]);
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
            'kode_transaksi' => 'required',
            'tanggal_kirim' => 'required|date_format:"Y-m-d"',
            'total_barang' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $rekap = new Rekapitulasi();
                $rekap->cuci_id = $request->get('kode_transaksi');
                $rekap->tanggal_kirim = $request->get('tanggal_kirim');
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
                    $detail = new DetailRekapitulasi();
                    $detail->rekapitulasi_id = $rekap->id;
                    $detail->ukuran = $value['ukuran'];
                    $detail->jumlah = $value['jumlah'];
                    $detail->save();
                }

                DB::commit();
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
                dd($th);
            }

            return redirect()->route('rekapitulasi.index')->with('success', 'rekapitulasi berhasil disimpan');
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
        $rekap = Rekapitulasi::findOrFail($id);
        return view("backend.rekapitulasi.show", ['rekap' => $rekap]);
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

    public function getDataCuci(Request $request)
    {
        if ($request->ajax()) {

            $cuci = Cuci::with(['detail_cuci', 'jahit' => function ($q) {
                $q->with(['potong' => function ($q) {
                    $q->with(['bahan' => function ($q) {
                        $q->with('skus');
                    }]);
                }]);
            }])->where('id', $request->get('id'))->first();

            return response()->json([
                'status' => true,
                'data' => $cuci
            ]);
        }
    }

    public function cetakPdf(Request $request)
    {
        $rekap = Rekapitulasi::findOrFail($request->get('id'));

        $titlerekap = [
            'Kode SKU',
            'Tanggal Selesai Cuci',
            'Jenis Bahan',
            'Nama Produk',
            'Ukuran Baju',
            'Warna Produk',
            'Tanggal Barang Masuk',
            'Tanggal Barang Dikirim',
            'Total Barang Siap Quality Control',
        ];


        $x['title'] = $titlerekap;
        $ukuran = '';
        if (empty($rekap->cuci_id)) {
            $x['kode_bahan'] = $rekap->jahit->potong->bahan->kode_transaksi;
        } else {
            $x['kode_bahan'] = $rekap->cuci->jahit->potong->bahan->kode_transaksi;
        }

        $arr= [];
        foreach ($rekap->detail_rekap as $key => $row) {

            array_push($arr, $row->ukuran);
        }

        $arr = array_unique($arr);
        foreach ($arr as $key => $value) {
            $ukuran .= $value . ',';
        }


        if (empty($rekap->cuci_id)) {
            $x['data'] = [
                $rekap->jahit->potong->bahan->sku,
                $rekap->tanggal_selesai,
                $rekap->jahit->potong->bahan->jenis_bahan,
                $rekap->jahit->potong->bahan->nama_bahan,
                $ukuran,
                $rekap->jahit->potong->bahan->warna,
                $rekap->jahit->potong->bahan->tanggal_masuk,
                $rekap->tanggal_kirim,
                $rekap->total_barang,
            ];
        } else {
            $x['data'] = [
                $rekap->cuci->jahit->potong->bahan->sku,
                $rekap->cuci->tanggal_selesai,
                $rekap->cuci->jahit->potong->bahan->jenis_bahan,
                $rekap->cuci->jahit->potong->bahan->nama_bahan,
                $ukuran,
                $rekap->cuci->jahit->potong->bahan->warna,
                $rekap->cuci->jahit->potong->bahan->tanggal_masuk,
                $rekap->tanggal_kirim,
                $rekap->total_barang,
            ];
        }


        $pdf = PDF::loadView('backend.rekapitulasi.pdf', ['data' => $x]);
        return $pdf->stream('rekapitulasi.pdf');
    }
}
