<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function finishing()
    {
        return $this->belongsTo(Finishing::class)->withTrashed();
    }

    public function detail_warehouse()
    {
        return $this->hasMany(DetailWarehouse::class)->withTrashed();
    }

    public function rekapitulasi_warehouse()
    {
        return $this->hasOne(RekapitulasiWarehouse::class);
    }

    public function produk()
    {
        return $this->hasOne(Produk::class);
    }
    
    public function getJumlahUkuranAttribute(){
        return $this->detail_warehouse()->sum('jumlah');
    }
}
