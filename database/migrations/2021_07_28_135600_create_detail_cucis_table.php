<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailCucisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_cucis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cuci_id')->unsigned()->index()->nullable();
            $table->foreign('cuci_id')->references('id')->on('cucis')->onDelete('cascade');
            $table->string('size');
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
        Schema::dropIfExists('detail_cucis');
    }
}
