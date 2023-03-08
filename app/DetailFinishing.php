<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailFinishing extends Model
{
    use SoftDeletes;
    
    protected $dates = ['deleted_at'];

    public function finishing()
    {
        return $this->belongsTo(Finishing::class)->withTrashed();
    }
}
