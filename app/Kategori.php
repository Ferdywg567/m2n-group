<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public function sub_kategori()
    {
        return $this->hasMany('App\SubKategori');
    }
}
