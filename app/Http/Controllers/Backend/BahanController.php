<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notification;
use App\Bahan;
use App\Sku;
use PDF;

class BahanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masuk = Bahan::where('status', 'bahan masuk')->orderBy('created_at', 'DESC')->get();
        $keluar = Bahan::where('status', 'bahan keluar')->orderBy('created_at', 'DESC')->get();
        return view("backend.bahan.index", ['masuk' => $masuk, 'keluar' => $keluar]);
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
            return view("backend.bahan.masuk.create");
        } else {
            $masuk = Bahan::all()->where('status', 'bahan masuk');
            $sku = Sku::all();
            $kode_transaksi = $this->getKode();

            return view("backend.bahan.keluar.create", ['masuk' => $masuk, 'kode' => $kode_transaksi, 'sku' => $sku]);
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

        if ($request->get('status') == 'bahan masuk') {
            $validator = Validator::make($request->all(), [
                'kode_bahan' =>  'required|unique:bahans,kode_bahan',
                'no_surat' => 'required|unique:bahans,no_surat',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal' => 'required',
                'panjang_bahan' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_bahan' =>  'required',
                'no_surat' => 'required',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal' => 'required',
                'panjang_bahan' => 'required',
                'sku' => 'required|unique:bahans,sku'
            ]);
        }

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors());
        } else {

            if ($request->get('status') == 'bahan masuk') {
                $bahan = new Bahan();
                $bahan->kode_bahan = $request->get('kode_bahan');
            } else {
                $bahan = Bahan::findOrFail($request->get('kode_bahan'));

                $notif = new Notification();
                $notif->description = "bahan keluar telah dikirim ke potong, silahkan di cek";
                $notif->url = route('potong.index');
                $notif->aktif = 0;
                $notif->save();

                session(['notification' => 1]);
            }
            $bahan->no_surat = $request->get('no_surat');
            $bahan->nama_bahan = $request->get('nama_bahan');
            $bahan->jenis_bahan = $request->get('jenis_bahan');
            $bahan->warna = $request->get('warna');
            $bahan->vendor = $request->get('vendor');
            if ($request->get('status') == 'bahan masuk') {
                $bahan->tanggal_masuk = $request->get('tanggal');
                $bahan->status = "bahan masuk";
            } else {
                $kode_transaksi = $this->getKode();
                $sku = Sku::findOrFail($request->get('sku'));
                $bahan->kode_transaksi = $kode_transaksi;
                $bahan->sku = $sku->kode_sku;
                $bahan->sku_id = $sku->id;
                $bahan->status = "bahan keluar";
                $bahan->tanggal_keluar = $request->get('tanggal');
            }

            $bahan->panjang_bahan = $request->get('panjang_bahan');

            $bahan->save();

            return redirect()->route('bahan.index')->with('success', $request->get('status') . ' berhasil disimpan');
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
        $bahan = Bahan::findOrFail($id);
        if ($bahan->status == 'bahan masuk') {
            return view("backend.bahan.masuk.show", ['bahan' => $bahan]);
        } else {

            return view("backend.bahan.keluar.show", ['bahan' => $bahan]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $bahan = Bahan::findOrFail($id);
        if ($bahan->status == 'bahan masuk') {
            return view("backend.bahan.masuk.edit", ['bahan' => $bahan]);
        } else {

            return view("backend.bahan.keluar.edit", ['bahan' => $bahan]);
        }
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
        if ($request->get('status') == 'bahan masuk') {
            $validator = Validator::make($request->all(), [

                'no_surat' => 'required',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal' => 'required',
                'panjang_bahan' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [

                'no_surat' => 'required',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal' => 'required',
                'panjang_bahan' => 'required',
                'sku' => 'required'
            ]);
        }

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors());
        } else {

            $bahan = Bahan::findOrFail($id);
            $bahan->no_surat = $request->get('no_surat');
            $bahan->nama_bahan = $request->get('nama_bahan');
            $bahan->jenis_bahan = $request->get('jenis_bahan');
            $bahan->warna = $request->get('warna');
            $bahan->vendor = $request->get('vendor');
            if ($request->get('status') == 'bahan masuk') {
                $bahan->tanggal_masuk = $request->get('tanggal');
                $bahan->status = "bahan masuk";
            } else {
                $bahan->status = "bahan keluar";
                $bahan->tanggal_keluar = $request->get('tanggal');
            }

            $bahan->panjang_bahan = $request->get('panjang_bahan');

            $bahan->save();
            return redirect()->route('bahan.index')->with('success', $request->get('status') . ' berhasil diupdate');
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
            $bahan = Bahan::findOrFail($id);
            $status = false;
            if ($bahan->potong()->exists()) {
                $status = true;
            } else {
                $bahan->delete();
            }
            return response()->json([
                'status' => $status
            ]);
        }
    }

    public function getDataBahan(Request $request)
    {
        if ($request->ajax()) {
            $bahan = Bahan::with('skus')->where('id',$request->get('id'))->first();

            return response()->json([
                'status' => true,
                'data' => $bahan
            ]);
        }
    }

    public function getDataSKU(Request $request){
        if ($request->ajax()) {
            $ksu = Sku::findOrFail($request->get('id'));

            return response()->json([
                'status' => true,
                'data' => $ksu
            ]);
        }
    }

    public function getDataPrint(Request $request)
    {
        if ($request->ajax()) {
            $bahan = Bahan::findOrFail($request->get('id'));
            $titlebahan = [
                'Kode SKU',
                'Nama Bahan',
                'Jenis Bahan',
                'Warna Bahan',
                'Panjang Bahan',
                'Vendor',
                'Tanggal Masuk',
                'Nomor Surat Jalan',
            ];
            $data = [];
            $x['title'] = $titlebahan;
            $x['data'] = [
                $bahan->sku,
                $bahan->nama_bahan,
                $bahan->jenis_bahan,
                $bahan->warna,
                $bahan->panjang_bahan,

                $bahan->vendor,
                $bahan->tanggal_masuk,
                $bahan->no_surat
            ];
            array_push($data, $x);
            return response()->json([
                'status' => true,
                'data' => $x
            ]);
        }
    }

    public function cetakPdf(Request $request)
    {
        $bahan = Bahan::findOrFail($request->get('id'));
        $titlebahan = [
            'Kode SKU',
            'Nama Bahan',
            'Jenis Bahan',
            'Warna Bahan',
            'Panjang Bahan',
            'Vendor',
            'Tanggal Masuk',
            'Nomor Surat Jalan',
        ];
        $data = [];
        $x['title'] = $titlebahan;
        $x['data'] = [
            $bahan->sku,
            $bahan->nama_bahan,
            $bahan->jenis_bahan,
            $bahan->warna,
            $bahan->panjang_bahan,

            $bahan->vendor,
            $bahan->tanggal_masuk,
            $bahan->no_surat
        ];

        $pdf = PDF::loadView('backend.bahan.pdf', ['data' => $x]);
        return $pdf->stream('bahan.pdf');
    }

    public function getKode()
    {
        $kode_transaksi = Bahan::max('kode_transaksi');
        if (empty($kode_transaksi)) {
            $kode_transaksi = "TR-" . date('Ymd') . "1";
        } else {
            $last = substr($kode_transaksi, -1);
            $jumlah = $last + 1;
            $kode_transaksi = "TR-" . date('Ymd') . $jumlah;
        }

        return $kode_transaksi;
    }
}
