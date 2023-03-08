<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RekapitulasiWarehouse extends Model
{
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->withTrashed();
    }


    public function detail_rekap_warehouse()
    {
        return $this->hasMany(DetailRekapitulasiWarehouse::class);
    }
}
