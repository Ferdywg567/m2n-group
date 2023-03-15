<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JahitDibuang extends Model
{
    public function jahit()
    {
        return $this->belongsTo('App\Jahit');
    }
}
