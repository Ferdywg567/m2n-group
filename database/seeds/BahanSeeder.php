<?php

use Illuminate\Database\Seeder;
use App\Bahan;
use Faker\Factory;
use Illuminate\Support\Arr;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $status =['bahan masuk', 'bahan keluar'];
        $vendor =['Triple A', 'J. Developer', 'Kaos Polos Surabaya', 'Chief Garment', 'Quax Kain'];
        $warna =['blue', 'red', 'maroon', 'green', 'yellow'];
        $nama =['kaos polos', 'polo bersaku', 'kaos polo bersaku', 'polo polos'];
        $jenis =['Cotton Combed 38s', 'Cotton Combed 28s', 'Cotton Combed 23s', 'Cotton Combed 14s'];
        for ($i = 0; $i <= 30; $i++) {
            $bahan = new Bahan();
            $bahan->kode_bahan = '#B00' . $i;
            $bahan->no_surat = '#SJM00' . $i;
            $bahan->status = Arr::random($status);
            $bahan->tanggal_masuk = $faker->dateTimeBetween('-7 days', '+0 days');
            if ($bahan->status == 'bahan keluar') {
                $bahan->sku = '#SKU00' . $i;
                $bahan->tanggal_keluar = $faker->dateTimeBetween('+0 days', '+2 days');
            }
            $bahan->nama_bahan = Arr::random($nama);
            $bahan->warna = Arr::random($warna);
            $bahan->jenis_bahan = Arr::random($jenis);
            $bahan->vendor = Arr::random($vendor);
            $bahan->panjang_bahan = $faker->numberBetween(1,30);
            $bahan->save();

        }
    }
}
