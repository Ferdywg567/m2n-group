<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuciDibuang extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function cuci()
    {
        return $this->belongsTo(Cuci::class)->withTrashed();
    }
}
