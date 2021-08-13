<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Rekapitulasi;
use App\Perbaikan;
use App\Jahit;
use App\Potong;
use App\Cuci;
use App\Sampah;
use PDF;
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
            $validator = Validator::make($request->all(), [
                'dari' => 'required',
                'sampai' => 'required',
                'menu' => 'required',
                'menu.*' => 'required',
            ]);

            if ($validator->fails()) {
                $error = '<div class="alert alert-danger" role="alert">
               ' . $validator->errors()->first() . '
              </div>';
                return response()->json([
                    'status' => false,
                    'data' => $error
                ]);
            }

            $dari = date('Y-m-d', strtotime($request->get('dari')));
            $sampai = date('Y-m-d', strtotime($request->get('sampai')));
            $menu = $request->get('menu');
            // $potong = Potong::with('bahan')->whereBetween('created_at', [$dari, $sampai])->get();
            $potong = Potong::with('bahan')->whereBetween('created_at', [$dari, $sampai])->get();
            $jahit = Jahit::with(['potong' => function ($q) {
                $q->with('bahan');
            }])->whereBetween('created_at', [$dari, $sampai])->get();
            $cuci = Cuci::with(['jahit' => function ($q) {
                $q->with(['potong' => function ($q) {
                    $q->with('bahan');
                }]);
            }])->whereBetween('created_at', [$dari, $sampai])->get();
            $perbaikan = Perbaikan::whereBetween('created_at', [$dari, $sampai])->get();
            $sampah = Sampah::whereBetween('created_at', [$dari, $sampai])->get();
            $rekap = Rekapitulasi::whereBetween('created_at', [$dari, $sampai])->get();
            $data = [];
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

            $titlerepair = [
                'Kode SKU',
                'Jenis Bahan',
                'Nama Produk',
                'Ukuran Baju',
                'Warna Produk',
                'Asal Barang',
                'Keterangan',
                'Total Barang Direpair',
                'Tanggal Selesai Repair',
                'Tanggal Kirim Barang'
            ];


            $titletrash = [
                'Kode SKU',
                'Jenis Bahan',
                'Nama Produk',
                'Ukuran Baju',
                'Warna Produk',
                'Asal Barang',
                'Keterangan',
                'Total Barang Dibuang',
            ];


            $titlerekap = [
                'Kode SKU',
                'Tanggal Selesai Cuci',
                'Jenis Bahan',
                'Nama Produk',
                'Ukuran Baju',
                'Warna Produk',
                'Tanggal Barang Masuk',
                'Tanggal Barang Dikirim',
                'Total Barang Siap Quality Control',
            ];

            foreach ($menu as $key => $list) {
                if ($list == 'CUTTING') {
                    foreach ($potong as $key => $value) {
                        $x['menu'] = 'CUTTING';
                        $x['icon'] = '<i class="fas fa-cut"></i>';
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
                } elseif ($list == 'TAILORING') {
                    foreach ($jahit as $key => $value) {
                        $x['menu'] = 'TAILORING';
                        $x['icon'] = '<i class="fas fa-user-cog"></i>';
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
                } elseif ($list == 'WASHING') {
                    foreach ($cuci as $key => $value) {
                        $x['menu'] = 'WASHING';
                        $x['icon'] = '<i class="ri-hand-coin-fill"></i>';
                        $x['title'] = $titlecuci;
                        $x['data'] = [
                            $value->jahit->potong->bahan->sku,
                            $value->tanggal_selesai,
                            $value->berhasil_cuci,
                            $value->gagal_cuci,
                            $value->barang_direpair,
                            $value->keterangan_direpair,
                            $value->barang_dibuang,
                            $value->keterangan_dibuang,
                        ];
                        array_push($data, $x);
                    }
                } elseif ($list == 'REPAIR') {
                    foreach ($perbaikan as $key => $value) {
                        $x['menu'] = 'REPAIR';
                        $x['icon'] = '<i class="fa fa-tools"></i>';
                        $x['title'] = $titlerepair;

                        $jumlahjahit = 0;
                        $jumlahcuci = 0;
                        $keteranganjahit = '';
                        $keterangancuci = '';
                        foreach ($value->detail_perbaikan as $key => $row) {
                            if (!empty($row->jahit_direpair_id)) {
                                $jumlahjahit = $row->jumlah;
                                $keteranganjahit = $row->keterangan;
                            }

                            if (!empty($row->cuci_direpair_id)) {
                                $jumlahcuci = $row->jumlah;
                                $keterangancuci = $row->keterangan;
                            }
                        }

                        $keterangan = 'Washing : ' . $keterangancuci . '<br>' . 'Tailoring : ' . $keteranganjahit;
                        $asalbarang = 'Washing : ' . $jumlahcuci . '<br>' . 'Tailoring : ' . $jumlahjahit;
                        $x['data'] = [
                            $value->bahan->sku,
                            $value->bahan->jenis_bahan,
                            $value->bahan->nama_bahan,
                            $value->ukuran,
                            $value->bahan->warna,
                            $asalbarang,
                            $keterangan,
                            $value->total,
                            $value->tanggal_selesai,
                            $value->tanggal_kirim,
                        ];
                        array_push($data, $x);
                    }
                } elseif ($list == 'TRASH') {
                    foreach ($sampah as $key => $value) {
                        $x['menu'] = 'TRASH';
                        $x['icon'] = '<i class="fas fa-trash"></i>';
                        $x['title'] = $titletrash;

                        $jumlahjahit = 0;
                        $jumlahcuci = 0;
                        $keteranganjahit = '';
                        $keterangancuci = '';
                        foreach ($value->detail_sampah as $key => $row) {
                            if (!empty($row->jahit_dibuang_id)) {
                                $jumlahjahit = $row->jumlah;
                                $keteranganjahit = $row->keterangan;
                            }

                            if (!empty($row->cuci_dibuang_id)) {
                                $jumlahcuci = $row->jumlah;
                                $keterangancuci = $row->keterangan;
                            }
                        }

                        $keterangan = 'Washing : ' . $keterangancuci . '<br>' . 'Tailoring : ' . $keteranganjahit;
                        $asalbarang = 'Washing : ' . $jumlahcuci . '<br>' . 'Tailoring : ' . $jumlahjahit;
                        $x['data'] = [
                            $value->bahan->sku,
                            $value->bahan->jenis_bahan,
                            $value->bahan->nama_bahan,
                            $value->ukuran,
                            $value->bahan->warna,
                            $asalbarang,
                            $keterangan,
                            $value->total,
                        ];
                        array_push($data, $x);
                    }
                } elseif ($list == 'RECAPITULATION') {
                    foreach ($rekap as $key => $value) {
                        $x['menu'] = 'RECAPITULATION';
                        $x['icon'] = '<i class="fas fa-file"></i>';
                        $x['title'] = $titlerekap;
                        $ukuran = '';

                        foreach ($value->detail_rekap as $key => $row) {
                            $ukuran .= $row->ukuran . ',';
                        }
                        $x['data'] = [
                            $value->cuci->jahit->potong->bahan->sku,
                            $value->cuci->tanggal_selesai,
                            $value->cuci->jahit->potong->bahan->jenis_bahan,
                            $value->cuci->jahit->potong->bahan->nama_bahan,
                            $ukuran,
                            $value->cuci->jahit->potong->bahan->warna,
                            $value->cuci->jahit->potong->bahan->tanggal_masuk,
                            $value->tanggal_kirim,
                            $value->total_barang,
                        ];
                        array_push($data, $x);
                    }
                }
            }

            return response()->json(['print' => $data, 'status' => true]);
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
        $validator = Validator::make($request->all(), [
            'dari' => 'required',
            'sampai' => 'required',
            'menu' => 'required',
            'menu.*' => 'required',
        ]);

        if ($validator->fails()) {
            $error = '<div class="alert alert-danger" role="alert">
           ' . $validator->errors()->first() . '
          </div>';
            return response()->json([
                'status' => false,
                'data' => $error
            ]);
        }

        $dari = date('Y-m-d', strtotime($request->get('dari')));
        $sampai = date('Y-m-d', strtotime($request->get('sampai')));
        $menu = $request->get('menu');
        // $potong = Potong::with('bahan')->whereBetween('created_at', [$dari, $sampai])->get();
        $potong = Potong::with('bahan')->whereBetween('created_at', [$dari, $sampai])->get();
        $jahit = Jahit::with(['potong' => function ($q) {
            $q->with('bahan');
        }])->whereBetween('created_at', [$dari, $sampai])->get();
        $cuci = Cuci::with(['jahit' => function ($q) {
            $q->with(['potong' => function ($q) {
                $q->with('bahan');
            }]);
        }])->whereBetween('created_at', [$dari, $sampai])->get();
        $perbaikan = Perbaikan::whereBetween('created_at', [$dari, $sampai])->get();
        $sampah = Sampah::whereBetween('created_at', [$dari, $sampai])->get();
        $rekap = Rekapitulasi::whereBetween('created_at', [$dari, $sampai])->get();
        $data = [];
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

        $titlerepair = [
            'Kode SKU',
            'Jenis Bahan',
            'Nama Produk',
            'Ukuran Baju',
            'Warna Produk',
            'Asal Barang',
            'Keterangan',
            'Total Barang Direpair',
            'Tanggal Selesai Repair',
            'Tanggal Kirim Barang'
        ];


        $titletrash = [
            'Kode SKU',
            'Jenis Bahan',
            'Nama Produk',
            'Ukuran Baju',
            'Warna Produk',
            'Asal Barang',
            'Keterangan',
            'Total Barang Dibuang',
        ];


        $titlerekap = [
            'Kode SKU',
            'Tanggal Selesai Cuci',
            'Jenis Bahan',
            'Nama Produk',
            'Ukuran Baju',
            'Warna Produk',
            'Tanggal Barang Masuk',
            'Tanggal Barang Dikirim',
            'Total Barang Siap Quality Control',
        ];

        foreach ($menu as $key => $list) {
            if ($list == 'CUTTING') {
                foreach ($potong as $key => $value) {
                    $x['menu'] = 'CUTTING';
                    $x['icon'] = '<i class="fas fa-cut"></i>';
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
            } elseif ($list == 'TAILORING') {
                foreach ($jahit as $key => $value) {
                    $x['menu'] = 'TAILORING';
                    $x['icon'] = '<i class="fas fa-user-cog"></i>';
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
            } elseif ($list == 'WASHING') {
                foreach ($cuci as $key => $value) {
                    $x['menu'] = 'WASHING';
                    $x['icon'] = '<i class="ri-hand-coin-fill"></i>';
                    $x['title'] = $titlecuci;
                    $x['data'] = [
                        $value->jahit->potong->bahan->sku,
                        $value->tanggal_selesai,
                        $value->berhasil_cuci,
                        $value->gagal_cuci,
                        $value->barang_direpair,
                        $value->keterangan_direpair,
                        $value->barang_dibuang,
                        $value->keterangan_dibuang,
                    ];
                    array_push($data, $x);
                }
            } elseif ($list == 'REPAIR') {
                foreach ($perbaikan as $key => $value) {
                    $x['menu'] = 'REPAIR';
                    $x['icon'] = '<i class="fa fa-tools"></i>';
                    $x['title'] = $titlerepair;

                    $jumlahjahit = 0;
                    $jumlahcuci = 0;
                    $keteranganjahit = '';
                    $keterangancuci = '';
                    foreach ($value->detail_perbaikan as $key => $row) {
                        if (!empty($row->jahit_direpair_id)) {
                            $jumlahjahit = $row->jumlah;
                            $keteranganjahit = $row->keterangan;
                        }

                        if (!empty($row->cuci_direpair_id)) {
                            $jumlahcuci = $row->jumlah;
                            $keterangancuci = $row->keterangan;
                        }
                    }

                    $keterangan = 'Washing : ' . $keterangancuci . '<br>' . 'Tailoring : ' . $keteranganjahit;
                    $asalbarang = 'Washing : ' . $jumlahcuci . '<br>' . 'Tailoring : ' . $jumlahjahit;
                    $x['data'] = [
                        $value->bahan->sku,
                        $value->bahan->jenis_bahan,
                        $value->bahan->nama_bahan,
                        $value->ukuran,
                        $value->bahan->warna,
                        $asalbarang,
                        $keterangan,
                        $value->total,
                        $value->tanggal_selesai,
                        $value->tanggal_kirim,
                    ];
                    array_push($data, $x);
                }
            } elseif ($list == 'TRASH') {
                foreach ($sampah as $key => $value) {
                    $x['menu'] = 'TRASH';
                    $x['icon'] = '<i class="fas fa-trash"></i>';
                    $x['title'] = $titletrash;

                    $jumlahjahit = 0;
                    $jumlahcuci = 0;
                    $keteranganjahit = '';
                    $keterangancuci = '';
                    foreach ($value->detail_sampah as $key => $row) {
                        if (!empty($row->jahit_dibuang_id)) {
                            $jumlahjahit = $row->jumlah;
                            $keteranganjahit = $row->keterangan;
                        }

                        if (!empty($row->cuci_dibuang_id)) {
                            $jumlahcuci = $row->jumlah;
                            $keterangancuci = $row->keterangan;
                        }
                    }

                    $keterangan = 'Washing : ' . $keterangancuci . '<br>' . 'Tailoring : ' . $keteranganjahit;
                    $asalbarang = 'Washing : ' . $jumlahcuci . '<br>' . 'Tailoring : ' . $jumlahjahit;
                    $x['data'] = [
                        $value->bahan->sku,
                        $value->bahan->jenis_bahan,
                        $value->bahan->nama_bahan,
                        $value->ukuran,
                        $value->bahan->warna,
                        $asalbarang,
                        $keterangan,
                        $value->total,
                    ];
                    array_push($data, $x);
                }
            } elseif ($list == 'RECAPITULATION') {
                foreach ($rekap as $key => $value) {
                    $x['menu'] = 'RECAPITULATION';
                    $x['icon'] = '<i class="fas fa-file"></i>';
                    $x['title'] = $titlerekap;
                    $ukuran = '';

                    foreach ($value->detail_rekap as $key => $row) {
                        $ukuran .= $row->ukuran . ',';
                    }
                    $x['data'] = [
                        $value->cuci->jahit->potong->bahan->sku,
                        $value->cuci->tanggal_selesai,
                        $value->cuci->jahit->potong->bahan->jenis_bahan,
                        $value->cuci->jahit->potong->bahan->nama_bahan,
                        $ukuran,
                        $value->cuci->jahit->potong->bahan->warna,
                        $value->cuci->jahit->potong->bahan->tanggal_masuk,
                        $value->tanggal_kirim,
                        $value->total_barang,
                    ];
                    array_push($data, $x);
                }
            }
        }

        $pdf = PDF::loadView('backend.print.download', ['print' => $data]);

        $tipe = $request->get('tipe');

        if($tipe == 'download'){
            return $pdf->download('production.pdf');
        }else{
            return $pdf->stream('production.pdf');
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


    public function cetak(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dari' => 'required',
            'sampai' => 'required',
            'menu' => 'required',
            'menu.*' => 'required',
        ]);

        if ($validator->fails()) {
            $error = '<div class="alert alert-danger" role="alert">
           ' . $validator->errors()->first() . '
          </div>';
            return response()->json([
                'status' => false,
                'data' => $error
            ]);
        }

        $dari = date('Y-m-d', strtotime($request->get('dari')));
        $sampai = date('Y-m-d', strtotime($request->get('sampai')));
        $menu = $request->get('menu');
        // $potong = Potong::with('bahan')->whereBetween('created_at', [$dari, $sampai])->get();
        $potong = Potong::with('bahan')->whereBetween('created_at', [$dari, $sampai])->get();
        $jahit = Jahit::with(['potong' => function ($q) {
            $q->with('bahan');
        }])->whereBetween('created_at', [$dari, $sampai])->get();
        $cuci = Cuci::with(['jahit' => function ($q) {
            $q->with(['potong' => function ($q) {
                $q->with('bahan');
            }]);
        }])->whereBetween('created_at', [$dari, $sampai])->get();
        $perbaikan = Perbaikan::whereBetween('created_at', [$dari, $sampai])->get();
        $sampah = Sampah::whereBetween('created_at', [$dari, $sampai])->get();
        $rekap = Rekapitulasi::whereBetween('created_at', [$dari, $sampai])->get();
        $data = [];
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

        $titlerepair = [
            'Kode SKU',
            'Jenis Bahan',
            'Nama Produk',
            'Ukuran Baju',
            'Warna Produk',
            'Asal Barang',
            'Keterangan',
            'Total Barang Direpair',
            'Tanggal Selesai Repair',
            'Tanggal Kirim Barang'
        ];


        $titletrash = [
            'Kode SKU',
            'Jenis Bahan',
            'Nama Produk',
            'Ukuran Baju',
            'Warna Produk',
            'Asal Barang',
            'Keterangan',
            'Total Barang Dibuang',
        ];


        $titlerekap = [
            'Kode SKU',
            'Tanggal Selesai Cuci',
            'Jenis Bahan',
            'Nama Produk',
            'Ukuran Baju',
            'Warna Produk',
            'Tanggal Barang Masuk',
            'Tanggal Barang Dikirim',
            'Total Barang Siap Quality Control',
        ];

        foreach ($menu as $key => $list) {
            if ($list == 'CUTTING') {
                foreach ($potong as $key => $value) {
                    $x['menu'] = 'CUTTING';
                    $x['icon'] = '<i class="fas fa-cut"></i>';
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
            } elseif ($list == 'TAILORING') {
                foreach ($jahit as $key => $value) {
                    $x['menu'] = 'TAILORING';
                    $x['icon'] = '<i class="fas fa-user-cog"></i>';
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
            } elseif ($list == 'WASHING') {
                foreach ($cuci as $key => $value) {
                    $x['menu'] = 'WASHING';
                    $x['icon'] = '<i class="ri-hand-coin-fill"></i>';
                    $x['title'] = $titlecuci;
                    $x['data'] = [
                        $value->jahit->potong->bahan->sku,
                        $value->tanggal_selesai,
                        $value->berhasil_cuci,
                        $value->gagal_cuci,
                        $value->barang_direpair,
                        $value->keterangan_direpair,
                        $value->barang_dibuang,
                        $value->keterangan_dibuang,
                    ];
                    array_push($data, $x);
                }
            } elseif ($list == 'REPAIR') {
                foreach ($perbaikan as $key => $value) {
                    $x['menu'] = 'REPAIR';
                    $x['icon'] = '<i class="fa fa-tools"></i>';
                    $x['title'] = $titlerepair;

                    $jumlahjahit = 0;
                    $jumlahcuci = 0;
                    $keteranganjahit = '';
                    $keterangancuci = '';
                    foreach ($value->detail_perbaikan as $key => $row) {
                        if (!empty($row->jahit_direpair_id)) {
                            $jumlahjahit = $row->jumlah;
                            $keteranganjahit = $row->keterangan;
                        }

                        if (!empty($row->cuci_direpair_id)) {
                            $jumlahcuci = $row->jumlah;
                            $keterangancuci = $row->keterangan;
                        }
                    }

                    $keterangan = 'Washing : ' . $keterangancuci . '<br>' . 'Tailoring : ' . $keteranganjahit;
                    $asalbarang = 'Washing : ' . $jumlahcuci . '<br>' . 'Tailoring : ' . $jumlahjahit;
                    $x['data'] = [
                        $value->bahan->sku,
                        $value->bahan->jenis_bahan,
                        $value->bahan->nama_bahan,
                        $value->ukuran,
                        $value->bahan->warna,
                        $asalbarang,
                        $keterangan,
                        $value->total,
                        $value->tanggal_selesai,
                        $value->tanggal_kirim,
                    ];
                    array_push($data, $x);
                }
            } elseif ($list == 'TRASH') {
                foreach ($sampah as $key => $value) {
                    $x['menu'] = 'TRASH';
                    $x['icon'] = '<i class="fas fa-trash"></i>';
                    $x['title'] = $titletrash;

                    $jumlahjahit = 0;
                    $jumlahcuci = 0;
                    $keteranganjahit = '';
                    $keterangancuci = '';
                    foreach ($value->detail_sampah as $key => $row) {
                        if (!empty($row->jahit_dibuang_id)) {
                            $jumlahjahit = $row->jumlah;
                            $keteranganjahit = $row->keterangan;
                        }

                        if (!empty($row->cuci_dibuang_id)) {
                            $jumlahcuci = $row->jumlah;
                            $keterangancuci = $row->keterangan;
                        }
                    }

                    $keterangan = 'Washing : ' . $keterangancuci . '<br>' . 'Tailoring : ' . $keteranganjahit;
                    $asalbarang = 'Washing : ' . $jumlahcuci . '<br>' . 'Tailoring : ' . $jumlahjahit;
                    $x['data'] = [
                        $value->bahan->sku,
                        $value->bahan->jenis_bahan,
                        $value->bahan->nama_bahan,
                        $value->ukuran,
                        $value->bahan->warna,
                        $asalbarang,
                        $keterangan,
                        $value->total,
                    ];
                    array_push($data, $x);
                }
            } elseif ($list == 'RECAPITULATION') {
                foreach ($rekap as $key => $value) {
                    $x['menu'] = 'RECAPITULATION';
                    $x['icon'] = '<i class="fas fa-file"></i>';
                    $x['title'] = $titlerekap;
                    $ukuran = '';

                    foreach ($value->detail_rekap as $key => $row) {
                        $ukuran .= $row->ukuran . ',';
                    }
                    $x['data'] = [
                        $value->cuci->jahit->potong->bahan->sku,
                        $value->cuci->tanggal_selesai,
                        $value->cuci->jahit->potong->bahan->jenis_bahan,
                        $value->cuci->jahit->potong->bahan->nama_bahan,
                        $ukuran,
                        $value->cuci->jahit->potong->bahan->warna,
                        $value->cuci->jahit->potong->bahan->tanggal_masuk,
                        $value->tanggal_kirim,
                        $value->total_barang,
                    ];
                    array_push($data, $x);
                }
            }
        }

        $pdf = PDF::loadView('backend.print.download', ['print' => $data]);

        $tipe = $request->get('tipe');

        if($tipe == 'download'){
            return $pdf->download('production.pdf');
        }else{
            return $pdf->stream('production.pdf');
        }
    }
}
