<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Rekapitulasi;
use App\Cuci;
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
        $cuci = Cuci::where('status', 'cucian keluar')->where('status_cuci', 'selesai')->get();
        $rekap = Rekapitulasi::all();
        return view("backend.rekapitulasi.index", ['cuci' => $cuci, 'rekap' => $rekap]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuci = Cuci::where('status', 'cucian keluar')->where('status_cuci', 'selesai')->with(['detail_cuci' => function ($q) {
            $q->doesntHave('rekapitulasi');
        }])->get();
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
            'kode_bahan' => 'required',
            'tanggal_kirim' => 'required|date_format:"Y-m-d"',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $rekap = new Rekapitulasi();
                $rekap->cuci_id = $request->get('kode_bahan');
                $rekap->detail_cuci_id = $request->get('detail_id');
                $rekap->tanggal_kirim = $request->get('tanggal_kirim');
                $rekap->ukuran = $request->get('ukuran_baju');
                $rekap->total_barang = $request->get('total_barang');
                $rekap->save();

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
            $size = $request->get('size');
            $cuci = Cuci::with(['detail_cuci' => function ($q) use ($size) {
                $q->where('size', $size);
            }, 'jahit' => function ($q) {
                $q->with(['potong' => function ($q) {
                    $q->with('bahan');
                }]);
            }])->where('id', $request->get('id'))->first();

            return response()->json([
                'status' => true,
                'data' => $cuci
            ]);
        }
    }
}
