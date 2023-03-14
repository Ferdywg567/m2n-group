<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranCuci extends Model
{
    public function cuci()
    {
        return $this->belongsTo('App\Cuci');
    }
}
