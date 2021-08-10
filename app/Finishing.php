<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finishing extends Model
{
   public function rekapitulasi()
   {
       return $this->belongsTo('App\Rekapitulasi');
   }


   public function detail_finish()
   {
       return $this->hasMany('App\DetailFinishing');
   }
}
