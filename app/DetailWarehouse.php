<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailWarehouse extends Model
{
    use SoftDeletes;
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }
}
