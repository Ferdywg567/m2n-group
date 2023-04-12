<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    use SoftDeletes;
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
        return $this->hasMany('App\Keranjang', 'produk_id', 'id');
    }

    public function favorit()
    {
        return $this->hasMany('App\Favorit');
    }

    public function ulasan()
    {
        return $this->hasMany('App\Ulasan');
    }

    public function get_ukuran($produk)
    {
        $target = ["S", "L", "M"];
        $detail = $produk->detail_produk->pluck('ukuran')->toArray();
        $harga_seri = 0;
        $arrdetail = [];
        if (in_array('S', $detail) && in_array('M', $detail) && in_array('L', $detail)) {
            $harga_seri = $produk->detail_produk->whereIn('ukuran', $target)->avg('harga');
            $resdetail = $produk->detail_produk->whereNotIn('ukuran', $target);
            $res = [
                ['ukuran' => 'S,M,L', 'harga' => $harga_seri]
            ];
            foreach ($resdetail as $key => $value) {
                $y['ukuran'] = $value->ukuran;
                $y['harga'] = $value->harga;
                array_push($res, $y);
            }
            $arrdetail = $res;
        } else {
            $resdetail = $produk->detail_produk;
            $arrdetail = $resdetail;
        }

        return $arrdetail;
    }
}
