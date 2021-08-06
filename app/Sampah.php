<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sampah extends Model
{
    public function bahan()
    {
        return $this->belongsTo('App\Bahan');
    }

    public function detail_sampah()
    {
        return $this->hasMany('App\DetailSampah');
    }
}
