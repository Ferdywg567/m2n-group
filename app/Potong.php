<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Potong extends Model
{
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
