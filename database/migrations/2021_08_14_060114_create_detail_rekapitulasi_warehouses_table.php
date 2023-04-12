<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRekapitulasiWarehousesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_rekapitulasi_warehouses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('rekapitulasi_warehouse_id')->unsigned()->index()->nullable();
            $table->foreign('rekapitulasi_warehouse_id')->references('id')->on('rekapitulasi_warehouses')->onDelete('cascade');
            $table->string('ukuran');
            $table->string('status');
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
        Schema::dropIfExists('detail_rekapitulasi_warehouses');
    }
}
