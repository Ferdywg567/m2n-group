<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailCuci extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cuci()
    {
        return $this->belongsTo(Cuci::class)->withTrashed();
    }

    public function rekapitulasi()
    {
        return $this->hasOne(Rekapitulasi::class)->withTrashed();
    }
}
