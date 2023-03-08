<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cuci extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function jahit()
    {
        return $this->belongsTo(Jahit::class)->withTrashed();
    }

    public function detail_cuci()
    {
        return $this->hasMany(DetailCuci::class)->withTrashed();
    }

    public function cuci_direpair()
    {
        return $this->hasMany(CuciDirepair::class)->withTrashed();
    }

    public function cuci_dibuang()
    {
        return $this->hasMany(CuciDibuang::class)->withTrashed();
    }

    public function finishing()
    {
        return $this->hasOne(Finishing::class)->withTrashed();
    }

    public function sampah()
    {
        return $this->hasOne(Sampah::class)->withTrashed();
    }

    public function rekap()
    {
        return $this->hasOne(Rekapitulasi::class)->withTrashed();
    }
    
    public function pembayaran_cuci()
    {
        return $this->hasMany(PembayaranCuci::class)->withTrashed();
    }
}
