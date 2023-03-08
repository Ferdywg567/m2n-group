<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JahitDibuang extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function jahit()
    {
        return $this->belongsTo(Jahit::class)->withTrashed();
    }
}
