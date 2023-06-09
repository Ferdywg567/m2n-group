<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCucisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cucis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jahit_id')->unsigned()->index()->nullable();
            $table->foreign('jahit_id')->references('id')->on('jahits')->onDelete('cascade');
            $table->string('no_surat');
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_cuci')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->integer('kain_siap_cuci');
            $table->string('vendor');
            $table->string('nama_vendor')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->float('harga_vendor')->nullable();
            $table->integer('berhasil_cuci')->nullable();
            $table->string('konversi')->nullable();
            $table->integer('gagal_cuci')->nullable();
            $table->integer('barang_direpair')->nullable();
            $table->integer('barang_dibuang')->nullable();
            $table->integer('barang_akan_direpair')->nullable();
            $table->integer('barang_akan_dibuang')->nullable();
            $table->longText('keterangan_direpair')->nullable();
            $table->longText('keterangan_dibuang')->nullable();
            $table->integer('total_bayar')->nullable()->default(0);
            $table->integer('sisa_bayar')->nullable();
            $table->integer('total_harga')->nullable();
            $table->string('status');
            $table->string('status_cuci');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cucis');
    }
}
