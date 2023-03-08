<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubKategori extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class)->withTrashed();
    }

    public function detail_sub()
    {
        return $this->hasMany(DetailSubKategori::class)->withTrashed();
    }
}
