<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    public function warehouse()
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function promo()
    {
        return $this->belongsTo(Promo::class);
    }

    public function detail_gambar()
    {
        return $this->hasMany(DetailProdukImage::class);
    }

    public function detail_produk()
    {
        return $this->hasMany(DetailProduk::class);
    }

    public function detail_transaksi()
    {
        return $this->hasMany(DetailTransaksi::class);
    }

    public function keranjang()
    {
        return $this->hasMany(Keranjang::class, 'produk_id','id');
    }

    public function favorit()
    {
        return $this->hasMany(Favorit::class);
    }

    public function ulasan()
    {
        return $this->hasMany(Ulasan::class);
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
