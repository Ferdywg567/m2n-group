<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Perbaikan extends Model
{
    use SoftDeletes;
    public function bahan()
    {
        return $this->belongsTo('App\Bahan');
    }

    public function detail_perbaikan()
    {
        return $this->hasMany('App\DetailPerbaikan');
    }
}
