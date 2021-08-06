<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rekapitulasi extends Model
{
    public function cuci()
    {
        return $this->belongsTo('App\Cuci');
    }

    public function detail_cuci()
    {
        return $this->belongsTo('App\DetailCuci');
    }
}
