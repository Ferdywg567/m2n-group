<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DetailSampah;
use App\Cuci;
use App\Sampah;

class SampahController extends Controller
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
                foreach ($value->cuci_dibuang as $key => $row) {
                    $sampah = Sampah::where('bahan_id', $idbahan)->where('ukuran', $row->ukuran)->first();
                    if ($sampah) {
                        $total = DetailSampah::where('sampah_id', $sampah->id)->sum('jumlah');

                        $sampah->total = $total;
                    } else {
                        $sampah = new Sampah();
                        $sampah->bahan_id = $idbahan;
                        $sampah->ukuran = $row->ukuran;
                        $sampah->total = $row->jumlah;
                    }
                    $sampah->save();

                    $detail = DetailSampah::where('sampah_id', $sampah->id)->where('cuci_dibuang_id', $row->id)->first();
                    if ($detail) {
                        $detail->jumlah = $row->jumlah;
                    } else {
                        $detail = new DetailSampah();
                        $detail->sampah_id = $sampah->id;
                        $detail->cuci_dibuang_id = $row->id;
                        $detail->jumlah = $row->jumlah;
                    }

                    $detail->save();
                }

                foreach ($value->jahit->jahit_dibuang as $key => $row) {
                    $sampah = Sampah::where('bahan_id', $idbahan)->where('ukuran', $row->ukuran)->first();
                    if ($sampah) {
                        $total = DetailSampah::where('sampah_id', $sampah->id)->sum('jumlah');

                        $sampah->total = $total;
                    } else {
                        $sampah = new Sampah();
                        $sampah->bahan_id = $idbahan;
                        $sampah->ukuran = $row->ukuran;
                        $sampah->total = $row->jumlah;
                    }
                    $sampah->save();

                    $detail = DetailSampah::where('sampah_id', $sampah->id)->where('jahit_dibuang_id', $row->id)->first();
                    if ($detail) {
                        $detail->jumlah = $row->jumlah;
                    } else {
                        $detail = new DetailSampah();
                        $detail->sampah_id = $sampah->id;
                        $detail->jahit_dibuang_id = $row->id;
                        $detail->jumlah = $row->jumlah;
                    }

                    $detail->save();
                }
            }
            DB::commit();

            $sampah = Sampah::all();
            return view("backend.sampah.index", ['sampah' => $sampah]);
        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();
            dd($th);
        }
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
        $sampah = Sampah::findOrFail($id);

        $jahit = [
            'jahit_dibuang_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        $cuci = [
            'cuci_dibuang_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        foreach ($sampah->detail_sampah as $key => $value) {
            if (!empty($value->jahit_dibuang_id)) {
                $jahit = [
                    'jahit_dibuang_id' => $value->id,
                    'jumlah' => $value->jumlah

                ];
            }
            if (!empty($value->cuci_dibuang_id)) {
                $cuci = [
                    'cuci_dibuang_id' => $value->id,
                    'jumlah' => $value->jumlah,

                ];
            }
        }

        return view("backend.sampah.show", ['sampah' => $sampah, 'cuci' => $cuci, 'jahit' => $jahit]);
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
}
