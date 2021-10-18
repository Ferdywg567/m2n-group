<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public function finishing()
    {
        return $this->belongsTo('App\Finishing');
    }

    public function detail_warehouse()
    {
        return $this->hasMany('App\DetailWarehouse');
    }

    public function rekapitulasi_warehouse()
    {
        return $this->hasOne('App\RekapitulasiWarehouse');
    }

    public function getJumlahUkuranAttribute(){
        return $this->detail_warehouse()->sum('jumlah');
    }
}
