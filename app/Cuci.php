<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuci extends Model

{
    public function jahit()
    {
        return $this->belongsTo('App\Jahit');
    }

    public function detail_cuci()
    {
        return $this->hasMany('App\DetailCuci');
    }

    public function cuci_direpair()
    {
        return $this->hasMany('App\CuciDirepair');
    }

    public function cuci_dibuang()
    {
        return $this->hasMany('App\CuciDibuang');
    }

    public function finishing()
    {
        return $this->hasOne('App\Finishing');
    }

    public function sampah()
    {
        return $this->hasOne('App\Sampah');
    }
}
