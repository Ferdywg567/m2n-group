<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}
