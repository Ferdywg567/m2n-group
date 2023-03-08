<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishingDibuangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finishing_dibuangs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('finishing_id')->unsigned()->index()->nullable();
            $table->foreign('finishing_id')->references('id')->on('finishings')->onDelete('cascade');
            $table->string('ukuran');
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
        Schema::dropIfExists('finishing_dibuangs');
    }
}
