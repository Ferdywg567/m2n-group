<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerbaikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('perbaikans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('bahan_id')->unsigned()->index()->nullable();
            $table->foreign('bahan_id')->references('id')->on('bahans')->onDelete('cascade');
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_kirim')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('total')->default(0);
            $table->string('ukuran');
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
        Schema::dropIfExists('perbaikans');
    }
}
