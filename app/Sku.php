<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sku extends Model
{
    use SoftDeletes;
    public function bahan()
    {
        return $this->hasOne('App\Bahan');
    }
}
