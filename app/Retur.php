<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Retur extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function detail_retur()
    {
        return $this->hasMany(DetailRetur::class)->withTrashed();
    }

    public function finishing()
    {
        return $this->belongsTo(Finishing::class)->withTrashed();
    }
}
