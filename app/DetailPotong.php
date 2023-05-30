<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPotong extends Model
{
    use SoftDeletes;
    public function potong()
    {
        return $this->belongsTo('App\Potong');
    }
}
