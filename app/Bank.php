<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $fillable = ['nama_penerima','nama_bank','nomor_rekening','logo'];
}
