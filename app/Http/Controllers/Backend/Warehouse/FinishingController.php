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

        $finish = Finishing::all()->where('status','finishing masuk');
        
        return view("backend.warehouse.finishing.index", ['finish' => $finish]);
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
            $rekap = Rekapitulasi::all();
            return view("backend.warehouse.finishing.masuk.create", ['rekap' => $rekap]);
        } else {
            return view("backend.warehouse.finishing.keluar.create");
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
                'vendor_jahit' => 'required',
                'berhasil_jahit' => 'required|integer',
                'konversi' => 'required'
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
                } else {
                    $finish = Finishing::findOrFail($request->get('kode_bahan'));
                }
                $finish->no_surat = $request->get('no_surat');

                if ($request->get('status') == 'finishing masuk') {
                    $finish->tanggal_masuk = date('Y-m-d', strtotime($request->get('tanggal_masuk')));
                    $finish->tanggal_qc = date('Y-m-d', strtotime($request->get('tanggal_qc')));
                    $finish->status = "finishing masuk";

                    $finish->barang_lolos_qc = $request->get('barang_lolos_qc');

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
            }])->where('id', $request->get('id'))->first();

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
}
