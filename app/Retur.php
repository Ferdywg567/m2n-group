<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Retur extends Model
{
    public function detail_retur()
    {
        return $this->hasMany('App\DetailRetur');
    }

    public function finishing()
    {
        return $this->belongsTo('App\Finishing');
    }
}
