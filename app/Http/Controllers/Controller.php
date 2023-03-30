<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function convertNumber($harga)
    {
        $hasil = str_replace('Rp', '', $harga);
        $hasil = str_replace(',00', '', $hasil);
        $hasil = str_replace('.', '', $hasil);
        $hasil = str_replace(' ', '', $hasil);
        return (float) $hasil;
    }
}
