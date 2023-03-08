<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sampah extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function detail_sampah()
    {
        return $this->hasMany(DetailSampah::class)->withTrashed();
    }

    public function jahit()
    {
        return $this->belongsTo(Jahit::class)->withTrashed();
    }
    public function cuci()
    {
        return $this->belongsTo(Cuci::class)->withTrashed();
    }
}
