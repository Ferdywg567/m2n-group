<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DetailPotong;
use App\Potong;
use App\Bahan;

class PotongController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bahan = Bahan::doesntHave('potong')->where('status', 'bahan keluar')->get();
        $masuk = Potong::all()->where('status', 'potong masuk');
        $keluar = Potong::all()->where('status', 'potong masuk')->where('status_potong', 'selesai');
        $datakeluar = Potong::all()->where('status', 'potong keluar')->where('status_potong', 'selesai');
        $proses = Potong::whereDate('tanggal_cutting', date('Y-m-d'))->where('status', 'potong masuk')->update(['status_potong' => 'proses potong']);
        $selesai = Potong::whereDate('tanggal_selesai', date('Y-m-d'))->where('status', 'potong masuk')->update(['status_potong' => 'selesai']);
        return view("backend.potong.index", ['bahan' => $bahan, 'masuk' => $masuk, 'keluar' => $keluar, 'datakeluar' => $datakeluar]);
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

        if ($request->get('status') == 'potong masuk') {
            $validator = Validator::make($request->all(), [
                'kode_bahan' =>  'required',
                'no_surat' => 'required|unique:potongs,no_surat',
                'tanggal_cutting' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                'tanggal_selesai' => 'required|date_format:"Y-m-d"|after:tanggal_cutting',
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
            $html = '';
            $html .= '<div class="alert alert-danger" role="alert">
                ' . $validator->errors()->first() . '
              </div>';

            return response()->json([
                'status' => false,
                'data' => $html
            ]);
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

            $html = '<div class="alert alert-success" role="alert">Data potong berhasil disimpan</div>';
            return response()->json([
                'status' => true,
                'data' => $html
            ]);
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
        //
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
        if ($request->get('status') == 'potong masuk') {
            $validator = Validator::make($request->all(), [
                'no_surat' => 'required',
                'tanggal_cutting' => 'required|date_format:"Y-m-d"|after_or_equal:' . date('Y-m-d'),
                'tanggal_selesai' => 'required|date_format:"Y-m-d"|after:tanggal_cutting',
                'hasil_cutting' => 'required',
                'konversi' => 'required'
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
                'sku' => 'required'
            ]);
        }

        if ($validator->fails()) {
            $html = '';
            $html .= '<div class="alert alert-danger" role="alert">
                ' . $validator->errors()->first() . '
              </div>';

            return response()->json([
                'status' => false,
                'data' => $html
            ]);
        } else {
            $jumlah = $request->get('jumlah');
            $dataukuran = $request->get('dataukuran');
            $iddetail = $request->get('iddetailukuran');
            $hasil_cut = $request->get('hasil_cutting');
            $arr = [];
            $sum = 0;
            foreach ($dataukuran as $key => $value) {
                if ($jumlah[$key] >= 0 && !empty($iddetail[$key])) {
                    $x['id'] = $iddetail[$key];
                    $x['ukuran'] = $value;
                    $x['jumlah'] = $jumlah[$key];
                    array_push($arr, $x);
                }
            }
            // return response()->json($iddetail);
            $potong = Potong::findOrFail($request->get('id'));
            $potong->no_surat = $request->get('no_surat');
            $potong->tanggal_cutting = date('Y-m-d', strtotime($request->get('tanggal_cutting')));
            $potong->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));
            $potong->hasil_cutting = $request->get('hasil_cutting');
            $potong->konversi = $request->get('konversi');
            if ($request->get('status') == 'potong masuk') {
                $potong->status = "potong masuk";
                if ($potong->tanggal_cutting == date('Y-m-d')) {
                    $potong->status_potong = "proses potong";
                } else {
                    $potong->status_potong = "belum potong";
                }
            } else {
                $potong->status = "potong keluar";
            }
            $potong->save();
            foreach ($arr as $key => $value) {
                $detail = DetailPotong::findOrFail($value['id']);
                $detail->size = $value['ukuran'];
                $detail->jumlah = $value['jumlah'];
                $detail->save();
            }



            $html = '<div class="alert alert-success" role="alert">Data potong berhasil diupdate</div>';
            return response()->json([
                'status' => true,
                'data' => $html
            ]);
        }
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
}
