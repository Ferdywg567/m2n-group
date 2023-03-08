<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Perbaikan extends Model
{
    public function bahan()
    {
        return $this->belongsTo(Bahan::class);
    }

    public function detail_perbaikan()
    {
        return $this->hasMany(DetailPerbaikan::class);
    }
}
