<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\DetailRekapitulasi;
use App\Cuci;
use App\Jahit;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rekapitulasi extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    
    public function detail_rekap()
    {
        return $this->hasMany(DetailRekapitulasi::class)->withTrashed();
    }

    public function jahit()
    {
        return $this->belongsTo(Jahit::class)->withTrashed();
    }
    public function cuci()
    {
        return $this->belongsTo(Cuci::class)->withTrashed();
    }

    public static function generateRekap()
    {
        $cuci = Cuci::all()->where('status','cucian keluar');
        $jahit = Jahit::all()->where('status','jahitan keluar');
        DB::beginTransaction();
        try {
            if($cuci->isNotEmpty()){
                foreach ($cuci as $key => $value) {

                    $rekapdata = Rekapitulasi::where('cuci_id', $value->id)->first();
                    if ($rekapdata) {
                        $rekapdata->jumlah_dibuang = $value->barang_dibuang;
                        $rekapdata->jumlah_diperbaiki = $value->barang_direpair;
                    } else {
                        $rekapdata = new Rekapitulasi();
                        $rekapdata->cuci_id =  $value->id;
                        $rekapdata->jumlah_dibuang = $value->barang_dibuang;
                        $rekapdata->jumlah_diperbaiki = $value->barang_direpair;
                    }
                    $rekapdata->save();
                    $detail = DetailRekapitulasi::where('rekapitulasi_id', $rekapdata->id)->where('status','dibuang')->delete();
                    foreach ($value->cuci_dibuang as $key => $row) {

                        $detail = new DetailRekapitulasi();
                        $detail->rekapitulasi_id = $rekapdata->id;
                        $detail->jumlah = $row->jumlah;
                        $detail->ukuran = $row->ukuran;
                        $detail->status = "dibuang";
                        $detail->save();
                    }
                    $detail = DetailRekapitulasi::where('rekapitulasi_id', $rekapdata->id)->where('status','direpair')->delete();
                    foreach ($value->cuci_direpair as $key => $row) {

                        $detail = new DetailRekapitulasi();
                        $detail->rekapitulasi_id = $rekapdata->id;
                        $detail->jumlah = $row->jumlah;
                        $detail->ukuran = $row->ukuran;
                        $detail->status = "direpair";
                        $detail->save();
                    }

                }
            }


            if($jahit->isNotEmpty()){
                foreach ($jahit as $key => $value) {

                    $rekapdata = Rekapitulasi::where('jahit_id', $value->id)->first();
                    if ($rekapdata) {
                        $rekapdata->jumlah_dibuang = $value->barang_dibuang;
                        $rekapdata->jumlah_diperbaiki = $value->barang_direpair;
                    } else {
                        $rekapdata = new Rekapitulasi();
                        $rekapdata->jahit_id =  $value->id;
                        $rekapdata->jumlah_dibuang = $value->barang_dibuang;
                        $rekapdata->jumlah_diperbaiki = $value->barang_direpair;
                    }
                    $rekapdata->save();
                    $detail = DetailRekapitulasi::where('rekapitulasi_id', $rekapdata->id)->where('status','dibuang')->delete();
                    foreach ($value->jahit_dibuang as $key => $row) {

                        $detail = new DetailRekapitulasi();
                        $detail->rekapitulasi_id = $rekapdata->id;
                        $detail->jumlah = $row->jumlah;
                        $detail->ukuran = $row->ukuran;
                        $detail->status = "dibuang";
                        $detail->save();
                    }
                    $detail = DetailRekapitulasi::where('rekapitulasi_id', $rekapdata->id)->where('status','direpair')->delete();
                    foreach ($value->jahit_direpair as $key => $row) {

                        $detail = new DetailRekapitulasi();
                        $detail->rekapitulasi_id = $rekapdata->id;
                        $detail->jumlah = $row->jumlah;
                        $detail->ukuran = $row->ukuran;
                        $detail->status = "direpair";
                        $detail->save();
                    }
                }
            }
            DB::commit();

        } catch (\Exception $th) {
            //throw $th;
            DB::rollBack();
            dd($th);
        }
    }
}
