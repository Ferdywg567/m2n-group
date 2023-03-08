<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alamat extends Model
{
    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
