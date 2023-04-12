<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranCuci extends Model
{
    use SoftDeletes;
    public function cuci()
    {
        return $this->belongsTo('App\Cuci');
    }
}
