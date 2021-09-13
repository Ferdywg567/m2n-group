<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Kategori;
use App\SubKategori;
use App\DetailSubKategori;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arrkat = ['Pria', 'Wanita'];
        for ($i = 0; $i < 2; $i++) {
            $kategori = new Kategori();
            $kategori->nama_kategori = $arrkat[$i];
            $kategori->sku = "SKU00" . $i + 1;
            $kategori->save();
        }
        $kategori = Kategori::all();
        foreach ($kategori as $key => $value) {
            $sub = new SubKategori();
            $sub->kategori_id = $value->id;
            $sub->nama_kategori = "Kemeja";
            $sub->sku = $value->sku . '/' . $key + 1;
            $sub->save();
        }

        $sub = SubKategori::all();
        $kemeja = ['Kemeja Lengan Panjang', 'Kemeja Lengan Pendek'];
        foreach ($sub as $key => $value) {
            $detail = new DetailSubKategori();
            $detail->sub_kategori_id = $value->id;
            $detail->nama_kategori = $kemeja[$key];
            $detail->sku = $value->sku . '/' . $key + 1;
            $detail->save();
        }
    }
}
