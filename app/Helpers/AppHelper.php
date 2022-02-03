<?php

namespace App\Helpers;

use App\Keranjang;
use DateTime;
use App\Favorit;
use App\Produk;
use App\Transaksi;
use App\Ulasan;
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
        $format = "Rp. " . number_format($data, 2, ',', '.');
        $format = str_replace(',00','',$format);
        return $format;
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

    function time_elapsed_string($datetime, $full = false)
    {
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
                $v = $diff->$k . ' ' . $v;
            } else {
                unset($string[$k]);
            }
        }

        if (!$full) $string = array_slice($string, 0, 1);
        return $string ? implode(', ', $string) . ' yang lalu' : 'baru saja';
    }

    public function favorit_data($iduser, $idproduk)
    {
        $status = false;
        $favorit = Favorit::where('user_id', $iduser)->where('produk_id', $idproduk)->first();

        if ($favorit) {
            $status = true;
        }

        return $status;
    }


    public function avg_ulasan($idproduk)
    {
        $jumlah = Ulasan::where('produk_id', $idproduk)->count();
        $jumlahulasan = Ulasan::where('produk_id', $idproduk)->sum('rating');
        $avg = 0;
        if ($jumlah > 0 && $jumlahulasan > 0) {
            $avg = $jumlahulasan / $jumlah;
        }

        return $avg;
    }

    public function jumlah_ulasan($idproduk)
    {
        $jumlah = Ulasan::where('produk_id', $idproduk)->count();

        return $jumlah;
    }


    public function jumlah_pesanan($idproduk)
    {
        $jumlah = Transaksi::where('status', 'telah tiba')->whereHas('detail_transaksi', function ($q) use ($idproduk) {
            return $q->where('produk_id', $idproduk);
        })->count();

        return $jumlah;
    }

    public function ukuran($idproduk)
    {
        $ukuran = [];
        $produk = Produk::findOrFail($idproduk);
        $target = ["S", "L", "M"];
        $detail = $produk->detail_produk->pluck('ukuran')->toArray();
        $seri = false;
        $harga_seri = 0;
        if (in_array('S', $detail) && in_array('M', $detail) && in_array('L', $detail)) {
            $seri = true;
            // $harga_seri = $produk->detail_produk->whereIn('ukuran', $target)->avg('harga');
            $detail = $produk->detail_produk->whereNotIn('ukuran', $target)->pluck('ukuran');
            $res = [];
            $x[] = 'S,M,L';
            if ($detail->isNotEmpty()) {
                $res = $detail->toArray();

                $data = array_merge($x, $res);
            } else {
                $data =  $x;
            }

            $ukuran = $data;
        } else {
            $detail = $produk->detail_produk->pluck('ukuran');
            if ($detail->isNotEmpty()) {
                $ukuran = $detail->toArray();
            }
        }

        return $ukuran;
    }
}
