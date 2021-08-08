<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Jahit;
use App\Potong;
use App\Cuci;
use Illuminate\Http\Request;

class PrintController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $dari = date('Y-m-d', strtotime($request->get('dari')));
            $sampai = date('Y-m-d', strtotime($request->get('sampai')));

            // $potong = Potong::with('bahan')->whereBetween('created_at', [$dari, $sampai])->get();
            $potong = Potong::with('bahan')->get();
            $jahit = Jahit::with(['potong'=> function($q){
                $q->with('bahan');
            }])->get();
            $cuci = Cuci::with(['jahit'=> function($q){
                $q->with(['potong'=> function($q){
                    $q->with('bahan');
                }]);
            }])->get();
            $data = [];
            $tes = [];
            $titlepotong = [
                'Kode SKU',
                'Tanggal Cutting',
                'Tanggal Selesai',
                'Hasil Cutting',
                'Jenis Kain',
                'Warna Kain',
                'Nama Produk'
            ];


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

            foreach ($potong as $key => $value) {
                $x['menu'] = 'CUTTING';
                $x['title'] = $titlepotong;
                $x['data'] = [
                    $value->bahan->sku,
                    $value->tanggal_cutting,
                    $value->tanggal_selesai,
                    $value->hasil_cutting,
                    $value->bahan->jenis_bahan,
                    $value->bahan->warna,
                    $value->bahan->nama_bahan,

                ];
                array_push($data, $x);
            }

            foreach ($jahit as $key => $value) {
                $x['menu'] = 'TAILORING';
                $x['title'] = $titlejahit;
                $x['data'] = [
                    $value->potong->bahan->sku,
                    $value->tanggal_selesai,
                    $value->vendor,
                    $value->berhasil,
                    $value->gagal_jahit,
                    $value->barang_direpair,
                    $value->keterangan_direpair,
                    $value->barang_dibuang,
                    $value->keterangan_dibuang,
                ];
                array_push($data, $x);
            }

            return response()->json(['print' => $data]);
        }
        return view("backend.print.index");
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
        //
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
}
