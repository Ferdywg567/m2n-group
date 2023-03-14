<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBahansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('detail_sub_kategori_id')->unsigned()->index()->nullable();
            $table->foreign('detail_sub_kategori_id')->references('id')->on('detail_sub_kategoris')->onDelete('cascade');
            $table->string('kode_transaksi')->nullable();
            $table->string('kode_bahan');
            $table->string('no_surat');
            $table->string('sku')->nullable();
            $table->string('nama_bahan');
            $table->string('jenis_bahan');
            $table->string('warna');
            $table->integer('panjang_bahan');
            $table->integer('panjang_bahan_diambil')->nullable();
            $table->integer('sisa_bahan')->nullable();
            $table->string('vendor');
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bahans');
    }
}
