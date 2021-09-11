<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSampahsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sampahs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sampah_id')->unsigned()->index()->nullable();
            $table->foreign('sampah_id')->references('id')->on('sampahs')->onDelete('cascade');
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
        Schema::dropIfExists('detail_sampahs');
    }
}
