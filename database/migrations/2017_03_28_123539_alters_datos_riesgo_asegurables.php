<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltersDatosRiesgoAsegurables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datos_riesgo_asegurables', function (Blueprint $table) {
            $table->integer('clientes_id')->unsigned()->after('id');
            $table->foreign('clientes_id')->references('id')->on('clientes')->OnDelete('cascade')->OnUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('datos_riesgo_asegurables', function (Blueprint $table) {
            //
        });
    }
}
