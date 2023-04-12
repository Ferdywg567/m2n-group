<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JahitDibuang extends Model
{
    use SoftDeletes;
    public function jahit()
    {
        return $this->belongsTo('App\Jahit');
    }
}
