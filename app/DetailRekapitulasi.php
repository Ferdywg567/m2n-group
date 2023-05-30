<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailRekapitulasi extends Model
{
    use SoftDeletes;
    public function rekapitulasi()
    {
        return $this->belongsTo('App\Rekapitulasi');
    }
}
