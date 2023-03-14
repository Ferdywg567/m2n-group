<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProduk extends Model
{
    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }
}
