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
}
