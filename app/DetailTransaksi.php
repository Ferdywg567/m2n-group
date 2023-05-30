<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailTransaksi extends Model
{
    use SoftDeletes;
    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi');
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }
}
