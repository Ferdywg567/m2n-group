<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Favorit extends Model
{
    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }
}
