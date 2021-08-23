<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Notification;
use App\Jahit;
use App\Cuci;
use App\DetailCuci;
use App\CuciDirepair;
use App\CuciDibuang;
use PDF;

class CuciController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masuk = Cuci::where('status', 'cucian masuk')->orderBy('created_at','DESC')->get();
        $keluar = Cuci::where('status', 'cucian keluar')->orderBy('created_at','DESC')->get();
        return view("backend.cuci.index", ['masuk' => $masuk, 'keluar' => $keluar]);
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
            $jahit = Jahit::where('status', 'jahitan keluar')->where('status_jahit', 'selesai')->doesntHave('cuci')->get();
            return view("backend.cuci.masuk.create", ['jahit' => $jahit]);
        } else {
            $cuci = Cuci::where('status', 'cucian masuk')->get();
            return view("backend.cuci.keluar.create", ['cuci' => $cuci]);
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
        if ($request->get('status') == 'cucian masuk') {

            if ($request->get('vendor_cuci') == 'internal') {
                $validasi = [
                    'kode_bahan' =>  'required',
                    'no_surat' => 'required|unique:potongs,no_surat',
                    'tanggal_masuk' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                    'tanggal_cuci' => 'required|date_format:"Y-m-d"|after:tanggal_masuk',
                    'vendor_cuci' => 'required',
                    'kain_siap_cuci' => 'required',
                ];
            } else {
                $validasi = [
                    'kode_bahan' =>  'required',
                    'no_surat' => 'required|unique:potongs,no_surat',
                    'tanggal_masuk' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                    'tanggal_cuci' => 'required|date_format:"Y-m-d"|after:tanggal_masuk',
                    'vendor_cuci' => 'required',
                    'kain_siap_cuci' => 'required',
                    'status_pembayaran' => 'required',
                    'nama_vendor' => 'required',
                    'harga_vendor' => 'required'
                ];
            }
            $validator = Validator::make($request->all(), $validasi);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_bahan' =>  'required',
                'no_surat' => 'required',
                'vendor_cuci' => 'required',
                'tanggal_selesai' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                'berhasil_cuci' => 'required|integer',
                'kain_gagal_cuci' => 'required|integer',
                'konversi' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {

                if ($request->get('status') == 'cucian masuk') {
                    $cuci = new Cuci();
                    $cuci->jahit_id = $request->get('kode_bahan');
                } else {
                    $cuci = Cuci::findOrFail($request->get('kode_bahan'));
                }
                $cuci->no_surat = $request->get('no_surat');
                $cuci->vendor = $request->get('vendor_cuci');
                $cuci->konversi = $request->get('konversi');
                if ($request->get('status') == 'cucian masuk') {
                    $cuci->tanggal_cuci = date('Y-m-d', strtotime($request->get('tanggal_cuci')));
                    $cuci->tanggal_masuk = date('Y-m-d', strtotime($request->get('tanggal_masuk')));
                    $cuci->status = "cucian masuk";
                    $cuci->kain_siap_cuci = $request->get('kain_siap_cuci');
                    if ($cuci->tanggal_cuci == date('Y-m-d')) {
                        $cuci->status_cuci = "proses cuci";
                    } else {
                        $cuci->status_cuci = "belum cuci";
                    }

                    if ($request->get('vendor_cuci') == 'eksternal') {
                        $cuci->nama_vendor = $request->get('nama_vendor');
                        $cuci->harga_vendor = $request->get('harga_vendor');
                        $cuci->status_pembayaran = $request->get('status_pembayaran');
                    }
                    $cuci->save();
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
                        $detail = new DetailCuci();
                        $detail->cuci_id = $cuci->id;
                        $detail->size = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }
                }


                if ($request->get('status') == 'cucian keluar') {
                    $cuci->berhasil_cuci = $request->get('berhasil_cuci');
                    $cuci->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));

                    $cuci->gagal_cuci = $request->get('kain_gagal_cuci');
                    $cuci->barang_direpair = $request->get('barang_direpair');
                    $cuci->barang_dibuang = $request->get('barang_dibuang');
                    $cuci->barang_akan_direpair = $request->get('barang_akan_direpair');
                    $cuci->barang_akan_dibuang = $request->get('barang_akan_dibuang');

                    $cuci->status = "cucian keluar";
                    if ($request->get('vendor_cuci') == 'eksternal') {
                        $cuci->nama_vendor = $request->get('nama_vendor');
                        $cuci->harga_vendor = $request->get('harga_vendor');
                        $cuci->status_pembayaran = $request->get('status_pembayaran');
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
                        $detail = DetailCuci::findOrFail($value['id']);
                        $detail->cuci_id = $cuci->id;
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
                        $detail = new CuciDirepair();
                        $detail->cuci_id = $cuci->id;
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
                        $detail = new CuciDibuang();
                        $detail->cuci_id = $cuci->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }

                    $cuci->keterangan_direpair = $request->get('keterangan_direpair');
                    $cuci->keterangan_dibuang = $request->get('keterangan_dibuang');
                    $cuci->save();

                    $notif = new Notification();
                    $notif->description = "cuci keluar telah masuk ke rekapitulasi, silahkan di cek";
                    $notif->url = route('rekapitulasi.index');
                    $notif->aktif = 0;
                    $notif->save();

                    session(['notification' => 1]);
                }

                DB::commit();
                return redirect()->route('cuci.index')->with('success', $request->get('status') . ' berhasil disimpan');
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
        $cuci = Cuci::findOrFail($id);
        if ($cuci->status == 'cucian masuk') {
            return view("backend.cuci.masuk.show", ['cuci' => $cuci]);
        } else {
            return view("backend.cuci.keluar.show", ['cuci' => $cuci]);
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
        $cuci = Cuci::findOrFail($id);
        if ($cuci->status == 'cucian masuk') {
            return view("backend.cuci.masuk.edit", ['cuci' => $cuci]);
        } else {
            return view("backend.cuci.keluar.edit", ['cuci' => $cuci]);
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
        if ($request->get('status') == 'cucian masuk') {

            if ($request->get('vendor_cuci') == 'internal') {
                $validasi = [

                    'no_surat' => 'required|unique:potongs,no_surat',
                    'tanggal_masuk' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                    'tanggal_cuci' => 'required|date_format:"Y-m-d"|after:tanggal_masuk',
                    'vendor_cuci' => 'required',
                    'kain_siap_cuci' => 'required',
                ];
            } else {
                $validasi = [

                    'no_surat' => 'required|unique:potongs,no_surat',
                    'tanggal_masuk' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                    'tanggal_cuci' => 'required|date_format:"Y-m-d"|after:tanggal_masuk',
                    'vendor_cuci' => 'required',
                    'kain_siap_cuci' => 'required',
                    'status_pembayaran' => 'required',
                    'nama_vendor' => 'required',
                    'harga_vendor' => 'required'
                ];
            }
            $validator = Validator::make($request->all(), $validasi);
        } else {
            $validator = Validator::make($request->all(), [

                'no_surat' => 'required',
                'vendor_cuci' => 'required',
                'tanggal_selesai' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                'berhasil_cuci' => 'required|integer',
                'kain_gagal_cuci' => 'required|integer',
                'konversi' => 'required'
            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {

                $cuci = Cuci::findOrFail($id);
                $cuci->no_surat = $request->get('no_surat');
                $cuci->vendor = $request->get('vendor_cuci');
                $cuci->konversi = $request->get('konversi');
                if ($request->get('status') == 'cucian masuk') {
                    $cuci->tanggal_cuci = date('Y-m-d', strtotime($request->get('tanggal_cuci')));
                    $cuci->tanggal_masuk = date('Y-m-d', strtotime($request->get('tanggal_masuk')));
                    $cuci->status = "cucian masuk";
                    $cuci->kain_siap_cuci = $request->get('kain_siap_cuci');
                    if ($cuci->tanggal_cuci == date('Y-m-d')) {
                        $cuci->status_cuci = "proses cuci";
                    } else {
                        $cuci->status_cuci = "belum cuci";
                    }

                    if ($request->get('vendor_cuci') == 'eksternal') {
                        $cuci->nama_vendor = $request->get('nama_vendor');
                        $cuci->harga_vendor = $request->get('harga_vendor');
                        $cuci->status_pembayaran = $request->get('status_pembayaran');
                    } else {
                        $cuci->nama_vendor = null;
                        $cuci->harga_vendor = null;
                        $cuci->status_pembayaran = null;
                    }
                    $cuci->save();
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
                        $detail = DetailCuci::findOrFail($value['id']);
                        $detail->cuci_id = $cuci->id;
                        $detail->size = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }
                }


                if ($request->get('status') == 'cucian keluar') {
                    $cuci->berhasil_cuci = $request->get('berhasil_cuci');
                    $cuci->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));

                    $cuci->gagal_cuci = $request->get('kain_gagal_cuci');
                    $cuci->barang_direpair = $request->get('barang_direpair');
                    $cuci->barang_dibuang = $request->get('barang_dibuang');
                    $cuci->barang_akan_direpair = $request->get('barang_akan_direpair');
                    $cuci->barang_akan_dibuang = $request->get('barang_akan_dibuang');

                    $cuci->status = "cucian keluar";
                    if ($request->get('vendor_cuci') == 'eksternal') {
                        $cuci->nama_vendor = $request->get('nama_vendor');
                        $cuci->harga_vendor = $request->get('harga_vendor');
                        $cuci->status_pembayaran = $request->get('status_pembayaran');
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
                        $detail = DetailCuci::findOrFail($value['id']);
                        $detail->cuci_id = $cuci->id;
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
                        $detail =  CuciDirepair::findOrFail($value['id']);
                        $detail->cuci_id = $cuci->id;
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
                        $detail =  CuciDibuang::findOrFail($value['id']);
                        $detail->cuci_id = $cuci->id;
                        $detail->ukuran = $value['ukuran'];
                        $detail->jumlah = $value['jumlah'];
                        $detail->save();
                    }

                    $cuci->keterangan_direpair = $request->get('keterangan_direpair');
                    $cuci->keterangan_dibuang = $request->get('keterangan_dibuang');
                    $cuci->save();
                }

                DB::commit();
                return redirect()->route('cuci.index')->with('success', $request->get('status') . ' berhasil diupdate');
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
            $cuci = Cuci::findOrFail($id);
            $status = false;
            if ($cuci->rekapitulasi()->exists()) {
                $status = true;
            }else{
                $cuci->delete();
            }
            return response()->json([
                'status' => $status
            ]);
        }
    }
    public function getDataCuci(Request $request)
    {
        if ($request->ajax()) {
            $cuci = Cuci::with(['detail_cuci', 'jahit' => function ($q) {
                $q->with(['potong' => function ($q) {
                    $q->with('bahan');
                }]);
            }])->where('id', $request->get('id'))->first();

            return response()->json([
                'status' => true,
                'data' => $cuci
            ]);
        }
    }

    public function getDataPrint(Request $request)
    {
        if ($request->ajax()) {
            $cuci = Cuci::findOrFail($request->get('id'));
            $titlecuci = [
                'Kode SKU',
                'Tanggal Selesai Cuci',
                'Berhasil Cuci',
                'Gagal Cuci',
                'Barang Direpair',
                'Keterangan Direpair',
                'Barang Dibuang',
                'Keterangan Dibuang'
            ];

            $x['kode_bahan']=  $cuci->jahit->potong->bahan->kode_bahan;
            $x['title'] = $titlecuci;
            $x['data'] = [
                $cuci->jahit->potong->bahan->sku,
                $cuci->tanggal_selesai,
                $cuci->berhasil_cuci,
                $cuci->gagal_cuci,
                $cuci->barang_direpair,
                $cuci->keterangan_direpair,
                $cuci->barang_dibuang,
                $cuci->keterangan_dibuang,
            ];

            return response()->json([
                'status' => true,
                'data' => $x
            ]);
        }
    }

    public function cetakPdf(Request $request){
        $cuci = Cuci::findOrFail($request->get('id'));
            $titlecuci = [
                'Kode SKU',
                'Tanggal Selesai Cuci',
                'Berhasil Cuci',
                'Gagal Cuci',
                'Barang Direpair',
                'Keterangan Direpair',
                'Barang Dibuang',
                'Keterangan Dibuang'
            ];

            $x['kode_bahan']=  $cuci->jahit->potong->bahan->kode_bahan;
            $x['title'] = $titlecuci;
            $x['data'] = [
                $cuci->jahit->potong->bahan->sku,
                $cuci->tanggal_selesai,
                $cuci->berhasil_cuci,
                $cuci->gagal_cuci,
                $cuci->barang_direpair,
                $cuci->keterangan_direpair,
                $cuci->barang_dibuang,
                $cuci->keterangan_dibuang,
            ];


        $pdf = PDF::loadView('backend.cuci.pdf', ['data' => $x]);
        return $pdf->stream('cuci.pdf');
    }
}
