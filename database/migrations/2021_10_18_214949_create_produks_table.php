<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProduksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_produk')->unique();
            $table->bigInteger('promo_id')->unsigned()->index()->nullable();
            $table->foreign('promo_id')->references('id')->on('promos')->onDelete('cascade');
            $table->bigInteger('warehouse_id')->unsigned()->index()->nullable();
            $table->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->string('barcode', 20)->unique()->nullable();
            $table->string('nama_produk')->nullable();
            $table->longText('deskripsi_produk')->nullable();
            $table->integer('stok');
            $table->integer('harga')->default(0);
            $table->integer('harga_promo')->default(0);
            $table->string('status')->nullable();
            $table->string('kategori')->nullable();
            $table->string('sub_kategori')->nullable();
            $table->string('detail_sub_kategori')->nullable();
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
        Schema::dropIfExists('produks');
    }
}
