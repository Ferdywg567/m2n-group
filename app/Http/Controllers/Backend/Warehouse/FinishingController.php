<?php

namespace App\Http\Controllers\Backend\Warehouse;

use App\DetailFinishing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Finishing;
use App\FinishingDibuang;
use App\FinishingRetur;
use App\Rekapitulasi;
use PDF;

use function GuzzleHttp\Promise\all;

class FinishingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $finish = Finishing::all()->where('status', 'finishing masuk');
        $kirim = Finishing::all()->where('status', 'kirim warehouse');

        return view("backend.warehouse.finishing.index", ['finish' => $finish, 'kirim' => $kirim]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $status = $request->get('status');
        if ($status == 'masuk') {
            $rekap = Rekapitulasi::doesntHave('finishing')->get();
            return view("backend.warehouse.finishing.masuk.create", ['rekap' => $rekap]);
        } else {
            $finish = Finishing::all()->where('status', 'finishing masuk');
            return view("backend.warehouse.finishing.keluar.create", ['finish' => $finish]);
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
        if ($request->get('status') == 'finishing masuk') {

            $validasi = [
                'kode_bahan' =>  'required',
                'no_surat' => 'required|unique:potongs,no_surat',
                'tanggal_masuk' => 'required|date_format:"Y-m-d"',
                'tanggal_qc' => 'required|date_format:"Y-m-d"|after:tanggal_jahit',
                'barang_lolos_qc' => 'required',
                'gagal_qc' => 'required',
                'barang_diretur' => 'required',
                'barang_dibuang' => 'required'
            ];
            $validator = Validator::make($request->all(), $validasi);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_bahan' =>  'required',
                'no_surat' => 'required',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {

            DB::beginTransaction();
            try {

                if ($request->get('status') == 'finishing masuk') {
                    $finish = new Finishing();
                    $finish->rekapitulasi_id = $request->get('kode_bahan');
                    $finish->tanggal_masuk = date('Y-m-d', strtotime($request->get('tanggal_masuk')));
                    $finish->tanggal_qc = date('Y-m-d', strtotime($request->get('tanggal_qc')));
                    $finish->barang_lolos_qc = $request->get('barang_lolos_qc');
                    $finish->no_surat = $request->get('no_surat');
                    $finish->status = "finishing masuk";
                    $finish->barang_gagal_qc = $request->get('gagal_qc');
                    $finish->barang_diretur = $request->get('barang_diretur');
                    $finish->barang_dibuang = $request->get('barang_dibuang');
                    $finish->keterangan_diretur = $request->get('keterangan_diretur');
                    $finish->keterangan_dibuang = $request->get('keterangan_dibuang');
                    $finish->save();

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
                        $detail = new DetailFinishing();
                        $detail->finishing_id = $finish->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }

                    //diretur
                    unset($arr);
                    $jumlah = $request->get('jumlahdiretur');
                    $dataukuran = $request->get('dataukurandiretur');
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    foreach ($arr as $key => $value) {
                        $detail = new FinishingRetur();
                        $detail->finishing_id = $finish->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }


                    //dibuang
                    unset($arr);
                    $jumlah = $request->get('jumlahdibuang');
                    $dataukuran = $request->get('dataukurandibuang');
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    foreach ($arr as $key => $value) {
                        $detail = new FinishingDibuang();
                        $detail->finishing_id = $finish->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }
                } else {
                    $finish = Finishing::findOrFail($request->get('kode_bahan'));
                    $finish->no_surat = $request->get('no_surat');
                    $finish->status = "kirim warehouse";
                    $finish->save();
                }



                DB::commit();
                return redirect()->route('warehouse.finishing.index')->with('success', $request->get('status') . ' berhasil disimpan');
            } catch (\Exception $th) {
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
        $finish = Finishing::findOrFail($id);
        if ($finish->status == 'finishing masuk') {
            return view("backend.warehouse.finishing.masuk.show", ['finish' => $finish]);
        } else {
            return view("backend.warehouse.finishing.keluar.show", ['finish' => $finish]);
        }
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
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $finish = Finishing::findOrFail($id);
            $status = false;
            if ($finish->warehouse()->exists()) {
                $status = true;
            } else {
                $diretur = FinishingRetur::where('finishing_id',$id)->delete();
                $dibuang = FinishingDibuang::where('finishing_id',$id)->delete();
                $detail = DetailFinishing::where('finishing_id',$id)->delete();
                $finish->delete();
            }
            return response()->json([
                'status' => $status
            ]);
        }
    }

    public function getDataFinish(Request $request)
    {

        if ($request->ajax()) {
            $finish = Finishing::with(['rekapitulasi' => function ($q) {
                $q->with(['cuci' => function ($q) {
                    $q->with(['jahit' => function ($q) {
                        $q->with(['potong' => function ($q) {
                            $q->with('bahan');
                        }]);
                    }]);
                }]);
            }, 'detail_finish', 'finish_dibuang', 'finish_retur'])->where('id', $request->get('id'))->first();

            return response()->json([
                'status' => true,
                'data' => $finish
            ]);
        }
    }


    public function getDataRekap(Request $request)
    {

        if ($request->ajax()) {
            $finish = Rekapitulasi::with(['cuci' => function ($q) {
                $q->with(['jahit' => function ($q) {
                    $q->with(['potong' => function ($q) {
                        $q->with('bahan');
                    }]);
                }]);
            }])->where('id', $request->get('id'))->first();

            return response()->json([
                'status' => true,
                'data' => $finish
            ]);
        }
    }

    public function getDataPrint(Request $request)
    {
        if ($request->ajax()) {
            $finish = Finishing::findOrFail($request->get('id'));
            $titlefinish = [
                'Kode SKU',
                'Jenis Kain',
                'Nama Produk',
                'Warna Kain',
                'Ukuran',
                'Tanggal QC',
                'Jumlah Barang Masuk',
                'Jumlah Barang Lolos QC',
                'Jumlah Barang Retur / Dibuang',
                'Keterangan Retur',
                'Keterangan Buang',
                'Nomor Surat Jalan'
            ];

            $x['title'] = $titlefinish;
            $x['kode_bahan']=  $finish->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan;
            $ukuran = '';

            foreach ($finish->detail_finish as $key => $row) {
                $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
            }

            $retur = $finish->barang_diretur . ' pcs';
            $retur .= '(';
            foreach ($finish->finish_retur as $key => $row) {
                $retur .= $row->ukuran . '=' . $row->jumlah . ', ';;
            }
            $retur .= ') / ';

            $retur .= $finish->barang_dibuang . ' pcs';
            $retur .= '(';
            foreach ($finish->finish_dibuang as $key => $row) {
                $retur .= $row->ukuran . '=' . $row->jumlah . ', ';;
            }
            $retur .= ')';
            $x['data'] = [
                $finish->rekapitulasi->cuci->jahit->potong->bahan->sku,
                $finish->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan,
                $finish->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan,
                $finish->rekapitulasi->cuci->jahit->potong->bahan->warna,
                $ukuran,
                $finish->tanggal_qc,
                $finish->rekapitulasi->total_barang,
                $finish->barang_lolos_qc,
                $retur,
                $finish->keterangan_diretur,
                $finish->keterangan_dibuang,
                $finish->no_surat,
            ];

            return response()->json([
                'status' => true,
                'data' => $x
            ]);
        }
    }

    public function cetakPdf(Request $request){
        $finish = Finishing::findOrFail($request->get('id'));
        $titlefinish = [
            'Kode SKU',
            'Jenis Kain',
            'Nama Produk',
            'Warna Kain',
            'Ukuran',
            'Tanggal QC',
            'Jumlah Barang Masuk',
            'Jumlah Barang Lolos QC',
            'Jumlah Barang Retur / Dibuang',
            'Keterangan Retur',
            'Keterangan Buang',
            'Nomor Surat Jalan'
        ];

        $x['title'] = $titlefinish;
        $ukuran = '';

        foreach ($finish->detail_finish as $key => $row) {
            $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
        }

        $retur = $finish->barang_diretur . ' pcs';
        $retur .= '(';
        foreach ($finish->finish_retur as $key => $row) {
            $retur .= $row->ukuran . '=' . $row->jumlah . ', ';;
        }
        $retur .= ') / ';

        $retur .= $finish->barang_dibuang . ' pcs';
        $retur .= '(';
        foreach ($finish->finish_dibuang as $key => $row) {
            $retur .= $row->ukuran . '=' . $row->jumlah . ', ';;
        }
        $retur .= ')';
        $x['data'] = [
            $finish->rekapitulasi->cuci->jahit->potong->bahan->sku,
            $finish->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan,
            $finish->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan,
            $finish->rekapitulasi->cuci->jahit->potong->bahan->warna,
            $ukuran,
            $finish->tanggal_qc,
            $finish->rekapitulasi->total_barang,
            $finish->barang_lolos_qc,
            $retur,
            $finish->keterangan_diretur,
            $finish->keterangan_dibuang,
            $finish->no_surat,
        ];

        $pdf = PDF::loadView('backend.warehouse.finishing.pdf', ['data' => $x]);
        return $pdf->stream('finishing.pdf');
    }
}
