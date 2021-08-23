<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DetailPotong;
use App\Potong;
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
        $proses = Potong::whereDate('tanggal_cutting', date('Y-m-d'))->where('status', 'potong masuk')->update(['status_potong' => 'proses potong']);
        $selesai = Potong::whereDate('tanggal_selesai', date('Y-m-d'))->where('status', 'potong masuk')->update(['status_potong' => 'selesai']);
        $bahan = Bahan::doesntHave('potong')->where('status', 'bahan keluar')->get();
        $masuk = Potong::where('status', 'potong masuk')->orderBy('created_at','DESC')->get();
        $keluar = Potong::all()->where('status', 'potong masuk')->where('status_potong', 'selesai');
        $datakeluar = Potong::where('status', 'potong keluar')->where('status_potong', 'selesai')->orderBy('created_at','DESC')->get();
        return view("backend.potong.index", ['bahan' => $bahan, 'masuk' => $masuk, 'keluar' => $keluar, 'datakeluar' => $datakeluar]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->get('status') == 'masuk') {
            $bahan = Bahan::doesntHave('potong')->where('status', 'bahan keluar')->get();
            return view("backend.potong.masuk.create", ['bahan' => $bahan]);
        } else {
            $keluar = Potong::all()->where('status', 'potong masuk')->where('status_potong', 'selesai');
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
                'kode_bahan' =>  'required',
                'no_surat' => 'required|unique:potongs,no_surat',
                'tanggal_cutting' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                'tanggal_selesai' => 'required|date_format:"Y-m-d"|after_or_equal:tanggal_cutting',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_bahan' =>  'required',
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

            if ($request->get('status') == 'potong keluar') {
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
            }


            if ($request->get('status') == 'potong masuk') {
                $potong = new Potong();
                $potong->bahan_id = $request->get('kode_bahan');
            } else {
                $potong = Potong::findOrFail($request->get('kode_bahan'));
            }
            $potong->no_surat = $request->get('no_surat');
            if ($request->get('status') == 'potong masuk') {
                $potong->tanggal_cutting = date('Y-m-d', strtotime($request->get('tanggal_cutting')));
                $potong->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));
                $potong->status = "potong masuk";
                if ($potong->tanggal_cutting == date('Y-m-d')) {
                    $potong->status_potong = "proses potong";
                } else {
                    $potong->status_potong = "belum potong";
                }
            } else {
                $potong->hasil_cutting = $request->get('hasil_cutting');
                $potong->tanggal_keluar =  date('Y-m-d', strtotime($request->get('tanggal_keluar')));
                $potong->konversi = $request->get('konversi');
                $potong->status = "potong keluar";
            }
            $potong->save();

            if ($request->get('status') == 'potong keluar') {
                foreach ($arr as $key => $value) {
                    $detail = new DetailPotong();
                    $detail->potong_id = $potong->id;
                    $detail->size = $value['ukuran'];
                    $detail->jumlah = $value['jumlah'];
                    $detail->save();
                }
            }


            return redirect()->route('potong.index')->with('success', $request->get('status') . ' berhasil disimpan');
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
        }else{
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
            $validator = Validator::make($request->all(), [
                'no_surat' => 'required',
                'tanggal_cutting' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                'tanggal_selesai' => 'required|date_format:"Y-m-d"|after_or_equal:tanggal_cutting',
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

            if ($request->get('status') == 'potong keluar') {
                $jumlah = $request->get('jumlah');
                $dataukuran = $request->get('dataukuran');
                $detail = $request->get('iddetailukuran');
                $arr = [];
                foreach ($dataukuran as $key => $value) {
                    if (!empty($jumlah[$key])) {
                        $x['ukuran'] = $value;
                        $x['id'] = $detail[$key];
                        $x['jumlah'] = $jumlah[$key];
                        array_push($arr, $x);
                    }
                }
            }


            $potong = Potong::findOrFail($id);
            $potong->no_surat = $request->get('no_surat');
            if ($request->get('status') == 'potong masuk') {
                $potong->tanggal_cutting = date('Y-m-d', strtotime($request->get('tanggal_cutting')));
                $potong->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));
                $potong->status = "potong masuk";
                if ($potong->tanggal_cutting == date('Y-m-d')) {
                    $potong->status_potong = "proses potong";
                } else {
                    $potong->status_potong = "belum potong";
                }
            } else {
                $potong->hasil_cutting = $request->get('hasil_cutting');
                $potong->tanggal_keluar =  date('Y-m-d', strtotime($request->get('tanggal_keluar')));
                $potong->konversi = $request->get('konversi');
                $potong->status = "potong keluar";
            }
            $potong->save();

            if ($request->get('status') == 'potong keluar') {
                foreach ($arr as $key => $value) {
                    $detail =  DetailPotong::find($value['id']);
                    $detail->potong_id = $potong->id;
                    $detail->size = $value['ukuran'];
                    $detail->jumlah = $value['jumlah'];
                    $detail->save();
                }
            }

            return redirect()->route('potong.index')->with('success', $request->get('status') . ' berhasil diupdate');
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
            }else{
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
            $potong = Potong::with(['detail_potong', 'bahan'])->where('id', $request->get('id'))->first();

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
            $x['kode_bahan']=  $potong->bahan->kode_bahan;
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

    public function cetakPdf(Request $request){
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
        $x['kode_bahan']=  $potong->bahan->kode_bahan;
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
}
