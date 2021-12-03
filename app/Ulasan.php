<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
