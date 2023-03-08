<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPotongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_potongs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('potong_id')->unsigned()->index()->nullable();
            $table->foreign('potong_id')->references('id')->on('potongs')->onDelete('cascade');
            $table->string('size');
            $table->integer('jumlah');
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
        Schema::dropIfExists('detail_potongs');
    }
}
