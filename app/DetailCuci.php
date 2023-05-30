<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailCuci extends Model
{
    use SoftDeletes;
    public function cuci()
    {
        return $this->belongsTo('App\Cuci');
    }

    public function rekapitulasi()
    {
        return $this->hasOne('App\Rekapitulasi');
    }
}
