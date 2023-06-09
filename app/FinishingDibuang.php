<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinishingDibuang extends Model
{
    use SoftDeletes;
    public function finishing()
    {
        return $this->belongsTo('App\Finishing');
    }
}
