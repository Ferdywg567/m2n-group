<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sampah extends Model
{
    use SoftDeletes;

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
