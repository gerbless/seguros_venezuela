<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AltersDatosRiesgoAsegurables1 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('datos_riesgo_asegurables', function (Blueprint $table) {
            $table->string('tipo_riesgo_id',1)->after('id');
            $table->foreign('tipo_riesgo_id')->references('id')->on('tipo_riesgo')->OnDelete('cascade')->OnUpdate('cascade');
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
