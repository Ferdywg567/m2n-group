<?php

namespace App\Helpers;

use App\Keranjang;

class AppHelper
{
    public function total_keranjang()
    {
        $jumlah = Keranjang::where('user_id', auth()->user()->id)->count();
        return $jumlah;
    }


    public static function instance()
    {
        return new AppHelper();
    }


    public function data_keranjang()
    {
        $keranjang = Keranjang::where('user_id', auth()->user()->id)->get();
        return $keranjang;
    }

    public function rupiah($data)
    {
        return "Rp. ".number_format($data, 2, ',', '.');
    }
}
