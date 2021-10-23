<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi');
    }

    public function produk()
    {
        return $this->belongsTo('App\Produk');
    }
}
