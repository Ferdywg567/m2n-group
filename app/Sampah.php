<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{


    public function detail_sampah()
    {
        return $this->hasMany('App\DetailSampah');
    }

    public function jahit()
    {
        return $this->belongsTo('App\Jahit');
    }
    public function cuci()
    {
        return $this->belongsTo('App\Cuci');
    }
}
