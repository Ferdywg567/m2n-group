<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promo extends Model
{
    use SoftDeletes;
    public function produk()
    {
        return $this->hasMany('App\Produk');
    }
}
