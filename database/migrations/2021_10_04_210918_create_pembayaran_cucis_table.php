<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranCucisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran_cucis', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cuci_id')->unsigned()->index()->nullable();
            $table->foreign('cuci_id')->references('id')->on('cucis')->onDelete('cascade');
            $table->string('status');
            $table->integer('nominal');
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
        Schema::dropIfExists('pembayaran_cucis');
    }
}
