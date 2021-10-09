<?php

namespace App\Http\Controllers\Backend\Warehouse;

use App\DetailWarehouse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Notification;
use App\Finishing;
use App\Warehouse;
use PDF;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouse = Warehouse::orderBy('created_at','DESC')->get();;
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
            'kode_transaksi' => 'required',
            'harga_produk' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $finish = Finishing::findOrfail($request->get('kode_transaksi'));
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

                $notif = new Notification();
                $notif->description = "gudang telah dikirim ke ecommerce, silahkan di cek";
                $notif->url = route('warehouse.warehouse.index');
                $notif->role = 'warehouse';
                $notif->aktif = 0;
                $notif->save();

                session(['notification' => 1]);
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
        $warehouse = Warehouse::findOrFail($id);
        return view("backend.warehouse.warehouse.show", ['warehouse' => $warehouse]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = Warehouse::findOrFail($id);
        return view("backend.warehouse.warehouse.edit", ['warehouse' => $warehouse]);
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
            'harga_produk' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $warehouse =  Warehouse::findOrFail($id);
                $warehouse->harga_produk = $request->get('harga_produk');
                $warehouse->save();
                DB::commit();
                return redirect()->route('warehouse.warehouse.index')->with('success', 'Data gudang berhasil diupdate');
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
            }
        }
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
            $warehouse = Warehouse::findOrFail($id);
            $status = false;
            if ($warehouse->rekapitulasi_warehouse()->exists()) {
                $status = true;
            } else {
                $detail = DetailWarehouse::where('warehouse_id',$id)->delete();
                $warehouse->delete();
            }
            return response()->json([
                'status' => $status
            ]);
        }
    }


    public function getDataPrint(Request $request)
    {
        if ($request->ajax()) {
            $warehouse = Warehouse::findOrFail($request->get('id'));
            $titlewarehouse = [
                'Kode SKU',
                'Jenis Kain',
                'Nama Produk',
                'Warna',
                'Produk Siap Jual',
                'Ukuran',
                'Harga Produk'
            ];

            $x['title'] = $titlewarehouse;
            $x['kode_bahan']=  $warehouse->finishing->cuci->jahit->potong->bahan->kode_transaksi;
            $ukuran = '';

            foreach ($warehouse->detail_warehouse as $key => $row) {
                $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
            }

            $jumlahproduk = $warehouse->detail_warehouse->sum('jumlah');
                            $harga = $this->rupiah($warehouse->harga_produk);
            $x['data'] = [
                $warehouse->finishing->cuci->jahit->potong->bahan->sku,
                $warehouse->finishing->cuci->jahit->potong->bahan->jenis_bahan,
                $warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan,
                $warehouse->finishing->cuci->jahit->potong->bahan->warna,
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
        $warehouse = Warehouse::findOrFail($request->get('id'));
        $titlewarehouse = [
            'Kode SKU',
            'Jenis Kain',
            'Nama Produk',
            'Warna',
            'Produk Siap Jual',
            'Ukuran',
            'Harga Produk'
        ];

        $x['title'] = $titlewarehouse;
        $x['kode_bahan']=  $warehouse->finishing->cuci->jahit->potong->bahan->kode_transaksi;
        $ukuran = '';

        foreach ($warehouse->detail_warehouse as $key => $row) {
            $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
        }

        $jumlahproduk = $warehouse->detail_warehouse->sum('jumlah');
                        $harga = $this->rupiah($warehouse->harga_produk);
        $x['data'] = [
            $warehouse->finishing->cuci->jahit->potong->bahan->sku,
            $warehouse->finishing->cuci->jahit->potong->bahan->jenis_bahan,
            $warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan,
            $warehouse->finishing->cuci->jahit->potong->bahan->warna,
            $jumlahproduk,
            $ukuran,
            $harga
        ];

        $pdf = PDF::loadView('backend.warehouse.warehouse.pdf', ['data' => $x]);
        return $pdf->stream('warehouse.pdf');
    }

    public function rupiah($expression)
    {
        return "Rp " . number_format($expression, 2, ',', '.');
    }
}
