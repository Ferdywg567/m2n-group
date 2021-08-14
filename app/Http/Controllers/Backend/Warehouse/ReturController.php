<?php

namespace App\Http\Controllers\Backend\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DetailRetur;
use App\Finishing;
use App\Retur;


class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $finish = Finishing::all();
        DB::beginTransaction();
        try {
            foreach ($finish as $key => $value) {
                $retur = Retur::where('finishing_id', $value->id)->first();
                if ($retur) {
                    $total = DetailRetur::where('retur_id', $retur->id)->sum('jumlah');

                    $retur->total_barang = $total;
                } else {
                    $retur = new Retur();
                    $retur->finishing_id = $value->id;
                    $retur->total_barang = $value->barang_diretur;
                    $retur->keterangan_diretur = $value->keterangan_diretur;
                }

                $retur->save();

                foreach ($value->finish_retur as $key => $row) {
                    $detailretur = DetailRetur::where('retur_id', $retur->id)->where('ukuran', $row->ukuran)->first();
                    if ($detailretur) {
                        $detailretur->jumlah = $row->jumlah;
                    } else {
                        $detailretur = new DetailRetur();
                        $detailretur->retur_id = $retur->id;
                        $detailretur->jumlah = $row->jumlah;
                        $detailretur->ukuran = $row->ukuran;
                    }

                    $detailretur->save();
                }
            }
            DB::commit();

            $retur = Retur::all();
            return view("backend.warehouse.retur.index", ['retur' => $retur]);
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
        $retur = Retur::findOrFail($id);
        return view("backend.warehouse.retur.show", ['retur' => $retur]);
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
