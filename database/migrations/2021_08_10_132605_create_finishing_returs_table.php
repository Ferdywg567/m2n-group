<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishingRetursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finishing_returs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('finishing_id')->unsigned()->index()->nullable();
            $table->foreign('finishing_id')->references('id')->on('finishings')->onDelete('cascade');
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
        Schema::dropIfExists('finishing_returs');
    }
}
