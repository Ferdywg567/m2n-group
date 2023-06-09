<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinishingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finishings', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('cuci_id')->unsigned()->index()->nullable();
            $table->foreign('cuci_id')->references('id')->on('cucis')->onDelete('cascade');
            $table->string('no_surat');
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_qc')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('barang_lolos_qc');
            $table->integer('barang_gagal_qc')->nullable();
            $table->integer('barang_diretur')->nullable();
            $table->integer('barang_dibuang')->nullable();
            $table->longText('keterangan_diretur')->nullable();
            $table->longText('keterangan_dibuang')->nullable();
            $table->string('status')->nullable();
            $table->string('status_finishing')->nullable();
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
        Schema::dropIfExists('finishings');
    }
}
