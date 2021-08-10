<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekapitulasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekapitulasis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cuci_id')->unsigned()->index()->nullable();
            $table->foreign('cuci_id')->references('id')->on('cucis')->onDelete('cascade');
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_kirim')->nullable();
            $table->integer('total_barang')->default(0);
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
        Schema::dropIfExists('rekapitulasis');
    }
}
