<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaksi extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function detail_transaksi()
    {
        return $this->hasMany('App\DetailTransaksi');
    }

    public function bank()
    {
        return $this->belongsTo('App\Bank');
    }

    public function alamat()
    {
        return $this->belongsTo('App\Alamat');
    }
}
