<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FinishingDibuang extends Model
{
    public function finishing()
    {
        return $this->belongsTo('App\Finishing');
    }
}
