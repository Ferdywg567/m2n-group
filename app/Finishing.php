<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Finishing extends Model
{
   public function cuci()
   {
       return $this->belongsTo('App\Rekapitulasi');
   }
}
