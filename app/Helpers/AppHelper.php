<?php

namespace App\Helpers;

use App\Keranjang;
use Illuminate\Support\Carbon;

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
        return "Rp. " . number_format($data, 2, ',', '.');
    }

    public function nama_header($nama)
    {
        $parts = explode(' ', $nama);
        $name_first = array_shift($parts);
        return $name_first;
    }

    public function tanggal_add($tanggal)
    {
        $date = Carbon::parse($tanggal);
        $daysToAdd = 2;
        $date = $date->addDays($daysToAdd);
        $date = $date->format('d M H:i');
        return $date;
    }
}
