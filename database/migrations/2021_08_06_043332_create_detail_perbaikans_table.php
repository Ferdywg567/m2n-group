<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailPerbaikansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_perbaikans', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('perbaikan_id')->unsigned()->index()->nullable();
            $table->foreign('perbaikan_id')->references('id')->on('perbaikans')->onDelete('cascade');
            $table->bigInteger('jahit_direpair_id')->unsigned()->index()->nullable();
            $table->foreign('jahit_direpair_id')->references('id')->on('jahit_direpairs')->onDelete('cascade');
            $table->bigInteger('cuci_direpair_id')->unsigned()->index()->nullable();
            $table->foreign('cuci_direpair_id')->references('id')->on('cuci_direpairs')->onDelete('cascade');
            $table->integer('jumlah');
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('detail_perbaikans');
    }
}
