<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailRetur extends Model
{
    use SoftDeletes;
    public function retur()
    {
        $this->belongsTo('App\Retur');
    }
}
