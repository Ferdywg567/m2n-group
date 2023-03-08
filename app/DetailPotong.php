<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailPotong extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function potong()
    {
        return $this->belongsTo(Potong::class)->withTrashed();
    }
}
