<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailRekapitulasiWarehouse extends Model
{
    use SoftDeletes;
    public function rekapitulasi_warehouse()
    {
        return $this->belongsTo('App\RekapitulasiWarehouse');
    }
}
