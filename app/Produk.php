<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public function warehouse()
    {
        return $this->belongsTo('App\Warehouse');
    }

    public function promo()
    {
        return $this->belongsTo('App\Promo');
    }

    public function detail_gambar()
    {
        return $this->hasMany('App\DetailProdukImage');
    }

    public function detail_produk()
    {
        return $this->hasMany('App\DetailProduk');
    }

    public function detail_transaksi()
    {
        return $this->hasMany('App\DetailTransaksi');
    }

    public function keranjang()
    {
        return $this->hasOne('App\Keranjang');
    }

    public function favorit()
    {
        return $this->hasMany('App\Favorit');
    }

    public function ulasan()
    {
        return $this->hasMany('App\Ulasan');
    }
}
