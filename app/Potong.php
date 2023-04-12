<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Potong extends Model
{
    use SoftDeletes;
    public function bahan()
    {
        return $this->belongsTo('App\Bahan');
    }

    public function detail_potong()
    {
        return $this->hasMany('App\DetailPotong');
    }

    public function jahit()
    {
        return $this->hasOne('App\Jahit');
    }
}
