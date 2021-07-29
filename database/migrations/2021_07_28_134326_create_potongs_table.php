<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePotongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('potongs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bahan_id')->unsigned()->index()->nullable();
            $table->foreign('bahan_id')->references('id')->on('bahans')->onDelete('cascade');
            $table->string('no_surat');
            $table->date('tanggal_cutting')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->float('hasil_cutting');
            $table->string('konversi');
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
        Schema::dropIfExists('potongs');
    }
}
