<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailRekapitulasi extends Model
{
    public function rekapitulasi()
    {
        return $this->belongsTo('App\Rekapitulasi');
    }

}
