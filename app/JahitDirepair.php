<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JahitDirepair extends Model
{
    use SoftDeletes;
    public function jahit()
    {
        return $this->belongsTo('App\Jahit');
    }

    public function detail_perbaikan(){
        return $this->hasMany(DetailPerbaikan::class);
    }
}
