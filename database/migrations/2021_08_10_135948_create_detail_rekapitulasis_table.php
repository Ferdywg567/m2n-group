<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRekapitulasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_rekapitulasis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rekapitulasi_id')->unsigned()->index()->nullable();
            $table->foreign('rekapitulasi_id')->references('id')->on('rekapitulasis')->onDelete('cascade');
            $table->string('ukuran');
            $table->integer('jumlah');
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
        Schema::dropIfExists('detail_rekapitulasis');
    }
}