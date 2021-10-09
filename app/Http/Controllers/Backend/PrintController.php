<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Finishing;
use App\Rekapitulasi;
use App\Perbaikan;
use App\Jahit;
use App\Potong;
use App\Cuci;
use App\RekapitulasiWarehouse;
use App\Retur;
use App\Sampah;
use App\Warehouse;
use PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            $user = Auth::user();

            if ($user->hasRole('production')) {
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
                    if ($list == 'POTONG') {
                        foreach ($potong as $key => $value) {
                            $x['menu'] = 'POTONG';
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
                    } elseif ($list == 'JAHIT') {
                        foreach ($jahit as $key => $value) {
                            $x['menu'] = 'JAHIT';
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
                    } elseif ($list == 'CUCI') {
                        foreach ($cuci as $key => $value) {
                            $x['menu'] = 'CUCI';
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
                    } elseif ($list == 'PERBAIKAN') {
                        foreach ($perbaikan as $key => $value) {
                            $x['menu'] = 'PERBAIKAN';
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

                            $keterangan = 'Cuci : ' . $keterangancuci . '<br>' . 'Jahit : ' . $keteranganjahit;
                            $asalbarang = 'Cuci : ' . $jumlahcuci . '<br>' . 'Jahit : ' . $jumlahjahit;
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
                    } elseif ($list == 'SAMPAH') {
                        foreach ($sampah as $key => $value) {
                            $x['menu'] = 'SAMPAH';
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

                            $keterangan = 'Cuci : ' . $keterangancuci . '<br>' . 'Jahit : ' . $keteranganjahit;
                            $asalbarang = 'Cuci : ' . $jumlahcuci . '<br>' . 'Jahit : ' . $jumlahjahit;
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
                    } elseif ($list == 'REKAPITULASI') {
                        foreach ($rekap as $key => $value) {
                            $x['menu'] = 'REKAPITULASI';
                            $x['icon'] = '<i class="ri-booklet-fill"></i>';
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
            } elseif ($user->hasRole('warehouse')) {

                $finish = Finishing::whereBetween('created_at', [$dari, $sampai])->get();
                $warehouse = Warehouse::whereBetween('created_at', [$dari, $sampai])->get();
                $dataretur = Retur::whereBetween('created_at', [$dari, $sampai])->get();
                $rekap = RekapitulasiWarehouse::whereBetween('created_at', [$dari, $sampai])->get();
                $data = [];
                $titlefinish = [
                    'Kode SKU',
                    'Jenis Kain',
                    'Nama Produk',
                    'Warna Kain',
                    'Ukuran',
                    'Tanggal QC',
                    'Jumlah Barang Masuk',
                    'Jumlah Barang Lolos QC',
                    'Jumlah Barang Retur / Dibuang',
                    'Keterangan Retur',
                    'Keterangan Buang',
                    'Nomor Surat Jalan'
                ];


                $titlewarehouse = [
                    'Kode SKU',
                    'Jenis Kain',
                    'Nama Produk',
                    'Warna',
                    'Produk Siap Jual',
                    'Ukuran',
                    'Harga Produk'
                ];


                $titleretur = [
                    'Kode SKU',
                    'Tanggal Selesai Cuci',
                    'Jenis Kain',
                    'Nama Produk',
                    'Warna',
                    'Tanggal Barang Diretur',
                    'Total Barang Diretur',
                    'Ukuran Baju Yang Diretur',
                    'Keterangan Diretur'
                ];



                $titlerekap = [
                    'Kode SKU',
                    'Tanggal Barang Masuk',
                    'Tanggal Barang Dikirim',
                    'Nama Produk',
                    'Warna Produk',
                    'Jenis Bahan',
                    'Total Barang Siap Quality Control',
                    'Ukuran Baju',
                    'Harga Produk'
                ];

                foreach ($menu as $key => $datamenu) {
                    if ($datamenu == 'SORTIR') {
                        foreach ($finish as $key => $value) {
                            $x['menu'] = 'SORTIR';
                            $x['icon'] = '<i class="ri-check-double-line"></i>';
                            $x['title'] = $titlefinish;
                            $ukuran = '';

                            foreach ($value->detail_finish as $key => $row) {
                                $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
                            }

                            $retur = $value->barang_diretur . ' pcs';
                            $retur .= '(';
                            foreach ($value->finish_retur as $key => $row) {
                                $retur .= $row->ukuran . '=' . $row->jumlah . ', ';;
                            }
                            $retur .= ') / ';

                            $retur .= $value->barang_dibuang . ' pcs';
                            $retur .= '(';
                            foreach ($value->finish_dibuang as $key => $row) {
                                $retur .= $row->ukuran . '=' . $row->jumlah . ', ';;
                            }
                            $retur .= ')';

                            $x['data'] = [
                                $value->cuci->jahit->potong->bahan->sku,
                                $value->cuci->jahit->potong->bahan->jenis_bahan,
                                $value->cuci->jahit->potong->bahan->nama_bahan,
                                $value->cuci->jahit->potong->bahan->warna,
                                $ukuran,
                                $value->tanggal_qc,
                                $value->cuci->berhasil_cuci,
                                $value->barang_lolos_qc,
                                $retur,
                                $value->keterangan_diretur,
                                $value->keterangan_dibuang,
                                $value->no_surat,
                            ];
                            array_push($data, $x);
                        }
                    } elseif ($datamenu == 'GUDANG') {

                        foreach ($warehouse as $key => $value) {
                            $x['menu'] = 'GUDANG';
                            $x['icon'] = '<i class="ri-home-gear-fill"></i>';
                            $x['title'] = $titlewarehouse;
                            $ukuran = '';

                            foreach ($value->detail_warehouse as $key => $row) {
                                $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
                            }

                            $jumlahproduk = $value->detail_warehouse->sum('jumlah');
                            $harga = $this->rupiah($value->harga_produk);
                            $x['data'] = [
                                $value->finishing->cuci->jahit->potong->bahan->sku,
                                $value->finishing->cuci->jahit->potong->bahan->jenis_bahan,
                                $value->finishing->cuci->jahit->potong->bahan->nama_bahan,
                                $value->finishing->cuci->jahit->potong->bahan->warna,
                                $jumlahproduk,
                                $ukuran,
                                $harga
                            ];
                            array_push($data, $x);
                        }
                    } elseif ($datamenu == 'RETUR') {
                        foreach ($dataretur as $key => $value) {
                            $x['menu'] = 'RETUR';
                            $x['icon'] = '<i class="ri-logout-box-fill"></i>';
                            $x['title'] = $titleretur;
                            $ukuran = '';

                            foreach ($value->detail_retur as $key => $row) {
                                $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
                            }

                            $jumlahproduk = $value->total_barang;
                            $tanggalretur = date('Y-m-d', strtotime($value->created_at));
                            $x['data'] = [
                                $value->finishing->cuci->jahit->potong->bahan->sku,
                                $value->finishing->cuci->tanggal_selesai,
                                $value->finishing->cuci->jahit->potong->bahan->jenis_bahan,
                                $value->finishing->cuci->jahit->potong->bahan->nama_bahan,
                                $value->finishing->cuci->jahit->potong->bahan->warna,
                                $tanggalretur,
                                $jumlahproduk,
                                $ukuran,
                                $value->finishing->keterangan_diretur
                            ];
                            array_push($data, $x);
                        }
                    } elseif ($datamenu == 'REKAPITULASI') {

                        foreach ($rekap as $key => $value) {
                            $x['menu'] = 'REKAPITULASI';
                            $x['icon'] = '<i class="ri-booklet-fill"></i>';
                            $x['title'] = $titlerekap;
                            $ukuran = '';

                            foreach ($value->detail_rekap_warehouse as $key => $row) {
                                $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
                            }

                            $jumlahproduk = $value->total_barang;
                            $harga = $this->rupiah($value->warehouse->harga_produk);
                            $x['data'] = [
                                $value->warehouse->finishing->cuci->jahit->potong->bahan->sku,
                                $value->tanggal_masuk,
                                $value->tanggal_kirim,
                                $value->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan,
                                $value->warehouse->finishing->cuci->jahit->potong->bahan->warna,
                                $value->warehouse->finishing->cuci->jahit->potong->bahan->jenis_bahan,
                                $jumlahproduk,
                                $ukuran,
                                $harga
                            ];
                            array_push($data, $x);
                        }
                    }
                }

                return response()->json(['print' => $data, 'status' => true]);
            }
            // $potong = Potong::with('bahan')->whereBetween('created_at', [$dari, $sampai])->get();

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
            if ($list == 'POTONG') {
                foreach ($potong as $key => $value) {
                    $x['menu'] = 'POTONG';
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
            } elseif ($list == 'JAHIT') {
                foreach ($jahit as $key => $value) {
                    $x['menu'] = 'JAHIT';
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
            } elseif ($list == 'CUCI') {
                foreach ($cuci as $key => $value) {
                    $x['menu'] = 'CUCI';
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
            } elseif ($list == 'PERBAIKAN') {
                foreach ($perbaikan as $key => $value) {
                    $x['menu'] = 'PERBAIKAN';
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
            } elseif ($list == 'SAMPAH') {
                foreach ($sampah as $key => $value) {
                    $x['menu'] = 'SAMPAH';
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
            } elseif ($list == 'REKAPITULASI') {
                foreach ($rekap as $key => $value) {
                    $x['menu'] = 'REKAPITULASI';
                    $x['icon'] = '<i class="ri-booklet-fill"></i>';
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

        if ($tipe == 'download') {
            return $pdf->download('production.pdf');
        } else {
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
        $user = Auth::user();
        $data = [];
        if ($user->hasRole('production')) {
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
                if ($list == 'POTONG') {
                    foreach ($potong as $key => $value) {
                        $x['menu'] = 'POTONG';
                        $x['icon'] = '<i class="fas fa-cut"></i>';
                        $x['title'] = $titlepotong;
                        $x['kode_bahan'] =  $value->bahan->kode_bahan;
                        $x['icon'] = 'scissors-line.png';
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
                } elseif ($list == 'JAHIT') {
                    foreach ($jahit as $key => $value) {
                        $x['menu'] = 'JAHIT';
                        $x['icon'] = '<i class="fas fa-user-cog"></i>';
                        $x['title'] = $titlejahit;
                        $x['kode_bahan'] =  $value->potong->bahan->kode_bahan;
                        $x['icon'] = 'user-settings-fill.png';
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
                } elseif ($list == 'CUCI') {
                    foreach ($cuci as $key => $value) {
                        $x['menu'] = 'CUCI';
                        $x['icon'] = '<i class="ri-hand-coin-fill"></i>';
                        $x['title'] = $titlecuci;
                        $x['icon'] = 'hand-coin-fill.png';
                        $x['kode_bahan'] =  $value->jahit->potong->bahan->kode_bahan;
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
                } elseif ($list == 'PERBAIKAN') {
                    foreach ($perbaikan as $key => $value) {
                        $x['menu'] = 'PERBAIKAN';
                        $x['icon'] = '<i class="fa fa-tools"></i>';
                        $x['title'] = $titlerepair;
                        $x['icon'] = 'refresh-fill.png';
                        $x['kode_bahan'] =   $value->bahan->kode_bahan;
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
                } elseif ($list == 'SAMPAH') {
                    foreach ($sampah as $key => $value) {
                        $x['menu'] = 'SAMPAH';
                        $x['icon'] = '<i class="fas fa-trash"></i>';
                        $x['title'] = $titletrash;
                        $x['icon'] = 'delete-bin-2-fill.png';
                        $x['kode_bahan'] =   $value->bahan->kode_bahan;
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
                } elseif ($list == 'REKAPITULASI') {
                    foreach ($rekap as $key => $value) {
                        $x['menu'] = 'REKAPITULASI';
                        $x['icon'] = '<i class="ri-booklet-fill"></i>';
                        $x['title'] = $titlerekap;
                        $x['icon'] = 'booklet-fill.png';
                        $ukuran = '';
                        $x['kode_bahan'] =      $value->cuci->jahit->potong->bahan->kode_bahan;
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

        } elseif ($user->hasRole('warehouse')) {

            $finish = Finishing::whereBetween('created_at', [$dari, $sampai])->get();
            $warehouse = Warehouse::whereBetween('created_at', [$dari, $sampai])->get();
            $dataretur = Retur::whereBetween('created_at', [$dari, $sampai])->get();
            $rekap = RekapitulasiWarehouse::whereBetween('created_at', [$dari, $sampai])->get();

            $titlefinish = [
                'Kode SKU',
                'Jenis Kain',
                'Nama Produk',
                'Warna Kain',
                'Ukuran',
                'Tanggal QC',
                'Jumlah Barang Masuk',
                'Jumlah Barang Lolos QC',
                'Jumlah Barang Retur / Dibuang',
                'Keterangan Retur',
                'Keterangan Buang',
                'Nomor Surat Jalan'
            ];


            $titlewarehouse = [
                'Kode SKU',
                'Jenis Kain',
                'Nama Produk',
                'Warna',
                'Produk Siap Jual',
                'Ukuran',
                'Harga Produk'
            ];


            $titleretur = [
                'Kode SKU',
                'Tanggal Selesai Cuci',
                'Jenis Kain',
                'Nama Produk',
                'Warna',
                'Tanggal Barang Diretur',
                'Total Barang Diretur',
                'Ukuran Baju Yang Diretur',
                'Keterangan Diretur'
            ];



            $titlerekap = [
                'Kode SKU',
                'Tanggal Barang Masuk',
                'Tanggal Barang Dikirim',
                'Nama Produk',
                'Warna Produk',
                'Jenis Bahan',
                'Total Barang Siap Quality Control',
                'Ukuran Baju',
                'Harga Produk'
            ];

            foreach ($menu as $key => $datamenu) {
                if ($datamenu == 'SORTIR') {
                    foreach ($finish as $key => $value) {
                        $x['menu'] = 'SORTIR';
                        $x['icon'] = '<i class="ri-check-double-line"></i>';
                        $x['title'] = $titlefinish;
                        $x['icon'] = 'check-double-fill.png';
                        $ukuran = '';
                        $x['kode_bahan'] = $value->cuci->jahit->potong->bahan->sku;
                        foreach ($value->detail_finish as $key => $row) {
                            $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
                        }

                        $retur = $value->barang_diretur . ' pcs';
                        $retur .= '(';
                        foreach ($value->finish_retur as $key => $row) {
                            $retur .= $row->ukuran . '=' . $row->jumlah . ', ';;
                        }
                        $retur .= ') / ';

                        $retur .= $value->barang_dibuang . ' pcs';
                        $retur .= '(';
                        foreach ($value->finish_dibuang as $key => $row) {
                            $retur .= $row->ukuran . '=' . $row->jumlah . ', ';;
                        }
                        $retur .= ')';

                        $x['data'] = [
                            $value->cuci->jahit->potong->bahan->sku,
                            $value->cuci->jahit->potong->bahan->jenis_bahan,
                            $value->cuci->jahit->potong->bahan->nama_bahan,
                            $value->cuci->jahit->potong->bahan->warna,
                            $ukuran,
                            $value->tanggal_qc,
                            $value->total_barang,
                            $value->barang_lolos_qc,
                            $retur,
                            $value->keterangan_diretur,
                            $value->keterangan_dibuang,
                            $value->no_surat,
                        ];
                        array_push($data, $x);
                    }
                } elseif ($datamenu == 'GUDANG') {

                    foreach ($warehouse as $key => $value) {
                        $x['menu'] = 'GUDANG';
                        $x['icon'] = '<i class="ri-home-gear-fill"></i>';
                        $x['title'] = $titlewarehouse;
                        $x['icon'] = 'home-gear-fill.png';
                        $ukuran = '';
                        $x['kode_bahan'] = $value->finishing->cuci->jahit->potong->bahan->sku;
                        foreach ($value->detail_warehouse as $key => $row) {
                            $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
                        }

                        $jumlahproduk = $value->detail_warehouse->sum('jumlah');
                        $harga = $this->rupiah($value->harga_produk);
                        $x['data'] = [
                            $value->finishing->cuci->jahit->potong->bahan->sku,
                            $value->finishing->cuci->jahit->potong->bahan->jenis_bahan,
                            $value->finishing->cuci->jahit->potong->bahan->nama_bahan,
                            $value->finishing->cuci->jahit->potong->bahan->warna,
                            $jumlahproduk,
                            $ukuran,
                            $harga
                        ];
                        array_push($data, $x);
                    }
                } elseif ($datamenu == 'RETUR') {
                    foreach ($dataretur as $key => $value) {
                        $x['menu'] = 'RETUR';
                        $x['icon'] = '<i class="ri-logout-box-fill"></i>';
                        $x['title'] = $titleretur;
                        $x['retur'] = 'logout-box-fill.png';
                        $ukuran = '';
                        $x['kode_bahan'] =  $value->finishing->cuci->jahit->potong->bahan->sku;
                        foreach ($value->detail_retur as $key => $row) {
                            $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
                        }

                        $jumlahproduk = $value->total_barang;
                        $tanggalretur = date('Y-m-d', strtotime($value->created_at));
                        $x['data'] = [
                            $value->finishing->cuci->jahit->potong->bahan->sku,
                            $value->finishing->cuci->tanggal_selesai,
                            $value->finishing->cuci->jahit->potong->bahan->jenis_bahan,
                            $value->finishing->cuci->jahit->potong->bahan->nama_bahan,
                            $value->finishing->cuci->jahit->potong->bahan->warna,
                            $tanggalretur,
                            $jumlahproduk,
                            $ukuran,
                            $value->finishing->keterangan_diretur
                        ];
                        array_push($data, $x);
                    }
                } elseif ($datamenu == 'REKAPITULASI') {

                    foreach ($rekap as $key => $value) {
                        $x['menu'] = 'REKAPITULASI';
                        $x['icon'] = '<i class="ri-booklet-fill"></i>';
                        $x['title'] = $titlerekap;
                        $x['icon'] = 'booklet-fill.png';
                        $ukuran = '';
                        $x['kode_bahan'] =    $value->warehouse->finishing->cuci->jahit->potong->bahan->sku;
                        foreach ($value->detail_rekap_warehouse as $key => $row) {
                            $ukuran .= $row->ukuran . '=' . $row->jumlah . ', ';
                        }

                        $jumlahproduk = $value->total_barang;
                        $harga = $this->rupiah($value->warehouse->harga_produk);
                        $x['data'] = [
                            $value->warehouse->finishing->cuci->jahit->potong->bahan->sku,
                            $value->tanggal_masuk,
                            $value->tanggal_kirim,
                            $value->warehouse->finishing->cuci->jahit->potong->bahan->nama_bahan,
                            $value->warehouse->finishing->cuci->jahit->potong->bahan->warna,
                            $value->warehouse->finishing->cuci->jahit->potong->bahan->jenis_bahan,
                            $jumlahproduk,
                            $ukuran,
                            $harga
                        ];
                        array_push($data, $x);
                    }
                }
            }
        }

        $pdf = PDF::loadView('backend.print.download', ['print' => $data]);

        $tipe = $request->get('tipe');

        if ($tipe == 'download') {
            return $pdf->download('production.pdf');
        } else {
            return $pdf->stream('production.pdf');
        }
    }

    public function rupiah($expression)
    {
        return "Rp " . number_format($expression, 2, ',', '.');
    }
}
