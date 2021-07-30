<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bahan extends Model
{
    public function potong()
    {
        return $this->hasOne('App\Potong');
    }
    
}
