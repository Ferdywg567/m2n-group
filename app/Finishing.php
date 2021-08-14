<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finishing extends Model
{
    public function rekapitulasi()
    {
        return $this->belongsTo('App\Rekapitulasi');
    }


    public function detail_finish()
    {
        return $this->hasMany('App\DetailFinishing');
    }

    public  function finish_retur()
    {
        return $this->hasMany('App\FinishingRetur');
    }

    public  function finish_dibuang()
    {
        return $this->hasMany('App\FinishingDibuang');
    }

    public function warehouse()
    {
        return $this->hasOne('App\Warehouse');
    }

    public function retur()
    {
        $this->hasOne('App\Retur');
    }
}
