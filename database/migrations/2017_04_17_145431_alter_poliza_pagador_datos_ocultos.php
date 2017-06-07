<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPolizaPagadorDatosOcultos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poliza_pagador', function (Blueprint $table) {
            $table->string('tipo_transaccion',1)->after('nu_medio_pago');
            $table->integer('operador_id')->after('tipo_transaccion');
            $table->integer('canal_id')->after('operador_id');
            $table->integer('sucursal_id')->after('canal_id');
            $table->string('userbanco',1)->after('sucursal_id');
            $table->string('userproveedor',1)->after('userbanco');
            $table->string('tipo_moneda_id',10)->after('userproveedor');

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
