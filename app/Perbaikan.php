<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    public function bahan()
    {
        return $this->belongsTo('App\Bahan');
    }

    public function detail_perbaikan()
    {
        return $this->hasMany('App\DetailPerbaikan');
    }
}
