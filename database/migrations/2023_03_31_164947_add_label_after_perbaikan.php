<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLabelAfterPerbaikan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cucis', function(Blueprint $table) {
            $table->string('status_perbaikan', 20);
        });

        Schema::table('jahits', function(Blueprint $table) {
            $table->string('status_perbaikan', 20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cucis', function(Blueprint $table) {
            $table->dropColumn('status_perbaikan');
        });

        Schema::table('jahits', function(Blueprint $table) {
            $table->dropColumn('status_perbaikan');
        });
    }
}
