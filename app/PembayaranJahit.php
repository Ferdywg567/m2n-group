<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PembayaranJahit extends Model
{
    public function jahit()
    {
        return $this->belongsTo('App\Jahit');
    }
}
