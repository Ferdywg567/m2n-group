<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailJahit extends Model
{
    public function jahit()
    {
        return $this->belongsTo('App\Jahit');
    }
}
