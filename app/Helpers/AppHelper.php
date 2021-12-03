<?php

namespace App\Helpers;

use App\Keranjang;
use DateTime;
use App\Favorit;
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

    function time_elapsed_string($datetime, $full = false) {
        $now = new DateTime;
        $ago = new DateTime($datetime);
        $diff = $now->diff($ago);

        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'tahun',
            'm' => 'bulan',
            'w' => 'minggu',
            'd' => 'hari',
            'h' => 'jam',
            'i' => 'menit',
            's' => 'detik',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v ;
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
    }

    public function favorit_data($iduser, $idproduk){
        $status =false;
        $favorit = Favorit::where('user_id', $iduser)->where('produk_id',$idproduk)->first();

        if($favorit){
            $status = true;
        }

        return $status;
    }
}
