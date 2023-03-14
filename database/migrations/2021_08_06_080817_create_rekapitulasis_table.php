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
            $table->bigInteger('jahit_id')->unsigned()->index()->nullable();
            $table->foreign('jahit_id')->references('id')->on('jahits')->onDelete('cascade');
            $table->integer('jumlah_diperbaiki')->nullable();
            $table->integer('jumlah_dibuang')->nullable();
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
