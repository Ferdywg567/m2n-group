<?php

namespace App\Http\Controllers\Backend\Warehouse;

use App\DetailWarehouse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Finishing;
use App\Warehouse;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouse = Warehouse::all();
        return view("backend.warehouse.warehouse.index", ['warehouse' => $warehouse]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kirim = Finishing::where('status', 'kirim warehouse')->doesntHave('warehouse')->get();
        return view("backend.warehouse.warehouse.create", ['kirim' => $kirim]);
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
            'harga_produk' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $finish = Finishing::findOrfail($request->get('kode_bahan'));
                $warehouse = new Warehouse();
                $warehouse->finishing_id = $finish->id;
                $warehouse->harga_produk = $request->get('harga_produk');
                $warehouse->save();
                $detailfinish = $finish->detail_finish;
                foreach ($detailfinish as $key => $value) {
                    $detail = new DetailWarehouse();
                    $detail->warehouse_id = $warehouse->id;
                    $detail->ukuran = $value->ukuran;
                    $detail->jumlah = $value->jumlah;
                    $detail->save();
                }


                DB::commit();
                return redirect()->route('warehouse.warehouse.index')->with('success', 'Data warehouse berhasil disimpan');
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
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
}
