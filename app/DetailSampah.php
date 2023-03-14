<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailSampah extends Model
{
    protected $guarded = [];

    public function sampah()
    {
        return $this->belongsTo('App\Sampah');
    }
}
