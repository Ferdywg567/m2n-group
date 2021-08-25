<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    public function bahan()
    {
        return $this->hasOne('App\Bahan');
    }
}
