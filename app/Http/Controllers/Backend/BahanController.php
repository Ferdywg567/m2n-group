<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Notification;
use App\Kategori;
use App\Bahan;
use App\DetailSubKategori;
use App\Sku;
use App\SubKategori;
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
        $keluar = Bahan::where('status', 'bahan keluar')->whereNotNull('kode_transaksi')->orderBy('created_at', 'DESC')->get();
        $bahan = Bahan::orderBy('created_at', 'DESC')->get();
        $kategori = Kategori::all();
        return view("backend.bahan.index", ['masuk' => $masuk, 'keluar' => $keluar, 'kategori' => $kategori, 'bahan' => $bahan]);
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
            $masuk = Bahan::where('sisa_bahan', '=', -1)->orwhere('sisa_bahan','>',0)->get();
            $kode_transaksi = $this->getKode();
            $kategori = Kategori::all();
            return view("backend.bahan.keluar.create", ['masuk' => $masuk, 'kode' => $kode_transaksi, 'kategori' => $kategori]);
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
        // dd($request->all());
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
                'no_surat' => 'required|unique:bahans,no_surat',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal_keluar' => 'required',
                'panjang_bahan' => 'required',
                'sku_bahan' => 'required',
                'panjang_bahan_diambil' => 'required|integer|max:'.$request->get('panjang_bahan')
            ]);
        }

        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator->errors());
        } else {

            if ($request->get('status') == 'bahan masuk') {
                $bahan = new Bahan();
                $bahan->sisa_bahan = -1;
                $bahan->kode_bahan = $request->get('kode_bahan');
            } else {
                $cekbahan = Bahan::find($request->get('kode_bahan'));
                $cekbahan->status = "bahan keluar";
                $cekbahan->sisa_bahan = null;
                $cekbahan->save();
                // dd($cekbahan);
                $bahan = new Bahan();
                $bahan->kode_bahan = $cekbahan->kode_bahan;
                $bahan->tanggal_masuk = $cekbahan->tanggal_masuk;
                $notif = new Notification();
                $notif->description = "bahan keluar telah dikirim ke potong, silahkan di cek bahan";
                $notif->url = route('potong.index');
                $notif->aktif = 0;
                $notif->role = 'production';
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
                $bahan->kode_transaksi = $kode_transaksi;
                $bahan->sku = $request->get('sku_bahan');
                $bahan->detail_sub_kategori_id = $request->get('detail_sub_kategori');
                $bahan->sisa_bahan = $request->get('sisa_bahan');
                $bahan->panjang_bahan_diambil = $request->get('panjang_bahan_diambil');
                $bahan->status = "bahan keluar";
                $bahan->tanggal_keluar = $request->get('tanggal_keluar');
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
            $kategori = Kategori::all();
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
            $kategori = Kategori::all();
            $sub = SubKategori::all();
            $detail = DetailSubKategori::all();
            // dd($bahan->detail_sub);
            return view("backend.bahan.keluar.edit", ['bahan' => $bahan, 'kategori' => $kategori, 'sub' => $sub, 'detail' => $detail]);
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
            $bahan = Bahan::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'no_surat' => 'required|unique:bahans,no_surat,' . $bahan->no_surat . ',no_surat',
                'nama_bahan' => 'required',
                'jenis_bahan' => 'required',
                'warna' => 'required',
                'vendor' => 'required',
                'tanggal_keluar' => 'required',
                'panjang_bahan' => 'required',
                'sku_bahan' => 'required',
                'panjang_bahan_diambil' => 'required'
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
                $bahan->sku = $request->get('sku_bahan');
                $bahan->detail_sub_kategori_id = $request->get('detail_sub_kategori');
                $bahan->sisa_bahan = $request->get('sisa_bahan');
                $bahan->panjang_bahan_diambil = $request->get('panjang_bahan_diambil');
                $bahan->status = "bahan keluar";
                $bahan->tanggal_keluar = $request->get('tanggal_keluar');
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
            $bahan = Bahan::where('id', $request->get('id'))->with(['detail_sub' => function ($q) {
                $q->with(['sub_kategori' => function ($q) {
                    $q->with('kategori');
                }]);
            }])->first();

            return response()->json([
                'status' => true,
                'data' => $bahan
            ]);
        }
    }

    public function getDataSKU(Request $request)
    {
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
        $day = date('d');
        $month = date('m');
        $year = date('Y');
        $data = Bahan::select('kode_transaksi')->whereNotNull('kode_transaksi')->whereYear('created_at', $year)->whereMonth('created_at', $month)->whereDay('created_at', $day)->OrderBy('created_at', 'DESC')->first();
        if ($data) {
            $nomor = (int) substr($data->kode_transaksi, 14);
            if ($nomor != 0) {
                if ($nomor >= 9999) {
                    $nomor = $nomor + 1;
                    $formatNomor = "TR-" . date('Y-m-d') . "-" . $nomor;
                } else {
                    $nomor = $nomor + 1;
                    $addzero = str_pad($nomor, 4, '0', STR_PAD_LEFT);
                    $formatNomor = "TR-" . date('Y-m-d') . "-" . $addzero;
                }
            }
        } else {
            $nomor = 1;
            $addzero = str_pad($nomor, 4, '0', STR_PAD_LEFT);
            $formatNomor = "TR-" . date('Y-m-d') . "-" . $addzero;
        }
        return $formatNomor;
    }
}
