<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use Illuminate\Support\Arr;
use App\DetailPotong;
use App\Potong;
use App\Bahan;

class PotongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $bahan = Bahan::doesntHave('potong')->where('status', 'bahan keluar')->get();
        $status = ['potong masuk','potong keluar'];
        $status_potong = ['proses potong','belum potong'];
        $ukuran = ['S','L','M','XL','XXL'];
        foreach ($bahan as $key => $value) {
            $potong = new Potong();
            $potong->bahan_id = $value->id;
            $potong->no_surat = '#SMN00'.$faker->unique()->numberBetween(1, 300);
            $potong->status = Arr::random($status);
            $potong->tanggal_cutting = $faker->dateTimeBetween('-2 month', '-4 days');
            $potong->tanggal_selesai = $faker->dateTimeBetween('-40 days', '+2 days');
            if($potong->status == 'potong masuk'){
                $potong->status_potong = Arr::random($status_potong);
            }else{
                $potong->hasil_cutting = $value->panjang_bahan-1;
                $potong->tanggal_keluar = $faker->dateTimeBetween('-20 days', '+3 days');
                $potong->konversi = $this->konversi($potong->hasil_cutting);
                $potong->status_potong = 'selesai';
            }
            $potong->save();
            if($potong->status == 'potong keluar'){
                foreach ($ukuran as $key => $row) {
                    $detail = new DetailPotong();
                    $detail->potong_id = $potong->id;
                    $detail->size = $row;
                    $detail->jumlah = round($potong->hasil_cutting / 5);
                    $detail->save();
                }
            }
        }
    }

    public function konversi($data){
        $lusin = 12;
        $sisa = $data%$lusin;
        $hasil = ($data - $sisa) / $lusin;
        $res = $hasil.' Lusin '.$sisa.' pcs';

        return $res;
    }
}
