<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CuciDirepair extends Model
{
    use SoftDeletes;
    public function cuci()
    {
        return $this->belongsTo('App\Cuci');
    }

    public function detail_perbaikan(){
        return $this->hasMany(DetailPerbaikan::class);
    }
}
