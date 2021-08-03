<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jahit extends Model
{
    public function potong()
    {
        return $this->belongsTo('App\Potong');
    }

    public function detail_jahit()
    {
        return $this->hasMany('App\DetailJahit');
    }
    public function jahit_dibuang()
    {
        return $this->hasMany('App\JahitDibuang');
    }
    public function jahit_direpair()
    {
        return $this->hasMany('App\JahitDirepair');
    }
}
