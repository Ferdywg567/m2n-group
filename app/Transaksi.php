<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
   public function detail_transaksi()
   {
       return $this->hasMany('App\DetailTransaksi');
   }

   public function bank()
   {
       return $this->belongsTo('App\Bank');
   }
}
