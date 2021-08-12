<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DetailJahit;
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
        $proses = Jahit::whereDate('tanggal_jahit', date('Y-m-d'))->where('status', 'jahitan masuk')->update(['status_jahit' => 'proses jahit']);
        $selesai = Jahit::whereDate('tanggal_selesai', date('Y-m-d'))->where('status', 'jahitan masuk')->update(['status_jahit' => 'selesai']);
        $datakeluar = Potong::where('status', 'potong keluar')->where('status_potong', 'selesai')->doesntHave('jahit')->get();
        $jahitmasuk = Jahit::all()->where('status', 'jahitan masuk');
        $jahitkeluar = Jahit::all()->where('status', 'jahitan keluar');

        return view("backend.jahit.index", ['datakeluar' => $datakeluar, 'jahitmasuk' => $jahitmasuk, 'jahitkeluar' => $jahitkeluar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if ($request->get('status') == 'masuk') {
            $datakeluar = Potong::where('status', 'potong keluar')->where('status_potong', 'selesai')->doesntHave('jahit')->get();
            return view("backend.jahit.masuk.create", ['datakeluar' => $datakeluar]);
        } else {
            $keluar = Jahit::all()->where('status', 'jahitan masuk')->where('status_jahit', 'selesai');
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
        if ($request->get('status') == 'jahitan masuk') {

            if ($request->get('vendor_jahit') == 'internal') {
                $validasi = [
                    'kode_bahan' =>  'required',
                    'no_surat' => 'required|unique:potongs,no_surat',
                    'tanggal_jahit' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                    'tanggal_selesai' => 'required|date_format:"Y-m-d"|after:tanggal_jahit',
                    'vendor_jahit' => 'required'
                ];
            } else {
                $validasi = [
                    'kode_bahan' =>  'required',
                    'no_surat' => 'required|unique:potongs,no_surat',
                    'tanggal_jahit' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                    'tanggal_selesai' => 'required|date_format:"Y-m-d"|after:tanggal_jahit',
                    'vendor_jahit' => 'required',
                    'nama_vendor' => 'required',
                    'harga_vendor' => 'required'
                ];
            }
            $validator = Validator::make($request->all(), $validasi);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_bahan' =>  'required',
                'no_surat' => 'required',
                'vendor_jahit' => 'required',
                'berhasil_jahit' => 'required|integer',
                'konversi' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {

            DB::beginTransaction();
            try {

                if ($request->get('status') == 'jahitan masuk') {
                    $jahit = new Jahit();
                    $jahit->potong_id = $request->get('kode_bahan');
                } else {
                    $jahit = Jahit::findOrFail($request->get('kode_bahan'));
                }
                $jahit->no_surat = $request->get('no_surat');
                $jahit->vendor = $request->get('vendor_jahit');
                if ($request->get('status') == 'jahitan masuk') {
                    $jahit->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));
                    $jahit->tanggal_jahit = date('Y-m-d', strtotime($request->get('tanggal_jahit')));
                    $jahit->status = "jahitan masuk";
                    if ($jahit->tanggal_selesai == date('Y-m-d')) {
                        $jahit->status_jahit = "proses jahit";
                    } else {
                        $jahit->status_jahit = "belum jahit";
                    }

                    if ($request->get('vendor_jahit') == 'eksternal') {
                        $jahit->nama_vendor = $request->get('nama_vendor');
                        $jahit->harga_vendor = $request->get('harga_vendor');
                        $jahit->status_pembayaran = $request->get('status_pembayaran');
                    }
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
                    $arr = [];
                    foreach ($dataukuran as $key => $value) {
                        if (!empty($jumlah[$key])) {
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

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
                $jahit->save();
                DB::commit();
                return redirect()->route('jahit.index')->with('success', $request->get('status') . ' berhasil disimpan');
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
                    'tanggal_selesai' => 'required|date_format:"Y-m-d"|after:tanggal_jahit',
                    'vendor_jahit' => 'required'
                ];
            } else {
                $validasi = [

                    'no_surat' => 'required|unique:potongs,no_surat',
                    'tanggal_jahit' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                    'tanggal_selesai' => 'required|date_format:"Y-m-d"|after:tanggal_jahit',
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
                'konversi' => 'required'
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
                    $jahit->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));
                    $jahit->tanggal_jahit = date('Y-m-d', strtotime($request->get('tanggal_jahit')));
                    $jahit->status = "jahitan masuk";
                    if ($jahit->tanggal_selesai == date('Y-m-d')) {
                        $jahit->status_jahit = "proses jahit";
                    } else {
                        $jahit->status_jahit = "belum jahit";
                    }

                    if ($request->get('vendor_jahit') == 'eksternal') {
                        $jahit->nama_vendor = $request->get('nama_vendor');
                        $jahit->harga_vendor = $request->get('harga_vendor');
                        $jahit->status_pembayaran = $request->get('status_pembayaran');
                    } else {
                        $jahit->nama_vendor = null;
                        $jahit->harga_vendor = null;
                        $jahit->status_pembayaran = null;
                    }
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

                    foreach ($arr as $key => $value) {
                        $detail = DetailJahit::firstOrNew(['id' => $value['id']]);
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
                            $x['id'] = $iddetailukurandirepair[$key];
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    foreach ($arr as $key => $value) {
                        $detail = JahitDirepair::firstOrNew(['id' => $value['id']]);
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
                            $x['id'] = $iddetailukurandibuang[$key];
                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }

                    foreach ($arr as $key => $value) {
                        $detail = JahitDibuang::firstOrNew(['id' => $value['id']]);
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
            }else{
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
            $jahit = Jahit::with(['potong' => function ($q) {
                $q->with('bahan');
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

    public function cetakPdf(Request $request){
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
}
