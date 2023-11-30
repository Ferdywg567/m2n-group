<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Cuci;
use App\Bahan;
use App\CuciDirepair;
use App\DetailCuci;
use App\DetailJahit;
use App\Perbaikan;
use App\DetailPerbaikan;
use App\Jahit;
use App\JahitDirepair;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;
use Exception;

class PerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $cuci = Cuci::all();
        // $jahit = Jahit::all();
        DB::beginTransaction();

        try {
            // ini logika aku gapaham sadakshdkas apa coba maksudnya
            // foreach ($cuci as $key => $value) {
            //     $idbahan = $value->jahit->potong->bahan->id;
            //     foreach ($value->cuci_direpair as $key => $row) {
            //         $repair = Perbaikan::where('bahan_id', $idbahan)->where('ukuran', $row->ukuran)->first();
            //         if ($repair) {
            //             $total = DetailPerbaikan::where('perbaikan_id', $repair->id)->sum('jumlah');
            //             $repair->tanggal_masuk = $repair->tanggal_masuk;
            //             $repair->total = $total;
            //         } else {
            //             $repair = new Perbaikan();
            //             $repair->bahan_id = $idbahan;
            //             $repair->tanggal_masuk = date('Y-m-d');
            //             $repair->ukuran = $row->ukuran;
            //             $repair->total = $row->jumlah;
            //             $repair->status = "butuh konfirmasi";
            //         }
            //         $repair->save();

            //         $detail = DetailPerbaikan::where('perbaikan_id', $repair->id)->where('cuci_direpair_id', $row->id)->first();
            //         if ($detail) {
            //             $detail->jumlah = $row->jumlah;
            //             $detail->keterangan = $value->keterangan_direpair;
            //         } else {
            //             $detail = new DetailPerbaikan();
            //             $detail->perbaikan_id = $repair->id;
            //             $detail->cuci_direpair_id = $row->id;
            //             $detail->jumlah = $row->jumlah;
            //             $detail->keterangan = $value->keterangan_direpair;
            //         }

            //         $detail->save();
            //     }

            //     foreach ($value->jahit->jahit_direpair as $key => $row) {
            //         $repair = Perbaikan::where('bahan_id', $idbahan)->where('ukuran', $row->ukuran)->first();
            //         if ($repair) {
            //             $total = DetailPerbaikan::where('perbaikan_id', $repair->id)->sum('jumlah');
            //             $repair->tanggal_masuk = $repair->tanggal_masuk;
            //             $repair->total = $total;
            //         } else {
            //             $repair = new Perbaikan();
            //             $repair->bahan_id = $idbahan;
            //             $repair->tanggal_masuk = date('Y-m-d');
            //             $repair->ukuran = $row->ukuran;
            //             $repair->total = $row->jumlah;
            //             $repair->status = "butuh konfirmasi";
            //         }
            //         $repair->save();

            //         $detail = DetailPerbaikan::where('perbaikan_id', $repair->id)->where('jahit_direpair_id', $row->id)->first();
            //         if ($detail) {
            //             $detail->jumlah = $row->jumlah;
            //             $detail->keterangan = $value->jahit->keterangan_direpair;
            //         } else {
            //             $detail = new DetailPerbaikan();
            //             $detail->perbaikan_id = $repair->id;
            //             $detail->jahit_direpair_id = $row->id;
            //             $detail->jumlah = $row->jumlah;
            //             $detail->keterangan = $value->jahit->keterangan_direpair;
            //         }

            //         $detail->save();
            //     }
            // }
            // end ini logika aku gapaham sadakshdkas apa coba maksudnya

            // ini aku pake logika sendiri

            //insert jahit
            $jahit = Jahit::whereHas('jahit_direpair')->get();
            foreach ($jahit as $j) {
                $dbPerbaikan = Perbaikan::where('bahan_id', $j->potong->bahan_id);
                $perbaikan = $dbPerbaikan->exists() ? $dbPerbaikan->first() : new Perbaikan;

                if (!$dbPerbaikan->exists()) {
                    $perbaikan->bahan_id = $j->potong->bahan_id;
                    $perbaikan->ukuran = '';
                    $perbaikan->status = 'butuh konfirmasi';
                    $perbaikan->tanggal_masuk = explode(' ', $j->jahit_direpair[0]->created_at)[0];
                    $perbaikan->total = $j->jahit_direpair->sum('jumlah');
                    $perbaikan->save();
                }

                foreach ($j->jahit_direpair as $jdr) {
                    $dbDetail = DetailPerbaikan::where('jahit_direpair_id', $jdr->id);
                    $detail = $dbDetail->exists() ? $dbDetail->first() : new DetailPerbaikan;

                    if (!$dbDetail->exists()) {
                        $detail->perbaikan_id = $perbaikan->id;
                        $detail->jahit_direpair_id = $jdr->id;
                        $detail->jumlah = $jdr->jumlah;
                        $detail->status = 'butuh konfirmasi';
                        $detail->keterangan = $j->keterangan_direpair;
                        $detail->save();
                    }
                }
            }

            //insert cuci
            $cuci = Cuci::whereHas('cuci_direpair')->get();
            foreach ($cuci as $j) {
                $dbPerbaikan = Perbaikan::where('bahan_id', $j->jahit->potong->bahan_id);
                $perbaikan = $dbPerbaikan->exists() ? $dbPerbaikan->first() : new Perbaikan;

                if (!$dbPerbaikan->exists()) {
                    $perbaikan->bahan_id = $j->jahit->potong->bahan_id;
                    $perbaikan->ukuran = '';
                    $perbaikan->status = 'butuh konfirmasi';
                    $perbaikan->tanggal_masuk = explode(' ', $j->cuci_direpair[0]->created_at)[0];
                    $perbaikan->total = $j->cuci_direpair->sum('jumlah');
                    $perbaikan->save();
                }

                foreach ($j->cuci_direpair as $jdr) {
                    $dbDetail = DetailPerbaikan::where('cuci_direpair_id', $jdr->id);
                    $detail = $dbDetail->exists() ? $dbDetail->first() : new DetailPerbaikan;

                    if (!$dbDetail->exists()) {
                        $detail->perbaikan_id = $perbaikan->id;
                        $detail->cuci_direpair_id = $jdr->id;
                        $detail->jumlah = $jdr->jumlah;
                        $detail->keterangan = $j->keterangan_direpair;
                        $detail->save();
                    }
                }
            }

            // end ini logika aku sendiri
            DB::commit();
            $dbrepair = DetailPerbaikan::with('perbaikan')->latest()->get();
            // dd($dbrepair);
            $repair = [];
            foreach ($dbrepair as $r) {

                $perbaikan = $r->perbaikan;
                $perbaikan->{'status_repair'} = $r->status;

                //sort by jenis perbaikan and insert total jumlah perbaikan
                if ($r->jahit_direpair_id) {
                    $perbaikan->{'is_jahit'} = true;
                } elseif ($r->cuci_direpair_id) {
                    $perbaikan->{'is_cuci'} = true;
                }

                if (!in_array($perbaikan, $repair)) {
                    $repair[] = $perbaikan;
                }
            }
            return view("backend.perbaikan.index", ['repair' => $repair]);
        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();
            dd($th->getMessage());
        }
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
        $repair = Perbaikan::findOrFail($id);

        $jahit = [
            'jahit_direpair_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        $cuci = [
            'cuci_direpair_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        $repairJahit = collect();
        $repairCuci = collect();
        foreach ($repair->detail_perbaikan as $key => $value) {
            // dd($value);
            if (!empty($value->jahit_direpair_id)) {
                $jahit = [
                    'jahit_direpair_id' => $value->id,
                    'jumlah' => $value->jumlah,
                    'keterangan' => $value->keterangan,
                    'ukuran' => $value->jahit_repair->ukuran
                ];
            }
            if (!empty($value->cuci_direpair_id)) {
                $cuci = [
                    'cuci_direpair_id' => $value->id,
                    'jumlah' => $value->jumlah,
                    'keterangan' => $value->keterangan,
                    'ukuran' => $value->cuci_repair->ukuran
                ];
            }
            if ($value->jahit_repair) {
                $repairJahit->add($value->jahit_repair);
            }
            if ($value->cuci_repair) {
                $repairCuci->add($value->jahit_repair);
            }
        }

        $repair->{'detail_jahit_repair'} = $repairJahit;
        $repair->{'detail_cuci_repair'} = $repairCuci;

        return view("backend.perbaikan.show", ['repair' => $repair, 'cuci' => $cuci, 'jahit' => $jahit]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $repair = Perbaikan::findOrFail($id);

        $jahit = [
            'jahit_direpair_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        $cuci = [
            'cuci_direpair_id' => '',
            'jumlah' => '',
            'keterangan' => ''
        ];
        $repairJahit = collect();
        $repairCuci = collect();
        foreach ($repair->detail_perbaikan as $key => $value) {
            if (!empty($value->jahit_direpair_id)) {
                $jahit = [
                    'jahit_direpair_id' => $value->id,
                    'jumlah' => $value->jumlah,
                    'keterangan' => $value->keterangan,
                ];
            }
            if (!empty($value->cuci_direpair_id)) {
                $cuci = [
                    'cuci_direpair_id' => $value->id,
                    'jumlah' => $value->jumlah,
                    'keterangan' => $value->keterangan,
                ];
            }

            if ($value->jahit_repair) {
                $repairJahit->add($value->jahit_repair);
            }
            if ($value->cuci_repair) {
                $repairCuci->add($value->jahit_repair);
            }
        }

        $repair->{'detail_jahit_repair'} = $repairJahit;
        $repair->{'detail_cuci_repair'} = $repairCuci;


        return view("backend.perbaikan.edit", ['repair' => $repair, 'cuci' => $cuci, 'jahit' => $jahit]);
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
        $validator = Validator::make($request->all(), [
            'tailoring' => 'nullable|integer',
            'washing' => 'nullable|integer',
            'keterangan_tailoring' => 'nullable',
            'keterangan_washing' => 'nullable',
            'tanggal_selesai' => 'required|date_format:"Y-m-d"',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            // dd($request->all());
            try {
                $repair = Perbaikan::findOrFail($id);
                $repair->status = "proses repair";
                $repair->tanggal_selesai = date('Y-m-d', strtotime($request->get('tanggal_selesai')));
                $repair->save();
                // $jahit = DetailPerbaikan::find($request->get('jahit_direpair_id'));
                // if ($jahit) {
                //     $jahit->jumlah = $request->get('tailoring');
                //     $jahit->keterangan = $request->get('keterangan_tailoring');
                //     $jahit->save();
                // }

                // $cuci = DetailPerbaikan::find($request->get('cuci_direpair_id'));
                // if ($cuci) {
                //     $cuci->jumlah = $request->get('washing');
                //     $cuci->keterangan = $request->get('keterangan_washing');
                //     $cuci->save();
                // }
                // dd($repair->status);
                DB::commit();

                return redirect()->route('perbaikan.index')->with('success', 'Perbaikan Berhasil di Konfirmasi');
            } catch (\Exception $th) {
                DB::rollBack();
                dd($th->getMessage());
            }
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

    public function cetakPdf(Request $request)
    {
        $repair = Perbaikan::findOrFail($request->get('id'));

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

        $x['title'] = $titlerepair;
        $x['icon'] = 'refresh-fill.png';
        $x['kode_bahan'] =  $repair->bahan->kode_bahan;
        $ukuran = '';

        $jumlahjahit = 0;
        $jumlahcuci = 0;
        $keteranganjahit = '';
        $keterangancuci = '';
        foreach ($repair->detail_perbaikan as $key => $row) {
            if (!empty($row->jahit_direpair_id)) {
                $jumlahjahit = $row->jumlah;
                $keteranganjahit = $row->keterangan;
            }

            if (!empty($row->cuci_direpair_id)) {
                $jumlahcuci = $row->jumlah;
                $keterangancuci = $row->keterangan;
            }
        }

        $keterangan = 'Washing : ' . $keterangancuci . "\r\n" . 'Tailoring : ' . $keteranganjahit;
        $asalbarang = 'Washing : ' . $jumlahcuci . "\r\n" . 'Tailoring : ' . $jumlahjahit;

        $x['data'] = [
            $repair->bahan->sku,
            $repair->bahan->jenis_bahan,
            $repair->bahan->nama_bahan,
            $repair->ukuran,
            $repair->bahan->warna,
            $asalbarang,
            $keterangan,
            $repair->total,
            $repair->tanggal_selesai,
            $repair->tanggal_kirim,
        ];

        $pdf = PDF::loadView('backend.perbaikan.pdf', ['data' => $x]);
        return $pdf->stream('perbaikan.pdf');
    }

    public function selesai($id, $is_jahit, Request $request)
    {
        $perbaikan = Perbaikan::find($id);
        $detail = DetailPerbaikan::where('perbaikan_id', $perbaikan->id)
            ->whereNull($is_jahit ? 'cuci_direpair_id' : 'jahit_direpair_id')
            ->first();
        $parent = $is_jahit ?
            JahitDirepair::find($detail->jahit_direpair_id) :
            CuciDirepair::find($detail->cuci_direpair_id);

        $data = (object) [
            'no_surat' => $is_jahit ? $parent->jahit->no_surat : $parent->cuci->no_surat,
            'vendor' => $is_jahit ? $parent->jahit->vendor : $parent->cuci->vendor,
            'nama_vendor' => $is_jahit ? $parent->jahit->nama_vendor : $parent->cuci->nama_vendor,
            'harga_vendor' => $is_jahit ? $parent->jahit->harga_vendor : $parent->cuci->harga_vendor,
            'detail_perbaikan' => $is_jahit ? Jahit::find($parent->jahit_id) : Cuci::find($parent->cuci_id),
            'tipe_perbaikan' => $is_jahit ? 'jahit' : 'cuci',
        ];
        return view("backend.perbaikan.selesai", compact('perbaikan', 'detail', 'data'));
    }

    public function storeSelesai($id, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'tipeperbaikan' => 'required',
            'kode_transaksi' => 'required',
            'berhasil_jahit' => 'required',
            'gagal_jahit' => 'required',
            'barang_dibuang' => 'required',
            'jumlahdibuang' => 'required',
            'dataukurandibuang' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        }

        DB::beginTransaction();

        try {
            $repair = Perbaikan::findOrFail($id);
            $repair->status = "selesai";
            $repair->save();

            if ($request->tipeperbaikan == 'jahit') {
                $oldData = Jahit::whereHas('potong', function ($q) use ($request) {
                    $q->whereHas('bahan', function ($qu) use ($request) {
                        $qu->where('kode_transaksi', $request->kode_transaksi);
                    });
                })->first();
            } else {
                $oldData = Cuci::whereHas('jahit', function ($q) use ($request) {
                    $q->whereHas('potong', function ($q) use ($request) {
                        $q->whereHas('bahan', function ($qu) use ($request) {
                            $qu->where('kode_transaksi', $request->kode_transaksi);
                        });
                    });
                })->first();
            }
            $data = $oldData->replicate();

            $data->tanggal_keluar = null;
            $data->tanggal_selesai = date('Y-m-d');
            $data->{$request->tipeperbaikan == 'jahit' ? 'berhasil' : 'berhasil_cuci'} = $request->berhasil_jahit;
            $data->{$request->tipeperbaikan == 'jahit' ? 'jumlah_bahan' : 'kain_siap_cuci'} = $request->berhasil_jahit + $request->gagal_jahit;
            $data->konversi = ceil($data->berhasil / 12) . " Lusin " . ($data->berhasil % 12) . " pcs";
            $data->{$request->tipeperbaikan == 'jahit' ? 'gagal_jahit' : 'gagal_cuci'} = $request->gagal_jahit;
            $data->barang_direpair = 0;
            $data->barang_dibuang = $request->barang_dibuang;
            $data->status_pembayaran = "Lunas";
            $data->total_bayar = 0;
            $data->sisa_bayar = 0;
            $data->total_harga = 0;
            $data->status = $request->tipeperbaikan == 'jahit' ? 'jahitan selesai' : 'cucian_selesai';
            $data->{$request->tipeperbaikan == 'jahit' ? 'status_jahit' : 'status_cuci'} = 'selesai';
            $data->status_perbaikan = 'selesai';
            $data->save();

            foreach ($repair->detail_perbaikan as $r) {
                $detail = $request->tipeperbaikan == 'jahit' ? new DetailJahit() : new DetailCuci();
                $detail->{$request->tipeperbaikan == 'jahit' ? 'jahit_id' : 'cuci_id'} = $data->id;
                if ($request->tipeperbaikan == 'jahit' and $r->jahit_direpair_id != null) {
                    $detail->size = $r->jahit_repair->ukuran;
                    $detail->jumlah = $r->jahit_repair->jumlah - $request->jumlahdibuang[array_search($r->jahit_repair->ukuran, $request->dataukurandibuang)];
                } elseif ($request->tipeperbaikan == 'cuci' and $r->cuci_direpair_id != null) {
                    $detail->size = $r->cuci_repair->ukuran;
                    $detail->jumlah = $r->cuci_repair->jumlah - $request->jumlahdibuang[array_search($r->cuci_repair->ukuran, $request->dataukurandibuang)];
                }
                $detail->save();
            }

            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
        return redirect()->route('perbaikan.index')->with('success', 'Perbaikan Berhasil di Dilakukan');
    }
}
