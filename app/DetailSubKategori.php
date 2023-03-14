<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSubKategori extends Model
{
    public function sub_kategori()
    {
        return $this->belongsTo('App\SubKategori');
    }

    public function bahan()
    {
        return $this->hasMany('App\Bahan');
    }
}
