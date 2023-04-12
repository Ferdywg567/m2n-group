<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ulasan extends Model
{
    use SoftDeletes;
    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
