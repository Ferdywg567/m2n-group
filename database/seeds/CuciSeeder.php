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

class CuciSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jahit = Jahit::where('status', 'jahitan keluar')->where('status_jahit', 'selesai')->doesntHave('cuci')->get();
        $faker = Factory::create();
        $vendor = ['internal', 'eksternal'];
        $bayar = ['lunas', 'belum'];
        $status_cuci = ['proses cuci', 'belum cuci'];
        $status = ['cucian masuk', 'cucian keluar'];
        $namavendor = ['Triple A', 'J. Developer', 'Kaos Polos Surabaya', 'Chief Garment', 'Quax Kain'];
        foreach ($jahit as $key => $value) {
            $cuci = new Cuci();
            $cuci->jahit_id = $value->id;
            $cuci->no_surat = '#SLN00' . $faker->unique()->numberBetween(1, 300);
            $cuci->status = Arr::random($status);
            $cuci->kain_siap_cuci = $value->berhasil;
            $cuci->tanggal_masuk = $value->potong->bahan->tanggal_masuk;
            $cuci->tanggal_cuci = $faker->dateTimeBetween('-14 days', '-1 days');
            $cuci->tanggal_selesai = $faker->dateTimeBetween('-13 days', '+3 days');
            if ($cuci->status == 'cucian keluar') {
                $cuci->berhasil_cuci = $value->berhasil - 10;
                $cuci->konversi = $this->konversi($cuci->berhasil_cuci);
                $cuci->status_cuci = 'selesai';
                $cuci->gagal_cuci = 10;
                $cuci->barang_direpair = 5;
                $cuci->barang_dibuang = 5;
                $cuci->keterangan_direpair = "cucian kurang bersih";
                $cuci->keterangan_dibuang = "warna kain luntur";
            } else {
                $cuci->status_cuci = Arr::random($status_cuci);
            }

            $cuci->vendor = Arr::random($vendor);

            if ($cuci->vendor == 'eksternal') {
                $cuci->nama_vendor =  Arr::random($namavendor);
                $cuci->harga_vendor = $faker->numberBetween(20000, 100000);
                $cuci->status_pembayaran = Arr::random($bayar);
            }
            $cuci->save();

            foreach ($value->detail_jahit as $key => $row) {
                $detail = new DetailCuci();
                $detail->cuci_id = $cuci->id;
                $detail->size = $row->size;
                $detail->jumlah = $row->jumlah - 2;
                $detail->save();

                $detail = new CuciDirepair();
                $detail->cuci_id = $cuci->id;
                $detail->ukuran = $row->size;
                $detail->jumlah = 1;
                $detail->save();

                $detail = new CuciDibuang();
                $detail->cuci_id = $cuci->id;
                $detail->ukuran = $row->size;
                $detail->jumlah = 1;
                $detail->save();
            }
        }
    }

    public function konversi($data)
    {
        $lusin = 12;
        $sisa = $data % $lusin;
        $hasil = ($data - $sisa) / $lusin;
        $res = $hasil . ' Lusin ' . $sisa . ' pcs';

        return $res;
    }
}
