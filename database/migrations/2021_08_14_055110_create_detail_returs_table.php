<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRetursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_returs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('retur_id')->unsigned()->index()->nullable();
            $table->foreign('retur_id')->references('id')->on('returs')->onDelete('cascade');
            $table->string('ukuran');
            $table->integer('jumlah');
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
        Schema::dropIfExists('detail_returs');
    }
}
