<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Potong;
use App\Jahit;

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
        $datakeluar = Potong::where('status', 'potong keluar')->where('status_potong', 'selesai')->doesntHave('jahit');
        $jahitmasuk = Jahit::all()->where('status', 'jahitan masuk');
        return view("backend.jahit.index", ['datakeluar' => $datakeluar, 'jahitmasuk' => $jahitmasuk]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $datakeluar = Potong::where('status', 'potong keluar')->where('status_potong', 'selesai')->doesntHave('jahit');
        return view("backend.jahit.create", ['datakeluar' => $datakeluar]);
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

            // if ($request->get('status') == 'potong keluar') {
            //     $jumlah = $request->get('jumlah');
            //     $dataukuran = $request->get('dataukuran');
            //     $arr = [];
            //     foreach ($dataukuran as $key => $value) {
            //         if (!empty($jumlah[$key])) {
            //             $x['ukuran'] = $value;
            //             $x['jumlah'] = $jumlah[$key];
            //             array_push($arr, $x);
            //         }
            //     }
            // }


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
                }
            } else {
                $jahit->hasil_cutting = $request->get('hasil_cutting');
                $jahit->tanggal_keluar =  date('Y-m-d', strtotime($request->get('tanggal_keluar')));
                $jahit->konversi = $request->get('konversi');
                $jahit->status = "potong keluar";
            }
            $jahit->save();

            // if ($request->get('status') == 'potong keluar') {
            //     foreach ($arr as $key => $value) {
            //         $detail = new DetailPotong();
            //         $detail->potong_id = $potong->id;
            //         $detail->size = $value['ukuran'];
            //         $detail->jumlah = $value['jumlah'];
            //         $detail->save();
            //     }
            // }

            $html = '<div class="alert alert-success" role="alert">Data jahit berhasil disimpan</div>';
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
        //
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
}
