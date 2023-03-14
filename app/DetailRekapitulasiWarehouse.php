<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailRekapitulasiWarehouse extends Model
{
    public function rekapitulasi_warehouse()
    {
        return $this->belongsTo('App\RekapitulasiWarehouse');
    }

}
