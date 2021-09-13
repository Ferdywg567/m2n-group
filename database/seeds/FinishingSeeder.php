<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Potong;
use App\Jahit;
use App\DetailJahit;
use App\JahitDibuang;
use App\JahitDirepair;
use Faker\Factory;
use App\Cuci;
use App\CuciDibuang;
use App\CuciDirepair;
use App\DetailCuci;
use App\DetailFinishing;
use App\DetailRekapitulasi;
use App\Rekapitulasi;
use App\Finishing;
use App\FinishingDibuang;
use App\FinishingRetur;

class FinishingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rekap = Cuci::doesntHave('finishing')->get();
        $faker = Factory::create();
        $status = ['finishing masuk', 'kirim warehouse'];
        foreach ($rekap as $key => $value) {
            $finish = new Finishing();
            $finish->cuci_id = $value->id;
            $finish->no_surat = '#SIN00' . $faker->unique()->numberBetween(1, 300);
            $finish->status = Arr::random($status);
            if($finish->status == 'kirim warehouse'){
                $finish->barang_lolos_qc = $value->berhasil_cuci - 10;
                $finish->tanggal_selesai = $faker->dateTimeBetween('-5 days', '+4 days');
            }else{
                $finish->barang_lolos_qc = 0;
            }
            $finish->tanggal_masuk = $faker->dateTimeBetween('-12 days', '+4 days');
            $finish->tanggal_qc = $faker->dateTimeBetween('-12 days', '+4 days');

            $finish->barang_gagal_qc = 10;
            $finish->barang_diretur = 5;
            $finish->barang_dibuang = 5;
            $finish->keterangan_diretur = "jahitan lepas";
            $finish->keterangan_dibuang = "warna kain luntur terlalu parah";
            $finish->save();


            if($finish->status == 'kirim warehouse'){
                DetailFinishing::where('finishing_id',$finish->id)->delete();
                foreach ($value->detail_cuci as $key => $row) {
                    $detail = new DetailFinishing();
                    $detail->finishing_id = $finish->id;
                    $detail->ukuran = $row->size;
                    $detail->jumlah = $row->jumlah - 2;
                    $detail->save();

                    $detail = new FinishingRetur();
                    $detail->finishing_id = $finish->id;
                    $detail->ukuran = $row->size;
                    $detail->jumlah = 1;
                    $detail->save();

                    $detail = new FinishingDibuang();
                    $detail->finishing_id = $finish->id;
                    $detail->ukuran = $row->size;
                    $detail->jumlah = 1;
                    $detail->save();
                }
            }else{
                foreach ($value->detail_cuci as $key => $row) {
                    $detail = new DetailFinishing();
                    $detail->finishing_id = $finish->id;
                    $detail->ukuran = $row->size;
                    $detail->jumlah = $row->jumlah - 2;
                    $detail->save();
                }
            }
        }
    }
}
