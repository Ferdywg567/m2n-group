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
use App\DetailJahit;
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
        // Cuci::query()->update(['status_cuci' => 'selesai']);
        $cuci = Cuci::where('status', 'cucian masuk')->orderBy('created_at', 'DESC')->get();
        $selesai = Cuci::where('status', 'cucian selesai')->orderBy('created_at', 'DESC')->get();
        $keluar = Cuci::where('status', 'cucian keluar')->orderBy('created_at', 'DESC')->get();
        return view("backend.cuci.index", ['cuci' => $cuci, 'keluar' => $keluar, 'selesai' => $selesai]);
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
            $jahit = Jahit::where('status', 'jahitan keluar')->where('status_jahit', 'selesai')->doesntHave('cuci')->orderBy('created_at', 'DESC')->get();
            return view("backend.cuci.masuk.create", ['jahit' => $jahit]);
        } else  if ($status == 'selesai') {
            $cuci = Cuci::where('status', 'cucian masuk')->get();
            return view("backend.cuci.selesai.create", ['cuci' => $cuci]);
        } else {
            $cuci = Cuci::where('status', 'cucian selesai')->get();
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
            // dd($request->all());
            $validasi = [
                'kode_transaksi' =>  'required',
                'no_surat' => 'required|unique:cucis,no_surat',
                'tanggal_cuci' => 'required|date_format:"Y-m-d"',
                'estimasi_selesai_cuci' => 'required|date_format:"Y-m-d"',
                'jumlah_bahan_yang_dicuci' => 'required',
                'nama_vendor' => 'required',
                'harga_vendor' => 'required'
            ];
            $validator = Validator::make($request->all(), $validasi);
        } else if ($request->get('status') == 'cucian selesai') {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'no_surat' => 'required',
                'berhasil_cuci' => 'required|integer',
                'nama_vendor' => 'required',
                'harga_vendor' => 'required',
                'jumlah_bahan' => 'required',
                'gagal_cuci' => 'required',
                'barang_direpair' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',

            ]);
        }

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {

                if ($request->get('status') == 'cucian masuk') {
                    $cuci = new Cuci();
                    $cuci->jahit_id = $request->get('kode_transaksi');
                } else {
                    $cuci = Cuci::findOrFail($request->get('kode_transaksi'));
                }
                $cuci->no_surat = $request->get('no_surat');
                $cuci->vendor = 'eksternal';

                if ($request->get('status') == 'cucian masuk') {
                    $cuci->tanggal_cuci = date('Y-m-d', strtotime($request->get('tanggal_cuci')));
                    $cuci->tanggal_selesai = date('Y-m-d', strtotime($request->get('estimasi_selesai_cuci')));
                    $cuci->status = "cucian masuk";
                    $cuci->kain_siap_cuci = $request->get('jumlah_bahan_yang_dicuci');
                    $cuci->konversi = $request->get('konversi');
                    // if ($cuci->tanggal_cuci == date('Y-m-d')) {
                    //     $cuci->status_cuci = "proses cuci";
                    // } else {
                    //     $cuci->status_cuci = "belum cuci";
                    // }
                    $cuci->status_cuci = "selesai";
                    $cuci->nama_vendor = $request->get('nama_vendor');
                    $cuci->harga_vendor = $request->get('harga_vendor');
                    $cuci->status_pembayaran = "Belum Lunas";
                    $totalbayar = $cuci->kain_siap_cuci * $cuci->harga_vendor;
                    $cuci->total_harga = $totalbayar;
                    $cuci->sisa_bayar = $totalbayar;
                    $cuci->save();
                    // $cuci->status_pembayaran = $request->get('status_pembayaran');
                    $detail = DetailJahit::where('jahit_id',  $cuci->jahit_id)->get();
                    foreach ($detail as $key => $value) {
                        $detail = new DetailCuci();
                        $detail->cuci_id = $cuci->id;
                        $detail->size = $value->size;
                        $detail->jumlah = $value->jumlah;
                        $detail->save();
                    }
                }

                if ($request->get('status') == 'cucian selesai') {
                    $cuci->berhasil_cuci = $request->get('berhasil_cuci');
                    $cuci->gagal_cuci = $request->get('gagal_cuci');
                    $cuci->barang_direpair = $request->get('barang_direpair');
                    $cuci->barang_dibuang = $request->get('barang_dibuang');
                    $cuci->status_cuci = "selesai";
                    $cuci->status = "cucian selesai";
                    $cuci->nama_vendor = $request->get('nama_vendor');
                    $cuci->harga_vendor = $request->get('harga_vendor');
                    $direpair = $request->get('jumlahdirepair');
                    $dibuang = $request->get('jumlahdibuang');
                    $cuci->konversi = $request->get('konversi');
                    $detailcuci = DetailCuci::where('cuci_id', $cuci->id)->get();

                    foreach ($detailcuci as $key => $value) {
                        $cek = DetailCuci::where('cuci_id', $cuci->id)->where('size', $value->size)->first();
                        if ($cek) {
                            $jumdirepair = $direpair[$key];
                            if ($jumdirepair < 0 || $jumdirepair == null) {
                                $jumdirepair = 0;
                            }

                            $jumdibuang = $dibuang[$key];
                            if ($jumdibuang < 0 || $jumdibuang == null) {
                                $jumdibuang = 0;
                            }

                            $cek->jumlah = $cek->jumlah - $jumdibuang - $jumdirepair;
                            $cek->save();
                        }
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
                }
                if ($request->get('status') == 'cucian keluar') {
                    $cuci->tanggal_keluar = date('Y-m-d');
                    $cuci->status = "cucian keluar";
                    $cuci->save();
                    $notif = new Notification();
                    $notif->description = "cuci keluar telah dikirim ke gudang, silahkan di cek";
                    $notif->url = route('cuci.index');
                    $notif->aktif = 0;
                    $notif->role = 'production';
                    $notif->save();

                    $notif = new Notification();
                    $notif->description = "cuci keluar telah dikirim ke gudang, silahkan di cek";
                    $notif->url = route('warehouse.finishing.index');
                    $notif->aktif = 0;
                    $notif->role = 'warehouse';
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
        } elseif ($cuci->status == 'cucian selesai') {
            // dd($cuci);
            return view("backend.cuci.selesai.show", ['cuci' => $cuci]);
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
        } elseif ($cuci->status == 'cucian selesai') {
            return view("backend.cuci.selesai.edit", ['cuci' => $cuci]);
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
            $cuci = Cuci::findOrFail($id);
            $validasi = [
                'no_surat' => 'required',
                'tanggal_cuci' => 'required|date_format:"Y-m-d"',
                'estimasi_selesai_cuci' => 'required|date_format:"Y-m-d"',
                'jumlah_bahan_yang_dicuci' => 'required',
                'nama_vendor' => 'required',
                'harga_vendor' => 'required'
            ];
            $validator = Validator::make($request->all(), $validasi);
        } elseif ($request->get('status') == 'cucian selesai') {
            $validasi = [
                'no_surat' => 'required',
                'nama_vendor' => 'required',
                'harga_vendor' => 'required',
                'jumlah_bahan' => 'required',
                'gagal_cuci' => 'required',
                'barang_direpair' => 'required',
            ];
            $validator = Validator::make($request->all(), $validasi);
        } else {
            $validator = Validator::make($request->all(), [
                'no_surat' => 'required',
                'vendor_cuci' => 'required',
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
                $cuci->konversi = $request->get('konversi');
                if ($request->get('status') == 'cucian masuk') {
                    // $cuci->tanggal_cuci = date('Y-m-d', strtotime($request->get('tanggal_mulai_cuci')));
                    // $cuci->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai_cuci')));

                    // if ($cuci->tanggal_cuci == date('Y-m-d')) {
                    //     $cuci->status_cuci = "proses cuci";
                    // } else {
                    //     $cuci->status_cuci = "belum cuci";
                    // }
                    $cuci->nama_vendor = $request->get('nama_vendor');
                    $cuci->harga_vendor = $request->get('harga_vendor');
                    $cuci->save();
                }

                if ($request->get('status') == 'cucian selesai') {
                    $cuci->berhasil_cuci = $request->get('berhasil_cuci');
                    $cuci->gagal_cuci = $request->get('gagal_cuci');
                    $cuci->barang_direpair = $request->get('barang_direpair');
                    $cuci->barang_dibuang = $request->get('barang_dibuang');
                    $cuci->nama_vendor = $request->get('nama_vendor');
                    $cuci->harga_vendor = $request->get('harga_vendor');
                    $cuci->status_pembayaran = '';

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
                    CuciDirepair::where('cuci_id', $cuci->id)->delete();

                    foreach ($arr as $key => $value) {
                        $detail = new CuciDirepair;
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

                            $x['ukuran'] = $value;
                            $x['jumlah'] = $jumlah[$key];
                            array_push($arr, $x);
                        }
                    }
                    CuciDibuang::where('cuci_id', $cuci->id)->delete();
                    foreach ($arr as $key => $value) {
                        $detail =  new CuciDibuang;
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
            } else {
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
            $cuci = Cuci::with(['detail_cuci', 'cuci_dibuang', 'cuci_direpair', 'jahit' => function ($q) {
                $q->with(['potong' => function ($q) {
                    $q->with(['bahan'  => function ($q) {
                        $q->with(['detail_sub' => function ($q) {
                            $q->with(['sub_kategori' => function ($q) {
                                $q->with('kategori');
                            }]);
                        }]);
                    }]);
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

            $x['kode_bahan'] =  $cuci->jahit->potong->bahan->kode_transaksi;
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

    public function cetakPdf(Request $request)
    {

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

        $x['kode_bahan'] =  $cuci->jahit->potong->bahan->kode_transaksi;
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

    public function pembayaranVendor(Request $request, $id)
    {
        $cuci = Cuci::where('id', $id)->where('status_pembayaran', 'Termin')->firstOrFail();
        return view("backend.cuci.pembayaran.edit", ['cuci' => $cuci]);
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
            $cuci = Cuci::where('id', $id)->where('status_pembayaran', 'Termin')->firstOrFail();

            if ($request->has('pembayaran_pertama')) {
                $cuci->pembayaran_pertama = $request->get('pembayaran_pertama');
                $cuci->sisa_bayar = $cuci->sisa_bayar -  $request->get('pembayaran_pertama');
            }

            if ($request->has('pembayaran_kedua')) {
                $cuci->pembayaran_kedua = $request->get('pembayaran_kedua');
                $cuci->sisa_bayar = $cuci->sisa_bayar -  $request->get('pembayaran_kedua');
            }

            if ($request->has('pembayaran_ketiga')) {
                $cuci->pembayaran_ketiga = $request->get('pembayaran_ketiga');
                $cuci->sisa_bayar = $cuci->sisa_bayar -  $request->get('pembayaran_ketiga');
            }

            if ($cuci->pembayaran_pertama > 0) {
                $total = $cuci->pembayaran_pertama;
                if ($total >= $cuci->total_bayar) {
                    $cuci->status_pembayaran = 'Lunas';
                }
            }

            if ($cuci->pembayaran_pertama > 0 && $cuci->pembayaran_kedua > 0) {
                $total = $cuci->pembayaran_pertama + $cuci->pembayaran_kedua;
                if ($total >= $cuci->total_bayar) {
                    $cuci->status_pembayaran = 'Lunas';
                }
            }

            if ($cuci->pembayaran_pertama > 0 && $cuci->pembayaran_kedua > 0 && $cuci->pembayaran_ketiga > 0) {
                $total = $cuci->pembayaran_pertama + $cuci->pembayaran_kedua + $cuci->pembayaran_ketiga;
                if ($total >= $cuci->total_bayar) {
                    $cuci->status_pembayaran = 'Lunas';
                }
            }
            $cuci->save();
            return redirect()->route('cuci.index')->with('success',  'Pembayaran berhasil diupdate');
        }
    }
}
