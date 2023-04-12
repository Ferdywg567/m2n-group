<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubKategori extends Model
{
    use SoftDeletes;
    public function kategori()
    {
        return $this->belongsTo('App\Kategori');
    }

    public function detail_sub()
    {
        return $this->hasMany('App\DetailSubKategori');
    }
}
