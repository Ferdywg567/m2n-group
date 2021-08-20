<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use App\Potong;
use App\Jahit;
use App\DetailJahit;
use App\JahitDibuang;
use App\JahitDirepair;
use Faker\Factory;

class JahitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datakeluar = Potong::where('status', 'potong keluar')->where('status_potong', 'selesai')->doesntHave('jahit')->get();
        $faker = Factory::create();
        $vendor = ['internal', 'eksternal'];
        $bayar = ['lunas', 'belum'];
        $status_jahit = ['proses jahit', 'belum jahit'];
        $status = ['jahitan masuk', 'jahitan keluar'];
        $namavendor = ['Triple A', 'J. Developer', 'Kaos Polos Surabaya', 'Chief Garment', 'Quax Kain'];
        foreach ($datakeluar as $key => $value) {
            $jahit = new Jahit();
            $jahit->potong_id = $value->id;
            $jahit->no_surat = '#SKN00' . $faker->unique()->numberBetween(1, 300);
            $jahit->status = Arr::random($status);
            $jahit->tanggal_jahit = $faker->dateTimeBetween('-18 days', '-1 days');
            $jahit->tanggal_selesai = $faker->dateTimeBetween('-15 days', '+2 days');
            if ($jahit->status == 'jahitan keluar') {
                $jahit->berhasil = $value->hasil_cutting - 10;
                $jahit->konversi = $this->konversi($jahit->berhasil);
                $jahit->status_jahit = 'selesai';
                $jahit->gagal_jahit = 10;
                $jahit->barang_direpair = 5;
                $jahit->barang_dibuang = 5;
                $jahit->keterangan_direpair = "masih ada yang sobek";
                $jahit->keterangan_dibuang = "kerusakan jahitan terlalu parah";
            } else {
                $jahit->status_jahit = Arr::random($status_jahit);
            }

            $jahit->vendor = Arr::random($vendor);

            if ($jahit->vendor == 'eksternal') {
                $jahit->nama_vendor =  Arr::random($namavendor);
                $jahit->harga_vendor = $faker->numberBetween(20000, 100000);
                $jahit->status_pembayaran = Arr::random($bayar);
            }


            $jahit->save();

            foreach ($value->detail_potong as $key => $row) {
                $detail = new DetailJahit();
                $detail->jahit_id = $jahit->id;
                $detail->size = $row->size;
                $detail->jumlah = $row->jumlah - 2;
                $detail->save();

                $detail = new JahitDirepair();
                $detail->jahit_id = $jahit->id;
                $detail->ukuran = $row->size;
                $detail->jumlah = 1;
                $detail->save();

                $detail = new JahitDibuang();
                $detail->jahit_id = $jahit->id;
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
