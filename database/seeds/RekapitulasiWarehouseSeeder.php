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
use App\DetailWarehouse;
use App\Rekapitulasi;
use App\Warehouse;
use App\Finishing;
use App\RekapitulasiWarehouse;
use App\DetailRekapitulasiWarehouse;

class RekapitulasiWarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouse = Warehouse::doesntHave('rekapitulasi_warehouse')->get();
        $faker = Factory::create();
        foreach ($warehouse as $key => $value) {
            $rekap = new RekapitulasiWarehouse();
            $rekap->warehouse_id = $value->id;
            $rekap->total_barang = $value->detail_warehouse->sum('jumlah');
            $rekap->tanggal_masuk =  $faker->dateTimeBetween('-37 days', '+10 days');
            $rekap->tanggal_kirim = $faker->dateTimeBetween('+11 days', '+20 days');

            $rekap->save();

            foreach ($value->detail_warehouse as $key => $row) {
                $detail = new DetailRekapitulasiWarehouse();
                $detail->rekapitulasi_warehouse_id = $rekap->id;
                $detail->ukuran = $row->ukuran;
                $detail->jumlah = $row->jumlah;
                $detail->save();
            }
        }
    }
}
