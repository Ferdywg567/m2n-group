<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PembayaranCuci extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cuci()
    {
        return $this->belongsTo('App\Cuci')->withTrashed();
    }
}
