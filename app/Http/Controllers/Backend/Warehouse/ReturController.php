<?php

namespace App\Http\Controllers\Backend\Warehouse;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\DetailRetur;
use App\Finishing;
use App\Retur;
use PDF;

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
                    $retur->tanggal_masuk = $value->rekapitulasi->cuci->jahit->potong->bahan->tanggal_masuk;
                    $retur->total_barang = $total;
                } else {
                    $retur = new Retur();
                    $retur->finishing_id = $value->id;
                    $retur->total_barang = $value->barang_diretur;
                    $retur->keterangan_diretur = $value->keterangan_diretur;
                    $retur->tanggal_masuk = $value->rekapitulasi->cuci->jahit->potong->bahan->tanggal_masuk;
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

    public function getDataPrint(Request $request)
    {
        if ($request->ajax()) {
            $retur = Retur::findOrFail($request->get('id'));
            $titleretur = [
                'Kode SKU',
                'Tanggal Selesai Cuci',
                'Jenis Kain',
                'Nama Produk',
                'Warna',
                'Tanggal Barang Diretur',
                'Total Barang Diretur',
                'Ukuran Baju Yang Diretur',
                'Keterangan Diretur'
            ];


            $x['title'] = $titleretur;
            $x['kode_bahan']=  $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan;
            $ukuran = '';

            foreach ($retur->detail_retur as $key => $row) {
                $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
            }
            $tanggalretur = date('Y-m-d', strtotime($retur->created_at));
            $jumlahproduk = $retur->detail_retur->sum('jumlah');

            $x['data'] = [
                $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->sku,
                $retur->finishing->rekapitulasi->cuci->tanggal_selesai,
                $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan,
                $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan,
                $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->warna,
                $tanggalretur,
                $jumlahproduk,
                $ukuran,
                $retur->finishing->keterangan_diretur
            ];

            return response()->json([
                'status' => true,
                'data' => $x
            ]);
        }
    }

    public function cetakPdf(Request $request){
        $retur = Retur::findOrFail($request->get('id'));
        $titleretur = [
            'Kode SKU',
            'Tanggal Selesai Cuci',
            'Jenis Kain',
            'Nama Produk',
            'Warna',
            'Tanggal Barang Diretur',
            'Total Barang Diretur',
            'Ukuran Baju Yang Diretur',
            'Keterangan Diretur'
        ];


        $x['title'] = $titleretur;
        $x['kode_bahan']=  $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->kode_bahan;
        $ukuran = '';

        foreach ($retur->detail_retur as $key => $row) {
            $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
        }
        $tanggalretur = date('Y-m-d', strtotime($retur->created_at));
        $jumlahproduk = $retur->detail_retur->sum('jumlah');

        $x['data'] = [
            $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->sku,
            $retur->finishing->rekapitulasi->cuci->tanggal_selesai,
            $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->jenis_bahan,
            $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->nama_bahan,
            $retur->finishing->rekapitulasi->cuci->jahit->potong->bahan->warna,
            $tanggalretur,
            $jumlahproduk,
            $ukuran,
            $retur->finishing->keterangan_diretur
        ];

        $pdf = PDF::loadView('backend.warehouse.retur.pdf', ['data' => $x]);
        return $pdf->stream('retur.pdf');
    }

    public function rupiah($expression)
    {
        return "Rp " . number_format($expression, 2, ',', '.');
    }
}
