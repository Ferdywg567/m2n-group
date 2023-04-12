<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailSampah extends Model
{
    use SoftDeletes;
    protected $guarded = [];

    public function sampah()
    {
        return $this->belongsTo('App\Sampah');
    }
}
