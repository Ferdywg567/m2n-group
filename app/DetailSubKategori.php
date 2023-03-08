<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetailSubKategori extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function sub_kategori()
    {
        return $this->belongsTo(SubKategori::class)->withTrashed();
    }

    public function bahan()
    {
        return $this->hasMany(Bahan::class)->withTrashed();
    }
}
