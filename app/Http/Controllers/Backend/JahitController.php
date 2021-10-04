<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DetailJahit;
use App\DetailPotong;
use App\Notification;
use App\JahitDirepair;
use App\JahitDibuang;
use App\Potong;
use App\Jahit;
use PDF;

class JahitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $proses = Jahit::whereDate('tanggal_jahit', date('Y-m-d'))->where('status', 'jahitan masuk')->update(['status_jahit' => 'proses jahit']);
        // $selesai = Jahit::whereDate('tanggal_selesai', date('Y-m-d'))->where('status', 'jahitan masuk')->update(['status_jahit' => 'selesai']);
        // $selesai = Jahit::query()->update(['status_jahit' => 'konfirmasi selesai']);
        $datakeluar = Potong::where('status', 'potong keluar')->where('status_potong', 'selesai')->doesntHave('jahit')->get();
        $jahitmasuk = Jahit::orderBy('created_at', 'DESC')->get();
        $jahitkeluar = Jahit::where('status', 'jahitan keluar')->orderBy('created_at', 'DESC')->get();
        $jahitselesai = Jahit::where('status', 'jahitan selesai')->orderBy('created_at', 'DESC')->get();

        return view("backend.jahit.index", ['datakeluar' => $datakeluar, 'jahitmasuk' => $jahitmasuk, 'jahitkeluar' => $jahitkeluar, 'jahitselesai' => $jahitselesai]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->get('status') == 'masuk') {
            $datakeluar = Potong::where('status_potong', 'selesai')->doesntHave('jahit')->get();
            return view("backend.jahit.masuk.create", ['datakeluar' => $datakeluar]);
        } else if ($request->get('status') == 'selesai') {
            $keluar = Jahit::all()->where('status_jahit', 'konfirmasi selesai');
            return view("backend.jahit.selesai.create", ['keluar' => $keluar]);
        } else {
            // $keluar = Jahit::all()->where('status', 'jahitan selesai')->where('status_jahit', 'selesai');
            $keluar = Jahit::all()->where('status', 'jahitan selesai');
            return view("backend.jahit.keluar.create", ['keluar' => $keluar]);
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
        $status = $request->get('status');
        if ($status == 'jahitan masuk') {
            if ($request->get('vendor_jahit') == 'internal') {
                $validasi = [
                    'kode_transaksi' =>  'required',
                    'no_surat' => 'required|unique:jahits,no_surat',
                    'tanggal_jahit' => 'required|date_format:"Y-m-d"',
                    'estimasi_selesai_jahit' => 'required|date_format:"Y-m-d"|after:tanggal_jahit',
                    'vendor_jahit' => 'required',
                    'jumlah_bahan_yang_dijahit' => 'required',

                ];
            } else {
                $validasi = [
                    'kode_transaksi' =>  'required',
                    'no_surat' => 'required|unique:jahits,no_surat',
                    'tanggal_jahit' => 'required|date_format:"Y-m-d"',
                    'estimasi_selesai_jahit' => 'required|date_format:"Y-m-d"|after:tanggal_jahit',
                    'vendor_jahit' => 'required',
                    'nama_vendor' => 'required',
                    'harga_vendor' => 'required',
                    'jumlah_bahan_yang_dijahit' => 'required',
                ];
            }
            $validator = Validator::make($request->all(), $validasi);
        } elseif ($status == 'jahitan selesai') {
            if ($request->get('vendor_jahit') == 'internal') {
                $validasi = [
                    'kode_transaksi' =>  'required',
                    'no_surat' => 'required',
                    'vendor_jahit' => 'required',
                    'berhasil_jahit' => 'required|integer',
                ];
            } else {
                $validasi = [
                    'kode_transaksi' =>  'required',
                    'no_surat' => 'required',
                    'vendor_jahit' => 'required',
                    'berhasil_jahit' => 'required|integer',
                    'nama_vendor' => 'required',
                    'harga_vendor' => 'required'
                ];
            }
            $validator = Validator::make($request->all(), $validasi);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'no_surat' => 'required',
                'vendor_jahit' => 'required',
                'berhasil_jahit' => 'required|integer',
                'konversi' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            DB::beginTransaction();
            try {

                if ($request->get('status') == 'jahitan masuk') {
                    $jahit = new Jahit();
                    $jahit->potong_id = $request->get('kode_transaksi');
                } else {
                    $jahit = Jahit::findOrFail($request->get('kode_transaksi'));
                }
                $jahit->no_surat = $request->get('no_surat');
                $jahit->vendor = $request->get('vendor_jahit');
                if ($request->get('status') == 'jahitan masuk') {
                    $jahit->tanggal_selesai = date('Y-m-d', strtotime($request->get('estimasi_selesai_jahit')));
                    $jahit->tanggal_jahit = date('Y-m-d', strtotime($request->get('tanggal_jahit')));
                    $jahit->status = "jahitan masuk";
                    if ($jahit->tanggal_selesai == date('Y-m-d')) {
                        // $jahit->status_jahit = "proses jahit";
                        $jahit->status_jahit = "selesai";
                    } else {
                        // $jahit->status_jahit = "belum jahit";
                        $jahit->status_jahit = "selesai";
                    }
                    if ($request->get('vendor_jahit') == 'eksternal') {
                        $jahit->nama_vendor = $request->get('nama_vendor');
                        $jahit->harga_vendor = $request->get('harga_vendor');
                        $jahit->status_pembayaran = "Belum Lunas";
                    }
                    $detailpotong = DetailPotong::where('potong_id', $jahit->potong_id)->get();
                    $jahit->jumlah_bahan = $request->get('jumlah_bahan_yang_dijahit');
                    $jahit->konversi = $request->get('konversi');
                    $jahit->save();
                    foreach ($detailpotong as $key => $value) {
                        $detail = new DetailJahit();
                        $detail->jahit_id = $jahit->id;
                        $detail->size = $value->size;
                        $detail->jumlah = $value->jumlah;
                        $detail->save();
                    }
                }



                if ($request->get('status') == 'jahitan selesai') {
                    $jahit->berhasil = $request->get('berhasil_jahit');
                    $jahit->status = "jahitan selesai";
                    $jahit->status_jahit = "selesai";
                    //direpair

                    $jumlah = $request->get('jumlahdirepair');
                    $dataukuran = $request->get('dataukurandirepair');
                    $sum = array_sum($jumlah);
                    if ($sum != intval($request->get('barang_direpair'))) {
                        return redirect()->back()->withErrors('Jumlah repair yang harus dimasukkan sebanyak ' . $request->get('barang_direpair'));
                    }
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    foreach ($arr as $key => $value) {
                        $detail = new JahitDirepair();
                        $detail->jahit_id = $jahit->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }


                    //dibuang
                    unset($arr);
                    $jumlah = $request->get('jumlahdibuang');
                    $dataukuran = $request->get('dataukurandibuang');
                    $sum = array_sum($jumlah);
                    if ($sum != intval($request->get('barang_dibuang'))) {
                        return redirect()->back()->withErrors('Jumlah dibuang yang harus dimasukkan sebanyak ' . $request->get('barang_dibuang'));
                    }
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    foreach ($arr as $key => $value) {
                        $detail = new JahitDibuang();
                        $detail->jahit_id = $jahit->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }

                    $jahit->gagal_jahit = $request->get('gagal_jahit');
                    $jahit->barang_direpair = $request->get('barang_direpair');
                    $jahit->barang_dibuang = $request->get('barang_dibuang');
                    $jahit->keterangan_direpair = $request->get('keterangan_direpair');
                    $jahit->keterangan_dibuang = $request->get('keterangan_dibuang');
                }


                if ($request->get('status') == 'jahitan keluar') {
                    $jahit->berhasil = $request->get('berhasil_jahit');
                    $jahit->konversi = $request->get('konversi');
                    $jahit->status = "jahitan keluar";
                    if ($request->get('vendor_jahit') == 'eksternal') {
                        $jahit->nama_vendor = $request->get('nama_vendor');
                        $jahit->harga_vendor = $request->get('harga_vendor');
                        $jahit->status_pembayaran = $request->get('status_pembayaran');
                    }
                    $jumlah = $request->get('jumlah');
                    $dataukuran = $request->get('dataukuran');
                    $sum = array_sum($jumlah);
                    if ($sum != intval($request->get('berhasil_jahit'))) {
                        return redirect()->back()->withErrors('Jumlah berhasil jahit yang harus dimasukkan sebanyak ' . $request->get('berhasil_jahit'));
                    }
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    DetailJahit::where('jahit_id', $jahit->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new DetailJahit();
                        $detail->jahit_id = $jahit->id;
                        $detail->size = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }

                    //direpair
                    unset($arr);
                    $jumlah = $request->get('jumlahdirepair');
                    $dataukuran = $request->get('dataukurandirepair');
                    $iddetailukurandirepair = $request->get('iddetailukurandirepair');
                    $sum = array_sum($jumlah);
                    if ($sum != intval($request->get('barang_direpair'))) {
                        return redirect()->back()->withErrors('Jumlah direpair jahit yang harus dimasukkan sebanyak ' . $request->get('barang_direpair'));
                    }
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {

                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    JahitDirepair::where('jahit_id', $jahit->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new JahitDirepair();
                        $detail->jahit_id = $jahit->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }


                    //dibuang
                    unset($arr);
                    $jumlah = $request->get('jumlahdibuang');
                    $dataukuran = $request->get('dataukurandibuang');
                    $iddetailukurandibuang = $request->get('iddetailukurandibuang');
                    $sum = array_sum($jumlah);
                    if ($sum != intval($request->get('barang_dibuang'))) {
                        return redirect()->back()->withErrors('Jumlah dibuang yang harus dimasukkan sebanyak ' . $request->get('barang_dibuang'));
                    }
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {

                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }
                    JahitDibuang::where('jahit_id', $jahit->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new JahitDibuang();
                        $detail->jahit_id = $jahit->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }
                    $jahit->gagal_jahit = $request->get('gagal_jahit');
                    $jahit->barang_direpair = $request->get('barang_direpair');
                    $jahit->barang_dibuang = $request->get('barang_dibuang');
                    $jahit->keterangan_direpair = $request->get('keterangan_direpair');
                    $jahit->keterangan_dibuang = $request->get('keterangan_dibuang');

                    $notif = new Notification();
                    $notif->description = "jahit keluar telah dikirim ke cuci, silahkan di cek";
                    $notif->url = route('cuci.index');
                    $notif->aktif = 0;
                    $notif->save();

                    session(['notification' => 1]);
                }
                $jahit->save();
                DB::commit();
                return redirect()->route('jahit.index')->with('success', 'Data jahitan berhasil disimpan');
            } catch (\Exception $th) {
                //throw $th;
                DB::rollBack();
                dd($th);
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
        $jahit = Jahit::find($id);

        if ($jahit->status == 'jahitan masuk') {
            return view("backend.jahit.masuk.show", ['jahit' => $jahit]);
        } else  if ($jahit->status == 'jahitan selesai') {
            return view("backend.jahit.selesai.show", ['jahit' => $jahit]);
        } else {
            return view("backend.jahit.keluar.show", ['jahit' => $jahit]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jahit = Jahit::find($id);

        if ($jahit->status == 'jahitan masuk') {
            return view("backend.jahit.masuk.edit", ['jahit' => $jahit]);
        } else  if ($jahit->status == 'jahitan selesai') {
            return view("backend.jahit.selesai.edit", ['jahit' => $jahit]);
        } else {
            return view("backend.jahit.keluar.edit", ['jahit' => $jahit]);
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
        if ($request->get('status') == 'jahitan masuk') {

            if ($request->get('vendor_jahit') == 'internal') {
                $validasi = [

                    'no_surat' => 'required|unique:potongs,no_surat',
                    'tanggal_jahit' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                    'estimasi_selesai_jahit' => 'required|date_format:"Y-m-d"|after:tanggal_jahit',
                    'vendor_jahit' => 'required'
                ];
            } else {
                $validasi = [

                    'no_surat' => 'required|unique:potongs,no_surat',
                    'tanggal_jahit' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                    'estimasi_selesai_jahit' => 'required|date_format:"Y-m-d"|after:tanggal_jahit',
                    'vendor_jahit' => 'required',
                    'nama_vendor' => 'required',
                    'harga_vendor' => 'required'
                ];
            }
            $validator = Validator::make($request->all(), $validasi);
        } else {
            $validator = Validator::make($request->all(), [

                'no_surat' => 'required',
                'vendor_jahit' => 'required',
                'berhasil_jahit' => 'required|integer',
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {

            DB::beginTransaction();
            try {

                $jahit = Jahit::findOrFail($id);
                $jahit->no_surat = $request->get('no_surat');
                $jahit->vendor = $request->get('vendor_jahit');
                if ($request->get('status') == 'jahitan masuk') {
                    $jahit->tanggal_selesai = date('Y-m-d', strtotime($request->get('estimasi_selesai_jahit')));
                    $jahit->tanggal_jahit = date('Y-m-d', strtotime($request->get('tanggal_jahit')));
                    $jahit->status = "jahitan masuk";
                    // if ($jahit->tanggal_selesai == date('Y-m-d')) {
                    //     $jahit->status_jahit = "proses jahit";
                    // } else {
                    //     $jahit->status_jahit = "belum jahit";
                    // }

                    if ($request->get('vendor_jahit') == 'eksternal') {
                        $jahit->nama_vendor = $request->get('nama_vendor');
                        $jahit->harga_vendor = $request->get('harga_vendor');
                        $jahit->status_pembayaran = $request->get('status_pembayaran');
                    } else {
                        $jahit->nama_vendor = null;
                        $jahit->harga_vendor = null;
                        $jahit->status_pembayaran = null;
                    }
                    $jahit->jumlah_bahan = $request->get('jumlah_bahan_yang_dijahit');
                    $jahit->konversi = $request->get('konversi');
                    $dataukuran = $request->get('dataukuran');
                    $jumlah = $request->get('jumlah');
                    $sum = array_sum($jumlah);
                    if ($sum != intval($request->get('jumlah_bahan_yang_dijahit'))) {
                        return redirect()->back()->withErrors('Jumlah bahan jahit yang harus dimasukkan sebanyak ' . $request->get('jumlah_bahan_yang_dijahit'));
                    }
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    DetailJahit::where('jahit_id', $jahit->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new DetailJahit();
                        $detail->jahit_id = $jahit->id;
                        $detail->size = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }
                }


                if ($request->get('status') == 'jahitan keluar') {
                    $jahit->berhasil = $request->get('berhasil_jahit');
                    $jahit->konversi = $request->get('konversi');
                    $jahit->status = "jahitan keluar";
                    $jumlah = $request->get('jumlah');
                    $dataukuran = $request->get('dataukuran');
                    $iddetailukuran = $request->get('iddetailukuran');
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['id'] = $iddetailukuran[$key];
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    DetailJahit::where('jahit_id', $jahit->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new DetailJahit();
                        $detail->jahit_id = $jahit->id;
                        $detail->size = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }

                    //direpair
                    unset($arr);
                    $jumlah = $request->get('jumlahdirepair');
                    $dataukuran = $request->get('dataukurandirepair');
                    $iddetailukurandirepair = $request->get('iddetailukurandirepair');
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {

                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    JahitDirepair::where('jahit_id', $jahit->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new JahitDirepair();
                        $detail->jahit_id = $jahit->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }


                    //dibuang
                    unset($arr);
                    $jumlah = $request->get('jumlahdibuang');
                    $dataukuran = $request->get('dataukurandibuang');
                    $iddetailukurandibuang = $request->get('iddetailukurandibuang');
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {

                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }
                    JahitDibuang::where('jahit_id', $jahit->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new JahitDibuang();
                        $detail->jahit_id = $jahit->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }

                    $jahit->gagal_jahit = $request->get('gagal_jahit');
                    $jahit->barang_direpair = $request->get('barang_direpair');
                    $jahit->barang_dibuang = $request->get('barang_dibuang');
                    $jahit->keterangan_direpair = $request->get('keterangan_direpair');
                    $jahit->keterangan_dibuang = $request->get('keterangan_dibuang');
                }



                if ($request->get('status') == 'jahitan selesai') {
                    $jahit->berhasil = $request->get('berhasil_jahit');

                    //direpair

                    $jumlah = $request->get('jumlahdirepair');
                    $dataukuran = $request->get('dataukurandirepair');
                    $iddetailukurandirepair = $request->get('iddetailukurandirepair');
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {

                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    JahitDirepair::where('jahit_id', $jahit->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new JahitDirepair();
                        $detail->jahit_id = $jahit->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }


                    //dibuang
                    unset($arr);
                    $jumlah = $request->get('jumlahdibuang');
                    $dataukuran = $request->get('dataukurandibuang');
                    $iddetailukurandibuang = $request->get('iddetailukurandibuang');
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {

                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }
                    JahitDibuang::where('jahit_id', $jahit->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new JahitDibuang();
                        $detail->jahit_id = $jahit->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }

                    $jahit->gagal_jahit = $request->get('gagal_jahit');
                    $jahit->barang_direpair = $request->get('barang_direpair');
                    $jahit->barang_dibuang = $request->get('barang_dibuang');
                    $jahit->keterangan_direpair = $request->get('keterangan_direpair');
                    $jahit->keterangan_dibuang = $request->get('keterangan_dibuang');
                }
                $jahit->save();
                DB::commit();
                return redirect()->route('jahit.index')->with('success', $request->get('status') . ' berhasil diupdate');
            } catch (\Exception $th) {
                //throw $th;
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
    public function destroy(Request $request, $id)
    {
        if ($request->ajax()) {
            $jahit = Jahit::findOrFail($id);
            $status = false;
            if ($jahit->cuci()->exists()) {
                $status = true;
            } else {
                $jahit->delete();
            }
            return response()->json([
                'status' => $status
            ]);
        }
    }
    public function getDataJahit(Request $request)
    {
        if ($request->ajax()) {
            $jahit = Jahit::with(['detail_jahit', 'potong' => function ($q) {
                $q->with(['bahan'  => function ($q) {
                    $q->with(['detail_sub' => function ($q) {
                        $q->with(['sub_kategori' => function ($q) {
                            $q->with('kategori');
                        }]);
                    }]);
                }]);
            }])->where('id', $request->get('id'))->first();

            return response()->json([
                'status' => true,
                'data' => $jahit
            ]);
        }
    }

    public function getDataPrint(Request $request)
    {
        if ($request->ajax()) {
            $jahit = Jahit::findOrFail($request->get('id'));
            $titlejahit = [
                'Kode SKU',
                'Tanggal Selesai Jahit',
                'Vendor Jahit',
                'Berhasil Jahit',
                'Gagal Jahit',
                'Barang Direpair',
                'Keterangan Direpair',
                'Barang Dibuang',
                'Keterangan Dibuang'
            ];
            $x['kode_bahan'] =  $jahit->potong->bahan->kode_transaksi;
            $x['title'] = $titlejahit;
            $x['data'] = [
                $jahit->potong->bahan->sku,
                $jahit->tanggal_selesai,
                $jahit->vendor,
                $jahit->berhasil,
                $jahit->gagal_jahit,
                $jahit->barang_direpair,
                $jahit->keterangan_direpair,
                $jahit->barang_dibuang,
                $jahit->keterangan_dibuang,
            ];

            return response()->json([
                'status' => true,
                'data' => $x
            ]);
        }
    }

    public function cetakPdf(Request $request)
    {
        $jahit = Jahit::findOrFail($request->get('id'));
        $titlejahit = [
            'Kode SKU',
            'Tanggal Selesai Jahit',
            'Vendor Jahit',
            'Berhasil Jahit',
            'Gagal Jahit',
            'Barang Direpair',
            'Keterangan Direpair',
            'Barang Dibuang',
            'Keterangan Dibuang'
        ];
        $x['kode_bahan'] =  $jahit->potong->bahan->kode_bahan;
        $x['title'] = $titlejahit;
        $x['data'] = [
            $jahit->potong->bahan->sku,
            $jahit->tanggal_selesai,
            $jahit->vendor,
            $jahit->berhasil,
            $jahit->gagal_jahit,
            $jahit->barang_direpair,
            $jahit->keterangan_direpair,
            $jahit->barang_dibuang,
            $jahit->keterangan_dibuang,
        ];

        $pdf = PDF::loadView('backend.jahit.pdf', ['data' => $x]);
        return $pdf->stream('jahit.pdf');
    }

    public function pembayaranVendor(Request $request, $id)
    {
        $jahit = Jahit::where('id', $id)->where('status_pembayaran', 'Termin')->firstOrFail();
        return view("backend.jahit.pembayaran.edit", ['jahit' => $jahit]);
    }

    public function pembayaranVendorUpdate(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'pembayaran_pertama' =>  'nullable|integer',
            'pembayaran_kedua' =>  'nullable|integer',
            'pembayaran_ketiga' =>  'nullable|integer',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            $jahit = Jahit::where('id', $id)->where('status_pembayaran', 'Termin')->firstOrFail();

            if ($request->has('pembayaran_pertama')) {
                $jahit->pembayaran_pertama = $request->get('pembayaran_pertama');
                $jahit->sisa_bayar = $jahit->sisa_bayar -  $request->get('pembayaran_pertama');
            }

            if ($request->has('pembayaran_kedua')) {
                $jahit->pembayaran_kedua = $request->get('pembayaran_kedua');
                $jahit->sisa_bayar = $jahit->sisa_bayar -  $request->get('pembayaran_kedua');
            }

            if ($request->has('pembayaran_ketiga')) {
                $jahit->pembayaran_ketiga = $request->get('pembayaran_ketiga');
                $jahit->sisa_bayar = $jahit->sisa_bayar -  $request->get('pembayaran_ketiga');
            }

            if ($jahit->pembayaran_pertama > 0) {
                $total = $jahit->pembayaran_pertama;
                if ($total >= $jahit->total_bayar) {
                    $jahit->status_pembayaran = 'Lunas';
                }
            }

            if ($jahit->pembayaran_pertama > 0 && $jahit->pembayaran_kedua > 0) {
                $total = $jahit->pembayaran_pertama + $jahit->pembayaran_kedua;
                if ($total >= $jahit->total_bayar) {
                    $jahit->status_pembayaran = 'Lunas';
                }
            }

            if ($jahit->pembayaran_pertama > 0 && $jahit->pembayaran_kedua > 0 && $jahit->pembayaran_ketiga > 0) {
                $total = $jahit->pembayaran_pertama + $jahit->pembayaran_kedua + $jahit->pembayaran_ketiga;
                if ($total >= $jahit->total_bayar) {
                    $jahit->status_pembayaran = 'Lunas';
                }
            }
            $jahit->save();
            return redirect()->route('jahit.index')->with('success',  'Pembayaran berhasil diupdate');
        }
    }
}
