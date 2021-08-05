<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Cuci;
use App\Bahan;
use App\Perbaikan;
use App\DetailPerbaikan;
use Illuminate\Support\Facades\DB;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cuci = Cuci::all();

        DB::beginTransaction();

        try {
            foreach ($cuci as $key => $value) {
                $idbahan = $value->jahit->potong->bahan->id;
                foreach ($value->cuci_direpair as $key => $row) {
                    $repair = Perbaikan::where('bahan_id', $idbahan)->where('ukuran', $row->ukuran)->first();
                    if ($repair) {
                        $total = DetailPerbaikan::where('perbaikan_id', $repair->id)->sum('jumlah');
                        $repair->tanggal_masuk = $repair->tanggal_masuk;
                        $repair->total = $total;
                    } else {
                        $repair = new Perbaikan();
                        $repair->bahan_id = $idbahan;
                        $repair->tanggal_masuk = date('Y-m-d');
                        $repair->ukuran = $row->ukuran;
                        $repair->total = $row->jumlah;
                        $repair->status = "butuh konfirmasi";
                    }
                    $repair->save();

                    $detail = DetailPerbaikan::where('perbaikan_id', $repair->id)->where('cuci_direpair_id', $row->id)->first();
                    if ($detail) {
                        $detail->jumlah = $row->jumlah;
                    } else {
                        $detail->perbaikan_id = $repair->id;
                        $detail->cuci_direpair_id = $row->id;
                    }

                    $detail->save();
                }

                foreach ($value->jahit->jahit_direpair as $key => $row) {
                    $repair = Perbaikan::where('bahan_id', $idbahan)->where('ukuran', $row->ukuran)->first();
                    if ($repair) {
                        $total = DetailPerbaikan::where('perbaikan_id', $repair->id)->sum('jumlah');
                        $repair->tanggal_masuk = $repair->tanggal_masuk;
                        $repair->total = $total;
                    } else {
                        $repair = new Perbaikan();
                        $repair->bahan_id = $idbahan;
                        $repair->tanggal_masuk = date('Y-m-d');
                        $repair->ukuran = $row->ukuran;
                        $repair->total = $row->jumlah;
                        $repair->status = "butuh konfirmasi";
                    }
                    $repair->save();

                    $detail = DetailPerbaikan::where('perbaikan_id', $repair->id)->where('jahit_direpair_id', $row->id)->first();
                    if ($detail) {
                        $detail->jumlah = $row->jumlah;
                    } else {
                        $detail->perbaikan_id = $repair->id;
                        $detail->jahit_direpair_id = $row->id;
                    }

                    $detail->save();
                }
            }
            DB::commit();

            $repair = Perbaikan::all();
            return view("backend.perbaikan.index", ['repair' => $repair]);
        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();
            dd($th);
        }


        return view("backend.perbaikan.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $repair = Perbaikan::findOrFail($id);

        $jahit = [
            'jahit_direpair_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        $cuci = [
            'cuci_direpair_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        foreach ($repair->detail_perbaikan as $key => $value) {
            if (!empty($value->jahit_direpair_id)) {
                $jahit = [
                    'jahit_direpair_id' => $value->id,
                    'jumlah' => $value->jumlah,
                    'keterangan' => $value->keterangan
                ];
            }
            if (!empty($value->cuci_direpair_id)) {
                $cuci = [
                    'cuci_direpair_id' => $value->id,
                    'jumlah' => $value->jumlah,
                    'keterangan' => $value->keterangan
                ];
            }
        }
        
        return view("backend.perbaikan.show", ['repair' => $repair, 'cuci' => $cuci, 'jahit' => $jahit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repair = Perbaikan::findOrFail($id);

        $jahit = [
            'jahit_direpair_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        $cuci = [
            'cuci_direpair_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        foreach ($repair->detail_perbaikan as $key => $value) {
            if (!empty($value->jahit_direpair_id)) {
                $jahit = [
                    'jahit_direpair_id' => $value->id,
                    'jumlah' => $value->jumlah,
                    'keterangan' => $value->keterangan
                ];
            }
            if (!empty($value->cuci_direpair_id)) {
                $cuci = [
                    'cuci_direpair_id' => $value->id,
                    'jumlah' => $value->jumlah,
                    'keterangan' => $value->keterangan
                ];
            }
        }



        return view("backend.perbaikan.edit", ['repair' => $repair, 'cuci' => $cuci, 'jahit' => $jahit]);
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
        $validator = Validator::make($request->all(), [
            'tailoring' => 'required|integer',
            'washing' => 'required|integer',
            'keterangan_tailoring' => 'required',
            'keterangan_washing' => 'required',
            'tanggal_selesai' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
            'tanggal_kirim' => 'required|date_format:"Y-m-d"|after:tanggal_selesai',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            // dd($request->all());
            try {
                $repair = Perbaikan::findOrFail($id);
                $repair->status = "proses repair";
                $repair->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));
                $repair->tanggal_kirim = date('Y-m-d', strtotime($request->get('tanggal_kirim')));
                $repair->save();

                $jahit = DetailPerbaikan::find($request->get('jahit_direpair_id'));
                if ($jahit) {
                    $jahit->jumlah = $request->get('tailoring');
                    $jahit->keterangan = $request->get('keterangan_tailoring');
                    $jahit->save();
                }

                $cuci = DetailPerbaikan::find($request->get('cuci_direpair_id'));
                if ($cuci) {
                    $cuci->jumlah = $request->get('washing');
                    $cuci->keterangan = $request->get('keterangan_washing');
                    $cuci->save();
                }


                DB::commit();

                return redirect()->route('perbaikan.index')->with('success', 'Perbaikan Berhasil di Konfirmasi');
            } catch (\Exception $th) {
                DB::rollBack();
                dd($th);
            }
        }
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
}
