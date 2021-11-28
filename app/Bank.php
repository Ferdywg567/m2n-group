<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['nama_penerima','nama_bank','nomor_rekening','logo'];

    public function transaksi()
    {
        return $this->hasMany('App\Transaksi');
    }
}
