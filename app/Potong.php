<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Potong extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function bahan()
    {
        return $this->belongsTo(Bahan::class)->withTrashed();
    }

    public function detail_potong()
    {
        return $this->hasMany(DetailPotong::class)->withTrashed();
    }

    public function jahit()
    {
        return $this->hasOne(Jahit::class)->withTrashed();
    }
}
