<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailWarehouse extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class)->withTrashed();
    }
}
