<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retur extends Model
{
    use SoftDeletes;
    public function detail_retur()
    {
        return $this->hasMany('App\DetailRetur');
    }

    public function finishing()
    {
        return $this->belongsTo('App\Finishing');
    }
}
