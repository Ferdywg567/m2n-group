<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Potong;
use App\Cuci;
use App\Jahit;
use App\PembayaranCuci;
use App\PembayaranJahit;
use PDF;

class PembayaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jahit = Jahit::where('status_pembayaran', '!=', 'Belum Lunas')
                    ->where('vendor', 'eksternal')
                    ->orderBy(PembayaranJahit::select('pembayaran_jahits.status')
                        ->whereColumn('pembayaran_jahits.jahit_id', 'jahits.id')
                        ->latest()
                        ->take(1)
                    )
                    ->get();
        $cuci = Cuci::where('status_pembayaran', '!=', 'Belum Lunas')->orderBy('created_at', 'DESC')->get();
        return view('backend.pembayaran.index', ['jahit' => $jahit, 'cuci' => $cuci]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->get('status') == 'jahit') {
            $jahit = Jahit::where('vendor', 'eksternal')->doesntHave('pembayaran_jahit')->get();
            return view("backend.pembayaran.jahit.create", ['jahit' => $jahit]);
        } else {
            // $keluar = Jahit::all()->where('status', 'jahitan selesai')->where('status_jahit', 'selesai');
            $cuci = Cuci::where('vendor', 'eksternal')->doesntHave('pembayaran_cuci')->get();
            return view("backend.pembayaran.cuci.create", ['cuci' => $cuci]);
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
        $status = $request->get('status');

        if ($status == 'jahit') {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'pembayaran1' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'pembayaran1' => 'required'
            ]);
        }


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                // dd($request->all());
                $total_harga = $request->get('total_harga');
                $total_harga = $this->convertToAngkaRp($total_harga);
                $nominal1 = $request->get('nominal1');
                $nominal2 = $request->get('nominal2');
                $nominal3 = $request->get('nominal3');
                $nominal1 = $this->convertToAngkaRp($nominal1);
                $nominal2 = $this->convertToAngkaRp($nominal2);
                $nominal3 = $this->convertToAngkaRp($nominal3);
                if ($status == 'jahit') {

                    $pembayaran1 = $request->get('pembayaran1');
                    if ($pembayaran1 == 'Lunas') {
                        $jahit = Jahit::findOrFail($request->get('kode_transaksi'));
                        $jahit->total_bayar = $total_harga;
                        $jahit->sisa_bayar = 0;
                        $jahit->status_pembayaran = "Lunas";
                        $jahit->save();

                        $pembayaran = new PembayaranJahit();
                        $pembayaran->jahit_id = $jahit->id;
                        $pembayaran->status = "Lunas";
                        $pembayaran->nominal = $nominal1;
                        $pembayaran->save();
                    } elseif ($pembayaran1 == 'Termin 1') {


                        if ($nominal1 > 0 && $nominal2 > 0 && $nominal3 > 0) {
                            $total = $nominal1 + $nominal2 + $nominal3;
                            if ($total_harga == $total) {
                                $status = 'Lunas';
                                $jahit = Jahit::findOrFail($request->get('kode_transaksi'));
                                $jahit->total_bayar = $total;
                                $jahit->sisa_bayar = 0;
                                $jahit->status_pembayaran = "Lunas";
                                $jahit->save();

                                $pembayaran = new PembayaranJahit();
                                $pembayaran->jahit_id = $jahit->id;
                                $pembayaran->status = "Termin 1";
                                $pembayaran->nominal = $nominal1;
                                $pembayaran->save();

                                $pembayaran = new PembayaranJahit();
                                $pembayaran->jahit_id = $jahit->id;
                                $pembayaran->status = "Termin 2";
                                $pembayaran->nominal = $nominal2;
                                $pembayaran->save();

                                $pembayaran = new PembayaranJahit();
                                $pembayaran->jahit_id = $jahit->id;
                                $pembayaran->status = "Termin 3";
                                $pembayaran->nominal = $nominal3;
                                $pembayaran->save();
                            }
                        } else  if ($nominal1 > 0 && $nominal2 > 0) {
                            $total = $nominal1 + $nominal2;
                            if ($total == $total_harga) {
                                $status = 'Lunas';
                            } else {
                                $status = 'Termin 2';
                            }
                            $sisa =  $total_harga - $total;
                            $jahit = Jahit::findOrFail($request->get('kode_transaksi'));
                            $jahit->total_bayar = $total;
                            $jahit->sisa_bayar = $sisa;
                            $jahit->status_pembayaran = $status;
                            $jahit->save();

                            $pembayaran = new PembayaranJahit();
                            $pembayaran->jahit_id = $jahit->id;
                            $pembayaran->status = "Termin 1";
                            $pembayaran->nominal = $nominal1;
                            $pembayaran->save();

                            $pembayaran = new PembayaranJahit();
                            $pembayaran->jahit_id = $jahit->id;
                            $pembayaran->status = "Termin 2";
                            $pembayaran->nominal = $nominal2;
                            $pembayaran->save();
                        } else  if ($nominal1 > 0) {
                            $total = $nominal1;
                            if ($total == $total_harga) {
                                $status = 'Lunas';
                            } else {
                                $status = 'Termin 1';
                            }
                            $sisa =  $total_harga - $total;
                            $jahit = Jahit::findOrFail($request->get('kode_transaksi'));
                            $jahit->total_bayar = $total;
                            $jahit->sisa_bayar = $sisa;
                            $jahit->status_pembayaran =  $status;
                            $jahit->save();

                            $pembayaran = new PembayaranJahit();
                            $pembayaran->jahit_id = $jahit->id;
                            $pembayaran->status = "Termin 1";
                            $pembayaran->nominal = $nominal1;
                            $pembayaran->save();
                        }
                    }
                } else {
                    $pembayaran1 = $request->get('pembayaran1');
                    if ($pembayaran1 == 'Lunas') {
                        $cuci = Cuci::findOrFail($request->get('kode_transaksi'));
                        $cuci->total_bayar = $total_harga;
                        $cuci->sisa_bayar = 0;
                        $cuci->status_pembayaran = "Lunas";
                        $cuci->save();

                        $pembayaran = new PembayaranCuci();
                        $pembayaran->cuci_id = $cuci->id;
                        $pembayaran->status = "Lunas";
                        $pembayaran->nominal = $nominal1;
                        $pembayaran->save();
                    } elseif ($pembayaran1 == 'Termin 1') {


                        if ($nominal1 > 0 && $nominal2 > 0 && $nominal3 > 0) {
                            $total = $nominal1 + $nominal2 + $nominal3;
                            if ($total_harga == $total) {
                                $status = 'Lunas';
                                $cuci = Cuci::findOrFail($request->get('kode_transaksi'));
                                $cuci->total_bayar = $total;
                                $cuci->sisa_bayar = 0;
                                $cuci->status_pembayaran = "Lunas";
                                $cuci->save();

                                $pembayaran = new PembayaranCuci();
                                $pembayaran->cuci_id = $cuci->id;
                                $pembayaran->status = "Termin 1";
                                $pembayaran->nominal = $nominal1;
                                $pembayaran->save();

                                $pembayaran = new PembayaranCuci();
                                $pembayaran->cuci_id = $cuci->id;
                                $pembayaran->status = "Termin 2";
                                $pembayaran->nominal = $nominal2;
                                $pembayaran->save();

                                $pembayaran = new PembayaranCuci();
                                $pembayaran->cuci_id = $cuci->id;
                                $pembayaran->status = "Termin 3";
                                $pembayaran->nominal = $nominal3;
                                $pembayaran->save();
                            }
                        } else  if ($nominal1 > 0 && $nominal2 > 0) {
                            $total = $nominal1 + $nominal2;
                            if ($total == $total_harga) {
                                $status = 'Lunas';
                            } else {
                                $status = 'Termin 2';
                            }
                            $sisa =  $total_harga - $total;
                            $cuci = Cuci::findOrFail($request->get('kode_transaksi'));
                            $cuci->total_bayar = $total;
                            $cuci->sisa_bayar = $sisa;
                            $cuci->status_pembayaran = $status;
                            $cuci->save();

                            $pembayaran = new PembayaranCuci();
                            $pembayaran->cuci_id = $cuci->id;
                            $pembayaran->status = "Termin 1";
                            $pembayaran->nominal = $nominal1;
                            $pembayaran->save();

                            $pembayaran = new PembayaranCuci();
                            $pembayaran->cuci_id = $cuci->id;
                            $pembayaran->status = "Termin 2";
                            $pembayaran->nominal = $nominal2;
                            $pembayaran->save();
                        } else  if ($nominal1 > 0) {
                            $total = $nominal1;
                            if ($total == $total_harga) {
                                $status = 'Lunas';
                            } else {
                                $status = 'Termin 1';
                            }
                            $sisa =  $total_harga - $total;
                            $cuci = Cuci::findOrFail($request->get('kode_transaksi'));
                            $cuci->total_bayar = $total;
                            $cuci->sisa_bayar = $sisa;
                            $cuci->status_pembayaran =  $status;
                            $cuci->save();

                            $pembayaran = new PembayaranCuci();
                            $pembayaran->cuci_id = $cuci->id;
                            $pembayaran->status = "Termin 1";
                            $pembayaran->nominal = $nominal1;
                            $pembayaran->save();
                        }
                    }
                }
                DB::commit();
                return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil disimpan');
            } catch (\Exception $th) {
                //throw $th;
                dd($th);
                DB::rollBack();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        if ($request->get('status') == 'jahit') {
            $jahit = Jahit::findOrFail($id);
            return view("backend.pembayaran.jahit.show", ['jahit' => $jahit]);
        } else {
            $cuci = Cuci::findOrFail($id);
            return view("backend.pembayaran.cuci.show", ['cuci' => $cuci]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if ($request->get('status') == 'jahit') {
            $jahit = Jahit::findOrFail($id);
            return view("backend.pembayaran.jahit.edit", ['jahit' => $jahit]);
        } else {
            $cuci = Cuci::findOrFail($id);
            return view("backend.pembayaran.cuci.edit", ['cuci' => $cuci]);
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
        $status = $request->get('status');

        if ($status == 'jahit') {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'pembayaran1' => 'required'
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'kode_transaksi' =>  'required',
                'pembayaran1' => 'required'
            ]);
        }


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors());
        } else {
            DB::beginTransaction();
            try {
                $total_harga = $request->get('total_harga');
                $total_harga = $this->convertToAngkaRp($total_harga);
                $nominal1 = $request->get('nominal1');
                $nominal2 = $request->get('nominal2');
                $nominal3 = $request->get('nominal3');
                $nominal1 = $this->convertToAngkaRp($nominal1);
                $nominal2 = $this->convertToAngkaRp($nominal2);
                $nominal3 = $this->convertToAngkaRp($nominal3);
                if ($status == 'jahit') {
                    $pembayaran1 = $request->get('pembayaran1');
                    $jahit = Jahit::findOrFail($id);
                    $lastbayar = PembayaranJahit::where('jahit_id', $id)->latest()->first();

                    if ($pembayaran1 == 'Termin 1') {


                        if ($nominal1 > 0 && $nominal2 > 0 && $nominal3 > 0) {
                            $total = $nominal1 + $nominal2 + $nominal3;
                            if ($total_harga == $total) {
                                if ($jahit->status_pembayaran == 'Termin 1') {
                                    $pembayaran = new PembayaranJahit();
                                    $pembayaran->jahit_id = $jahit->id;
                                    $pembayaran->status = "Termin 2";
                                    $pembayaran->nominal = $nominal2;
                                    $pembayaran->save();

                                    $pembayaran = new PembayaranJahit();
                                    $pembayaran->jahit_id = $jahit->id;
                                    $pembayaran->status = "Termin 3";
                                    $pembayaran->nominal = $nominal3;
                                    $pembayaran->save();
                                } elseif ($jahit->status_pembayaran == 'Termin 2') {
                                    $pembayaran = new PembayaranJahit();
                                    $pembayaran->jahit_id = $jahit->id;
                                    $pembayaran->status = "Termin 3";
                                    $pembayaran->nominal = $nominal3;
                                    $pembayaran->save();
                                }
                                $status = 'Lunas';
                                $jahit->total_bayar = $total;
                                $jahit->sisa_bayar = 0;
                                $jahit->status_pembayaran = "Lunas";
                                $jahit->save();
                            }
                        } else  if ($nominal1 > 0 && $nominal2 > 0) {
                            $total = $nominal1 + $nominal2;
                            if ($total == $total_harga) {
                                $status = 'Lunas';
                            } else {
                                $status = 'Termin 2';
                            }
                            $sisa =  $total_harga - $total;
                            $jahit->total_bayar = $total;
                            $jahit->sisa_bayar = $sisa;
                            $jahit->status_pembayaran = $status;
                            $jahit->save();

                            $pembayaran = new PembayaranJahit();
                            $pembayaran->jahit_id = $jahit->id;
                            $pembayaran->status = "Termin 2";
                            $pembayaran->nominal = $nominal2;
                            $pembayaran->save();
                        }
                    }
                } else {
                    $pembayaran1 = $request->get('pembayaran1');
                    $cuci = Cuci::findOrFail($id);


                    if ($pembayaran1 == 'Termin 1') {



                        if ($nominal1 > 0 && $nominal2 > 0 && $nominal3 > 0) {
                            $total = $nominal1 + $nominal2 + $nominal3;
                            if ($total_harga == $total) {
                                if ($cuci->status_pembayaran == 'Termin 1') {
                                    $pembayaran = new PembayaranCuci();
                                    $pembayaran->cuci_id = $cuci->id;
                                    $pembayaran->status = "Termin 2";
                                    $pembayaran->nominal = $nominal2;
                                    $pembayaran->save();

                                    $pembayaran = new PembayaranCuci();
                                    $pembayaran->cuci_id = $cuci->id;
                                    $pembayaran->status = "Termin 3";
                                    $pembayaran->nominal = $nominal3;
                                    $pembayaran->save();
                                } elseif ($cuci->status_pembayaran == 'Termin 2') {
                                    $pembayaran = new PembayaranCuci();
                                    $pembayaran->cuci_id = $cuci->id;
                                    $pembayaran->status = "Termin 3";
                                    $pembayaran->nominal = $nominal3;
                                    $pembayaran->save();
                                }
                                $status = 'Lunas';
                                $cuci->total_bayar = $total;
                                $cuci->sisa_bayar = 0;
                                $cuci->status_pembayaran = "Lunas";
                                $cuci->save();
                            }
                        } else  if ($nominal1 > 0 && $nominal2 > 0) {
                            $total = $nominal1 + $nominal2;
                            if ($total == $total_harga) {
                                $status = 'Lunas';
                            } else {
                                $status = 'Termin 2';
                            }
                            $sisa =  $total_harga - $total;
                            $cuci->total_bayar = $total;
                            $cuci->sisa_bayar = $sisa;
                            $cuci->status_pembayaran = $status;
                            $cuci->save();

                            $pembayaran = new PembayaranCuci();
                            $pembayaran->cuci_id = $cuci->id;
                            $pembayaran->status = "Termin 2";
                            $pembayaran->nominal = $nominal2;
                            $pembayaran->save();
                        }
                    }
                }
                DB::commit();
                return redirect()->route('pembayaran.index')->with('success', 'Data pembayaran berhasil diupdate');
            } catch (\Exception $th) {
                //throw $th;
                dd($th);
                DB::rollBack();
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

        $cuci = Cuci::all();
        $jahit = Jahit::all()->where('vendor', 'eksternal');
        $arr = [];

        // $cuci = Cuci::findOrFail($request->get('id'));
        $titlecuci = [
            'Asal',
            'Kode Transaksi',
            'Nama Produk',
            'SKU',
            'Kategori',
            'Sub Kategori',
            'Detail Sub Kategori',
            'Nama Vendor',
            'Harga Vendor',
            'Jumlah Bahan di Cuci',
            'Status Pembayaran',
            'Total Harga',
            'Sisa Bayar'
        ];

        $titlejahit = [
            'Asal',
            'Kode Transaksi',
            'Nama Produk',
            'SKU',
            'Kategori',
            'Sub Kategori',
            'Detail Sub Kategori',
            'Nama Vendor',
            'Harga Vendor',
            'Jumlah Bahan di Jahit',
            'Status Pembayaran',
            'Total Harga',
            'Sisa Bayar'
        ];



        foreach ($cuci as $key => $value) {
            $x['menu'] = 'CUCI';
            $x['kode_bahan'] = $value->jahit->potong->bahan->kode_transaksi;
            $x['title'] = $titlecuci;
            $x['data'] = [
                'Cuci',
                $value->jahit->potong->bahan->kode_transaksi,
                $value->jahit->potong->bahan->nama_bahan,
                $value->jahit->potong->bahan->sku,
                $value->jahit->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori,
                $value->jahit->potong->bahan->detail_sub->sub_kategori->nama_kategori,
                $value->jahit->potong->bahan->detail_sub->nama_kategori,
                $value->nama_vendor,
                $value->harga_vendor,
                $value->kain_siap_cuci,
                $value->status_pembayaran,
                $value->total_bayar,
                $value->sisa_bayar,
            ];
            array_push($arr, $x);
        }


        foreach ($jahit as $key => $value) {
            $x['menu'] = 'JAHIT';
            $x['kode_bahan'] = $value->potong->bahan->kode_transaksi;
            $x['title'] = $titlejahit;
            $x['data'] = [
                'Jahit',
                $value->potong->bahan->kode_transaksi,
                $value->potong->bahan->nama_bahan,
                $value->potong->bahan->sku,
                $value->potong->bahan->detail_sub->sub_kategori->kategori->nama_kategori,
                $value->potong->bahan->detail_sub->sub_kategori->nama_kategori,
                $value->potong->bahan->detail_sub->nama_kategori,
                $value->nama_vendor,
                $value->harga_vendor,
                $value->jumlah_bahan,
                $value->status_pembayaran,
                $value->total_bayar,
                $value->sisa_bayar,
            ];
            array_push($arr, $x);
        }
        $pdf = PDF::loadView('backend.pembayaran.pdf', ['print' => $arr]);
        return $pdf->stream('pembayaran.pdf');
    }

    public function convertToAngkaRp($harga)
    {
        $hasil = str_replace('.', '', $harga);
        $hasil = str_replace('Rp. ', '', $hasil);
        $hasil = str_replace(',00', '', $hasil);
        return (float)$hasil;
    }

    public function convertToAngka($harga)
    {
        $hasil = str_replace('.', '', $harga);
        return (float)$hasil;
    }
}
