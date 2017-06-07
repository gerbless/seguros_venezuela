<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaDirec1A extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_asegurados', function (Blueprint $table) {
            $table->dropColumn('tx_direccion');
            $table->integer('direccion_id')->unsigned()->after('ff_registro');;
            $table->foreign('direccion_id')->references('id')->on('direcciones')->OnDelete('cascade')->OnUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poliza_asegurados', function (Blueprint $table) {
            //
        });
    }
}
