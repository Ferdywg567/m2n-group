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
use App\DetailRekapitulasi;
use App\Rekapitulasi;

class RekapitulasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cuci = Cuci::where('status', 'cucian keluar')->where('status_cuci', 'selesai')->get();
        $faker = Factory::create();
        foreach ($cuci as $key => $value) {
            $rekap = new Rekapitulasi();
            $rekap->cuci_id = $value->id;
            $rekap->total_barang = $value->berhasil_cuci;
            $rekap->tanggal_masuk = $value->jahit->potong->bahan->tanggal_masuk;
            $rekap->tanggal_kirim = $faker->dateTimeBetween('-7 days', '-1 days');

            $rekap->save();

            foreach ($value->detail_cuci as $key => $row) {
                $detail = new DetailRekapitulasi();
                $detail->rekapitulasi_id = $rekap->id;
                $detail->ukuran = $row->size;
                $detail->jumlah = $row->jumlah;
                $detail->save();
            }
        }
    }
}
