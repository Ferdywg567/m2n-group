<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    public function produk()
    {
        return $this->hasMany('App\Produk');
    }
}
