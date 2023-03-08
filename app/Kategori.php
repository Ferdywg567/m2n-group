<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Kategori extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function sub_kategori()
    {
        return $this->hasMany(SubKategori::class)->withTrashed();
    }
}
