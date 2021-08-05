<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    public function potong()
    {
        return $this->hasOne('App\Potong');
    }

    public function perbaikan()
    {
        return $this->hasMany('App\Perbaikan');
    }
}
