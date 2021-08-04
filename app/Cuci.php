<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuci extends Model
{
    public function jahit()
    {
        return $this->belongsTo('App\Jahit');
    }

    public function detail_cuci()
    {
        return $this->hasMany('App\DetailCuci');
    }
}
