<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJahitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jahits', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('potong_id')->unsigned()->index()->nullable();
            $table->foreign('potong_id')->references('id')->on('potongs')->onDelete('cascade');
            $table->string('no_surat');
            $table->date('tanggal_jahit')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->date('tanggal_keluar')->nullable();
            $table->string('vendor')->nullable();
            $table->string('nama_vendor')->nullable();
            $table->float('harga_vendor')->nullable();
            $table->integer('berhasil')->nullable();
            $table->integer('jumlah_bahan')->nullable();
            $table->string('konversi')->nullable();
            $table->integer('gagal_jahit')->nullable();
            $table->integer('barang_direpair')->nullable();
            $table->integer('barang_dibuang')->nullable();
            $table->longText('keterangan_direpair')->nullable();
            $table->longText('keterangan_dibuang')->nullable();
            $table->string('status_pembayaran')->nullable();
            $table->integer('total_bayar')->nullable()->default(0);
            $table->integer('sisa_bayar')->nullable();
            $table->integer('total_harga')->nullable();
            $table->string('status');
            $table->string('status_jahit');
            $table->softDeletes();
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
        Schema::dropIfExists('jahits');
    }
}
