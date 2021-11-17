<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DetailJahit;
use App\DetailPotong;
use App\Notification;
use App\Potong;
use App\Jahit;
use App\Bahan;
use PDF;

class PotongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $proses = Potong::whereDate('tanggal_cutting', date('Y-m-d'))->where('status', 'potong masuk')->update(['status_potong' => 'proses potong']);
        // $selesai = Potong::whereDate('tanggal_selesai', date('Y-m-d'))->where('status', 'potong masuk')->update(['status_potong' => 'selesai']);
        $selesai = Potong::whereNotNull('tanggal_cutting')->whereNotNull('tanggal_selesai')->update(['status_potong' => 'selesai']);
        $bahan = Bahan::doesntHave('potong')->where('status', 'bahan keluar')->get();
        $masuk = Potong::where('status', 'potong masuk')->orderBy('created_at', 'DESC')->get();
        $selesai = Potong::where('status', 'potong selesai')->orderBy('created_at', 'DESC')->get();
        $keluar = Potong::where('status', 'potong keluar')->where('status_potong', 'selesai')->orderBy('created_at', 'DESC')->get();;
        $datakeluar = Potong::where('status', 'potong keluar')->where('status_potong', 'selesai')->orderBy('created_at', 'DESC')->get();
        return view("backend.potong.index", ['bahan' => $bahan, 'masuk' => $masuk, 'keluar' => $keluar, 'datakeluar' => $datakeluar, 'selesai' => $selesai]);
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
            $bahan = Bahan::doesntHave('potong')->where('status', 'bahan keluar')->whereNotNull('kode_transaksi')->get();
            return view("backend.potong.masuk.create", ['bahan' => $bahan]);
        } elseif ($status == 'selesai') {
            $selesai = Potong::where('status', 'potong masuk')->where('status_potong', 'selesai')->whereNotNull('tanggal_cutting')->whereNotNull('tanggal_selesai')->get();
            return view("backend.potong.selesai.create", ['selesai' => $selesai]);
        } else {
            $keluar = Potong::all()->where('status', 'potong selesai')->where('status_potong', 'selesai');
            return view("backend.potong.keluar.create", ['keluar' => $keluar]);
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

        if ($request->get('status') == 'potong masuk') {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'no_surat' => 'required|unique:potongs,no_surat',
                'tanggal_potong' => 'required|date_format:"Y-m-d"',
                'estimasi_selesai_potong' => 'required|date_format:"Y-m-d"',
            ]);
        } else if ($request->get('status') == 'potong selesai') {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'no_surat' => 'required',
                'tanggal_potong' => 'required|date_format:"Y-m-d"',
                'estimasi_selesai_potong' => 'required|date_format:"Y-m-d"',
                'hasil_cutting' => 'required|integer',
                'konversi' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required'
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            DB::beginTransaction();
            try {
                if ($request->get('status') == 'potong masuk') {
                    $potong = new Potong();
                    $potong->bahan_id = $request->get('kode_transaksi');
                    $potong->no_surat = $request->get('no_surat');
                    $potong->tanggal_cutting = date('Y-m-d', strtotime($request->get('tanggal_potong')));
                    $potong->tanggal_selesai = date('Y-m-d', strtotime($request->get('estimasi_selesai_potong')));
                    $potong->status = "potong masuk";
                    if ($potong->tanggal_cutting == date('Y-m-d')) {
                        $potong->status_potong = "proses potong";
                    } else {
                        $potong->status_potong = "belum potong";
                    }
                    $potong->save();
                } else if ($request->get('status') == 'potong selesai') {
                    $potong = Potong::findOrFail($request->get('kode_transaksi'));
                    $jumlah = $request->get('jumlah');
                    $dataukuran = $request->get('ukuran');
                    $potong->no_surat = $request->get('no_surat');
                    $sum = array_sum($jumlah);
                    if ($sum != intval($request->get('hasil_cutting'))) {
                        return redirect()->back()->withErrors('Jumlah yang harus dimasukkan sebanyak ' . $request->get('hasil_cutting'));
                    }
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }
                    $potong->status = "potong selesai";
                    $potong->hasil_cutting = $request->get('hasil_cutting');
                    $potong->konversi = $request->get('konversi');
                    $potong->save();

                    foreach ($arr as $key => $value) {
                        $detail = new DetailPotong();
                        $detail->potong_id = $potong->id;
                        $detail->size = strtoupper($value['ukuran']);
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }
                } else {
                    $potong = Potong::findOrFail($request->get('kode_transaksi'));
                    $potong->status = "potong keluar";
                    $potong->save();

                    $jahit = new Jahit();
                    $jahit->potong_id = $potong->id;
                    $jahit->no_surat = $potong->no_surat;
                    $jahit->status = "jahitan masuk";
                    $jahit->status_jahit = "belum jahit";
                    $jahit->jumlah_bahan = $potong->hasil_cutting;
                    $jahit->konversi = $this->konversi($jahit->jumlah_bahan);
                    $detailpotong = DetailPotong::where('potong_id', $jahit->potong_id)->get();
                    $jahit->save();
                    foreach ($detailpotong as $key => $value) {
                        $detail = new DetailJahit();
                        $detail->jahit_id = $jahit->id;
                        $detail->size = $value->size;
                        $detail->jumlah = $value->jumlah;
                        $detail->save();
                    }
                }

                if ($request->get('status') == 'potong keluar') {
                    $notif = new Notification();
                    $notif->description = "potong keluar telah dikirim ke jahit, silahkan di cek";
                    $notif->url = route('jahit.index');
                    $notif->aktif = 0;
                    $notif->role = 'production';
                    $notif->save();
                    session(['notification' => 1]);
                }
                DB::commit();
                return redirect()->route('potong.index')->with('success', 'Data potong berhasil disimpan');
            } catch (\Throwable $th) {
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
        $potong = Potong::with(['detail_potong', 'bahan'])->where('id', $id)->first();
        if ($potong->status == 'potong masuk') {
            return view("backend.potong.masuk.show", ['potong' => $potong]);
        } else if ($potong->status == 'potong selesai') {
            return view("backend.potong.selesai.show", ['potong' => $potong]);
        } else {
            return view("backend.potong.keluar.show", ['potong' => $potong]);
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
        $potong = Potong::with(['detail_potong', 'bahan'])->where('id', $id)->first();
        if ($potong->status == 'potong masuk') {
            return view("backend.potong.masuk.edit", ['potong' => $potong]);
        } else  if ($potong->status == 'potong selesai') {
            return view("backend.potong.selesai.edit", ['potong' => $potong]);
        } else {
            return view("backend.potong.keluar.edit", ['potong' => $potong]);
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
        if ($request->get('status') == 'potong masuk') {
            $potong = Potong::findOrFail($id);
            $validator = Validator::make($request->all(), [
                'tanggal_potong' => 'required|date_format:"Y-m-d"',
                'estimasi_selesai_potong' => 'required|date_format:"Y-m-d"',
            ]);
        } elseif ($request->get('status') == 'potong selesai') {
            $validator = Validator::make($request->all(), [
                'hasil_cutting' =>  'required',
                'ukuran.*' => 'required',
                'jumlah.*' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'no_surat' => 'required',
                'tanggal_selesai' => 'required|date_format:"Y-m-d"',
                'tanggal_keluar' => 'required|date_format:"Y-m-d"|after_or_equal:tanggal_selesai',
                'hasil_cutting' => 'required|integer',
                'konversi' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $status = $request->get('status');
                $potong = Potong::findOrFail($id);
                if ($status == 'potong masuk') {
                    $potong->tanggal_cutting = $request->get('tanggal_potong');
                    $potong->tanggal_selesai = $request->get('estimasi_selesai_potong');
                    $potong->save();
                } elseif ($status == 'potong selesai') {
                    $jumlah = $request->get('jumlah');
                    $dataukuran = $request->get('ukuran');
                    $sum = array_sum($jumlah);
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];

                            array_push($arr, $x);
                        }
                    }
                    $potong = Potong::findOrFail($id);
                    $potong->hasil_cutting = $request->get('hasil_cutting');
                    $potong->konversi = $request->get('konversi');
                    $potong->save();
                    DetailPotong::where('potong_id', $potong->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail = new DetailPotong();
                        $detail->potong_id = $potong->id;
                        $detail->size = strtoupper($value['ukuran']);
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }
                }

                DB::commit();
                return redirect()->route('potong.index')->with('success', ' Data Potong berhasil diupdate');
            } catch (\Throwable $th) {
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
            $potong = Potong::findOrFail($id);
            $status = false;
            if ($potong->jahit()->exists()) {
                $status = true;
            } else {
                $potong->delete();
            }
            return response()->json([
                'status' => $status
            ]);
        }
    }
    public function getDataPotong(Request $request)
    {
        if ($request->ajax()) {
            $potong = Potong::with(['detail_potong', 'bahan' => function ($q) {
                $q->with(['detail_sub' => function ($q) {
                    $q->with(['sub_kategori' => function ($q) {
                        $q->with('kategori');
                    }]);
                }]);
            }])->where('id', $request->get('id'))->first();

            return response()->json([
                'status' => true,
                'data' => $potong
            ]);
        }
    }

    public function getDataPrint(Request $request)
    {
        if ($request->ajax()) {
            $potong = Potong::findOrFail($request->get('id'));
            $titlepotong = [
                'Kode SKU',
                'Tanggal Cutting',
                'Tanggal Selesai',
                'Hasil Cutting',
                'Jenis Kain',
                'Warna Kain',
                'Nama Produk'
            ];
            $x['kode_bahan'] =  $potong->bahan->kode_bahan;
            $x['title'] = $titlepotong;
            $x['data'] = [
                $potong->bahan->sku,
                $potong->tanggal_cutting,
                $potong->tanggal_selesai,
                $potong->hasil_cutting,
                $potong->bahan->jenis_bahan,
                $potong->bahan->warna,
                $potong->bahan->nama_bahan,
            ];
            return response()->json([
                'status' => true,
                'data' => $x
            ]);
        }
    }

    public function cetakPdf(Request $request)
    {
        $potong = Potong::findOrFail($request->get('id'));
        $titlepotong = [
            'Kode SKU',
            'Tanggal Potong',
            'Tanggal Selesai',
            'Hasil Potong',
            'Jenis Kain',
            'Warna Kain',
            'Nama Produk'
        ];
        $x['kode_bahan'] =  $potong->bahan->kode_transaksi;
        $x['title'] = $titlepotong;
        $x['data'] = [
            $potong->bahan->sku,
            $potong->tanggal_cutting,
            $potong->tanggal_selesai,
            $potong->hasil_cutting,
            $potong->bahan->jenis_bahan,
            $potong->bahan->warna,
            $potong->bahan->nama_bahan,
        ];

        $pdf = PDF::loadView('backend.potong.pdf', ['data' => $x]);
        return $pdf->stream('potong.pdf');
    }


    public function konversi($data)
    {
        $lusin = 12;
        $sisa = $data % $lusin;
        $hasil = ($data - $sisa) / $lusin;
        $res = $hasil . ' Lusin ' . $sisa . ' pcs';
        return $res;
    }

    public function update_status(Request $request)
    {
        if ($request->ajax()) {
            $potong = Potong::findOrFail($request->get('id'));
            $potong->status = "potong keluar";
            $potong->save();

            $jahit = new Jahit();
            $jahit->potong_id = $potong->id;
            $jahit->no_surat = $potong->no_surat;
            $jahit->status = "jahitan masuk";
            $jahit->status_jahit = "belum jahit";
            $jahit->jumlah_bahan = $potong->hasil_cutting;
            $jahit->konversi = $this->konversi($jahit->jumlah_bahan);
            $detailpotong = DetailPotong::where('potong_id', $jahit->potong_id)->get();
            $jahit->save();
            foreach ($detailpotong as $key => $value) {
                $detail = new DetailJahit();
                $detail->jahit_id = $jahit->id;
                $detail->size = $value->size;
                $detail->jumlah = $value->jumlah;
                $detail->save();
            }
            $notif = new Notification();
            $notif->description = "potong keluar telah dikirim ke jahit, silahkan di cek";
            $notif->url = route('jahit.index');
            $notif->aktif = 0;
            $notif->role = 'production';
            $notif->save();
            $request->session()->flash('success', 'Potong selesai berhasil dipindah ke potong keluar!');

            return response()->json([
                'status' => true
            ]);
        }
    }

    public function getselesai(Request $request, $id)
    {
        $potong = Potong::with(['detail_potong', 'bahan'])->where('id', $id)->first();
        if ($potong->status == 'potong masuk') {
            return view("backend.potong.masuk.selesai", ['potong' => $potong]);
        }
    }

    public function storeselesai(Request $request, $id)
    {

        if ($request->get('status') == 'potong selesai') {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'no_surat' => 'required',
                'tanggal_potong' => 'required|date_format:"Y-m-d"',
                'estimasi_selesai_potong' => 'required|date_format:"Y-m-d"',
                'hasil_cutting' => 'required|integer',
                'konversi' => 'required'
            ]);
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        } else {

            DB::beginTransaction();
            try {
                if ($request->get('status') == 'potong selesai') {
                    $potong = Potong::findOrFail($id);
                    $jumlah = $request->get('jumlah');
                    $dataukuran = $request->get('ukuran');
                    $potong->no_surat = $request->get('no_surat');
                    $sum = array_sum($jumlah);
                    if ($sum != intval($request->get('hasil_cutting'))) {
                        return redirect()->back()->withErrors('Jumlah yang harus dimasukkan sebanyak ' . $request->get('hasil_cutting'));
                    }
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }
                    $potong->status = "potong selesai";
                    $potong->hasil_cutting = $request->get('hasil_cutting');
                    $potong->konversi = $request->get('konversi');
                    $potong->save();

                    foreach ($arr as $key => $value) {
                        $detail = new DetailPotong();
                        $detail->potong_id = $potong->id;
                        $detail->size = strtoupper($value['ukuran']);
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }
                }
                DB::commit();
                return redirect()->route('potong.index')->with('success', 'Data potong berhasil disimpan');
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack();
            }
        }
    }
}
