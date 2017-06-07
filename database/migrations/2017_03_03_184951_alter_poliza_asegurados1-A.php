<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaAsegurados1A extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_asegurados', function (Blueprint $table) {
            $table->string('nacionalidad_id',1)->after('nb_nombre');
            $table->foreign('nacionalidad_id')->references('id')->on('nacionalidad')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('tipo_persona_id',1)->after('tx_direccion');
            $table->foreign('tipo_persona_id')->references('id')->on('tipo_persona')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('nivel_educativo_id')->unsigned()->after('ff_ultima_actualizacion');
            $table->foreign('nivel_educativo_id')->references('id')->on('nivel_educativo')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('ocupacion_id')->unsigned()->after('nivel_educativo_id');
            $table->foreign('ocupacion_id')->references('id')->on('ocupacion')->OnDelete('cascade')->OnUpdate('cascade');
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
