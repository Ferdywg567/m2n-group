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
        return view("backend.potong.index", ['bahan' => $bahan, 'masuk' => $masuk]);
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
                'no_surat' => 'required',
                'tanggal_cutting' => 'required',
                'tanggal_selesai' => 'required',
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
            $hasil_cut = $request->get('hasil_cutting');
            $arr = [];
            $sum = 0;
            foreach ($dataukuran as $key => $value) {
                if (!empty($jumlah[$key])) {
                    $x['ukuran'] = $value;
                    $x['jumlah'] = $jumlah[$key];
                    array_push($arr, $x);
                }
            }
            if ($request->get('status') == 'potong masuk') {
                $potong = new Potong();
                $potong->bahan_id = $request->get('kode_bahan');
            } else {
                $potong = Potong::findOrFail($request->get('kode_bahan'));
            }
            $potong->no_surat = $request->get('no_surat');
            $potong->tanggal_cutting = date('Y-m-d', strtotime($request->get('tanggal_cutting')));
            $potong->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));
            $potong->hasil_cutting = $request->get('hasil_cutting');
            $potong->konversi = $request->get('konversi');
            if ($request->get('status') == 'potong masuk') {
                $potong->status = "potong masuk";
            } else {
                $potong->status = "potong keluar";
            }
            $potong->save();

            foreach ($arr as $key => $value) {
                $detail = new DetailPotong();
                $detail->potong_id = $potong->id;
                $detail->size = $value['ukuran'];
                $detail->jumlah = $value['jumlah'];
                $detail->save();
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
                'tanggal_cutting' => 'required',
                'tanggal_selesai' => 'required',
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
