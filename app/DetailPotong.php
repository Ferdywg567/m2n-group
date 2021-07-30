<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPotong extends Model
{
    public function potong()
    {
        return $this->belongsTo('App\Potong');
    }
}
