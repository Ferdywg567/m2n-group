<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RekapitulasiWarehouse extends Model
{
    use SoftDeletes;
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }


    public function detail_rekap_warehouse()
    {
        return $this->hasMany('App\DetailRekapitulasiWarehouse');
    }
}
