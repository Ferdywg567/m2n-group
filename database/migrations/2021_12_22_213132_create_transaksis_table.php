<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransaksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bank_id')->unsigned()->index()->nullable();
            $table->foreign('bank_id')->references('id')->on('banks')->onDelete('cascade');
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('alamat_id')->unsigned()->index()->nullable();
            $table->foreign('alamat_id')->references('id')->on('alamats')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('alamat')->nullable();
            $table->string('no_resi')->nullable();
            $table->double('ongkir')->nullable();
            $table->string('kode_transaksi')->unique();
            $table->timestamp('tgl_transaksi');
            $table->integer('qty')->default(0);
            $table->double('total_harga');
            $table->string('status_transaksi');
            $table->string('status')->nullable();
            $table->string('status_bayar')->nullable();
            $table->string('bukti_bayar')->nullable();
            $table->string('pembayaran')->nullable();
            $table->double('bayar')->nullable();
            $table->double('kembalian')->nullable();
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
        Schema::dropIfExists('transaksis');
    }
}
