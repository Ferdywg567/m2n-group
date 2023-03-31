<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPerbaikan extends Model
{

    protected $guarded = [];

    public function perbaikan()
    {
        return $this->belongsTo('App\Perbaikan');
    }

    public function jahit_repair(){
        return $this->belongsTo(JahitDirepair::class, 'jahit_direpair_id');
    }

    public function cuci_repair(){
        return $this->belongsTo(CuciDirepair::class, 'cuci_direpair_id');
    }
}
