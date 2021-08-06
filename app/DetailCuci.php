<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailCuci extends Model
{
    public function cuci()
    {
        return $this->belongsTo('App\Cuci');
    }

    public function rekapitulasi()
    {
        return $this->hasOne('App\Rekapitulasi');
    }
}
