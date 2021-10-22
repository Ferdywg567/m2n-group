<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailTransaksi extends Model
{
    public function transaksi()
    {
        return $this->belongsTo('App\Transaksi');
    }
}
