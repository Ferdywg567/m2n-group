<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jahit extends Model
{
    public function potong()
    {
        return $this->belongsTo('App\Potong');
    }
}
