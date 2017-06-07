<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaPagadorMediosPago extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_pagador', function (Blueprint $table) {
            $table->string('medio_pago_id',1)->after('tipo_persona_id');
            $table->foreign('medio_pago_id')->references('id')->on('medios_pago')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('nu_medio_pago')->after('medio_pago_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poliza_pagador', function (Blueprint $table) {
            //
        });
    }
}
