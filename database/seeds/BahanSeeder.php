<?php

use Illuminate\Database\Seeder;
use App\Bahan;
use Faker\Factory;
use Illuminate\Support\Arr;
use App\DetailSubKategori;

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
        $status = ['bahan masuk', 'bahan keluar'];
        $vendor = ['Triple A', 'J. Developer', 'Kaos Polos Surabaya', 'Chief Garment', 'Quax Kain'];
        $warna = ['blue', 'red', 'maroon', 'green', 'yellow'];
        $nama = ['kaos polos', 'polo bersaku', 'kaos polo bersaku', 'polo polos'];
        $jenis = ['Cotton Combed 38s', 'Cotton Combed 28s', 'Cotton Combed 23s', 'Cotton Combed 14s'];
        for ($i = 0; $i <= 250; $i++) {
            $bahan = new Bahan();
            $bahan->detail_sub_kategori_id = Arr::random([1, 2]);
            $bahan->kode_transaksi = $this->getKode($i);
            $bahan->kode_bahan = '#B00' . $i;
            $bahan->no_surat = '#SJM00' . $i;
            $bahan->status = Arr::random($status);
            $bahan->tanggal_masuk = $faker->dateTimeBetween('-2 month', '+0 days');
            if ($bahan->status == 'bahan keluar') {
                $bahan->sku = '#SKU00' . $i;
                $bahan->tanggal_keluar = $faker->dateTimeBetween('-50 days', '+2 days');
            }
            $bahan->nama_bahan = Arr::random($nama);
            $bahan->warna = Arr::random($warna);
            $bahan->jenis_bahan = Arr::random($jenis);
            $bahan->vendor = Arr::random($vendor);
            $bahan->panjang_bahan = $faker->numberBetween(40, 200);
            $bahan->save();
        }
    }

    public function getKode($i)
    {
        $kode_transaksi = Bahan::select('kode_transaksi')->whereNotNull('kode_transaksi')->orderBy('created_at', 'DESC')->first();
        $jumlah = $i + 1;
        $datakode = "TR-" . date('Ymd') . $jumlah;

        return $datakode;
    }
}
