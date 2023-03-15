<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailProdukImage extends Model
{
    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }
}
