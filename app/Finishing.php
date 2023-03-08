<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Finishing extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function rekapitulasi()
    {
        return $this->belongsTo(Rekapitulasi::class)->withTrashed();
    }

    public function detail_finish()
    {
        return $this->hasMany(DetailFinishing::class)->withTrashed();
    }

    public  function finish_retur()
    {
        return $this->hasMany(FinishingRetur::class)->withTrashed();
    }

    public  function finish_dibuang()
    {
        return $this->hasMany(FinishingDibuang::class)->withTrashed();
    }

    public function warehouse()
    {
        return $this->hasOne(Warehouse::class)->withTrashed();
    }

    public function retur()
    {
        $this->hasOne(Retur::class)->withTrashed();
    }

    public function cuci()
    {
        return $this->belongsTo(Cuci::class)->withTrashed();
    }
}
