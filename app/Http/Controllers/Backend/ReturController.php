<?php

namespace App\Http\Controllers\Backend;

use App\DetailFinishing;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Finishing;
use App\DetailRetur;
use App\Retur;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;

class ReturController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $finish = Finishing::all()->where('status','kirim warehouse');
        DB::beginTransaction();
        try {
            foreach ($finish as $key => $value) {
                $retur = Retur::where('finishing_id', $value->id)->first();
                if ($retur) {
                    $total = DetailRetur::where('retur_id', $retur->id)->sum('jumlah');
                    $retur->tanggal_masuk = $value->cuci->jahit->potong->bahan->tanggal_masuk;
                    $retur->total_barang = $total;
                    $retur->save();
                } else {
                    if($value->barang_diretur > 0){
                        $retur = new Retur();
                        $retur->finishing_id = $value->id;
                        $retur->total_barang = $value->barang_diretur;
                        $retur->keterangan_diretur = $value->keterangan_diretur;
                        $retur->tanggal_masuk = $value->cuci->jahit->potong->bahan->tanggal_masuk;
                        $retur->save();
                    }
                }

                

                if($value->barang_diretur > 0){
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
            }
            DB::commit();

            $retur = Retur::orderBy('tanggal_masuk', 'desc')->get();
            return view("backend.retur.index", ['retur' => $retur]);
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
        return view("backend.retur.show", ['retur' => $retur]);
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
            $x['kode_bahan']=  $retur->finishing->cuci->jahit->potong->bahan->kode_transaksi;
            $ukuran = '';

            foreach ($retur->detail_retur as $key => $row) {
                $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
            }
            $tanggalretur = date('Y-m-d', strtotime($retur->created_at));
            $jumlahproduk = $retur->detail_retur->sum('jumlah');
            $ukuran = rtrim($ukuran,', ');
            $x['data'] = [
                $retur->finishing->cuci->jahit->potong->bahan->sku,
                $retur->finishing->cuci->tanggal_selesai,
                $retur->finishing->cuci->jahit->potong->bahan->jenis_bahan,
                $retur->finishing->cuci->jahit->potong->bahan->nama_bahan,
                $retur->finishing->cuci->jahit->potong->bahan->warna,
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
        $x['kode_bahan']=  $retur->finishing->cuci->jahit->potong->bahan->kode_transaksi;
        $ukuran = '';

        foreach ($retur->detail_retur as $key => $row) {
            $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
        }
        $tanggalretur = date('Y-m-d', strtotime($retur->created_at));
        $jumlahproduk = $retur->detail_retur->sum('jumlah');
        $ukuran = rtrim($ukuran,', ');
        $x['data'] = [
            $retur->finishing->cuci->jahit->potong->bahan->sku,
            $retur->finishing->cuci->tanggal_selesai,
            $retur->finishing->cuci->jahit->potong->bahan->jenis_bahan,
            $retur->finishing->cuci->jahit->potong->bahan->nama_bahan,
            $retur->finishing->cuci->jahit->potong->bahan->warna,
            $tanggalretur,
            $jumlahproduk,
            $ukuran,
            $retur->finishing->keterangan_diretur
        ];

        $pdf = PDF::loadView('backend.retur.pdf', ['data' => $x]);
        return $pdf->stream('retur.pdf');
    }

    public function rupiah($expression)
    {
        return "Rp " . number_format($expression, 2, ',', '.');
    }

    public function moveToSortir($id){
        DB::beginTransaction();
        try{
            $retur = Retur::find($id);
            $retur->status = 'dikirim ke gudang';
            $retur->save();
            
            $oldFinish = Finishing::find($retur->finishing_id);
            $finish = new Finishing;
            $finish->cuci_id = $oldFinish->cuci_id;
            $finish->barang_lolos_qc = 0;
            $finish->no_surat = $oldFinish->no_surat;
            $finish->status = "finishing masuk";
            $finish->tanggal_masuk = date('Y-m-d');
            $finish->save();

            foreach ($retur->detail_retur as $key => $value) {
                $detail = new DetailFinishing();
                $detail->finishing_id = $finish->id;
                $detail->ukuran = $value->ukuran;
                $detail->jumlah = $value->jumlah;
                $detail->save();
            }
            $finish->barang_siap_qc = $finish->detail_finish->sum('jumlah');
            $finish->save();

            DB::commit();
            return redirect()->back()->with('success', 'Barang berhasil dikeluarkan ke gudang');
        }catch(Exception $e){
            DB::rollBack();
            dd($e->getMessage());
        }

        
    }
}
