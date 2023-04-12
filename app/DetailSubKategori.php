<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailSubKategori extends Model
{
    use SoftDeletes;
    public function sub_kategori()
    {
        return $this->belongsTo('App\SubKategori');
    }

    public function bahan()
    {
        return $this->hasMany('App\Bahan');
    }
}
