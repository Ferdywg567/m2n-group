<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailSubKategorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_sub_kategoris', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('sub_kategori_id')->unsigned()->index()->nullable();
            $table->foreign('sub_kategori_id')->references('id')->on('sub_kategoris')->onDelete('cascade');
            $table->string('nama_kategori');
            $table->string('sku');
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
        Schema::dropIfExists('detail_sub_kategoris');
    }
}
