<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailProduk extends Model
{
    use SoftDeletes;
    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }
}
