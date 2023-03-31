<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JahitDirepair extends Model
{
    public function jahit()
    {
        return $this->belongsTo('App\Jahit');
    }

    public function detail_perbaikan(){
        return $this->hasMany(DetailPerbaikan::class);
    }
}
