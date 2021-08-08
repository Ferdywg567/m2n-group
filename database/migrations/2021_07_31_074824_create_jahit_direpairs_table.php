<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJahitDirepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jahit_direpairs', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('jahit_id')->unsigned()->index()->nullable();
            $table->foreign('jahit_id')->references('id')->on('jahits')->onDelete('cascade');
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
        Schema::dropIfExists('jahit_direpairs');
    }
}