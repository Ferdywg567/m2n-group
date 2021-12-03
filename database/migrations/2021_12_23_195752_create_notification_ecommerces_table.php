<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationEcommercesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notification_ecommerces', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('transaksi_id')->unsigned()->index()->nullable();
            $table->foreign('transaksi_id')->references('id')->on('transaksis')->onDelete('cascade');
            $table->string('pesan');
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
        Schema::dropIfExists('notification_ecommerces');
    }
}
