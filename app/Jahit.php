<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Jahit extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function potong()
    {
        return $this->belongsTo(Potong::class)->withTrashed();
    }

    public function detail_jahit()
    {
        return $this->hasMany(DetailJahit::class)->withTrashed();
    }
    public function jahit_dibuang()
    {
        return $this->hasMany(JahitDibuang::class)->withTrashed();
    }
    public function jahit_direpair()
    {
        return $this->hasMany(JahitDirepair::class)->withTrashed();
    }

    public function cuci()
    {
        return $this->hasOne(Cuci::class)->withTrashed();
    }

    public function sampah()
    {
        return $this->hasOne(Sampah::class)->withTrashed();
    }
    public function rekap()
    {
        return $this->hasOne(Rekapitulasi::class)->withTrashed();
    }

    public function pembayaran_jahit()
    {
        return $this->hasMany(PembayaranJahit::class)->withTrashed();
    }
}