<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailRetur extends Model
{
    public function retur()
    {
        $this->belongsTo('App\Retur');
    }
}
