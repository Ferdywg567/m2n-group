<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubKategori extends Model
{
    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    public function detail_sub()
    {
        return $this->hasMany('App\DetailSubKategori');
    }
}
