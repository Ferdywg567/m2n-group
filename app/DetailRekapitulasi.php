<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailRekapitulasi extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function rekapitulasi()
    {
        return $this->belongsTo(Rekapitulasi::class)->withTrashed();
    }

}
