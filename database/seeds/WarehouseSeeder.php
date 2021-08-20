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
class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kirim = Finishing::where('status', 'kirim warehouse')->doesntHave('warehouse')->get();
        $faker = Factory::create();
        foreach ($kirim as $key => $value) {
            $warehouse = new Warehouse();
            $warehouse->finishing_id = $value->id;
            $warehouse->harga_produk = $faker->numberBetween(50000,100000);
            $warehouse->tanggal_masuk = $value->tanggal_masuk;
            $warehouse->save();
            foreach ($value->detail_finish as $key => $row) {
                $detail = new DetailWarehouse();
                $detail->warehouse_id = $warehouse->id;
                $detail->ukuran = $row->ukuran;
                $detail->jumlah = $row->jumlah;
                $detail->save();
            }
        }
    }
}
