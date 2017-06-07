<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaPagador extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_pagador', function (Blueprint $table) {
            $table->string('ramo_id',3)->after('canal_id')->nullable();
            $table->foreign('ramo_id')->references('id')->on('ramos')->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('producto_id')->after('ramo_id')->nullable();
            $table->foreign('producto_id')->references('id')->on('productos')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('plan_id',3)->after('producto_id')->nullable();
            $table->foreign('plan_id')->references('id')->on('planes')->OnDelete('cascade')->OnUpdate('cascade');
            $table->string('frecuencia_pago_id',3)->after('plan_id')->nullable();
            $table->foreign('frecuencia_pago_id')->references('id')->on('frecuencia_pago')->OnDelete('cascade')->OnUpdate('cascade');
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
