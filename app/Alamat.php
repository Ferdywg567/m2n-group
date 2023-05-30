<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Alamat extends Model
{
    use SoftDeletes;
    public function transaksi()
    {
        return $this->hasMany('App\Transaksi');
    }
}
